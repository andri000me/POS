<?php

namespace App\Controllers;

use App\Models\T_itemtransfers;
use App\Controllers\Base_Controller;
use App\Models\M_enumdetails;
use App\Models\T_itemreceivingdetails;
use Core\Database\DbTrans;
use Core\Libraries\Datatables;
use Core\Nayo_Exception;
use Core\Session;
use Nayo;

class T_itemtransfer extends Base_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->hasPermission('t_itemtransfer', 'Read')) {
            $this->loadBlade('t_itemtransfer.index', lang('Form.itemtransfer'));
        }
    }

    public function add()
    {
        if ($this->hasPermission('t_itemtransfer', 'Write')) {
            $itemtransfers = new T_itemtransfers();
            $data = setPageData_paging($itemtransfers);
            $this->loadBlade('t_itemtransfer.add', lang('Form.itemtransfer'), $data);
        }
    }

    public function addsave()
    {

        if ($this->hasPermission('t_itemtransfer', 'Write')) {

            $itemtransfers = new T_itemtransfers();
            $itemtransfers->parseFromRequest();
            DbTrans::beginTransaction();
            try { 
                $itemtransfers->validate();
                $id = $itemtransfers->savedata();
                if($id){
                    DbTrans::commit();
                    Session::setFlash('success_msg', array(0 => lang('Form.datasaved')));
                    redirect("titemtransfer/edit/{$id}")->go();
                } 
            } catch (Nayo_Exception $e) {

                DbTrans::rollback();
                Session::setFlash('add_warning_msg', array(0 => $e->messages));
                redirect("titemtransfer/add")->with($e->data)->go();
            }
        }
    }

    public function edit($id)
    {
        if ($this->hasPermission('t_itemtransfer', 'Write')) {

            $itemtransfers = T_itemtransfers::get($id);
            $data['model'] = $itemtransfers;
            $this->loadBlade('t_itemtransfer.edit', lang('Form.itemtransfer'), $data);
        }
    }

    public function editsave()
    {

        if ($this->hasPermission('t_itemtransfer', 'Write')) {
            $id = $this->request->post('Id');

            $itemtransfers = T_itemtransfers::get($id);
            $oldmodel = clone $itemtransfers;

            $itemtransfers->parseFromRequest();
            // echo json_encode($itemtransfers);

            DbTrans::beginTransaction();
            try {
                $itemtransfers->validate($oldmodel);
                if($itemtransfers->savedata($oldmodel)){
                    DbTrans::commit();
                    Session::setFlash('success_msg', array(0 => lang('Form.datasaved')));
                    redirect('titemtransfer')->go();
                }
            } catch (Nayo_Exception $e) {
                DbTrans::rollback();
                Session::setFlash('edit_warning_msg', array(0 => $e->messages));
                redirect("titemtransfer/edit/{$id}")->with($e->data)->go();
            }
        }
    }

    public function copy($id){
        DbTrans::beginTransaction();
        try {
            $exist = T_itemtransfers::get($id);
            $data = $exist->copyFrom();
            DbTrans::commit();
            Session::setFlash('success_msg', array(0 => lang('Info.success_to_copy')));
            redirect("titemtransfer/edit/{$data->Id}")->with($data)->go();

        } catch (Nayo_Exception $e) {
            DbTrans::rollback();
            Session::setFlash('edit_warning_msg', array(0 => $e->messages));
            redirect("titemtransfer/edit/{$id}")->with($e->data)->go();
        }
    }

    public function delete()
    {

        $id = $this->request->post("id");
        if ($this->hasPermission('t_itemtransfer', 'Delete')) {
            $model = T_itemtransfers::get($id);
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

        if ($this->hasPermission('t_itemtransfer', 'Read')) {

            $params = [
                'join' => [
                    'm_shops' => [
                        [
                            'as' => 'shopfrom',
                            'table' => 't_itemtransfers',
                            'column' => 'M_shop_Id_From',
                            'type' =>'LEFT'
                        ],[
                            'as' => 'shopto',
                            'table' => 't_itemtransfers',
                            'column' => 'M_shop_Id_To',
                            'type' =>'LEFT'
                        ],
                    ]
                ]
            ];
            $params['where']['M_Shop_Id_From'] = isset(Session::get(get_variable() . 'userdata')['M_Shop_Id']) ? Session::get(get_variable() . 'userdata')['M_Shop_Id'] : null;
            
            $datatable = new Datatables('T_itemtransfers', $params);
            $datatable
                ->addDtRowClass("rowdetail")
                ->addColumn(
                    't_itemtransfers.Id',
                    function ($row) {
                        return $row->Id;
                    },
                    false,
                    false
                )->addColumn(
                    't_itemtransfers.TransNo',
                    function ($row) {
                        return
                            formLink($row->TransNo, array(
                                "id" => $row->Id . "~a",
                                "href" => baseUrl('titemtransfer/edit/' . $row->Id),
                                "class" => "text-muted"
                            ));
                    }
              
                )->addColumn(
                    't_itemtransfers.TransDate',
                    function($row){
                        return get_formated_date($row->TransDate, "Y-m-d");
                    }
              
                )->addColumn(
                    't_itemtransfers.Status',
                    function($row){
                        return M_enumdetails::getEnumName('ItemtransferStatus', $row->Status);
                    }
              
                )->addColumn(
                    'shopfrom.Code',
                    function($row){
                        return $row->get_M_Shop('From')->Code;
                    }
                )->addColumn(
                    'shopto.Code',
                    function($row){
                        return $row->get_M_Shop('To')->Code;
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

    public function getDataModalItemTransfer($id)
    {
       
        $params = [
            
            'where' => [
                't_itemtransfers.Status' => 2,
                't_itemtransfers.M_Shop_Id_To' => isset(Session::get(get_variable() . 'userdata')['M_Shop_Id']) ? Session::get(get_variable() . 'userdata')['M_Shop_Id'] : null
            ],
            'join' => [
                'm_shops' => [
                    [
                        'as' => 'shopfrom',
                        'table' => 't_itemtransfers',
                        'column' => 'M_shop_Id_From',
                        'type' =>'LEFT'
                    ]
                ]
            ],
        ];

        $transferid = [];
        $receivingparams = ['where' => ['T_Itemreceiving_Id' => $id]];
        $itemreceivingdetail = T_itemreceivingdetails::getAll($receivingparams);
        if($itemreceivingdetail){
            foreach($itemreceivingdetail as $det){
                $transferid[] = $det->T_Itemtransfer_Id;
            }
            $params['whereNotIn']['t_itemtransfers.Id'] = $transferid;

        }


        $datatable = new Datatables('T_itemtransfers', $params);
        $datatable
            ->addDtRowClass("rowdetail")
            ->addColumn(
                't_itemtransfers.Id'
            )->addColumn(
                't_itemtransfers.TransNo',
            )->addColumn(
                't_itemtransfers.TransDate',
                function ($row) {
                    return get_formated_date($row->TransDate, "d-m-Y");
                },
                false
            )->addColumn(
                'shopfrom.Code',
                function($row){
                    return $row->get_M_Shop('From')->Code;
                }
            );

        echo json_encode($datatable->populate());
    }

    public function getDataModal()
    {
        $params = [
            
            'where' => [
                'M_Shop_Id_To' => isset(Session::get(get_variable() . 'userdata')['M_Shop_Id']) ? Session::get(get_variable() . 'userdata')['M_Shop_Id'] : null
            ],
            'join' => [
                'm_shops' => [
                    [
                        'as' => 'shopfrom',
                        'table' => 't_itemtransfers',
                        'column' => 'M_shop_Id_From',
                        'type' =>'LEFT'
                    ]
                ]
            ]
        ];

        $datatable = new Datatables('T_itemtransfers', $params);
        $datatable
            ->addDtRowClass("rowdetail")
            ->addColumn(
                't_itemtransfers.Id'
            )->addColumn(
                't_itemtransfers.TransNo',
            )->addColumn(
                't_itemtransfers.TransDate',
                function ($row) {
                    return get_formated_date($row->TransDate, "d-m-Y");
                },
                false
            )->addColumn(
                'shopfrom.Code',
                function($row){
                    return $row->get_M_Shop('From')->Code;
                }
            );

        echo json_encode($datatable->populate());
    }
}
