<?php  
namespace App\Models;
use App\Models\Base_Model;

class M_itemstocks extends Base_Model {

	public $Id;
	public $M_Item_Id;
	public $M_Uom_Id;
	public $M_Warehouse_Id;
	public $Qty;
	public $CreatedBy;
	public $ModifiedBy;
	public $Created;
	public $Modified;

    
    protected $table = "m_itemstocks";

    public function __construct(){
        parent::__construct();
    }

}