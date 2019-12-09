<?php  
namespace App\Models;
use App\Models\Base_Model;

class T_itemtransfers extends Base_Model {

	public $Id;
	public $TransNo;
	public $TransDate;
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
    }

}