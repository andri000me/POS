<?php

namespace App\Controllers;

use App\Models\T_itemreceivingdetails;
use App\Controllers\Base_Controller;
use App\Enums\T_itemreceivingstatus;
use Core\Libraries\Datatables;
use App\Models\T_itemreceivings;
use App\Models\M_enumdetails;
use Core\Database\DbTrans;
use Core\Nayo_Exception;
use Core\Session;

class T_itemreceivingdetail extends Base_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index($iditem)
    {
        if ($this->hasPermission('m_item', 'Read')) {

            try {
                $result = T_itemreceivings::get($iditem);
                // if ($result->Status != T_itemreceivingstatus::NEW) {
                //     Nayo_Exception::throw("{$result->TransNo} Tidak bisa menambah barang, Status : " . M_enumdetails::getEnumName('ItemreceivingStatus', $result->Status), $result);
                // }

                $data['model'] = $result;

                $this->loadBlade('t_itemreceivingdetail.index', lang('Form.itemreceiving'), $data);
            } catch (Nayo_Exception $e) {
                Session::setFlash('add_warning_msg', array(0 => $e->messages));
                redirect("titemreceiving/edit/{$e->data->Id}")->with($e->data)->go();
            }
        }
    }

    public function add($iditem)
    {
        if ($this->hasPermission('m_item', 'Write')) {
            try {
                $result = T_itemreceivings::get($iditem);
                if ($result->Status != T_itemreceivingstatus::NEW) {
                    Nayo_Exception::throw("Tidak bisa menambah barang, Status : " . M_enumdetails::getEnumName('ItemreceivingStatus', $result->Status), $result);
                }

                $itemreceivings = new T_itemreceivingdetails($iditem);

                $data = setPageData_paging($itemreceivings);

                $data['item'] = $result;
                $this->loadBlade('t_itemreceivingdetail.add', lang('Form.itemreceiving'), $data);
            } catch (Nayo_Exception $e) {
                Session::setFlash('add_warning_msg', array(0 => $e->messages));
                redirect("titemreceivingdetail/{$e->data->Id}")->with($e->data)->go();
            }
        }
    }

    public function addsave()
    {

        if ($this->hasPermission('m_item', 'Write')) {

            $itemreceivings = new T_itemreceivingdetails();
            $itemreceivings->parseFromRequest();
            try {
                $result = T_itemreceivings::get($itemreceivings->T_Itemreceiving_Id);
                if ($result->Status != T_itemreceivingstatus::NEW) {
                    Nayo_Exception::throw("Tidak bisa menambah barang, Status : " . M_enumdetails::getEnumName('ItemreceivingStatus', $result->Status), $result);
                }
                $itemreceivings->validate();

                $itemreceivings->save();
                Session::setFlash('success_msg', array(0 => lang('Form.datasaved')));
                redirect("titemreceivingdetail/add/{$itemreceivings->T_Itemreceiving_Id}")->go();
            } catch (Nayo_Exception $e) {

                Session::setFlash('add_warning_msg', array(0 => $e->messages));
                redirect("titemreceivingdetail/add/{$itemreceivings->T_Itemreceiving_Id}")->with($itemreceivings)->go();
            }
        }
    }

    public function edit($id)
    {
        if ($this->hasPermission('m_item', 'Write')) {


            $itemreceivings = T_itemreceivingdetails::get($id);

            $result = T_itemreceivings::get($itemreceivings->T_Itemreceiving_Id);

            $data['model'] = $itemreceivings;
            $data['item'] = $result;
            $this->loadBlade('t_itemreceivingdetail.edit', lang('Form.itemreceiving'), $data);
        }
    }

    public function editsave()
    {

        if ($this->hasPermission('m_item', 'Write')) {

            $id = $this->request->post('Id');

            $itemreceivings = T_itemreceivingdetails::get($id);
            $oldmodel = clone $itemreceivings;

            $itemreceivings->parseFromRequest();

            try {
                $itemreceivings->validate($oldmodel);
                $itemreceivings->save();
                Session::setFlash('success_msg', array(0 => lang('Form.datasaved')));
                redirect("titemreceivingdetail/$itemreceivings->T_Itemreceiving_Id")->go();
            } catch (Nayo_Exception $e) {

                Session::setFlash('edit_warning_msg', array(0 => $e->messages));
                redirect("titemreceivingdetail/edit/$id")->with($e->data)->go();
            }
        }
    }


    public function delete()
    {

        $id = $this->request->post("id");
        if ($this->hasPermission('m_item', 'Delete')) {

            $model = T_itemreceivingdetails::get($id);
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

    public function getAllData($receivingid)
    {

        if ($this->hasPermission('m_item', 'Read')) {

            $params = [
                'where' => [
                    'T_Itemreceiving_Id' => $receivingid
                ],
                'join' => [
                    't_itemtransfers' => [
                        [
                            'table' => 't_itemreceivingdetails',
                            'column' => 'T_Itemtransfer_Id',
                            'type' => 'left'
                        ]

                    ], 
                    'm_shops' => [
                        [
                            'table' => 't_itemtransfers',
                            'column' => 'M_Shop_Id_From',
                            'type' => 'left'
                        ]
                    ]

                ]
            ];
            $datatable = new Datatables('T_itemreceivingdetails', $params);
            $datatable
                ->addDtRowClass("rowdetail")
                ->addColumn(
                    't_itemreceivingdetails.Id',
                    function ($row) {
                        return $row->Id;
                    },
                    false,
                    false
                )->addColumn(
                    't_itemtransfers.TransNo',
                    function($row){
                        return "<div id = {$row->Id}~a>". $row->get_T_Itemtransfer()->TransNo . "</div>";
                    }
                )->addColumn(
                    't_itemtransfers.TransDate',
                    function($row){
                        return get_formated_date($row->get_T_Itemtransfer()->TransDate, 'd-m-Y');
                    }
                )->addColumn(
                    'm_shops.Code',
                    function($row){
                        return $row->get_T_Itemtransfer()->get_M_Shop('From')->Code;
                    }
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

    public function getDataModal($iditem)
    {
        $params = array();
        if ($iditem > 0)
            $params = [
                'where' => [
                    'T_Itemreceiving_Id' => $iditem
                ]
            ];
        $datatable = new Datatables('T_itemreceivingdetails', $params);
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
                'NIK',
                function ($row) {
                    return $row->NIK;
                }
            )->addColumn(
                'T_Itemreceiving_Id',
                function ($row) {
                    return $row->get_M_Item()->getHeadFamily();
                }
            )->addColumn(
                'CompleteName',
                function ($row) {
                    return $row->CompleteName;
                }
            );

        echo json_encode($datatable->populate());
    }

    public function getDataById()
    {

        $id = $this->request->post("id");
        $role = $this->request->post("role");
        if ($this->hasPermission($role, 'Write')) {

            $model = T_itemreceivingdetails::get($id);
            if ($model) {
                $data = [
                    'data' => $model
                ];

                echo json_encode($data);
            } else {
                echo json_encode(deleteStatus("", FALSE, TRUE));
            }
        }
    }

    public function addDetailJson(){
        $id = $this->request->post("id");
        $detail = $this->request->post("detail");
        if(!empty($detail)){
            DbTrans::beginTransaction();
            try {
                foreach($detail as $d){
                    $details = new T_itemreceivingdetails();
                    $details->T_Itemreceiving_Id = $id;
                    $details->T_Itemtransfer_Id = $d;
                    $newid = $details->save();
                    if($newid){
                    
                    }
                    else {
                        Nayo_Exception::throw("Gagal Menambah Data");
                    }
                }

                DbTrans::commit();
                echo "true";
            } catch (Nayo_Exception $e){
                DbTrans::rollback();
                echo "false";
            }
        }
    }
}
