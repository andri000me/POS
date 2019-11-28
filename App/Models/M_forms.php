<?php  
namespace App\Models;
use Core\Nayo_Model;

class M_forms extends Nayo_Model {

    public $Id;
    public $FormName;
    public $AliasName;
    public $LocalName;
    public $ClassName;
    public $Resource;
    public $IndexRoute;

    
    protected $table = "m_forms";

    public function __construct(){
        parent::__construct();
    }

    public static function getDataByName($name){
        $params = [
            'where' => [
                'FormName' => $name
            ]
        ];

        $result = self::getOne($params);
        return $result;
    }

}