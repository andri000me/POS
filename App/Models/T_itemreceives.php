<?php  
namespace App\Models;

use App\Enums\T_itemreceivestatus;
use App\Libraries\ResponseCode;
use App\Models\Base_Model;
use Core\Nayo_Exception;
use Core\Session;

class T_itemreceives extends Base_Model {

	public $Id;
	public $TransNo;
	public $TransDate;
	public $M_Shop_Id;
	public $Status;
	public $CreatedBy;
	public $ModifiedBy;
	public $Created;
	public $Modified;

    
    protected $table = "t_itemreceives";

    public function __construct(){
		parent::__construct();
		$this->TransDate = get_current_date("d-m-Y");
		$this->Status = T_itemreceivestatus::NEW;
		$this->M_Shop_Id = isset(Session::get(get_variable() . 'userdata')['M_Shop_Id']) ? Session::get(get_variable() . 'userdata')['M_Shop_Id'] : null;
	
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


		if (empty($this->TransDate)) {
			Nayo_Exception::throw(lang('Error.date_cannot_null'), $this, ResponseCode::INVALID_DATA);
		}

		return $warning;
	}

	public function getEnumStatus()
	{
		if ($this->Status == T_itemreceivestatus::NEW || is_null($this->Status)) {
			return M_enumdetails::getEnums("ItemreceiveStatus", [3]);
		} else if ($this->Status == T_itemreceivestatus::RECEIVED) {
			return M_enumdetails::getEnums("ItemreceiveStatus", [1,3]);
		} 

		return M_enumdetails::getEnums("ItemreceiveStatus", [1, 2]);
	}

	public function savedata($oldmodel = null)
	{
		$id = null;
		$formid = M_forms::getFormId(form_paging()['t_itemreceive']);

		if (is_null($this->Id)) {
			$this->TransNo = G_transactionnumbers::getLastNumberByFormId($formid);
			G_transactionnumbers::updateLastNumber($formid);
		}

		if ($this->Status == T_itemreceivestatus::NEW) {
			$id = $this->save();
		} else if ($this->Status == T_itemreceivestatus::RECEIVED) {

			if ($this->Status == $oldmodel->Status) {
				$id = $this->save();
			} else {
				$params = []; 
				$id = $this->save();
				foreach ($this->get_list_T_Itemreceivedetail() as $t) {
					$transfer = T_itemtransfers::get($t->T_Itemtransfer_Id);
					echo json_encode($transfer);
					foreach($transfer->get_list_T_Itemtransferdetail() as $detail){
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
			}
		} else {
			$this->setToOriginal();
			$this->Status = T_itemreceivestatus::CANCEL;
			$id = $this->save();
		}

		if ($id)
			return $id;
		return false;
	}

}