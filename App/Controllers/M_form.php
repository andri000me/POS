<?php

namespace App\Controllers;

use App\Controllers\Base_Controller;
use App\Models\M_formsettings;
use App\Models\G_transactionnumbers;
use App\Models\M_shops;
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

            $itemstockmodel = M_formsettings::getTItemStockFormat();
            $itemtransfermodel = M_formsettings::getTItemTransferFormat();
            $itemreceivemodel = M_formsettings::getTItemReceiveFormat();

            $data['itemstockmodel'] = $itemstockmodel;
            $data['itemtransfermodel'] = $itemtransfermodel;
            $data['itemreceivemodel'] = $itemreceivemodel;
            $this->loadBlade('m_form.add', lang('Form.setting'), $data);
        }
    }

    public function saveitemreceive()
    {
        if ($this->hasPermission('m_form', 'Write')) {
            $formatnumber = $this->request->post('itemreceiveformatnumber');

            if ($formatnumber) {
                $tordermodel = M_formsettings::getTItemReceiveFormat();
                $tordermodel->StringValue = $formatnumber;
                $saveret = $tordermodel->save();

                if (!is_bool($saveret)) {
                    $arrmemnumber = explode("/", $formatnumber);
                    $sequence = "";
                    for ($i = 0; $i < $arrmemnumber[2]; $i++) {
                        $sequence = $sequence . "#";
                    }

                    $newnumber = $arrmemnumber[0] . "/" . $arrmemnumber[1] . "/" . $sequence;

                    foreach (M_shops::getAll() as $shop) {

                        $params = [
                            'where' => [
                                "M_Form_Id" => $tordermodel->M_Form_Id,
                                "Branch" => $shop->Id
                            ]
                        ];

                        $transnumber = G_transactionnumbers::getOne($params);
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
                            $gtransnumber->Branch = $shop->Id;
                            $gtransnumber->save();
                        }
                    }
                }
            }

            redirect("setting")->go();
        }
    }

    public function saveitemtransfer()
    {
        if ($this->hasPermission('m_form', 'Write')) {
            $formatnumber = $this->request->post('itemtransferformatnumber');

            if ($formatnumber) {
                $tordermodel = M_formsettings::getTItemTransferFormat();
                $tordermodel->StringValue = $formatnumber;
                $saveret = $tordermodel->save();

                if (!is_bool($saveret)) {
                    $arrmemnumber = explode("/", $formatnumber);
                    $sequence = "";
                    for ($i = 0; $i < $arrmemnumber[2]; $i++) {
                        $sequence = $sequence . "#";
                    }

                    $newnumber = $arrmemnumber[0] . "/" . $arrmemnumber[1] . "/" . $sequence;

                    foreach (M_shops::getAll() as $shop) {

                        $params = [
                            'where' => [
                                "M_Form_Id" => $tordermodel->M_Form_Id,
                                "Branch" => $shop->Id
                            ]
                        ];

                        $transnumber = G_transactionnumbers::getOne($params);
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
                            $gtransnumber->Branch = $shop->Id;
                            $gtransnumber->save();
                        }
                    }
                }
            }

            redirect("setting")->go();
        }
    }

    public function saveitemstock()
    {
        if ($this->hasPermission('m_form', 'Write')) {
            $formatnumber = $this->request->post('itemstockformatnumber');

            if ($formatnumber) {
                $tordermodel = M_formsettings::getTItemStockFormat();
                $tordermodel->StringValue = $formatnumber;
                $saveret = $tordermodel->save();

                if (!is_bool($saveret)) {
                    $arrmemnumber = explode("/", $formatnumber);
                    $sequence = "";
                    for ($i = 0; $i < $arrmemnumber[2]; $i++) {
                        $sequence = $sequence . "#";
                    }

                    $newnumber = $arrmemnumber[0] . "/" . $arrmemnumber[1] . "/" . $sequence;

                    foreach (M_shops::getAll() as $shop) {

                        $params = [
                            'where' => [
                                "M_Form_Id" => $tordermodel->M_Form_Id,
                                "Branch" => $shop->Id
                            ]
                        ];

                        $transnumber = G_transactionnumbers::getOne($params);
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
                            $gtransnumber->Branch = $shop->Id;
                            $gtransnumber->save();
                        }
                    }
                }
            }

            redirect("setting")->go();
        }
    }

    
}
