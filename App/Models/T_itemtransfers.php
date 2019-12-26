<?php  
namespace App\Models;

use App\Enums\T_itemtransferstatus;
use App\Libraries\ResponseCode;
use App\Models\Base_Model;
use Core\Nayo_Exception;
use Core\Session;

class T_itemtransfers extends Base_Model {

	public $Id;
	public $TransNo;
	public $TransDate;
	public $ReceivedDate;
	public $TransitDate;
	public $M_Shop_Id_From;
	public $M_Shop_Id_To;
	public $Status;
	public $Sender;
	public $CreatedBy;
	public $ModifiedBy;
	public $Created;
	public $Modified;

    
    protected $table = "t_itemtransfers";

    public function __construct(){
		parent::__construct();
		$this->Status = T_itemtransferstatus::NEW;
		$this->M_Shop_Id_From = isset(Session::get(get_variable() . 'userdata')['M_Shop_Id']) ? Session::get(get_variable() . 'userdata')['M_Shop_Id'] : null;
	}

	public static function getAll($params = array(), $htmlspeciachars = true){
		$params['where']['M_Shop_Id'] = isset(Session::get(get_variable() . 'userdata')['M_Shop_Id']) ? Session::get(get_variable() . 'userdata')['M_Shop_Id'] : null;
		return parent::getAll($params, $htmlspeciachars);
	}

	public static function countAll($params = array()){
		$params['where']['M_Shop_Id'] = isset(Session::get(get_variable() . 'userdata')['M_Shop_Id']) ? Session::get(get_variable() . 'userdata')['M_Shop_Id'] : null;
		return parent::countAll($params);
	}
	
	public function validate(self $oldmodel = null)
	{
		$nameexist = false;
		$warning = array();


		if (empty($this->M_Shop_Id_From)) {
			Nayo_Exception::throw(lang('Error.shop_from_cannot_null'), $this, ResponseCode::INVALID_DATA);
		}

		return $warning;
	}
	
	public function getEnumStatus()
	{
		if ($this->Status == T_itemtransferstatus::NEW || is_null($this->Status)) {
			return M_enumdetails::getEnums("ItemtransferStatus", [3]);
		} else if ($this->Status == T_itemtransferstatus::RELEASE) {
			return M_enumdetails::getEnums("ItemtransferStatus", [1,2,3]);
		} else if ($this->Status == T_itemtransferstatus::INTRANSIT) {
			return M_enumdetails::getEnums("ItemtransferStatus", [1,3,4]);
		}

		return M_enumdetails::getEnums("ItemtransferStatus", [1, 3]);
	}

	public function savedata($oldmodel = null)
	{
		$id = null;
		$formid = M_forms::getFormId(form_paging()['t_itemtransfer']);

		if (is_null($this->Id)) {
			$this->TransNo = G_transactionnumbers::getLastNumberByFormId($formid);
			G_transactionnumbers::updateLastNumber($formid);
		}

		if ($this->Status == T_itemtransferstatus::NEW) {
			$id = $this->save();
		} else if ($this->Status == T_itemtransferstatus::INTRANSIT) {

				$this->setToOriginal();
				$this->Status = T_itemtransferstatus::INTRANSIT;
				$this->TransitDate = get_current_date('Y-m-d H:i:s');
				$id = $this->save();
			// 	// $params = []; 
			// 	$id = $this->save();
			// 	// foreach ($this->get_list_T_Itemstockdetail() as $detail) {
			// 	// 	$params = [
			// 	// 		'where' => [
			// 	// 			'M_Item_Id' => $detail->M_Item_Id,
			// 	// 			'M_Shop_Id' => isset(Session::get(get_variable() . 'userdata')['M_Shop_Id']) ? Session::get(get_variable() . 'userdata')['M_Shop_Id'] : null
			// 	// 		]
			// 	// 	];
					
			// 	// 	if ($detail->M_Warehouse_Id)
			// 	// 		$params['where']['M_Warehouse_Id'] = $detail->M_Warehouse_Id;
			// 	// 	else
			// 	// 		$params['where']['M_Warehouse_Id'] = "null";

			// 	// 	$item = M_items::get($detail->M_Item_Id);
			// 	// 	$itemstock = M_itemstocks::getOne($params);
			// 	// 	if ($itemstock) {
			// 	// 		$itemstock->Qty += $detail->Qty * M_uomconversions::getQtyConversion($detail->M_Item_Id, $detail->M_Uom_Id, $item->M_Uom_Id);
			// 	// 		$itemstock->save();
			// 	// 	} else {
			// 	// 		$newstock = new M_itemstocks();
			// 	// 		$newstock->M_Item_Id = $detail->M_Item_Id;
			// 	// 		$newstock->M_Uom_Id = $item->M_Uom_Id;
			// 	// 		$newstock->M_Warehouse_Id = $detail->M_Warehouse_Id;
			// 	// 		$newstock->Qty = $detail->Qty * M_uomconversions::getQtyConversion($detail->M_Item_Id, $detail->M_Uom_Id, $item->M_Uom_Id);
			// 	// 		$newstock->save();
			// 	// 	}
			// 	// }
		} else {
			$this->setToOriginal();
			$this->Status = T_itemtransferstatus::CANCEL;
			$id = $this->save();
			// $params = [];
			// $id = $this->save();
			// foreach ($this->get_list_T_Itemstockdetail() as $detail) {
			// 	$params = [
			// 		'where' => [
			// 			'M_Item_Id' => $detail->M_Item_Id,
			// 			'M_Shop_Id' => isset(Session::get(get_variable() . 'userdata')['M_Shop_Id']) ? Session::get(get_variable() . 'userdata')['M_Shop_Id'] : null
			// 		]
			// 	];

			// 	if ($detail->M_Warehouse_Id)
			// 		$params['where']['M_Warehouse_Id'] = $detail->M_Warehouse_Id;
			// 	else
			// 		$params['where']['M_Warehouse_Id'] = "null";

			// 	$item = M_items::get($detail->M_Item_Id);
			// 	$itemstock = M_itemstocks::getOne($params);
			// 	if ($itemstock) {
			// 		$itemqty = $detail->Qty * M_uomconversions::getQtyConversion($detail->M_Item_Id, $detail->M_Uom_Id, $item->M_Uom_Id);
			// 		if ($itemqty > $itemstock->Qty) {
			// 			Nayo_Exception::throw(lang('Error.qty_is_not_enough') . " : {$item->Code} ~ $item->Name", $oldmodel);
			// 		}

			// 		$itemstock->Qty -= $itemqty;
			// 		$itemstock->save();
			// 	} else {
			// 		Nayo_Exception::throw(lang('Error.item_not_available') . " : {$item->Code} ~ $item->Name", $oldmodel);
			// 	}
			// }
		}

		if ($id)
			return true;
		return false;
	}

}