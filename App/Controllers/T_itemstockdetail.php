<?php

namespace App\Controllers;

use App\Models\T_itemstockdetails;
use App\Controllers\Base_Controller;
use Core\Libraries\Datatables;
use App\Models\T_itemstocks;
use App\Models\M_enumdetails;
use Core\Nayo_Exception;
use Core\Session;

class T_itemstockdetail extends Base_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index($iditem)
    {
        if ($this->hasPermission('m_item', 'Read')) {

            $result = T_itemstocks::get($iditem);
            $data['model'] = $result;

            $this->loadBlade('t_itemstockdetail.index', lang('Form.itemstock'), $data);
        }
    }

    public function add($iditem)
    {
        if ($this->hasPermission('m_item', 'Write')) {

            $result = T_itemstocks::get($iditem);

            $itemstocks = new T_itemstockdetails();

            $data = setPageData_paging($itemstocks);

            $data['item'] = $result;
            $this->loadBlade('t_itemstockdetail.add', lang('Form.itemstock'), $data);
        }
    }

    public function addsave()
    {

        if ($this->hasPermission('m_item', 'Write')) {


            $itemstocks = new T_itemstockdetails();
            $itemstocks->parseFromRequest();
            // $itemstocks->Ordering = T_itemstockdetails::getNextOrdering($itemstocks->M_Item_Id);

            try {
                $itemstocks->validate();

                $itemstocks->save();
                Session::setFlash('success_msg', array(0 => lang('Form.datasaved')));
                redirect("mitemstock/add/{$itemstocks->M_Item_Id}")->go();
            } catch (Nayo_Exception $e) {

                Session::setFlash('add_warning_msg', array(0 => $e->messages));
                redirect("mitemstock/add/{$itemstocks->M_Item_Id}")->with($itemstocks)->go();
            }
        }
    }

    public function edit($id)
    {
        if ($this->hasPermission('m_item', 'Write')) {


            $itemstocks = T_itemstockdetails::get($id);

            $items = new T_itemstocks();
            $result = T_itemstocks::get($itemstocks->M_Item_Id);

            $data['model'] = $itemstocks;
            $data['item'] = $result;
            $this->loadBlade('t_itemstockdetail.edit', lang('Form.itemstock'), $data);
        }
    }

    public function editsave()
    {

        if ($this->hasPermission('m_item', 'Write')) {

            $id = $this->request->post('Id');

            $itemstocks = T_itemstockdetails::get($id);
            $oldmodel = clone $itemstocks;

            $itemstocks->parseFromRequest();

            try {
                $itemstocks->validate($oldmodel);
                $itemstocks->save();
                Session::setFlash('success_msg', array(0 => lang('Form.datasaved')));
                redirect("mitemstock/$itemstocks->M_Item_Id")->go();
            } catch (Nayo_Exception $e) {

                Session::setFlash('edit_warning_msg', array(0 => $e->messages));
                redirect("mitemstock/edit/$id")->with($e->data)->go();
            }
        }
    }


    public function delete()
    {

        $id = $this->request->post("id");
        if ($this->hasPermission('m_item', 'Delete')) {

            $model = T_itemstockdetails::get($id);
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

    public function getAllData($iditem)
    {

        if ($this->hasPermission('m_item', 'Read')) {

            $params = [
                'where' => [
                    'M_Item_Id' => $iditem
                ],
                'join' => [
                    'm_uoms' => [
                        [
                            'as' => 'uomfrom',
                            'table' => 't_itemstockdetails',
                            'column' => 'M_Uom_Id_From',
                            'type' => 'left'
                        ],
                        [
                            'as' => 'uomto',
                            'table' => 't_itemstockdetails',
                            'column' => 'M_Uom_Id_To',
                            'type' => 'left'
                        ]
                    ],
                ]
            ];
            // echo \json_encode($params);
            // foreach($params['join'] as $key => $p){
            //     echo json_encode($key);
            // }
            $datatable = new Datatables('T_itemstockdetails', $params);
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
                    'uomfrom.Name',
                    function ($row) {
                        return
                            formLink($row->get_M_Uom('From')->Name, array(
                                "id" => $row->Id . "~a",
                                "href" => baseUrl("mitemstock/edit/$row->Id"),
                                "class" => "text-muted"
                            ));
                    }
                )->addColumn(
                    'uomto.Name',
                    function($row){
                        return $row->get_M_Uom('To')->Name;
                    }
                )->addColumn(
                    't_itemstockdetails.Qty'
                
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
                    'M_Item_Id' => $iditem
                ]
            ];
        $datatable = new Datatables('T_itemstockdetails', $params);
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
                'M_Item_Id',
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

            $model = T_itemstockdetails::get($id);
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
}
