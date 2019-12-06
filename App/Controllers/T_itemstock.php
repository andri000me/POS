<?php

namespace App\Controllers;

use App\Models\T_itemstocks;
use App\Controllers\Base_Controller;
use App\Models\M_enumdetails;
use Core\Database\DbTrans;
use Core\Libraries\Datatables;
use Core\Nayo_Exception;
use Core\Session;

class T_itemstock extends Base_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->hasPermission('t_itemstock', 'Read')) {
            $this->loadBlade('t_itemstock.index', lang('Form.itemstock'));
        }
    }

    public function add()
    {
        if ($this->hasPermission('t_itemstock', 'Write')) {
            $itemstocks = new T_itemstocks();
            $data = setPageData_paging($itemstocks);
            $this->loadBlade('t_itemstock.add', lang('Form.itemstock'), $data);
            // echo json_encode($data);
            // echo \json_encode($itemstocks->getEnumStatus());
        }
    }

    public function addsave()
    {

        if ($this->hasPermission('t_itemstock', 'Write')) {

            $itemstocks = new T_itemstocks();
            $itemstocks->parseFromRequest();
            DbTrans::beginTransaction();
            try {
                $itemstocks->validate();

                if($itemstocks->savedata()){
                    DbTrans::commit();
                    Session::setFlash('success_msg', array(0 => lang('Form.datasaved')));
                    redirect('titemstock/add')->go();
                }
            } catch (Nayo_Exception $e) {

                DbTrans::rollback();
                Session::setFlash('add_warning_msg', array(0 => $e->messages));
                redirect("titemstock/add")->with($e->data)->go();
            }
        }
    }

    public function edit($id)
    {
        if ($this->hasPermission('t_itemstock', 'Write')) {

            $itemstocks = T_itemstocks::get($id);
            $data['model'] = $itemstocks;
            $this->loadBlade('t_itemstock.edit', lang('Form.itemstock'), $data);
        }
    }

    public function editsave()
    {

        if ($this->hasPermission('t_itemstock', 'Write')) {
            $id = $this->request->post('Id');

            $itemstocks = T_itemstocks::get($id);
            $oldmodel = clone $itemstocks;

            $itemstocks->parseFromRequest();
            // echo json_encode($itemstocks);

            DbTrans::beginTransaction();
            try {
                $itemstocks->validate($oldmodel);
                if($itemstocks->savedata($oldmodel)){
                    DbTrans::commit();
                    Session::setFlash('success_msg', array(0 => lang('Form.datasaved')));
                    redirect('titemstock')->go();
                }
            } catch (Nayo_Exception $e) {
                DbTrans::rollback();
                Session::setFlash('edit_warning_msg', array(0 => $e->messages));
                redirect("titemstock/edit/{$id}")->with($e->data)->go();
            }
        }
    }

    public function copy($id){
        DbTrans::beginTransaction();
        try {
            $exist = T_itemstocks::get($id);
            $data = $exist->copyFrom();
            DbTrans::commit();
            Session::setFlash('success_msg', array(0 => lang('Info.success_to_copy')));
            redirect("titemstock/edit/{$data->Id}")->with($data)->go();

        } catch (Nayo_Exception $e) {
            DbTrans::rollback();
            Session::setFlash('edit_warning_msg', array(0 => $e->messages));
            redirect("titemstock/edit/{$id}")->with($e->data)->go();
        }
    }

    public function delete()
    {

        $id = $this->request->post("id");
        if ($this->hasPermission('t_itemstock', 'Delete')) {
            $model = T_itemstocks::get($id);
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

        if ($this->hasPermission('t_itemstock', 'Read')) {
            
            $datatable = new Datatables('T_itemstocks');
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
                    'TransNo',
                    function ($row) {
                        return
                            formLink($row->TransNo, array(
                                "id" => $row->Id . "~a",
                                "href" => baseUrl('titemstock/edit/' . $row->Id),
                                "class" => "text-muted"
                            ));
                    }
              
                )->addColumn(
                    'TransDate',
                    function($row){
                        return get_formated_date($row->TransDate, "Y-m-d");
                    }
              
                )->addColumn(
                    'Status',
                    function($row){
                        return M_enumdetails::getEnumName('ItemstockStatus', $row->Status);
                    }
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

    public function getDataModal()
    {

        $datatable = new Datatables('T_itemstocks');
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
                    return $row->get_M_Subvillage()->Name;
                },
                false
            );

        echo json_encode($datatable->populate());
    }
}
