<?php  
namespace App\Models;

use App\Libraries\ResponseCode;
use App\Models\Base_Model;
use Core\Nayo_Exception;

class M_shops extends Base_Model {

	public $Id;
	public $Code;
	public $Name;
	public $Address1;
	public $Address2;
	public $Email;
	public $Phone;
	public $City;
	public $Province;
	public $PostCode;
	public $Country;
	public $CreatedBy;
	public $ModifiedBy;
	public $Created;
	public $Modified;

    
    protected $table = "m_shops";

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
        
	}

}