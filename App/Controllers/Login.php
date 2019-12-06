<?php

namespace App\Controllers;

use Core\Nayo_Controller;
use App\Models\M_users;
use Core\Database\Driver\Sqlsrv;
use Core\Session;

class Login extends Nayo_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        // new Sqlsrv();
        $userSession = Session::get(get_variable() . 'userdata');
        if (!isset($userSession))
            $this->blade('login.login');
        else
            redirect('home')->go();
    }

    public function dologin()
    {
        $username = $this->request->post('loginUsername');
        $password = $this->request->post('loginPassword');

        $query = M_users::login($username, $password);
        
        if ($query) {
            if ($query->IsActive == 1) {
                Session::set(get_variable() . 'userdata', get_object_vars($query));
                Session::set(get_variable() . 'language', $query->Language);
                redirect('home')->go();
            } else {
                redirect('home')->go();
            }
        } else {
            redirect('home')->go();  
        }
    }

    public function dologout()
    {
        Session::destroy();
        redirect('')->go();
    }
}
