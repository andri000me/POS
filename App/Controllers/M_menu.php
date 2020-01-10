<?php

namespace App\Controllers;

use App\Models\M_menus;
use App\Controllers\Base_Controller;
use Core\Database\DbTrans;
use Core\Libraries\Datatables;
use Core\Libraries\File;
use Core\Nayo_Exception;
use Core\Session;

class M_menu extends Base_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->hasPermission('m_menu', 'Read')) {

            $this->loadBlade('m_menu.index', lang('Form.menu'));
        }
    }

    public function add()
    {
        if ($this->hasPermission('m_menu', 'Write')) {
            $menus = new M_menus();
            $data = setPageData_paging($menus);
            $this->loadBlade('m_menu.add', lang('Form.menu'), $data);
        }
    }

    public function addsave()
    {

        if ($this->hasPermission('m_menu', 'Write')) {

            $menus = new M_menus();
            $menus->parseFromRequest();

            DbTrans::beginTransaction();
            try {
                $menus->validate();
                $file = new File("assets/uploads/menu",['jpg', 'png']);
                $files = $_FILES['photo'];
                $id = $menus->save();
                if($id){
                    $menus->Id = $id;
                    if($file->upload($files)){  
                        $menus->PhotoUrl = $file->getFileUrl();
                        $menus->save();
                    } else {
                        Nayo_Exception::throw($file->getErrorMessage(), $menus);
                    }
                } else {
                    Nayo_Exception::throw(DbTrans::getCurrentError(), $menus);
                }
                
                DbTrans::commit();
                Session::setFlash('success_msg', array(0 => lang('Form.datasaved')));
                redirect('mmenu/add')->go();
            } catch (Nayo_Exception $e) {

                DbTrans::rollback();
                Session::setFlash('add_warning_msg', array(0 => $e->messages));
                redirect("mmenu/add")->with($menus)->go();
            }
        }
    }

    public function edit($id)
    {
        if ($this->hasPermission('m_menu', 'Write')) {

            $menus = M_menus::get($id);

            $data['model'] = $menus;
            $this->loadBlade('m_menu.edit', lang('Form.menu'), $data);
        }
    }

    public function editsave()
    {

        if ($this->hasPermission('m_menu', 'Write')) {

            $id = $this->request->post('Id');

            $menus = M_menus::get($id);
            $oldmodel = clone $menus;

            $menus->parseFromRequest();
            DbTrans::beginTransaction();
            try {
                $menus->validate($oldmodel);
                $file = new File("assets/uploads/menu",['jpg', 'png']);
                $files = $_FILES['photo'];
                if($file->upload($files)){  
                    $menus->PhotoUrl = $file->getFileUrl();
                    $ids = $menus->save();
                    if($ids){
                        unlink($oldmodel->PhotoUrl);
                    } else {
                        Nayo_Exception::throw("Gagal Menyimpan Data", $menus);
                    }
                } else {
                    Nayo_Exception::throw($file->getErrorMessage(), $menus);
                }
                
                DbTrans::commit();
                Session::setFlash('success_msg', array(0 => lang('Form.datasaved')));
                redirect("mmenu/edit/{$id}")->go();
            } catch (Nayo_Exception $e) {
                DbTrans::rollback();
                Session::setFlash('edit_warning_msg', array(0 => $e->messages));
                redirect("mmenu/edit/{$id}")->with($menus)->go();
            }
        }
    }


    public function delete()
    {

        $id = $this->request->post("id");
        if (isPermitted_paging($_SESSION[get_variable() . 'userdata']['M_Groupuser_Id'], form_paging()['m_menu'], 'Delete')) {

            $model = M_menus::get($id);

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

        if ($this->hasPermission('m_menu', 'Read')) {
            $params = [
                'join' => [
                    'm_menucategories' =>[
                        [
                            'table' => 'm_menus',
                            'column' => 'M_Menucategory_Id',
                            'type' => 'Left'
                        ]
                    ]
                ]
            ];
            $datatable = new Datatables('M_menus', $params);
            $datatable
                ->addDtRowClass("rowdetail")
                ->addColumn(
                    'Id',
                    null,
                    false,
                    false
                )->addColumn(
                    'Name',
                    function ($row) {
                        return
                            formLink($row->Name, array(
                                "id" => $row->Id . "~a",
                                "href" => baseUrl('mmenu/edit/' . $row->Id),
                                "class" => "text-muted"
                            ));
                    }
                )->addColumn(
                    'm_menucategories.Name'
                )->addColumn(
                    'Price'
                )->addColumn(
                    'Status',
                    function ($row) {
                        if ($row->Status)
                            return "<td><a><i class='fa fa-check'></i></a></td>";
                        else
                            return "<td><a><i class='fa fa-close'></i></a></td>";
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

        $datatable = new Datatables('M_menus');
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
            );

        echo json_encode($datatable->populate());
    }
}
