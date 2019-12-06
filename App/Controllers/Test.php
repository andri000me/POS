<?php
namespace App\Controllers;

use App\Models\M_forms;
use App\Models\M_items;
use App\Models\M_itemstocks;
use App\Models\M_uomconversions;
use App\Models\T_itemstockdetails;
use App\Models\T_itemstocks;
use Core\Nayo_Controller;
use Core\Session;

class Test extends Nayo_Controller{

    public function __construct()
    {
        parent::__construct();
    }
    
    public function index(){
        // $params = array(
        //     'whereNotIn' => array(
        //         'FormName' => ['t_pos']
        //     )
        // );


        // $allmenu = M_forms::getAll($params);
        // echo \json_encode($allmenu);
        echo Session::get(get_variable() . 'userdata')['a'];
        
        
    }
}