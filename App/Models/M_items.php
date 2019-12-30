<?php  
namespace App\Models;

use App\Libraries\ResponseCode;
use App\Models\Base_Model;
use Core\Nayo_Exception;

class M_items extends Base_Model {

	public $Id;
	public $Code;
	public $Name;
	public $M_Category_Id;
	public $M_Uom_Id;
	public $Cost;
	public $Price;
	public $PhotoUrl;
	public $CreatedBy;
	public $ModifiedBy;
	public $Created;
	public $Modified;

    
    protected $table = "m_items";

    public function __construct(){
        parent::__construct();
	}
	
	public function validate(self $oldmodel = null){

		$nameexist = false;
        $warning = array();

        if(!empty($oldmodel))
        {
            if($this->Code != $oldmodel->Code)
			{
				$params = [
					"Code" => $this->Code
				];
                $nameexist = $this->isDataExist($params);
            }
        }
        else{
            if(!empty($this->Code))
            {
				$params = [
					"Code" => $this->Code
				];
                $nameexist = $this->isDataExist($params);
            }
            else{
                Nayo_Exception::throw(lang('Error.code_can_not_null'), $this, ResponseCode::INVALID_DATA);
            }
        }
        if($nameexist)
        {
            Nayo_Exception::throw(lang('Error.code_exist'), $this, ResponseCode::DATA_EXIST);
		}
		
		if(empty($this->Name))
			Nayo_Exception::throw(lang('Error.name_can_not_null'), $this, ResponseCode::INVALID_DATA);

		if(empty($this->M_Category_Id))
			Nayo_Exception::throw(lang('Error.category_can_not_null'), $this, ResponseCode::INVALID_DATA);
		
		if(empty($this->M_Uom_Id))
			Nayo_Exception::throw(lang('Error.uom_can_not_null'), $this, ResponseCode::INVALID_DATA);
        
        return $warning;
	}

}