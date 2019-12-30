<?php

namespace App\Controllers;

use Core\Nayo_Controller;
use Core\Libraries\Helper;
use App\Models\M_forms;
use Core\Session;
use Core\View;

class Base_Controller extends Nayo_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function loadView($url,  $title = "", $datas = array())
    {

        // menu
        $params = array(
            'whereNotIn' => array(
                'FormName' => ['t_pos']
            )
        );


        $allmenu = M_forms::getAll($params);
        $master = Helper::arr_filter($allmenu, "ClassName", "Master");
        $setting = Helper::arr_filter($allmenu, "ClassName", "Setting");
        $area = Helper::arr_filter($allmenu, "ClassName", "Master Area");
        $user = Helper::arr_filter($allmenu, "ClassName", "Master User");
        $general = Helper::arr_filter($allmenu, "ClassName", "Master General");
        $infrastructur = Helper::arr_filter($allmenu, "ClassName", "Master Infrastructur");
        $volunteer = Helper::arr_filter($allmenu, "ClassName", "Master Volunteer");
        $item = Helper::arr_filter($allmenu, "ClassName", "Master Item");
        $transaction = Helper::arr_filter($allmenu, "ClassName", "Transaction");
        $broadcast = Helper::arr_filter($allmenu, "ClassName", "Master Broadcast");



        $expandfound = "";
        $usermenu = "";
        foreach ($user as $menu) {
            if (lang($menu->Resource) == $title) {
                $expandfound = "userexpand";
                $usermenu .= "<li class = 'active'><a href='" . baseUrl($menu->IndexRoute) . "'>" . lang($menu->Resource) . "</a></li>";
            } else {
                $usermenu .= "<li><a href='" . baseUrl($menu->IndexRoute) . "'>" . lang($menu->Resource) . "</a></li>";
            }
        }

        $generalmenu = "";
        foreach ($general as $menu) {
            if (lang($menu->Resource) == $title) {
                $expandfound = "generalexpand";
                $generalmenu .= "<li class = 'active'><a href='" . baseUrl($menu->IndexRoute) . "'>" . lang($menu->Resource) . "</a></li>";
            } else {
                $generalmenu .= "<li><a href='" . baseUrl($menu->IndexRoute) . "'>" . lang($menu->Resource) . "</a></li>";
            }
        }

        $areamenu = "";
        foreach ($area as $menu) {
            if (lang($menu->Resource) == $title) {
                $expandfound = "areaexpand";
                $areamenu .= "<li class = 'active'><a href='" . baseUrl($menu->IndexRoute) . "'>" . lang($menu->Resource) . "</a></li>";
            } else {
                $areamenu .= "<li><a href='" . baseUrl($menu->IndexRoute) . "'>" . lang($menu->Resource) . "</a></li>";
            }
        }

        $broadcastmenu = "";
        foreach ($broadcast as $menu) {
            if (lang($menu->Resource) == $title) {
                $expandfound = "broadcastexpand";
                $broadcastmenu .= "<li class = 'active'><a href='" . baseUrl($menu->IndexRoute) . "'>" . lang($menu->Resource) . "</a></li>";
            } else {
                $broadcastmenu .= "<li><a href='" . baseUrl($menu->IndexRoute) . "'>" . lang($menu->Resource) . "</a></li>";
            }
        }

        $volunteermenu = "";
        foreach ($volunteer as $menu) {
            if (lang($menu->Resource) == $title) {
                $expandfound = "volunteerexpand";
                $volunteermenu .= "<li class = 'active'><a href='" . baseUrl($menu->IndexRoute) . "'>" . lang($menu->Resource) . "</a></li>";
            } else {
                $volunteermenu .= "<li><a href='" . baseUrl($menu->IndexRoute) . "'>" . lang($menu->Resource) . "</a></li>";
            }
        }

        $itemmenu = "";
        foreach ($item as $menu) {
            if (lang($menu->Resource) == $title) {
                $expandfound = "itemexpand";
                $itemmenu .= "<li class = 'active'><a href='" . baseUrl($menu->IndexRoute) . "'>" . lang($menu->Resource) . "</a></li>";
            } else {
                $itemmenu .= "<li><a href='" . baseUrl($menu->IndexRoute) . "'>" . lang($menu->Resource) . "</a></li>";
            }
        }

        $transactionmenu = "";
        foreach ($transaction as $menu) {
            if (lang($menu->Resource) == $title) {
                $expandfound = "transactionexpand";
                $transactionmenu .= "<li class = 'active'><a href='" . baseUrl($menu->IndexRoute) . "'>" . lang($menu->Resource) . "</a></li>";
            } else {
                $transactionmenu .= "<li><a href='" . baseUrl($menu->IndexRoute) . "'>" . lang($menu->Resource) . "</a></li>";
            }
        }

        $expndas = [
            "userexpand" =>  [$usermenu, "fa fa-user", lang('Form.masteruser')],
            "generalexpand" =>  [$generalmenu, "fa fa-archive", lang('Form.mastergeneral')],
            "areaexpand" =>  [$areamenu, "fa fa-archive", lang('Form.masterarea')],
            "broadcastexpand" =>  [$broadcastmenu, "fa fa-archive", "Master Broadcast"],
            "volunteerexpand" =>  [$volunteermenu, "fa fa-archive", lang('Form.mastervolunteer')],
            "itemexpand" =>  [$itemmenu, "fa fa-archive", lang('Form.masteritem')],
            "transactionexpand" =>  [$transactionmenu, "fa fa-archive", lang('Form.transaction')],
        ];


        $menudata["menu"] = "<div class='main-menu'>
          <h5 class='sidenav-heading'>Main</h5>
          <ul id='side-main-menu' class='side-menu list-unstyled'>                  
            <li><a href='" . baseUrl('welcome') . "'> <i class='fa fa-map-marked-alt'></i>" . lang('Form.map') . "</a></li>
            <li><a href='#exampledropdownDropdownGeneral' aria-expanded='false' data-toggle='collapse'> <i class='fa fa-cog'></i>" . lang('Form.setting') . "</a>
              <ul id='exampledropdownDropdownGeneral' class='collapse list-unstyled '>
                <li><a href='" . baseUrl('setting') . "'>" . lang('Form.setting') . "</a></li>
                <li><a href='" . baseUrl('mcompany') . "'>" . lang('Form.company') . "</a></li>
                <li><a href='" . baseUrl('msafedistance') . "'>" . lang('Form.safedistance') . "</a></li>
              </ul>
            </li>";

        $menuend = "</ul>
        </div>
        <div class='admin-menu'>
          <h5 class='sidenav-heading'>" . lang('Form.report') . "</h5>
          <ul id='side-admin-menu' class='side-menu list-unstyled'> 
            <li><a href='" . baseUrl('reports') . "'><i class='icon-interface-windows'></i>" . lang('Form.report') . "</a></li>
          </ul>
        </div>";

        foreach ($expndas as $key => $ex) {
            if ($key == $expandfound) {
                $menudata["menu"] .= "<li class = 'active'><a href='#{$key}' aria-expanded='true' data-toggle='collapse'> <i class='{$ex[1]}'></i>{$ex[2]}</a>
                <ul id='$key' class='collapse list-unstyled show'>
                    $ex[0]
                </ul>
                </li>";
            } else {
                $menudata["menu"] .= "<li ><a href='#{$key}' aria-expanded='false' data-toggle='collapse'> <i class='{$ex[1]}'></i>{$ex[2]}</a>
                <ul id='$key' class='collapse list-unstyled'>
                    $ex[0]
                </ul>
                </li>";
            }
            // $menudata['menu'] = str_replace($key, $ex, $menudata['menu']);
        }
        $menudata['menu'] .= $menuend;
        $menudata['title'] = $title;

        $session = Session::getInstance();
        $data = array();
        if($session->get('data')){
            $sesdata = $session->get('data');
            foreach($datas['model'] as $key => $model){
                $datas['model']->$key = $sesdata[$key];
            }

            $data = $datas;
        } else {
            $data = $datas;
        }
        // echo json_encode($datas);
        $this->view('shared/header', $menudata, false);
        $this->view($url, $data, false);
        $this->view('shared/footer', array());
    }

    public function loadBlade($path, $title = "", $datas = array())
    {
        $params = array(
            'whereNotIn' => array(
                'FormName' => ['t_pos']
            )
        );


        $allmenu = M_forms::getAll($params);
        $master = Helper::arr_filter($allmenu, "ClassName", "Master");
        $setting = Helper::arr_filter($allmenu, "ClassName", "Setting");
        $area = Helper::arr_filter($allmenu, "ClassName", "Master Area");
        $user = Helper::arr_filter($allmenu, "ClassName", "Master User");
        $general = Helper::arr_filter($allmenu, "ClassName", "Master General");
        $infrastructur = Helper::arr_filter($allmenu, "ClassName", "Master Infrastructur");
        $volunteer = Helper::arr_filter($allmenu, "ClassName", "Master Volunteer");
        $item = Helper::arr_filter($allmenu, "ClassName", "Master Item");
        $transaction = Helper::arr_filter($allmenu, "ClassName", "Transaction");
        $broadcast = Helper::arr_filter($allmenu, "ClassName", "Master Broadcast");


        $menudata = [];

        $expandfound = "";
        $usermenu = "";
        // echo json_encode("");
        foreach ($user as $menu) {
            if (lang($menu->Resource) == $title) {
                $expandfound = "userexpand";
                $usermenu .= "<li class = 'nav-item'>
                    <a class = 'nav-link active' href='" . baseUrl($menu->IndexRoute) . "'>
                        <i class='nav-icon fas fa-file'></i>
                        <p>".lang($menu->Resource)."
                            
                           
                        </p>
                    </a>
                </li>";
            } else {
                $usermenu .= "<li class = 'nav-item'>
                <a class = 'nav-link' href='" . baseUrl($menu->IndexRoute) . "'>
                    <i class='nav-icon fas fa-file'></i>
                    <p>".lang($menu->Resource).
                        
                        "
                    </p>
                </a>
            </li>";
            }
        }

        $generalmenu = "";
        foreach ($general as $menu) {
            if (lang($menu->Resource) == $title) {
                $expandfound = "generalexpand";
                $generalmenu .= "<li class = 'nav-item'>
                    <a class = 'nav-link active' href='" . baseUrl($menu->IndexRoute) . "'>
                        <i class='nav-icon fas fa-file'></i>
                        <p>".lang($menu->Resource)."
                            
                           
                        </p>
                    </a>
                </li>";
            } else {
                $generalmenu .= "<li class = 'nav-item'>
                <a class = 'nav-link' href='" . baseUrl($menu->IndexRoute) . "'>
                    <i class='nav-icon fas fa-file'></i>
                    <p>".lang($menu->Resource).
                        
                        "
                    </p>
                </a>
            </li>";
            }
        }

        // $areamenu = "";
        // foreach ($area as $menu) {
        //     if (lang($menu->Resource) == $title) {
        //         $expandfound = "areaexpand";
        //         $areamenu .= "<li class = 'active'><a href='" . baseUrl($menu->IndexRoute) . "'>" . lang($menu->Resource) . "</a></li>";
        //     } else {
        //         $areamenu .= "<li><a href='" . baseUrl($menu->IndexRoute) . "'>" . lang($menu->Resource) . "</a></li>";
        //     }
        // }

        // $broadcastmenu = "";
        // foreach ($broadcast as $menu) {
        //     if (lang($menu->Resource) == $title) {
        //         $expandfound = "broadcastexpand";
        //         $broadcastmenu .= "<li class = 'active'><a href='" . baseUrl($menu->IndexRoute) . "'>" . lang($menu->Resource) . "</a></li>";
        //     } else {
        //         $broadcastmenu .= "<li><a href='" . baseUrl($menu->IndexRoute) . "'>" . lang($menu->Resource) . "</a></li>";
        //     }
        // }

        // $volunteermenu = "";
        // foreach ($volunteer as $menu) {
        //     if (lang($menu->Resource) == $title) {
        //         $expandfound = "volunteerexpand";
        //         $volunteermenu .= "<li class = 'active'><a href='" . baseUrl($menu->IndexRoute) . "'>" . lang($menu->Resource) . "</a></li>";
        //     } else {
        //         $volunteermenu .= "<li><a href='" . baseUrl($menu->IndexRoute) . "'>" . lang($menu->Resource) . "</a></li>";
        //     }
        // }

        $itemmenu = "";
        foreach ($item as $menu) {
            if (lang($menu->Resource) == $title) {
                $expandfound = "itemexpand";
                $itemmenu .= "<li class = 'nav-item'>
                <a class = 'nav-link active' href='" . baseUrl($menu->IndexRoute) . "'>
                    <i class='nav-icon fas fa-file'></i>
                    <p>".lang($menu->Resource)."
                        
                       
                    </p>
                </a>
            </li>";
            } else {
                $itemmenu .= "<li class = 'nav-item'>
                <a class = 'nav-link' href='" . baseUrl($menu->IndexRoute) . "'>
                    <i class='nav-icon fas fa-file'></i>
                    <p>".lang($menu->Resource).
                        
                        "
                    </p>
                </a>
            </li>";
            }
        }

        $transactionmenu = "";
        foreach ($transaction as $menu) {
            if (lang($menu->Resource) == $title) {
                $expandfound = "transactionexpand";
                $transactionmenu .= "<li class = 'nav-item'>
                <a class = 'nav-link active' href='" . baseUrl($menu->IndexRoute) . "'>
                    <i class='nav-icon fas fa-file'></i>
                    <p>".lang($menu->Resource)."
                        
                       
                    </p>
                </a>
            </li>";
            } else {
                $transactionmenu .= "<li class = 'nav-item'>
                <a class = 'nav-link' href='" . baseUrl($menu->IndexRoute) . "'>
                    <i class='nav-icon fas fa-file'></i>
                    <p>".lang($menu->Resource).
                        
                        "
                    </p>
                </a>
            </li>";
            }
        }
        $expndas = [
            "userexpand" =>  [$usermenu, "nav-icon fas fa fa-user", lang('Form.masteruser')],
            "generalexpand" =>  [$generalmenu, " nav-icon fa fa-archive", lang('Form.mastergeneral')],
            // "areaexpand" =>  [$areamenu, "fa fa-archive", lang('Form.masterarea')],
            // "broadcastexpand" =>  [$broadcastmenu, "fa fa-archive", "Master Broadcast"],
            // "volunteerexpand" =>  [$volunteermenu, "fa fa-archive", lang('Form.mastervolunteer')],
            "itemexpand" =>  [$itemmenu, "nav-icon fa fa-archive", lang('Form.masteritem')],
            "transactionexpand" =>  [$transactionmenu, "nav-icon fa fa-archive", lang('Form.transaction')],
        ];
        $menudata["menu"]="";
        // $menudata["menu"] = "<div class='main-menu'>
        //   <h5 class='sidenav-heading'>Main</h5>
        //   <ul id='side-main-menu' class='side-menu list-unstyled'>                  
        //     <li><a href='" . baseUrl('welcome') . "'> <i class='fa fa-map-marked-alt'></i>" . lang('Form.map') . "</a></li>
        //     <li><a href='#exampledropdownDropdownGeneral' aria-expanded='false' data-toggle='collapse'> <i class='fa fa-cog'></i>" . lang('Form.setting') . "</a>
        //       <ul id='exampledropdownDropdownGeneral' class='collapse list-unstyled '>
        //         <li><a href='" . baseUrl('setting') . "'>" . lang('Form.setting') . "</a></li>
        //         <li><a href='" . baseUrl('mcompany') . "'>" . lang('Form.company') . "</a></li>
        //         <li><a href='" . baseUrl('msafedistance') . "'>" . lang('Form.safedistance') . "</a></li>
        //       </ul>
        //     </li>";
        $menuend ="";
        // $menuend = "</ul>
        // </div>
        // <div class='admin-menu'>
        //   <h5 class='sidenav-heading'>" . lang('Form.report') . "</h5>
        //   <ul id='side-admin-menu' class='side-menu list-unstyled'> 
        //     <li><a href='" . baseUrl('reports') . "'><i class='icon-interface-windows'></i>" . lang('Form.report') . "</a></li>
        //   </ul>
        // </div>";
        foreach ($expndas as $key => $ex) {
            if ($key == $expandfound) {
                $menudata["menu"] .= "<li class = 'nav-item has-treeview menu-open'>
                    <a href='#' class='nav-link' aria-expanded='true' data-toggle='collapse'> 
                        <i class= '{$ex[1]}'></i>
                        <p>
                            {$ex[2]}
                            <i class='right fas fa-angle-left'></i>
                        </p>
                    </a>
                    <ul class='nav nav-treeview'>
                        $ex[0]
                    </ul>
                </li>";
            } else {
                $menudata["menu"] .= "<li class = 'nav-item has-treeview'>
                <a href='#' class='nav-link'> 
                    <i class= '{$ex[1]}'></i>
                    <p>
                        {$ex[2]}
                        <i class='right fas fa-angle-left'></i>
                    </p>
                </a>
                <ul class='nav nav-treeview'>
                    $ex[0]
                </ul>
            </li>";
            }
            // $menudata['menu'] = str_replace($key, $ex, $menudata['menu']);
        }
        $menudata['menu'] .= $menuend;
        // $menudata['menu'] .= "";
        $menudata['title'] = $title;

        $session = Session::getInstance();
        $data = array();
        if($session->get('data')){
            $sesdata = $session->get('data');
            foreach($datas['model'] as $key => $model){
                $datas['model']->$key = $sesdata[$key];
            }

            $data = $datas;
        } else {
            $data = $datas;
        }

        View::presentBlade('shared.header', $menudata, true);
        View::presentBlade($path, $data, true);
        View::presentBlade('shared.footer');
    }

    public function hasPermission($form, $role)
    {

        if (empty(Session::get(get_variable() . 'userdata'))) {
            redirect()->go();
        }

        if (isPermitted_paging($_SESSION[get_variable() . 'userdata']['M_Groupuser_Id'], form_paging()[$form], $role)) {
            return true;
        }
        redirect("Forbidden")->go();
    }

    public function hasReportPermission($report, $role)
    {

        if (empty(Session::get(get_variable() . 'userdata'))) {
            redirect()->go();
        }

        if (isPermitted_paging($_SESSION[get_variable() . 'userdata']['M_Groupuser_Id'], report_paging()[$report], $role, true)) {
            return true;
        }
        redirect("Forbidden")->go();
    }
}
