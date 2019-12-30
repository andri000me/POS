<?php

namespace App\Models;

use Core\Nayo_Model;
use App\Models\M_forms;

class M_formsettings extends Nayo_Model
{

    public $Id;
    public $M_Form_Id;
    public $TypeTrans;
    public $Value;
    public $Name;
    public $IntValue;
    public $StringValue;
    public $DecimalValue;
    public $DateTimeValue;
    public $BooleanValue;


    protected $table = "m_formsettings";

    public function __construct()
    {
        parent::__construct();
    }

    public static function getTItemStockFormat()
    {
        $forms = M_forms::getDataByName(form_paging()['t_itemstock']);
        $params = array(
            'where' => array(
                'M_Form_Id' => $forms->Id,
                'Name' => 'NUMBERING_FORMAT'
            )
        );

        return static::getOne($params);
    }

    public static function getTItemTransferFormat()
    {
        $forms = M_forms::getDataByName(form_paging()['t_itemtransfer']);
        $params = array(
            'where' => array(
                'M_Form_Id' => $forms->Id,
                'Name' => 'NUMBERING_FORMAT'
            )
        );

        return static::getOne($params);
    }

    public static function getTItemReceiveFormat()
    {
        $forms = M_forms::getDataByName(form_paging()['t_itemreceive']);
        $params = array(
            'where' => array(
                'M_Form_Id' => $forms->Id,
                'Name' => 'NUMBERING_FORMAT'
            )
        );

        return static::getOne($params);
    }

    
}
