<?php

namespace App\Controllers;

use App\Models\M_shops;
use App\Controllers\Base_Controller;
use App\Models\G_transactionnumbers;
use App\Models\M_formsettings;
use Core\Libraries\Datatables;
use Core\Nayo_Exception;
use Core\Session;

class M_shop extends Base_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->hasPermission('m_shop', 'Read')) {
            $this->loadBlade('m_shop.index', lang('Form.shop'));
        }
    }

    public function add()
    {
        if ($this->hasPermission('m_shop', 'Write')) {
            $shops = new M_shops();
            $data = setPageData_paging($shops);
            $this->loadBlade('m_shop.add', lang('Form.shop'), $data);
        }
    }

    public function addsave()
    {

        if ($this->hasPermission('m_shop', 'Write')) {

            $shops = new M_shops();
            $shops->parseFromRequest();

            try {
                $shops->validate();
                $id = $shops->save();

                // create format number for new shop
                $tordermodel = M_formsettings::getTItemStockFormat();
                $params = [
                    'where' => [
                        "M_Form_Id" => $tordermodel->M_Form_Id
                    ]
                ];
                $existtrans = G_transactionnumbers::getOne($params);
                if($existtrans){

                    $gtransnumber = new G_transactionnumbers();
                    $gtransnumber->Format = $existtrans->Format;
                    $gtransnumber->Year = date("Y");
                    $gtransnumber->Month = date("n");
                    $gtransnumber->LastNumber = 0;
                    $gtransnumber->M_Form_Id = $tordermodel->M_Form_Id;
                    $gtransnumber->TypeTrans = $tordermodel->TypeTrans;
                    $gtransnumber->Branch = $id;
                    $gtransnumber->save();
                }
                // end of creating new shop format number

                Session::setFlash('success_msg', array(0 => lang('Form.datasaved')));
                redirect('mshop/add')->go();
            } catch (Nayo_Exception $e) {

                Session::setFlash('add_warning_msg', array(0 => $e->messages));
                redirect("mshop/add")->with($e->data)->go();
            }
        }
    }

    public function edit($id)
    {
        if ($this->hasPermission('m_shop', 'Write')) {

            $shops = M_shops::get($id);
            $data['model'] = $shops;
            $this->loadBlade('m_shop.edit', lang('Form.shop'), $data);
        }
    }

    public function editsave()
    {

        if ($this->hasPermission('m_shop', 'Write')) {
            $id = $this->request->post('Id');

            $shops = M_shops::get($id);
            $oldmodel = clone $shops;

            $shops->parseFromRequest();
            // echo json_encode($shops);

            try {
                $shops->validate($oldmodel);
                $shops->save();
                Session::setFlash('success_msg', array(0 => lang('Form.datasaved')));
                redirect('mshop')->go();
            } catch (Nayo_Exception $e) {

                Session::setFlash('edit_warning_msg', array(0 => $e->messages));
                redirect("mshop/edit/{$id}")->with($e->data)->go();
            }
        }
    }

    public function delete()
    {

        $id = $this->request->post("id");
        if ($this->hasPermission('m_shop', 'Delete')) {
            $model = M_shops::get($id);
            $result = $model->delete();
            if (!is_bool($result)) {
                $deletemsg = getDeleteErrorMessage();
                echo json_encode(deleteStatus($deletemsg, FALSE));
            } else {
                if ($result) {
                    $deletemsg = getDeleteMessage();
                    echo json_encode(deleteStatus($deletemsg));
                }
            }
        } else {
            echo json_encode(deleteStatus("", FALSE, TRUE));
        }
    }

    public function getAllData()
    {

        if ($this->hasPermission('m_shop', 'Read')) {

            $datatable = new Datatables('M_shops');
            $datatable
                ->addDtRowClass("rowdetail")
                ->addColumn(
                    'Id',
                    function ($row) {
                        return $row->Id;
                    },
                    false,
                    false
                )->addColumn(
                    'Code',
                    function ($row) {
                        return
                            formLink($row->Code, array(
                                "id" => $row->Id . "~a",
                                "href" => baseUrl('mshop/edit/' . $row->Id),
                                "class" => "text-muted"
                            ));
                    }
              
                )->addColumn(
                    'Name'
                )->addColumn(
                    'Email'
                )->addColumn(
                    'Phone'
                )->addColumn(
                    'Created',
                    null,
                    false
                )->addColumn(
                    'Action',
                    function ($row) {
                        return
                            formLink("<i class='fa fa-trash'></i>", array(
                                "href" => "#",
                                "class" => "btn-just-icon link-action delete",
                                "rel" => "tooltip",
                                "title" => lang('Form.delete')
                            ));
                    },
                    false,
                    false
                );

            echo json_encode($datatable->populate());
        }
    }

    private function getModal($params = []){

        $datatable = new Datatables('M_shops', $params);
        $datatable
            ->addDtRowClass("rowdetail")
            ->addColumn(
                'Id',
                function ($row) {
                    return $row->Id;
                },
                false,
                false
            )->addColumn(
                'Code',
                function ($row) {
                    return $row->Code;
                }
            )->addColumn(
                'Name',
                function ($row) {
                    return $row->Name;
                }
            );

        echo json_encode($datatable->populate());
    }

    public function getDataModal()
    {
        $this->getModal();
        
    }

    public function getItemTransferShopModal(){
        $notid = isset(Session::get(get_variable() . 'userdata')['M_Shop_Id']) ? Session::get(get_variable() . 'userdata')['M_Shop_Id'] : null;
        $params = [
            'whereNotIn' => [
                'Id' => [$notid]
            ]
        ];
        // echo json_encode($params);
        $this->getModal($params);
    }
}
