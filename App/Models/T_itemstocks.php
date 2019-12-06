<?php

namespace App\Models;

use App\Enums\T_itemstockstatus;
use App\Libraries\ResponseCode;
use App\Models\Base_Model;
use Core\Nayo_Exception;
use Core\Session;

class T_itemstocks extends Base_Model
{

	public $Id;
	public $TransNo;
	public $TransDate;
	public $Status;
	public $Recipient;
	public $M_Shop_Id;
	public $CreatedBy;
	public $ModifiedBy;
	public $Created;
	public $Modified;


	protected $table = "t_itemstocks";

	public function __construct()
	{
		parent::__construct();
		$this->Status = T_itemstockstatus::NEW;
		$branch = isset(Session::get(get_variable() . 'userdata')['M_Shop_Id']) ? Session::get(get_variable() . 'userdata')['M_Shop_Id'] : null;
		$this->M_Shop_Id = $branch;
	}

	public static function getAll($params = array()){
		$params['where']['M_Shop_Id'] = isset(Session::get(get_variable() . 'userdata')['M_Shop_Id']) ? Session::get(get_variable() . 'userdata')['M_Shop_Id'] : null;
		return parent::getAll($params);
	}

	public function validate(self $oldmodel = null)
	{
		$nameexist = false;
		$warning = array();


		if (empty($this->TransDate)) {
			Nayo_Exception::throw(lang('Error.date_cannot_null'), $this, ResponseCode::INVALID_DATA);
		}

		return $warning;
	}

	public function savedata($oldmodel = null)
	{
		$id = null;
		$formid = M_forms::getFormId(form_paging()['t_itemstock']);

		if (is_null($this->Id)) {
			$this->TransNo = G_transactionnumbers::getLastNumberByFormId($formid);
			G_transactionnumbers::updateLastNumber($formid);
		}

		if ($this->Status == T_itemstockstatus::NEW) {
			$id = $this->save();
		} else if ($this->Status == T_itemstockstatus::RELEASE) {

			if ($this->Status == $oldmodel->Status) {
				$id = $this->save();
			} else {
				$params = [];
				$id = $this->save();
				foreach ($this->get_list_T_Itemstockdetail() as $detail) {
					$params['where']['M_Item_Id'] = $detail->M_Item_Id;
					if ($detail->M_Warehouse_Id)
						$params['where']['M_Warehouse_Id'] = $detail->M_Warehouse_Id;
					else
						$params['where']['M_Warehouse_Id'] = "null";

					$item = M_items::get($detail->M_Item_Id);
					$itemstock = M_itemstocks::getOne($params);
					if ($itemstock) {
						$itemstock->Qty += $detail->Qty * M_uomconversions::getQtyConversion($detail->M_Item_Id, $detail->M_Uom_Id, $item->M_Uom_Id);
						$itemstock->save();
					} else {
						$newstock = new M_itemstocks();
						$newstock->M_Item_Id = $detail->M_Item_Id;
						$newstock->M_Uom_Id = $item->M_Uom_Id;
						$newstock->M_Warehouse_Id = $detail->M_Warehouse_Id;
						$newstock->Qty = $detail->Qty * M_uomconversions::getQtyConversion($detail->M_Item_Id, $detail->M_Uom_Id, $item->M_Uom_Id);
						$newstock->save();
					}
				}
			}
		} else {
			$params = [];
			$id = $this->save();
			foreach ($this->get_list_T_Itemstockdetail() as $detail) {
				$params['where']['M_Item_Id'] = $detail->M_Item_Id;
				if ($detail->M_Warehouse_Id)
					$params['where']['M_Warehouse_Id'] = $detail->M_Warehouse_Id;
				else
					$params['where']['M_Warehouse_Id'] = "null";

				$item = M_items::get($detail->M_Item_Id);
				$itemstock = M_itemstocks::getOne($params);
				if ($itemstock) {
					$itemqty = $detail->Qty * M_uomconversions::getQtyConversion($detail->M_Item_Id, $detail->M_Uom_Id, $item->M_Uom_Id);
					if ($itemqty > $itemstock->Qty) {
						Nayo_Exception::throw(lang('Error.qty_is_not_enough') . " : {$item->Code} ~ $item->Name", $oldmodel);
					}

					$itemstock->Qty -= $itemqty;
					$itemstock->save();
				} else {
					Nayo_Exception::throw(lang('Error.item_not_available') . " : {$item->Code} ~ $item->Name", $oldmodel);
				}
			}
		}

		if ($id)
			return true;
		return false;
	}

	public function getEnumStatus()
	{
		if ($this->Status == T_itemstockstatus::NEW || is_null($this->Status)) {
			return M_enumdetails::getEnums("ItemstockStatus");
		} else if ($this->Status == T_itemstockstatus::RELEASE) {
			return M_enumdetails::getEnums("ItemstockStatus", [1]);
		}

		return M_enumdetails::getEnums("ItemstockStatus", [1, 2]);
	}

	public function copyFrom(){
		$copied = new static;

		$formid = M_forms::getFormId(form_paging()['t_itemstock']);
		if (is_null($copied->Id)) {
			$copied->TransNo = G_transactionnumbers::getLastNumberByFormId($formid);
			G_transactionnumbers::updateLastNumber($formid);
		}
		$copied->TransDate = $this->TransDate;
		$id = $copied->save();
		if(!$id)
			Nayo_Exception::throw(lang('Form.failed_to_save_data'), $this);

		$copied->Id = $id;

		foreach ($this->get_list_T_Itemstockdetail() as $detail) {
			
				$newstock = new T_itemstockdetails();
				$newstock->T_Itemstock_Id = $id;
				$newstock->M_Item_Id = $detail->M_Item_Id;
				$newstock->M_Uom_Id = $detail->M_Uom_Id;
				$newstock->M_Warehouse_Id = $detail->M_Warehouse_Id;
				$newstock->Qty = $detail->Qty;
				$newstock->save();
		}

		return $copied;
	}
}
