<?php

namespace App\Controllers;

use App\Models\M_items;
use App\Controllers\Base_Controller;
use Core\Libraries\Datatables;
use Core\Nayo_Exception;
use Core\Session;

class M_item extends Base_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->hasPermission('m_item', 'Read')) {
            $this->loadBlade('m_item.index', lang('Form.item'));
        }
    }

    public function add()
    {
        if ($this->hasPermission('m_item', 'Write')) {
            $items = new M_items();
            $data = setPageData_paging($items);
            $this->loadBlade('m_item.add', lang('Form.item'), $data);
        }
    }

    public function addsave()
    {

        if ($this->hasPermission('m_item', 'Write')) {

            $items = new M_items();
            $items->parseFromRequest();

            try {
                $items->validate();
                $items->save();
                Session::setFlash('success_msg', array(0 => lang('Form.datasaved')));
                redirect('mitem/add')->go();
            } catch (Nayo_Exception $e) {

                Session::setFlash('add_warning_msg', array(0 => $e->messages));
                redirect('mitem/add')->with($e->data)->go();
            }
        }
    }

    public function edit($id)
    {
        if ($this->hasPermission('m_item', 'Write')) {

            $items = M_items::get($id);
            $data['model'] = $items;
            $this->loadBlade('m_item.edit', lang('Form.item'), $data);
        }
    }

    public function editsave()
    {

        if ($this->hasPermission('m_item', 'Write')) {
            $id = $this->request->post('Id');

            $items = M_items::get($id);
            $oldmodel = clone $items;

            $items->parseFromRequest();
            // echo json_encode($items);

            try {
                $items->validate($oldmodel);
                $items->save();
                Session::setFlash('success_msg', array(0 => lang('Form.datasaved')));
                redirect('mitem')->go();
            } catch (Nayo_Exception $e) {

                Session::setFlash('edit_warning_msg', array(0 => $e->messages));
                redirect("mitem/edit/{$id}")->with($e->data)->go();
            }
        }
    }

    public function itemstock($itemid)
    {

        if ($this->hasPermission('m_item', 'Read')) {
            $items = M_items::get($itemid);
            $data['model'] = $items;
            $this->loadBlade('m_item.stock', lang('Form.item'), $data);
        }
    }


    public function delete()
    {

        $id = $this->request->post("id");
        if ($this->hasPermission('m_item', 'Delete')) {
            $model = M_items::get($id);
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

        if ($this->hasPermission('m_item', 'Read')) {

            $params = [
                'join' => [
                    'm_categories' => [
                        'table' => 'm_items',
                        'column' => 'M_Category_Id',
                        'type' => 'left'
                    ]
                ]
            ];

            $datatable = new Datatables('M_items', $params);
            $datatable
                ->addDtRowClass("rowdetail")
                ->addColumn(
                    'm_items.Id',
                    function ($row) {
                        return $row->Id;
                    },
                    false,
                    false
                )->addColumn(
                    'm_items.Code',
                    function ($row) {
                        return
                            formLink($row->Code, array(
                                "id" => $row->Id . "~a",
                                "href" => baseUrl('mitem/edit/' . $row->Id),
                                "class" => "text-muted"
                            ));
                    }
                )->addColumn(
                    'm_items.Name'
                )->addColumn(
                    'm_categories.Name'
                )->addColumn(
                    'm_items.Created',
                    function ($row) {
                        return $row->Created;
                    },
                    false
                )->addColumn(
                    'm_items.Action',
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

    public function getStock($itemid)
    {

        if ($this->hasPermission('m_item', 'Read')) {
            $params = [
                'where' => [
                    'M_Item_Id' => $itemid
                ]
            ];

            $datatable = new Datatables('M_itemstocks', $params);
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
                    'M_Warehouse_Id',
                    function ($row) {
                        return $row->get_M_Warehouse()->Name;
                    },
                    false
                )->addColumn(
                    'Qty',
                    function ($row) {
                        return $row->Qty;
                    },
                    false,
                    false
                );


            echo json_encode($datatable->populate());
        }
    }

    public function getDataModal()
    {

        $datatable = new Datatables('M_items');
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
                'Name',
                function ($row) {
                    return $row->Name;
                }
            )->addColumn(
                '',
                function ($row) {
                    return $row->get_M_Uom()->Name;
                },
                false,
                false
            );

        echo json_encode($datatable->populate());
    }
}
