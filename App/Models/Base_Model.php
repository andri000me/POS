<?php

namespace App\Models;

use Core\Nayo_Model;
use Core\Database\DBBuilder;
use Core\Nayo_Exception;
use Core\Request;

class Base_Model extends Nayo_Model
{
    protected $ismobile = false;
    public function __construct()
    {
        parent::__construct();
    }

    public function parseFromRequest()
    {
        $builder = new DBBuilder();
        $request = Request::getInstance();
        $builder->query("DESC {$this->table}");
        $fields = $builder->fetch();
        if ($fields) {
            foreach ($fields as $field) {
                $prop = $field['Field'];
                if (key_exists($prop, $request->body())){
                    if (!empty($request->post($field['Field']))) {
                        if (preg_match("/^int/", $field['Type']))
                            $this->$prop = setisnumber($request->post($field['Field']));
                        else if (preg_match("/^varchar/", $field['Type']))
                            $this->$prop = setisnull($request->post($field['Field']));
                        else if (preg_match("/^decimal/", $field['Type']))
                            $this->$prop = setisdecimal($request->post($field['Field']));
                        else if (preg_match("/^datetime/", $field['Type']))
                            $this->$prop = get_formated_date($request->post($field['Field']));
                        else if (preg_match("/^date/", $field['Type']))
                            $this->$prop = get_formated_date($request->post($field['Field']), "Y-m-d");
                        else if (preg_match("/^double/", $field['Type']))
                            $this->$prop = $request->post($field['Field']);
                        else if(preg_match("/^smallint/", $field['Type'])){
                            if(substr($field['Type'], 8, 3) == "(1)"){
                                $this->$prop = 1;
                            } else {
                                $this->$prop = setisnumber($request->post($field['Field']));
                            }
                        }else if (preg_match("/^text/", $field['Type']))
                            $this->$prop = $request->post($field['Field']);
                    } else {
                        $this->$prop = null;
                    } 
                } else if(preg_match("/^smallint/", $field['Type'])){
                    if(substr($field['Type'], 8, 3) == "(1)")
                        $this->$prop = null;
                }
            }
        }

        return $this;
    }

    public function setMobile(){
        $this->ismobile = true;
    }

    public function beforeSave()
    {
        if($this->ismobile){

        } else {

            if (!isset($this->Id)) {

                $this->Created = mysqldatetime();
                $this->CreatedBy = isset($_SESSION[get_variable() . 'userdata']['Username']) ? $_SESSION[get_variable() . 'userdata']['Username'] : null;
            } else {
    
                $this->Modified = mysqldatetime();
                $this->ModifiedBy = isset($_SESSION[get_variable() . 'userdata']['Username']) ? $_SESSION[get_variable() . 'userdata']['Username'] : null;
            }
        }
    }

    public function isDataExist($values = array())
    {
        $params = array();

        if (!empty($values))
            $params['where'] = $values;

        if ($this->countAll($params) > 0) {
            return true;
        }

        return false;
    }

    public function setToOriginal(){
        $original = static::get($this->Id);
        foreach($original as $k => $v){
            $this->$k = $v;
        }
		return $this;
    }
    
    // public function save(){
    //     // if(!parent::save())
    //         Nayo_Exception::throw("Failed To Save Data", $this);
    // }
}
