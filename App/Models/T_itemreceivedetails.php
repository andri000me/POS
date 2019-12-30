<?php  
namespace App\Models;
use Core\Nayo_Model;

class T_itemreceivedetails extends Nayo_Model {

	public $Id;
	public $T_Itemtransfer_Id;
	public $T_Itemreceive_Id;
	public $CreatedBy;
	public $ModifiedBy;
	public $Created;
	public $Modified;

    
    protected $table = "t_itemreceivedetails";

    public function __construct(){
        parent::__construct();
    }

}