<?php  
namespace App\Models;

use App\Enums\T_itemreceivestatus;
use App\Libraries\ResponseCode;
use Core\Nayo_Exception;
use Core\Nayo_Model;
use Core\Session;

class T_itemreceives extends Nayo_Model {

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
		$this->Status = T_itemreceivestatus::NEW;
		$this->M_Shop_Id = isset(Session::get(get_variable() . 'userdata')['M_Shop_Id']) ? Session::get(get_variable() . 'userdata')['M_Shop_Id'] : null;
	
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

}