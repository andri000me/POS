<?php  
namespace App\Models;

use App\Libraries\ResponseCode;
use App\Models\Base_Model;
use Core\Nayo_Exception;

class T_itemstockdetails extends Base_Model {

	public $Id;
	public $T_Itemstock_Id;
	public $M_Item_Id;
	public $M_Uom_Id;
	public $M_Warehouse_Id;
	public $Qty;
	public $CreatedBy;
	public $ModifiedBy;
	public $Created;
	public $Modified;

    
    protected $table = "t_itemstockdetails";

    public function __construct($itemstockid = null){
		parent::__construct();
		$this->T_Itemstock_Id = $itemstockid;
	}

	public function validate($oldmodel = null){

		if(!empty($oldmodel))
        {
            if($this->M_Item_Id != $oldmodel->M_Item_Id)
            {
				$exist = [
					"M_Item_Id" => $this->M_Item_Id,
					"T_Itemstock_Id" => $this->T_Itemstock_Id,
				];
                $nameexist = $this->isDataExist($exist);
            }
        }
        else{
            if(!empty($this->M_Item_Id))
            {
				$exist = [
					"M_Item_Id" => $this->M_Item_Id,
					"T_Itemstock_Id" => $this->T_Itemstock_Id,
				];
                $nameexist = $this->isDataExist($exist);
            }
            else{
                Nayo_Exception::throw(lang('Error.item_can_not_null'), $this, ResponseCode::INVALID_DATA);
            }
		}
		
        if($nameexist)
        {
            Nayo_Exception::throw(lang('Error.item_exist'), $this, ResponseCode::DATA_EXIST);
		}
		
		if(empty($this->M_Uom_Id))
        {
            Nayo_Exception::throw(lang('Error.uom_can_not_null'), $this, ResponseCode::INVALID_DATA);
		}
		
		if(empty($this->Qty))
        {
            Nayo_Exception::throw(lang('Error.qty_must_greaterthan_zero'), $this, ResponseCode::INVALID_DATA);
        }
	}
	

}