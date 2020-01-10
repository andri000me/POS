<?php

namespace App\Controllers;

use App\Models\M_mealtimes;
use App\Controllers\Base_Controller;
use Core\Libraries\Datatables;
use Core\Nayo_Exception;
use Core\Session;

class M_mealtime extends Base_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->hasPermission('m_mealtime', 'Read')) {

            $this->loadBlade('m_mealtime.index', lang('Form.mealtime'));
        }
    }

    public function add()
    {
        if ($this->hasPermission('m_mealtime', 'Write')) {
            $mealtimes = new M_mealtimes();
            $data = setPageData_paging($mealtimes);
            $this->loadBlade('m_mealtime.add', lang('Form.mealtime'), $data);
        }
    }

    public function addsave()
    {

        if ($this->hasPermission('m_mealtime', 'Write')) {

            $mealtimes = new M_mealtimes();
            $mealtimes->parseFromRequest();

            try {
                $mealtimes->validate();
                $mealtimes->save();
                Session::setFlash('success_msg', array(0 => lang('Form.datasaved')));
                redirect('mmealtime/add')->go();
            } catch (Nayo_Exception $e) {

                Session::setFlash('add_warning_msg', array(0 => $e->messages));
                redirect("mmealtime/add")->with($mealtimes)->go();
            }
        }
    }

    public function edit($id)
    {
        if ($this->hasPermission('m_mealtime', 'Write')) {

            $mealtimes = M_mealtimes::get($id);

            $data['model'] = $mealtimes;
            $this->loadBlade('m_mealtime.edit', lang('Form.mealtime'), $data);
        }
    }

    public function editsave()
    {

        if ($this->hasPermission('m_mealtime', 'Write')) {

            $id = $this->request->post('Id');

            $mealtimes = M_mealtimes::get($id);
            $oldmodel = clone $mealtimes;

            $mealtimes->parseFromRequest();

            try {
                $mealtimes->validate($oldmodel);

                $mealtimes->save();
                Session::setFlash('success_msg', array(0 => lang('Form.datasaved')));
                redirect('mmealtime')->go();
            } catch (Nayo_Exception $e) {

                Session::setFlash('edit_warning_msg', array(0 => $e->message));
                redirect("mmealtimeedit/edit/{$id}")->with($mealtimes)->go();
            }
        }
    }


    public function delete()
    {

        $id = $this->request->post("id");
        if (isPermitted_paging($_SESSION[get_variable() . 'userdata']['M_Groupuser_Id'], form_paging()['m_mealtime'], 'Delete')) {

            $model = M_mealtimes::get($id);

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

        if ($this->hasPermission('m_mealtime', 'Read')) {

            $datatable = new Datatables('M_mealtimes');
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
                                "href" => baseUrl('mmealtime/edit/' . $row->Id),
                                "class" => "text-muted"
                            ));
                    }
                )->addColumn(
                    'StartTime'
                )->addColumn(
                    'EndTime'
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

        $datatable = new Datatables('M_mealtimes');
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
