<?php  
namespace App\Models;
use App\Models\Base_Model;
use Core\Session;

class M_itemstocks extends Base_Model {

	public $Id;
	public $M_Shop_Id;
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
		$this->M_Shop_Id = isset(Session::get(get_variable() . 'userdata')['M_Shop_Id']) ? Session::get(get_variable() . 'userdata')['M_Shop_Id'] : null;
    }

}