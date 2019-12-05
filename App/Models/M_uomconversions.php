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

	public static function getQtyConversion($itemid, $from, $to){
		if($from == $to)
			return 1;

		$order = "DESC";

		$params = [
			'where' => [
				'M_Item_Id' => $itemid
			]
		];
		$parfrom = $params;
		$parfrom['where']['M_Uom_Id_From'] = $from;
		$fromdata = self::getOne($parfrom);
		
		$parto = $params;
		$parto['where']['M_Uom_Id_To'] = $to;
		$todata = self::getOne($parto);

		if($fromdata){

		} else {
			
			$parfrom['where']['M_Uom_Id_From'] = null;
			$parfrom['where']['M_Uom_Id_To'] = $from;
			$fromdata = self::getOne($parfrom);
		}

		if($todata){

		} else {
				
			$parto['where']['M_Uom_Id_To'] = null;
			$parto['where']['M_Uom_Id_From'] = $to;
			$todata = self::getOne($parto);
		}

		if($fromdata->Ordering < $todata->Ordering || $fromdata->Ordering == $todata->Ordering){
			$order = "ASC";
		}

			// if($fromdata){
			// 	$parto['where']['M_Uom_Id_To'] = $to;
			// 	$todata = self::getOne($parto);

			// 	if($todata)
			// 		if($fromdata->Ordering < $todata->Ordering || $fromdata->Ordering == $todata->Ordering){
			// 			$order = "ASC";
			// 		}
			// 	else {
			// 		$parto['where']['M_Uom_Id_To'] = null;
			// 		$parto['where']['M_Uom_Id_From'] = $to;
			// 		$todata = self::getOne($parto);
			// 		if($todata){
			// 			if($fromdata->Ordering < $todata->Ordering || $fromdata->Ordering == $todata->Ordering){
			// 				$order = "ASC";
			// 			}
			// 		}

			// 	}
			// } else {
			// 	$parfrom['where']['M_Uom_Id_From'] = null;
			// 	$parfrom['where']['M_Uom_Id_To'] = $from;
			// 	$fromdata = self::getOne($parfrom);
			// 	if($fromdata){
			// 		$parto['where']['M_Uom_Id_To'] = $to;
			// 		$todata = self::getOne($parto);
			// 		if($todata){
			// 			if($fromdata->Ordering > $todata->Ordering || $fromdata->Ordering == $todata->Ordering){
			// 				$order = "DESC";
			// 			}
			// 		} else {
			// 			$parto['where']['M_Uom_Id_To'] = null;
			// 			$parto['where']['M_Uom_Id_From'] = $to;
			// 			$todata = self::getOne($parto);
			// 			if($fromdata->Ordering > $todata->Ordering || $fromdata->Ordering == $todata->Ordering){
			// 				$order = "DESC";
			// 			}
			// 		}
			// 	}
			// }
		// }
			
		// $order = $updown == 'down' ? 'ASC' : 'DESC';
		$params = [
			'where' => [
				'M_Item_Id' => $itemid
			],
			'order' => [
				'Ordering' => $order
			]
		];
		$multiply = 1.00;
		$datas = self::getAll($params);
		$fromid = null;

		if($order == 'ASC')
			foreach($datas as $d){
				if($d->M_Uom_Id_From == $from){
					$fromid = $d->M_Uom_Id_From;
					$multiply *= $d->Qty;
					if($d->M_Uom_Id_To == $to)
						break;
					continue;
				} 

				if(!is_null($fromid)){
					$multiply *= $d->Qty;
				}

				if($d->M_Uom_Id_To == $to){
					break;
				}
			}
		else {
			foreach($datas as $d){
				if($d->M_Uom_Id_To == $from){
					$fromid = $d->M_Uom_Id_To;
					$multiply /= $d->Qty;
					if($d->M_Uom_Id_From == $to)
						break;
					continue;
				} 

				if(!is_null($fromid)){
					$multiply /= $d->Qty;
				}

				if($d->M_Uom_Id_From == $to){
					break;
				}
			}
		}

		return $multiply;
	}

}