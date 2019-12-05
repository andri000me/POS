<?php
namespace App\Controllers;

use App\Models\M_items;
use App\Models\M_itemstocks;
use App\Models\M_uomconversions;
use App\Models\T_itemstockdetails;
use App\Models\T_itemstocks;
use Core\Nayo_Controller;

class Test extends Nayo_Controller{

    public function __construct()
    {
        parent::__construct();
    }
    
    public function index(){
        // $params = [
        //     'where' => [
        //         'T_Itemstock_Id' => 2,
        //         'M_Warehouse_Id' => 'null'
        //     ]
        // ];
        $u = M_uomconversions::getQtyConversion(2, 1, 2);
        echo 60.00 * $u;
        
        
    }
}