<?php

namespace App\Controllers;

use App\Models\M_menuoptions;
use App\Controllers\Base_Controller;
use App\Libraries\ResponseCode;
use Core\Libraries\Datatables;
use Core\Nayo_Exception;
use Core\Session;
use GuzzleHttp\Psr7\Response;

class M_menuoption extends Base_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->hasPermission('m_menu', 'Read')) {
            
            $this->loadBlade('m_menuoption.index', lang('Form.menuoption'));
        }
    }

    public function add()
    {
        if ($this->hasPermission('m_menu', 'Write')) {
            $menuoptions = new M_menuoptions();
            $data = setPageData_paging($menuoptions);
            $this->loadBlade('m_menuoption.add', lang('Form.menuoption'), $data);
        }
    }

    public function addsave()
    {

        if ($this->hasPermission('m_menu', 'Write')) {

            $menuoptions = new M_menuoptions();
            $menuoptions->parseFromRequest();

            try {
                $menuoptions->validate();
                $menuoptions->save();
                Session::setFlash('success_msg', array(0 => lang('Form.datasaved')));
                redirect('mmenuoption/add')->go();
            } catch (Nayo_Exception $e) {

                Session::setFlash('add_warning_msg', array(0 => $e->messages));
                redirect("mmenuoption/add")->with($menuoptions)->go();
            }
        }
    }

    public function edit($id)
    {
        if ($this->hasPermission('m_menu', 'Write')) {

            $menuoptions = M_menuoptions::get($id);

            $data['model'] = $menuoptions;
            $this->loadBlade('m_menuoption.edit', lang('Form.menuoption'), $data);
        }
    }

    public function editsave()
    {

        if ($this->hasPermission('m_menu', 'Write')) {

            $id = $this->request->post('Id');

            $menuoptions = M_menuoptions::get($id);
            $oldmodel = clone $menuoptions;

            $menuoptions->parseFromRequest();

            try {
                $menuoptions->validate($oldmodel);

                $menuoptions->save();
                Session::setFlash('success_msg', array(0 => lang('Form.datasaved')));
                redirect('mmenuoption')->go();
            } catch (Nayo_Exception $e) {

                Session::setFlash('edit_warning_msg', array(0 => $e->message));
                redirect("mmenuoptionedit/edit/{$id}")->with($menuoptions)->go();
            }
        }
    }


    public function delete()
    {

        $id = $this->request->post("id");
        if (isPermitted_paging($_SESSION[get_variable() . 'userdata']['M_Groupuser_Id'], form_paging()['m_menuoption'], 'Delete')) {

            $model = M_menuoptions::get($id);

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

            $datatable = new Datatables('M_menuoptions');
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
                                "href" => baseUrl('mmenuoption/edit/' . $row->Id),
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

        $datatable = new Datatables('M_menuoptions');
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
                'StartTime'
            )->addColumn(
                'EndTime'
            );

        echo json_encode($datatable->populate());
    }

    public function getDataJson(){

        if ($this->hasPermission('m_menu', 'Read')) {
            $menuoption = M_menuoptions::getAll();
            $result = [
                'Message' => lang('Form.success'),
                'Result' => $menuoption,
                'Status' => ResponseCode::OK
            ];
           echo json_encode($result);
            // $this->response->json($result, 200);
        }
    }
}
