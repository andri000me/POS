<?php  
namespace App\Models;
use Core\Nayo_Model;

class M_enums extends Nayo_Model {

    public $Id;
public $Name;

    
    protected $table = "m_enums";

    public function __construct(){
        parent::__construct();
    }

}