<?php

namespace App\Controllers;

use App\Models\T_itemstockdetails;
use App\Controllers\Base_Controller;
use App\Enums\T_itemstockstatus;
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

            try {
                $result = T_itemstocks::get($iditem);
                // if ($result->Status != T_itemstockstatus::NEW) {
                //     Nayo_Exception::throw("{$result->TransNo} Tidak bisa menambah barang, Status : " . M_enumdetails::getEnumName('ItemstockStatus', $result->Status), $result);
                // }

                $data['model'] = $result;

                $this->loadBlade('t_itemstockdetail.index', lang('Form.itemstock'), $data);
            } catch (Nayo_Exception $e) {
                Session::setFlash('add_warning_msg', array(0 => $e->messages));
                redirect("titemstock/edit/{$e->data->Id}")->with($e->data)->go();
            }
        }
    }

    public function add($iditem)
    {
        if ($this->hasPermission('m_item', 'Write')) {
            try {
                $result = T_itemstocks::get($iditem);
                if ($result->Status != T_itemstockstatus::NEW) {
                    Nayo_Exception::throw("Tidak bisa menambah barang, Status : " . M_enumdetails::getEnumName('ItemstockStatus', $result->Status), $result);
                }

                $itemstocks = new T_itemstockdetails($iditem);

                $data = setPageData_paging($itemstocks);

                $data['item'] = $result;
                $this->loadBlade('t_itemstockdetail.add', lang('Form.itemstock'), $data);
            } catch (Nayo_Exception $e) {
                Session::setFlash('add_warning_msg', array(0 => $e->messages));
                redirect("titemstockdetail/{$e->data->Id}")->with($e->data)->go();
            }
        }
    }

    public function addsave()
    {

        if ($this->hasPermission('m_item', 'Write')) {

            $itemstocks = new T_itemstockdetails();
            $itemstocks->parseFromRequest();
            try {
                $result = T_itemstocks::get($itemstocks->T_Itemstock_Id);
                if ($result->Status != T_itemstockstatus::NEW) {
                    Nayo_Exception::throw("Tidak bisa menambah barang, Status : " . M_enumdetails::getEnumName('ItemstockStatus', $result->Status), $result);
                }
                $itemstocks->validate();

                $itemstocks->save();
                Session::setFlash('success_msg', array(0 => lang('Form.datasaved')));
                redirect("titemstockdetail/add/{$itemstocks->T_Itemstock_Id}")->go();
            } catch (Nayo_Exception $e) {

                Session::setFlash('add_warning_msg', array(0 => $e->messages));
                redirect("titemstockdetail/add/{$itemstocks->T_Itemstock_Id}")->with($itemstocks)->go();
            }
        }
    }

    public function edit($id)
    {
        if ($this->hasPermission('m_item', 'Write')) {


            $itemstocks = T_itemstockdetails::get($id);

            $result = T_itemstocks::get($itemstocks->T_Itemstock_Id);

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
                redirect("titemstockdetail/$itemstocks->T_Itemstock_Id")->go();
            } catch (Nayo_Exception $e) {

                Session::setFlash('edit_warning_msg', array(0 => $e->messages));
                redirect("titemstockdetail/edit/$id")->with($e->data)->go();
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

    public function getAllData($stockid)
    {

        if ($this->hasPermission('m_item', 'Read')) {

            $params = [
                'where' => [
                    'T_Itemstock_Id' => $stockid
                ],
                'join' => [
                    'm_uoms' => [
                        [
                            'table' => 't_itemstockdetails',
                            'column' => 'M_Uom_Id',
                            'type' => 'left'
                        ]

                    ],
                    'm_warehouses' => [
                        [

                            'table' => 't_itemstockdetails',
                            'column' => 'M_Warehouse_Id',
                            'type' => 'left'
                        ]
                    ],
                    'm_items' => [
                        [

                            'table' => 't_itemstockdetails',
                            'column' => 'M_Item_Id',
                            'type' => 'left'
                        ]
                    ]
                ]
            ];
            $datatable = new Datatables('T_itemstockdetails', $params);
            $datatable
                ->addDtRowClass("rowdetail")
                ->addColumn(
                    't_itemstockdetails.Id',
                    function ($row) {
                        return $row->Id;
                    },
                    false,
                    false
                )->addColumn(
                    'm_items.Name',
                    function ($row) {
                        return
                            formLink($row->get_M_Item()->Name, array(
                                "id" => $row->Id . "~a",
                                "href" => baseUrl("titemstockdetail/edit/$row->Id"),
                                "class" => "text-muted"
                            ));
                    }
                )->addColumn(
                    'm_uoms.Name'
                )->addColumn(
                    'm_warehouses.Name'
                )->addColumn(
                    't_itemstockdetails.Qty'

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

    public function getDataModal($iditem)
    {
        $params = array();
        if ($iditem > 0)
            $params = [
                'where' => [
                    'T_Itemstock_Id' => $iditem
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
                'T_Itemstock_Id',
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
