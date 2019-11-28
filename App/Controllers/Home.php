<?php
namespace App\Controllers;
use App\Controllers\Base_Controller;
use App\Models\M_disasters;
use App\Models\T_disasteroccurs;
use Core\Database\DBBuilder;
use Core\Session;

class Home extends Base_Controller{
    
    public function index(){
        if(empty(Session::get(get_variable().'userdata'))){
            redirect('/')->go();
        }
        $this->loadBlade('home.home', "Home");
    }
}