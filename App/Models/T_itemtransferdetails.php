<?php  
namespace App\Models;
use App\Models\Base_Model;

class T_itemtransferdetails extends Base_Model {

	public $Id;
	public $T_Itemtransfer_Id;
	public $M_Item_Id;
	public $M_Uom_Id;
	public $M_Warehouse_Id;
	public $Qty;
	public $CreatedBy;
	public $ModifiedBy;
	public $Created;
	public $Modified;

    
    protected $table = "t_itemtransferdetails";

    public function __construct($itemtransferid = null){
        parent::__construct();
		$this->T_Itemtransfer_Id = $itemtransferid;
    }

}