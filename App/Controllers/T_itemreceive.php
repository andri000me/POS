<?php

namespace App\Controllers;

use App\Models\T_itemreceives;
use App\Controllers\Base_Controller;
use App\Models\M_enumdetails;
use Core\Database\DbTrans;
use Core\Libraries\Datatables;
use Core\Nayo_Exception;
use Core\Session;

class T_itemreceive extends Base_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->hasPermission('t_itemreceive', 'Read')) {
            $this->loadBlade('t_itemreceive.index', lang('Form.itemreceive'));
        }
    }

    public function add()
    {
        if ($this->hasPermission('t_itemreceive', 'Write')) {
            $itemreceives = new T_itemreceives();
            $data = setPageData_paging($itemreceives);
            $this->loadBlade('t_itemreceive.add', lang('Form.itemreceive'), $data);
            // echo json_encode($data);
            // echo \json_encode($itemreceives->getEnumStatus());
        }
    }

    public function addsave()
    {

        if ($this->hasPermission('t_itemreceive', 'Write')) {

            $itemreceives = new T_itemreceives();
            $itemreceives->parseFromRequest();
            DbTrans::beginTransaction();
            try {
                $itemreceives->validate();
                $id = $itemreceives->savedata();
                if($id){
                    DbTrans::commit();
                    Session::setFlash('success_msg', array(0 => lang('Form.datasaved')));
                    redirect("titemreceive/edit/{$id}")->go();
                }
            } catch (Nayo_Exception $e) {

                DbTrans::rollback();
                Session::setFlash('add_warning_msg', array(0 => $e->messages));
                redirect("titemreceive/add")->with($e->data)->go();
            }
        }
    }

    public function edit($id)
    {
        if ($this->hasPermission('t_itemreceive', 'Write')) {

            $itemreceives = T_itemreceives::get($id);
            $data['model'] = $itemreceives;
            $this->loadBlade('t_itemreceive.edit', lang('Form.itemreceive'), $data);
        }
    }

    public function editsave()
    {

        if ($this->hasPermission('t_itemreceive', 'Write')) {
            $id = $this->request->post('Id');

            $itemreceives = T_itemreceives::get($id);
            $oldmodel = clone $itemreceives;

            $itemreceives->parseFromRequest();
            // echo json_encode($itemreceives);

            DbTrans::beginTransaction();
            try {
                $itemreceives->validate($oldmodel);
                if($itemreceives->savedata($oldmodel)){
                    DbTrans::commit();
                    Session::setFlash('success_msg', array(0 => lang('Form.datasaved')));
                    redirect('titemreceive')->go();
                }
            } catch (Nayo_Exception $e) {
                DbTrans::rollback();
                Session::setFlash('edit_warning_msg', array(0 => $e->messages));
                redirect("titemreceive/edit/{$id}")->with($e->data)->go();
            }
        }
    }

    public function copy($id){
        DbTrans::beginTransaction();
        try {
            $exist = T_itemreceives::get($id);
            $data = $exist->copyFrom();
            DbTrans::commit();
            Session::setFlash('success_msg', array(0 => lang('Info.success_to_copy')));
            redirect("titemreceive/edit/{$data->Id}")->with($data)->go();

        } catch (Nayo_Exception $e) {
            DbTrans::rollback();
            Session::setFlash('edit_warning_msg', array(0 => $e->messages));
            redirect("titemreceive/edit/{$id}")->with($e->data)->go();
        }
    }

    public function delete()
    {

        $id = $this->request->post("id");
        if ($this->hasPermission('t_itemreceive', 'Delete')) {
            $model = T_itemreceives::get($id);
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

        if ($this->hasPermission('t_itemreceive', 'Read')) {

            $params = [
                'join' => [
                    'm_shops' => [
                        [
                            'table' => 't_itemreceives',
                            'column' => 'M_shop_Id',
                            'type' =>'LEFT'
                        ]
                    ]
                ]
            ];
            
            $datatable = new Datatables('T_itemreceives', $params);
            $datatable
                ->addDtRowClass("rowdetail")
                ->addColumn(
                    't_itemreceives.Id',
                    function ($row) {
                        return $row->Id;
                    },
                    false,
                    false
                )->addColumn(
                    't_itemreceives.TransNo',
                    function ($row) {
                        return
                            formLink($row->TransNo, array(
                                "id" => $row->Id . "~a",
                                "href" => baseUrl('titemreceive/edit/' . $row->Id),
                                "class" => "text-muted"
                            ));
                    }
              
                )->addColumn(
                    't_itemreceives.TransDate',
                    function($row){
                        return get_formated_date($row->TransDate, "Y-m-d");
                    }
              
                )->addColumn(
                    't_itemreceives.Status',
                    function($row){
                        return M_enumdetails::getEnumName('ItemreceiveStatus', $row->Status);
                    }
              
                )->addColumn(
                    'm_shops.Code'
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

        $datatable = new Datatables('T_itemreceives');
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
