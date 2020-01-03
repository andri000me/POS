<?php  
namespace App\Models;
use Core\Nayo_Model;

class T_itemreceivingdetails extends Nayo_Model {

	public $Id;
	public $T_Itemtransfer_Id;
	public $T_Itemreceiving_Id;
	public $CreatedBy;
	public $ModifiedBy;
	public $Created;
	public $Modified;

    
    protected $table = "t_itemreceivingdetails";

    public function __construct(){
        parent::__construct();
    }

}