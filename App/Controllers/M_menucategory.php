<?php

namespace App\Controllers;

use App\Models\M_menucategories;
use App\Controllers\Base_Controller;
use Core\Libraries\Datatables;
use Core\Libraries\File;
use Core\Nayo_Exception;
use Core\Session;

class M_menucategory extends Base_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->hasPermission('m_menucategory', 'Read')) {

            $this->loadBlade('m_menucategory.index', lang('Form.menucategory'));
        }
    }

    public function add()
    {
        if ($this->hasPermission('m_menucategory', 'Write')) {
            $menucategories = new M_menucategories();
            $data = setPageData_paging($menucategories);
            $this->loadBlade('m_menucategory.add', lang('Form.menucategory'), $data);
        }
    }

    public function addsave()
    {

        if ($this->hasPermission('m_menucategory', 'Write')) {

            $menucategories = new M_menucategories();
            $menucategories->parseFromRequest();

            try {
                $menucategories->validate();
                $file = new File("assets/uploads/menucategory",['jpg', 'png']);
                $files = $_FILES['photo'];
                if($file->upload($files)){  
                    $menucategories->PhotoUrl = $file->getFileUrl();
                    $menucategories->save();
                } else {
                    Nayo_Exception::throw($file->getErrorMessage(), $menucategories);
                }
                
                Session::setFlash('success_msg', array(0 => lang('Form.datasaved')));
                redirect('mmenucategory/add')->go();
            } catch (Nayo_Exception $e) {

                Session::setFlash('add_warning_msg', array(0 => $e->messages));
                redirect("mmenucategory/add")->with($menucategories)->go();
            }
        }
    }

    public function edit($id)
    {
        if ($this->hasPermission('m_menucategory', 'Write')) {

            $menucategories = M_menucategories::get($id);

            $data['model'] = $menucategories;
            $this->loadBlade('m_menucategory.edit', lang('Form.menucategory'), $data);
        }
    }

    public function editsave()
    {

        if ($this->hasPermission('m_menucategory', 'Write')) {

            $id = $this->request->post('Id');

            $menucategories = M_menucategories::get($id);
            $oldmodel = clone $menucategories;

            $menucategories->parseFromRequest();

            try {
                $menucategories->validate($oldmodel);

                $menucategories->save();
                Session::setFlash('success_msg', array(0 => lang('Form.datasaved')));
                redirect('mmenucategory')->go();
            } catch (Nayo_Exception $e) {

                Session::setFlash('edit_warning_msg', array(0 => $e->message));
                redirect("mmenucategoryedit/edit/{$id}")->with($menucategories)->go();
            }
        }
    }


    public function delete()
    {

        $id = $this->request->post("id");
        if (isPermitted_paging($_SESSION[get_variable() . 'userdata']['M_Groupuser_Id'], form_paging()['m_menucategory'], 'Delete')) {

            $model = M_menucategories::get($id);

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

        if ($this->hasPermission('m_menucategory', 'Read')) {

            $datatable = new Datatables('M_menucategories');
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
                                "href" => baseUrl('mmenucategory/edit/' . $row->Id),
                                "class" => "text-muted"
                            ));
                    }
                )->addColumn(
                    'Description'
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

        $datatable = new Datatables('M_menucategories');
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
