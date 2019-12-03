<?php  
namespace App\Models;

use App\Libraries\ResponseCode;
use App\Models\Base_Model;
use Core\Nayo_Exception;

class M_uomconversions extends Base_Model {

	public $Id;
	public $M_Item_Id;
	public $M_Uom_Id_From;
	public $M_Uom_Id_To;
	public $Qty;
	public $Ordering;
	public $CreatedBy;
	public $ModifiedBy;
	public $Created;
	public $Modified;

    
    protected $table = "m_uomconversions";

    public function __construct(){
        parent::__construct();
	}
	
	public function validate(self $oldmodel = null){

		$nameexist = false;
        $warning = array();

        if(!empty($oldmodel))
        {
            if($this->M_Item_Id != $oldmodel->M_Item_Id)
			{
				$params = [
					"M_Item_Id" => $this->M_Item_Id,
					"M_Uom_Id_From" => $this->M_Uom_Id_From,
					"M_Uom_Id_To" => $this->M_Uom_Id_To
				];
                $nameexist = $this->isDataExist($params);
            }
        }
        else{
            if(!empty($this->M_Item_Id))
            {
				$params = [
					"M_Item_Id" => $this->M_Item_Id,
					"M_Uom_Id_From" => $this->M_Uom_Id_From,
					"M_Uom_Id_To" => $this->M_Uom_Id_To
				];
                $nameexist = $this->isDataExist($params);
            }
            else{
                Nayo_Exception::throw(lang('Error.item_can_not_null'), $this, ResponseCode::INVALID_DATA);
            }
        }
        if($nameexist)
        {
            Nayo_Exception::throw(lang('Error.data_exist'), $this, ResponseCode::DATA_EXIST);
		}
		
		
        
        return $warning;
	}

	public static function getNextOrdering($itemid){
		$params = [
			'where' => [
				'M_Item_Id' => $itemid
			],
			'order' => [
				'Ordering' => 'DESC'
			]
		];
		$data = static::getOne($params);
		if($data)
			return $data->Ordering + 1;
		else 
			return 1;

	}

}