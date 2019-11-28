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

    public static function getTDisasterReportFormat()
    {
        $forms = M_forms::getDataByName(form_paging()['t_disasterreport']);
        $params = array(
            'where' => array(
                'M_Form_Id' => $forms->Id,
                'Name' => 'NUMBERING_FORMAT'
            )
        );

        return static::getOne($params);
    }

    public static function getTDisasterOccurFormat()
    {

        $forms = M_forms::getDataByName(form_paging()['t_disasteroccur']);
        $params = array(
            'where' => array(
                'M_Form_Id' => $forms->Id,
                'Name' => 'NUMBERING_FORMAT'
            )
        );

        return static::getOne($params);
    }

    public static function getTInOutItemFormat()
    {

        $forms = M_forms::getDataByName(form_paging()['t_inoutitem']);
        $params = array(
            'where' => array(
                'M_Form_Id' => $forms->Id,
                'Name' => 'NUMBERING_FORMAT'
            )
        );

        return static::getOne($params);
    }

    public static function getMUserLocation()
    {

        $forms = M_forms::getDataByName(form_paging()['m_userlocation']);
        $params = array(
            'where' => array(
                'M_Form_Id' => $forms->Id,
                'Name' => 'TRACK_USER_LOCATION'
            )
        );

        return static::getOne($params);
    }

    public static function getImpactCompensation()
    {

        $forms = M_forms::getDataByName(form_paging()['m_impact']);
        $params = array(
            'where' => array(
                'M_Form_Id' => $forms->Id,
                'Name' => 'IMPACT_COMPENSATION_X_1M'
            )
        );

        return static::getOne($params);
    }
}
