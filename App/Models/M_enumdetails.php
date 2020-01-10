<?php  
namespace App\Models;
use Core\Nayo_Model;

class M_enumdetails extends Nayo_Model {

    public $Id;
    public $M_Enum_Id;
    public $Value;
    public $EnumName;
    public $Ordering;
    public $Resource;

    
    protected $table = "m_enumdetails";

    public function __construct(){
        parent::__construct();
    }

    public static function getEnumName($enumName, $value){
        $enum = new M_enums();
        $params = [
            'where' => [
                'Name' => $enumName
            ]
        ];

        $enums = $enum->findOne($params)->get_list_M_Enumdetail(['where' => ['Value' => $value]]);
        if($enums){
            if($enums[0]->Resource)
                return lang($enums[0]->Resource);
            else 
                return $enums[0]->EnumName;
        }
        return null;
    }

    public static function getEnums($enumName, $except = array()){

        $enum = new M_enums();
        $params = [
            'where' => [
                'Name' => $enumName
            ]
        ];
        $detailParams = [];
        if(!empty($except))
            $detailParams = [
                'whereNotIn' => [
                    'Value' => $except
                ]
            ];

        $enums = $enum->findOne($params)->get_list_M_Enumdetail($detailParams);
        if($enums){
            foreach($enums as $e){
                if($e->Resource)
                    $e->EnumName = lang($e->Resource);
            }
            return $enums;
        }
        return array();
    }

}