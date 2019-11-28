<?php  
namespace App\Models;
use Core\Nayo_Model;

class M_accessroles extends Nayo_Model {

    public $Id;
    public $M_Form_Id;
    public $M_Groupuser_Id;
    public $Read;
    public $Write;
    public $Delete;
    public $Print;

    
    protected $table = "m_accessroles";

    public function __construct(){
        parent::__construct();
    }

}