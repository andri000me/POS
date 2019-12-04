<?php  
namespace App\Models;
use App\Models\Base_Model;

class T_itemstockdetails extends Base_Model {

	public $Id;
	public $T_Itemstock_Id;
	public $M_Uom_Id;
	public $M_Warehouse_Id;
	public $Qty;
	public $CreatedBy;
	public $ModifiedBy;
	public $Created;
	public $Modified;

    
    protected $table = "t_itemstockdetails";

    public function __construct(){
        parent::__construct();
    }

}