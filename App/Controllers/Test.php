<?php
namespace App\Controllers;

use App\Models\M_uomconversions;
use Core\Nayo_Controller;

class Test extends Nayo_Controller{

    public function __construct()
    {
        parent::__construct();
    }
    
    public function index(){
        // $params = [
        //     'where' => [
        //         'M_Item_Id' => 2
        //     ]
        // ];
        // $u = M_uomconversions::get(2);

        // foreach($unit as $u){
            // echo $u->get_M_Item()->Code;
            // echo $u->get_M_Uom("From")->Name;
            // echo "<br>";
            // echo $u->get_M_Uom("To")->Name;
        // }

        // echo json_encode($u);
        // $this->blade("test.test");
        $params['where'][] = ['M_Item_Id' => 1];
        $params['where'][] = ['M_Wrehouse_Id' => 123];
        echo \json_encode($params);
    }
}