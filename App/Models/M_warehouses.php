<?php  
namespace App\Models;
use App\Models\Base_Model;

class M_warehouses extends Base_Model {

	public $Id;
	public $Name;
	public $Description;
	public $CreatedBy;
	public $ModifiedBy;
	public $Created;
	public $Modified;

    
    protected $table = "m_warehouses";

    public function __construct(){
        parent::__construct();
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

}