<?php  
namespace App\Models;
use Core\Nayo_Model;
use App\Controllers\M_groupuser;

class G_transactionnumbers extends Nayo_Model {

	public $Id;
	public $Format;
	public $Year;
	public $Month;
	public $LastNumber;
	public $M_Form_Id;
	public $TypeTrans;

    
    protected $table = "g_transactionnumbers";

    public function __construct(){
        parent::__construct();
	}
	
	public static function getLastNumberByFormId($formId, $year, $month, $type = null){
      
		$params = [
			'where' => [
				"M_Form_Id" => $formId,
				"Year" => $year,
				"Month" => (int)$month
			]
		];
		
		$query = self::getOne($params);

        if(is_null($query)){
            $insert = self::insertNewFormNumber($formId, $year, $month, $type);
            if($insert > 0)
                return self::getLastNumberByFormId($formId, $year, $month, $type);
        }

        $result = $query;
        $formatedNumber = $result->Format;
        $code = explode("/",$formatedNumber);
        $newNumber = str_replace("#","0",$code[2]);
        $newNumberLen = strlen($newNumber);
        $newNumber = $newNumber . (string)($result->LastNumber + 1);
        $newNumber = substr($newNumber, strlen($newNumber)-$newNumberLen,$newNumberLen);

        
        $formatedNumber = str_replace("{YY}",(string)$year, $formatedNumber);
        $formatedNumber = str_replace("{MM}",(string)$month, $formatedNumber);
        $formatedNumber = str_replace("######",$newNumber, $formatedNumber);

        return $code[0]."/".(string)$year.(string)$month."/".$newNumber;
    }

    public static function insertNewFormNumber($formId, $year, $month, $type = null){
       
        
        $params = array(
            'where' => array(
                'M_Form_Id' => $formId,
				'TypeTrans' => $type
            ),
            'order' => array(
                'Year' => 'ASC'
            )
        );

        $model = static::getOne($params);
        $id = null;
        if($model){
            $newmodel = new static;
            $newmodel->Format = $model->Format;
            $newmodel->Year = $year;
            $newmodel->Month = (int)$month;
            $newmodel->LastNumber = 0;
            $newmodel->M_Form_Id = $formId;
            $newmodel->TypeTrans = $type;
            $id = $newmodel->save();
        }

        return $id;
    }

    public static function updateLastNumber($formId, $year, $month, $type = null){
		
		$params = array(
            'where' => array(
				'M_Form_Id' => $formId,
				'Year' => $year,
				'Month' => (int)$month,
				'TypeTrans' => $type
            )
        );


		$model = self::getOne($params);
		$model->LastNumber += 1;
		$model->save();

    }

    public static function getByFormId($formId){
        $params = [
            'where' => [
                'M_Form_Id' => $formId
            ]
        ];

        return static::getOne($params);
    }

}