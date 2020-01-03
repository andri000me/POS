<?php

namespace App\Controllers;

use App\Models\M_categories;
use App\Controllers\Base_Controller;
use Core\Libraries\Datatables;
use Core\Nayo_Exception;
use Core\Session;

class M_category extends Base_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->hasPermission('m_category', 'Read')) {

            $this->loadBlade('m_category.index', lang('Form.category'));
        }
    }

    public function add()
    {
        if ($this->hasPermission('m_category', 'Write')) {
            $categories = new M_categories();
            $data = setPageData_paging($categories);
            $this->loadBlade('m_category.add', lang('Form.category'), $data);
        }
    }

    public function addsave()
    {

        if ($this->hasPermission('m_category', 'Write')) {

            $categories = new M_categories();
            $categories->parseFromRequest();

            try {
                $categories->validate();
                $categories->save();
                Session::setFlash('success_msg', array(0 => lang('Form.datasaved')));
                redirect('mcategory/add')->go();
            } catch (Nayo_Exception $e) {

                Session::setFlash('add_warning_msg', array(0 => $e->messages));
                redirect("mcategory/add")->with($categories)->go();
            }
        }
    }

    public function edit($id)
    {
        if ($this->hasPermission('m_category', 'Write')) {

            $categories = M_categories::get($id);

            $data['model'] = $categories;
            $this->loadBlade('m_category.edit', lang('Form.category'), $data);
        }
    }

    public function editsave()
    {

        if ($this->hasPermission('m_category', 'Write')) {

            $id = $this->request->post('Id');

            $categories = M_categories::get($id);
            $oldmodel = clone $categories;

            $categories->parseFromRequest();

            try {
                $categories->validate($oldmodel);

                $categories->save();
                Session::setFlash('success_msg', array(0 => lang('Form.datasaved')));
                redirect('mcategory')->go();
            } catch (Nayo_Exception $e) {

                Session::setFlash('edit_warning_msg', array(0 => $e->message));
                redirect("mcategoryedit/edit/{$id}")->with($categories)->go();
            }
        }
    }


    public function delete()
    {

        $id = $this->request->post("id");
        if (isPermitted_paging($_SESSION[get_variable() . 'userdata']['M_Groupuser_Id'], form_paging()['m_category'], 'Delete')) {

            $model = M_categories::get($id);

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

        if ($this->hasPermission('m_category', 'Read')) {

            $datatable = new Datatables('M_categories');
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
                                "href" => baseUrl('mcategory/edit/' . $row->Id),
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

        $datatable = new Datatables('M_categories');
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
