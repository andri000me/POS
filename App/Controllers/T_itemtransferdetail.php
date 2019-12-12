<?php

namespace App\Controllers;

use App\Models\T_itemtransferdetails;
use App\Controllers\Base_Controller;
use App\Enums\T_itemtransferstatus;
use Core\Libraries\Datatables;
use App\Models\T_itemtransfers;
use App\Models\M_enumdetails;
use Core\Nayo_Exception;
use Core\Session;

class T_itemtransferdetail extends Base_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index($iditem)
    {
        if ($this->hasPermission('m_item', 'Read')) {

            try {
                $result = T_itemtransfers::get($iditem);
                // if ($result->Status != T_itemtransferstatus::NEW) {
                //     Nayo_Exception::throw("{$result->TransNo} Tidak bisa menambah barang, Status : " . M_enumdetails::getEnumName('ItemtransferStatus', $result->Status), $result);
                // }

                $data['model'] = $result;

                $this->loadBlade('t_itemtransferdetail.index', lang('Form.itemtransfer'), $data);
            } catch (Nayo_Exception $e) {
                Session::setFlash('add_warning_msg', array(0 => $e->messages));
                redirect("titemtransfer/edit/{$e->data->Id}")->with($e->data)->go();
            }
        }
    }

    public function add($iditem)
    {
        if ($this->hasPermission('m_item', 'Write')) {
            try {
                $result = T_itemtransfers::get($iditem);
                if ($result->Status != T_itemtransferstatus::NEW) {
                    Nayo_Exception::throw("Tidak bisa menambah barang, Status : " . M_enumdetails::getEnumName('ItemtransferStatus', $result->Status), $result);
                }

                $itemtransfers = new T_itemtransferdetails($iditem);

                $data = setPageData_paging($itemtransfers);

                $data['item'] = $result;
                $this->loadBlade('t_itemtransferdetail.add', lang('Form.itemtransfer'), $data);
            } catch (Nayo_Exception $e) {
                Session::setFlash('add_warning_msg', array(0 => $e->messages));
                redirect("titemtransferdetail/{$e->data->Id}")->with($e->data)->go();
            }
        }
    }

    public function addsave()
    {

        if ($this->hasPermission('m_item', 'Write')) {

            $itemtransfers = new T_itemtransferdetails();
            $itemtransfers->parseFromRequest();
            try {
                $result = T_itemtransfers::get($itemtransfers->T_Itemtransfer_Id);
                if ($result->Status != T_itemtransferstatus::NEW) {
                    Nayo_Exception::throw("Tidak bisa menambah barang, Status : " . M_enumdetails::getEnumName('ItemtransferStatus', $result->Status), $result);
                }
                $itemtransfers->validate();

                $itemtransfers->save();
                Session::setFlash('success_msg', array(0 => lang('Form.datasaved')));
                redirect("titemtransferdetail/add/{$itemtransfers->T_Itemtransfer_Id}")->go();
            } catch (Nayo_Exception $e) {

                Session::setFlash('add_warning_msg', array(0 => $e->messages));
                redirect("titemtransferdetail/add/{$itemtransfers->T_Itemtransfer_Id}")->with($itemtransfers)->go();
            }
        }
    }

    public function edit($id)
    {
        if ($this->hasPermission('m_item', 'Write')) {


            $itemtransfers = T_itemtransferdetails::get($id);

            $result = T_itemtransfers::get($itemtransfers->T_Itemtransfer_Id);

            $data['model'] = $itemtransfers;
            $data['item'] = $result;
            $this->loadBlade('t_itemtransferdetail.edit', lang('Form.itemtransfer'), $data);
        }
    }

    public function editsave()
    {

        if ($this->hasPermission('m_item', 'Write')) {

            $id = $this->request->post('Id');

            $itemtransfers = T_itemtransferdetails::get($id);
            $oldmodel = clone $itemtransfers;

            $itemtransfers->parseFromRequest();

            try {
                $itemtransfers->validate($oldmodel);
                $itemtransfers->save();
                Session::setFlash('success_msg', array(0 => lang('Form.datasaved')));
                redirect("titemtransferdetail/$itemtransfers->T_Itemtransfer_Id")->go();
            } catch (Nayo_Exception $e) {

                Session::setFlash('edit_warning_msg', array(0 => $e->messages));
                redirect("titemtransferdetail/edit/$id")->with($e->data)->go();
            }
        }
    }


    public function delete()
    {

        $id = $this->request->post("id");
        if ($this->hasPermission('m_item', 'Delete')) {

            $model = T_itemtransferdetails::get($id);
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

    public function getAllData($transferid)
    {

        if ($this->hasPermission('m_item', 'Read')) {

            $params = [
                'where' => [
                    'T_Itemtransfer_Id' => $transferid
                ],
                'join' => [
                    'm_uoms' => [
                        [
                            'table' => 't_itemtransferdetails',
                            'column' => 'M_Uom_Id',
                            'type' => 'left'
                        ]

                    ],
                    'm_warehouses' => [
                        [

                            'table' => 't_itemtransferdetails',
                            'column' => 'M_Warehouse_Id',
                            'type' => 'left'
                        ]
                    ],
                    'm_items' => [
                        [

                            'table' => 't_itemtransferdetails',
                            'column' => 'M_Item_Id',
                            'type' => 'left'
                        ]
                    ]
                ]
            ];
            $datatable = new Datatables('T_itemtransferdetails', $params);
            $datatable
                ->addDtRowClass("rowdetail")
                ->addColumn(
                    't_itemtransferdetails.Id',
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
                                "href" => baseUrl("titemtransferdetail/edit/$row->Id"),
                                "class" => "text-muted"
                            ));
                    }
                )->addColumn(
                    'm_uoms.Name'
                )->addColumn(
                    'm_warehouses.Name'
                )->addColumn(
                    't_itemtransferdetails.Qty'

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
                    'T_Itemtransfer_Id' => $iditem
                ]
            ];
        $datatable = new Datatables('T_itemtransferdetails', $params);
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
                'T_Itemtransfer_Id',
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

            $model = T_itemtransferdetails::get($id);
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
