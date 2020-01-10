<?php  
namespace App\Models;

use App\Enums\OrderRestriction;
use App\Libraries\ResponseCode;
use App\Models\Base_Model;
use Core\Nayo_Exception;

class M_menus extends Base_Model {

	public $Id;
	public $Name;
	public $Price;
	public $M_Menucategory_Id;
	public $M_Mealtime_Id;
	public $M_Shop_Id;
	public $OrderRestriction;
	public $Description;
	public $PhotoUrl;
	public $Status;
	public $CreatedBy;
	public $ModifiedBy;
	public $Created;
	public $Modified;

    
    protected $table = "m_menus";

    public function __construct(){
		parent::__construct();
        $this->OrderRestriction = OrderRestriction::NONE;
        $this->Status = 1;
	}
	
	public function validate(self $oldmodel = null){
        $nameexist = false;
        $warning = array();

        if(!empty($oldmodel))
        {
            if($this->Name != $oldmodel->Name)
            {
                $nameexist = $this->isDataExist(["Name" => $this->Name]);
            }
        }
        else{
            if(!empty($this->Name))
            {
                $nameexist = $this->isDataExist(["Name" => $this->Name]);
            }
            else{
                Nayo_Exception::throw(lang('Error.name_can_not_null'), $this, ResponseCode::INVALID_DATA);
            }
        }
        if($nameexist)
        {
            Nayo_Exception::throw(lang('Error.name_exist'), $this, ResponseCode::DATA_EXIST);
        }
        
        return $warning;
	}

	public function getEnumOrder()
	{
		return M_enumdetails::getEnums("OrderRestriction");
	}
	
	

}