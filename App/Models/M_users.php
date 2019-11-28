<?php
namespace App\Models;

use App\Libraries\ResponseCode;
use App\Models\Base_Model;
use Core\Nayo_Exception;

class M_users extends Base_Model {
    public $Id;
    public $M_Groupuser_Id;
    public $Username;
    public $Password;
    public $IsLoggedIn;
    public $IsActive;
    public $Language;
    public $IsStartMoving;
	public $CreatedBy;
	public $ModifiedBy;
	public $Created;
	public $Modified;

    protected $table = 'm_users';

    public function __construct(){
        parent::__construct();
    }

    public function setPassword($password){
        $this->Password = encryptMd5(get_variable().$this->Username.$password);
        return $this->Password;
    }

    public function getByPassword($password){

        $params = array(
            'where' => array(
                'password' => $password
            )
        );
        // print_r($user);
        $query = $this->findOne($params);
        return $query;
    }

    public function validate(self $oldmodel = null){
        $nameexist = false;
        $warning = array();

        if(!empty($oldmodel))
        {
            if($this->Username != $oldmodel->Username)
            {
                
				$params = [
					"Username" => $this->Username
				];
                $nameexist = $this->isDataExist($params);
            }
        }
        else{
            if(!empty($this->Username))
            {
				$params = [
					"Username" => $this->Username
				];
                $nameexist = $this->isDataExist($params);
            }
            else{
                Nayo_Exception::throw(lang('Error.name_can_not_null'), $this, ResponseCode::INVALID_DATA);
            }
        }
        if($nameexist)
        {
            Nayo_Exception::throw(lang('Error.name_exist'), $this, ResponseCode::DATA_EXIST);
        }

        if(empty($this->Password)){
            Nayo_Exception::throw(lang('Error.password_can_not_null'), $this, ResponseCode::INVALID_DATA);
        }
        
        // return $warning;
    }

    public static function login($username, $password){

        $params = array(
            'where' => array(
                'password' => encryptMd5(get_variable() . $username . $password)
            )
        );
        // print_r($user);
        $query = static::getOne($params);
        return $query;
    }

}
