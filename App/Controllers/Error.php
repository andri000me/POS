<?php
namespace App\Controllers;
use App\Controllers\Base_Controller;
use Core\View;

class Error extends Base_Controller{

    public function forbidden(){
        
        $this->loadBlade('error.403');
    }

}