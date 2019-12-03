<?php

namespace App\Controllers;

use App\Models\M_uomconversions;
use App\Controllers\Base_Controller;
use Core\Libraries\Datatables;
use App\Models\M_items;
use App\Models\M_enumdetails;
use Core\Nayo_Exception;
use Core\Session;

class M_uomconversion extends Base_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index($iditem)
    {
        if ($this->hasPermission('m_item', 'Read')) {

            $result = M_items::get($iditem);
            $data['model'] = $result;

            $this->loadView('m_uomconversion/index', lang('Form.uomconversion'), $data);
        }
    }

    public function add($iditem)
    {
        if ($this->hasPermission('m_item', 'Write')) {

            $result = M_items::get($iditem);

            $uomconversions = new M_uomconversions();

            $data = setPageData_paging($uomconversions);

            $data['item'] = $result;
            $this->loadView('m_uomconversion/add', lang('Form.uomconversion'), $data);
        }
    }

    public function addsave()
    {

        if ($this->hasPermission('m_item', 'Write')) {


            $uomconversions = new M_uomconversions();
            $uomconversions->parseFromRequest();

            try {
                $uomconversions->validate();

                $uomconversions->save();
                Session::setFlash('success_msg', array(0 => lang('Form.datasaved')));
                redirect("muomconversion/add/{$uomconversions->M_Item_Id}")->go();
            } catch (Nayo_Exception $e) {

                Session::setFlash('add_warning_msg', array(0 => $e->messages));
                redirect("muomconversion/add/{$uomconversions->M_Item_Id}")->with($uomconversions)->go();
            }
        }
    }

    public function edit($id)
    {
        if ($this->hasPermission('m_item', 'Write')) {


            $uomconversions = M_uomconversions::get($id);

            $items = new M_items();
            $result = M_items::get($uomconversions->M_Item_Id);

            $data['model'] = $uomconversions;
            $data['item'] = $result;
            $this->loadView('m_uomconversion/edit', lang('Form.uomconversion'), $data);
        }
    }

    public function editsave()
    {

        if ($this->hasPermission('m_item', 'Write')) {

            $id = $this->request->post('Id');

            $uomconversions = M_uomconversions::get($id);
            $oldmodel = clone $uomconversions;

            $uomconversions->parseFromRequest();

            try {
                $uomconversions->validate($oldmodel);
                $uomconversions->save();
                Session::setFlash('success_msg', array(0 => lang('Form.datasaved')));
                redirect("muomconversion/$uomconversions->M_Item_Id")->go();
            } catch (Nayo_Exception $e) {

                Session::setFlash('edit_warning_msg', array(0 => $e->messages));
                redirect("muomconversion/edit/$id")->with($e->data)->go();
            }
        }
    }


    public function delete()
    {

        $id = $this->request->post("id");
        if ($this->hasPermission('m_item', 'Delete')) {

            $model = M_uomconversions::get($id);
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

    public function getAllData($iditem)
    {

        if ($this->hasPermission('m_item', 'Read')) {

            $params = [
                'where' => [
                    'M_Item_Id' => $iditem
                ]
            ];
            $datatable = new Datatables('M_uomconversions', $params);
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
                    'CompleteName',
                    function ($row) {
                        return
                            formLink($row->CompleteName, array(
                                "id" => $row->Id . "~a",
                                "href" => baseUrl("muomconversion/edit/$row->Id"),
                                "class" => "text-muted"
                            ));
                    }
                )->addColumn(
                    'NIK',
                    function ($row) {
                        return $row->NIK;
                    }
                )->addColumn(
                    'Gender',
                    function ($row) {
                        return M_enumdetails::getEnumName("Gender", $row->Gender);
                    },
                    false
                )->addColumn(
                    'Relation',
                    function ($row) {
                        return M_enumdetails::getEnumName("FamilyRelation", $row->Relation);
                    },
                    false
                )->addColumn(
                    'BirthPlace',
                    function ($row) {
                        return $row->BirthPlace;
                    },
                    false
                )->addColumn(
                    'BirthDate',
                    function ($row) {
                        return $row->BirthDate;
                    }
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

    public function getDataModal($iditem)
    {
        $params = array();
        if ($iditem > 0)
            $params = [
                'where' => [
                    'M_Item_Id' => $iditem
                ]
            ];
        $datatable = new Datatables('M_uomconversions', $params);
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
                'NIK',
                function ($row) {
                    return $row->NIK;
                }
            )->addColumn(
                'M_Item_Id',
                function ($row) {
                    return $row->get_M_Item()->getHeadFamily();
                }
            )->addColumn(
                'CompleteName',
                function ($row) {
                    return $row->CompleteName;
                }
            );

        echo json_encode($datatable->populate());
    }

    public function getDataById()
    {

        $id = $this->request->post("id");
        $role = $this->request->post("role");
        if ($this->hasPermission($role, 'Write')) {

            $model = M_uomconversions::get($id);
            if ($model) {
                $data = [
                    'data' => $model
                ];

                echo json_encode($data);
            } else {
                echo json_encode(deleteStatus("", FALSE, TRUE));
            }
        }
    }
}
