<?php  
namespace App\Models;

use App\Enums\T_itemstockstatus;
use App\Libraries\ResponseCode;
use App\Models\Base_Model;
use Core\Nayo_Exception;

class T_itemstocks extends Base_Model {

	public $Id;
	public $TransNo;
	public $TransDate;
	public $Status;
	public $Recipient;
	public $CreatedBy;
	public $ModifiedBy;
	public $Created;
	public $Modified;

    
    protected $table = "t_itemstocks";

    public function __construct(){
		parent::__construct();
		$this->Status = T_itemstockstatus::NEW;
	}

	public function validate(self $oldmodel = null){
        $nameexist = false;
        $warning = array();

       
        if(empty($this->TransDate))
        {
            Nayo_Exception::throw(lang('Error.date_cannot_null'), $this, ResponseCode::INVALID_DATA);
        }
        
        return $warning;
	}

	public function savenew(){
		if($this->Status == T_itemstockstatus::NEW){
			$this->save();
		} else if($this->Status == T_itemstockstatus::RELEASE){
			$params = [];
			$id = $this->save();
			foreach($this->get_list_T_Itemstockdetail() as $detail){
				$params['where'][] = ['M_Item_Id' => $detail->M_Item_Id];
				if($detail->M_Warehouse_Id)
					$params['where'][] = ['M_Warehouse_Id' => $detail->M_Warehouse_Id];
				else 
					$params['where'][] = ['M_Warehouse_Id' => "null" ];
				
				$itemstock = M_itemstocks::getOne($params);
				if($itemstock){
					$itemstock->Qty += $detail->Qty;
					$itemstock->save();
				} else {
					$newstock = new M_itemstocks();
					$item = M_items::get($detail->M_Item_Id);
					$newstock->T_Itemstock_Id = $id;
					$newstock->M_Item_Id = $detail->M_Item_Id;
					$newstock->M_Uom_Id = $item->M_Uom_Id;
					$newstock->M_Warehouse_Id = $detail->M_Warehouse_Id;
					$newstock->Qty = $detail->Qty;
					$newstock->save();

				}
			}
		}
	}
	
	public function getEnumStatus(){
		if($this->Status == T_itemstockstatus::NEW || is_null($this->Status)){
			return M_enumdetails::getEnums("ItemstockStatus");
		} else if ($this->Status == T_itemstockstatus::RELEASE) {
			return M_enumdetails::getEnums("ItemstockStatus",[1]);
		}

		return M_enumdetails::getEnums("ItemstockStatus",[1, 2]);
	}
	


}