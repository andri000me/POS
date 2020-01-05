<?php

namespace App\Controllers;

use App\Models\T_itemreceivings;
use App\Controllers\Base_Controller;
use App\Models\M_enumdetails;
use Core\Database\DbTrans;
use Core\Libraries\Datatables;
use Core\Nayo_Exception;
use Core\Session;

class T_itemreceiving extends Base_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->hasPermission('t_itemreceiving', 'Read')) {
            $this->loadBlade('t_itemreceiving.index', lang('Form.itemreceiving'));
        }
    }

    public function add()
    {
        if ($this->hasPermission('t_itemreceiving', 'Write')) {
            $itemreceivings = new T_itemreceivings();
            $data = setPageData_paging($itemreceivings);
            $this->loadBlade('t_itemreceiving.add', lang('Form.itemreceiving'), $data);
            // echo json_encode($data);
            // echo \json_encode($itemreceivings->getEnumStatus());
        }
    }

    public function addsave()
    {

        if ($this->hasPermission('t_itemreceiving', 'Write')) {

            $itemreceivings = new T_itemreceivings();
            $itemreceivings->parseFromRequest();
            DbTrans::beginTransaction();
            try {
                $itemreceivings->validate();
                $id = $itemreceivings->savedata();
                if($id){
                    DbTrans::commit();
                    Session::setFlash('success_msg', array(0 => lang('Form.datasaved')));
                    redirect("titemreceiving/edit/{$id}")->go();
                }
            } catch (Nayo_Exception $e) {

                DbTrans::rollback();
                Session::setFlash('add_warning_msg', array(0 => $e->messages));
                redirect("titemreceiving/add")->with($e->data)->go();
            }
        }
    }

    public function edit($id)
    {
        if ($this->hasPermission('t_itemreceiving', 'Write')) {

            $itemreceivings = T_itemreceivings::get($id);
            $data['model'] = $itemreceivings;
            $this->loadBlade('t_itemreceiving.edit', lang('Form.itemreceiving'), $data);
        }
    }

    public function editsave()
    {

        if ($this->hasPermission('t_itemreceiving', 'Write')) {
            $id = $this->request->post('Id');

            $itemreceivings = T_itemreceivings::get($id);
            $oldmodel = clone $itemreceivings;

            $itemreceivings->parseFromRequest();
            // echo json_encode($itemreceivings);

            DbTrans::beginTransaction();
            try {
                $itemreceivings->validate($oldmodel);
                $id = $itemreceivings->savedata($oldmodel);
                if($id){
                    DbTrans::commit();
                    Session::setFlash('success_msg', array(0 => lang('Form.datasaved')));
                    redirect('titemreceiving')->go();
                }
            } catch (Nayo_Exception $e) {
                DbTrans::rollback();
                Session::setFlash('edit_warning_msg', array(0 => $e->messages));
                redirect("titemreceiving/edit/{$id}")->with($e->data)->go();
            }
        }
    }

    public function copy($id){
        DbTrans::beginTransaction();
        try {
            $exist = T_itemreceivings::get($id);
            $data = $exist->copyFrom();
            DbTrans::commit();
            Session::setFlash('success_msg', array(0 => lang('Info.success_to_copy')));
            redirect("titemreceiving/edit/{$data->Id}")->with($data)->go();

        } catch (Nayo_Exception $e) {
            DbTrans::rollback();
            Session::setFlash('edit_warning_msg', array(0 => $e->messages));
            redirect("titemreceiving/edit/{$id}")->with($e->data)->go();
        }
    }

    public function delete()
    {

        $id = $this->request->post("id");
        if ($this->hasPermission('t_itemreceiving', 'Delete')) {
            $model = T_itemreceivings::get($id);
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

        if ($this->hasPermission('t_itemreceiving', 'Read')) {

            $params = [
                'join' => [
                    'm_shops' => [
                        [
                            'table' => 't_itemreceivings',
                            'column' => 'M_Shop_Id',
                            'type' =>'LEFT'
                        ]
                    ]
                ]
            ];
            
            $datatable = new Datatables('T_itemreceivings', $params);
            $datatable
                ->addDtRowClass("rowdetail")
                ->addColumn(
                    't_itemreceivings.Id',
                    function ($row) {
                        return $row->Id;
                    },
                    false,
                    false
                )->addColumn(
                    't_itemreceivings.TransNo',
                    function ($row) {
                        return
                            formLink($row->TransNo, array(
                                "id" => $row->Id . "~a",
                                "href" => baseUrl('titemreceiving/edit/' . $row->Id),
                                "class" => "text-muted"
                            ));
                    }
              
                )->addColumn(
                    't_itemreceivings.TransDate',
                    function($row){
                        return get_formated_date($row->TransDate, "Y-m-d");
                    }
              
                )->addColumn(
                    't_itemreceivings.Status',
                    function($row){
                        return M_enumdetails::getEnumName('ItemreceivingStatus', $row->Status);
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

        $datatable = new Datatables('T_itemreceivings');
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
