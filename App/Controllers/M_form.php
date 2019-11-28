<?php

namespace App\Controllers;

use App\Controllers\Base_Controller;
use App\Models\M_formsettings;
use App\Models\G_transactionnumbers;
use Core\Session;

class M_form extends Base_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->hasPermission('m_formsetting', 'Read')) {

            $disasterreportmodel = M_formsettings::getTDisasterReportFormat();
            $disasteroccurmodel = M_formsettings::getTDisasterOccurFormat();
            $inoutitemmodel = M_formsettings::getTInOutItemFormat();
            $userlocationmodel = M_formsettings::getMUserLocation();
            $impactmodel = M_formsettings::getImpactCompensation();

            $data['disasterreportmodel'] = $disasterreportmodel;
            $data['disasteroccurmodel'] = $disasteroccurmodel;
            $data['inoutitemmodel'] = $inoutitemmodel;
            $data['userlocationmodel'] = $userlocationmodel;
            $data['impactmodel'] = $impactmodel;
            $this->loadView('m_form/add', lang('Form.setting'), $data);
        } else {
            $this->loadView('forbidden/forbidden');
        }
    }
    public function savedisasterreport()
    {

        if ($this->hasPermission('m_form', 'Write')) {
            $formatnumber = $this->request->post('disasterreportformatnumber');

            if ($formatnumber) {
                $tordermodel = M_formsettings::getTDisasterReportFormat();
                $tordermodel->StringValue = $formatnumber;
                $saveret = $tordermodel->save();

                if (!is_bool($saveret)) {
                    $arrmemnumber = explode("/", $formatnumber);
                    $sequence = "";
                    for ($i = 0; $i < $arrmemnumber[2]; $i++) {
                        $sequence = $sequence . "#";
                    }

                    $newnumber = $arrmemnumber[0] . "/" . $arrmemnumber[1] . "/" . $sequence;

                    $transnumber = G_transactionnumbers::getByFormId($tordermodel->M_Form_Id);
                    // print_r($transnumber);
                    if ($transnumber) {
                        $transnumber->Format = $newnumber;
                        $transnumber->save();
                    } else {
                        $gtransnumber = new G_transactionnumbers();
                        $gtransnumber->Format = $newnumber;
                        $gtransnumber->Year = date("Y");
                        $gtransnumber->Month = date("n");
                        $gtransnumber->LastNumber = 0;
                        $gtransnumber->M_Form_Id = $tordermodel->M_Form_Id;
                        $gtransnumber->TypeTrans = $tordermodel->TypeTrans;
                        $gtransnumber->save();
                    }
                }
            }

            redirect("setting")->go();
        }
    }
    

    public function savedisasteroccur()
    {
        if ($this->hasPermission('m_form', 'Write')) {
            $formatnumber = $this->request->post('disasteroccurformatnumber');

            if ($formatnumber) {
                $tordermodel = M_formsettings::getTDisasterOccurFormat();
                $tordermodel->StringValue = $formatnumber;
                $saveret = $tordermodel->save();

                if (!is_bool($saveret)) {
                    $arrmemnumber = explode("/", $formatnumber);
                    $sequence = "";
                    for ($i = 0; $i < $arrmemnumber[2]; $i++) {
                        $sequence = $sequence . "#";
                    }

                    $newnumber = $arrmemnumber[0] . "/" . $arrmemnumber[1] . "/" . $sequence;

                    $transnumber = G_transactionnumbers::getByFormId($tordermodel->M_Form_Id);
                    // print_r($transnumber);
                    if ($transnumber) {
                        $transnumber->Format = $newnumber;
                        $transnumber->save();
                    } else {
                        $gtransnumber = new G_transactionnumbers();
                        $gtransnumber->Format = $newnumber;
                        $gtransnumber->Year = date("Y");
                        $gtransnumber->Month = date("n");
                        $gtransnumber->LastNumber = 0;
                        $gtransnumber->M_Form_Id = $tordermodel->M_Form_Id;
                        $gtransnumber->TypeTrans = $tordermodel->TypeTrans;
                        $gtransnumber->save();
                    }
                }
            }

            redirect("setting")->go();
        }
    }

    public function saveinoutitem()
    {
        if ($this->hasPermission('m_form', 'Write')) {
            $formatnumber = $this->request->post('inoutitemformatnumber');

            if ($formatnumber) {
                $tordermodel = M_formsettings::getTInOutItemFormat();
                $tordermodel->StringValue = $formatnumber;
                $saveret = $tordermodel->save();

                if (!is_bool($saveret)) {
                    $arrmemnumber = explode("/", $formatnumber);
                    $sequence = "";
                    for ($i = 0; $i < $arrmemnumber[2]; $i++) {
                        $sequence = $sequence . "#";
                    }

                    $newnumber = $arrmemnumber[0] . "/" . $arrmemnumber[1] . "/" . $sequence;

                    $transnumber = G_transactionnumbers::getByFormId($tordermodel->M_Form_Id);
                    // print_r($transnumber);
                    if ($transnumber) {
                        $transnumber->Format = $newnumber;
                        $transnumber->save();
                    } else {
                        $gtransnumber = new G_transactionnumbers();
                        $gtransnumber->Format = $newnumber;
                        $gtransnumber->Year = date("Y");
                        $gtransnumber->Month = date("n");
                        $gtransnumber->LastNumber = 0;
                        $gtransnumber->M_Form_Id = $tordermodel->M_Form_Id;
                        $gtransnumber->TypeTrans = $tordermodel->TypeTrans;
                        $gtransnumber->save();
                    }
                }
            }

            redirect("setting")->go();
        }
    }

    public function saveuserlocation()
    {

        if ($this->hasPermission('m_form', 'Write')) {
            $trackUser = $this->request->post('TrackUser');

            $location = M_formsettings::getMUserLocation();
            if ($trackUser) 
                $location->BooleanValue = 1;
            else 
                $location->BooleanValue = 0;

            $location->save();
            redirect("setting")->go();
        }
    }

    public function saveimpactcompensation()
    {

        if ($this->hasPermission('m_form', 'Write')) {
            $value = $this->request->post('Compensation');

            $impact = M_formsettings::getImpactCompensation();
            $impact->DecimalValue = setisdecimal($value);

            $impact->save();
            redirect("setting")->go();
        }
    }
}
