<?php

namespace App\Controllers;

use App\Models\M_uoms;
use App\Controllers\Base_Controller;
use Core\Nayo_Exception;
use Core\Libraries\Datatables;
use Core\Session;

class M_uom extends Base_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->hasPermission('m_uom', 'Read')) {
            $this->loadBlade('m_uom.index', lang('Form.uom'));
        }
    }

    public function add()
    {
        if ($this->hasPermission('m_uom', 'Write')) {
            $uoms = new M_uoms();
            $data = setPageData_paging($uoms);
            $this->loadBlade('m_uom.add', lang('Form.uom'), $data);
        }
    }

    public function addsave()
    {

        if ($this->hasPermission('m_uom', 'Write')) {
            $uoms = new M_uoms();
            $uoms->parseFromRequest();

            try {
                $uoms->validate();

                $uoms->save();
                Session::setFlash('success_msg', array(0 => lang('Form.datasaved')));
                redirect('muom/add')->go();
            } catch (Nayo_Exception $e) {

                Session::setFlash('add_warning_msg', array(0 => $e->messages));
                redirect("muom/add")->with($e->data)->go();
            }
        }
    }

    public function edit($id)
    {
        if ($this->hasPermission('m_uom', 'Write')) {

            $uoms = M_uoms::get($id);
            $data['model'] = $uoms;
            $this->loadBlade('m_uom.edit', lang('Form.uom'), $data);
        }
    }

    public function editsave()
    {

        if ($this->hasPermission('m_uom', 'Write')) {
            $id = $this->request->post('Id');

            $uoms = M_uoms::get($id);
            $oldmodel = clone $uoms;

            $uoms->parseFromRequest();

            try {
                $uoms->validate($oldmodel);


                $uoms->save();
                Session::setFlash('success_msg', array(0 => lang('Form.datasaved')));
                redirect('muom')->go();
            } catch (Nayo_Exception $e) {

                Session::setFlash('edit_warning_msg', array(0 => $e->messages));
                redirect("muom/edit/{$id}")->with($e->data)->go();
            }
        }
    }


    public function delete()
    {

        $id = $this->request->post("id");
        if ($this->hasPermission('m_uom', 'Delete')) {
            $model = M_uoms::get($id);
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

        if ($this->hasPermission('m_uom', 'Read')) {

            $datatable = new Datatables('M_uoms');
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
                        return
                            formLink($row->Name, array(
                                "id" => $row->Id . "~a",
                                "href" => baseUrl('muom/edit/' . $row->Id),
                                "class" => "text-muted"
                            ));
                    }
                )->addColumn(
                    'Description',
                    function ($row) {
                        return $row->Description;
                    }
                )->addColumn(
                    'Created',
                    function ($row) {
                        return $row->Created;
                    },
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

        $datatable = new Datatables('M_uoms');
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
