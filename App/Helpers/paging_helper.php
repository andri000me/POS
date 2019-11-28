<?php
use App\Models\M_groupusers;

function setPageData_paging($model){
    $data['model'] = $model;
    return $data;
}

function isPermitted_paging($groupid = null, $form = null, $role = null, $isreport = false){
    $groupuser = new M_groupusers();
    return $groupuser->isPermitted($groupid, $form, $role, $isreport);
}



function isPermittedMobile_paging($username, $groupid = null, $form = null, $role = null, $isreport = false){
    $groupuser = new M_groupusers();
    return $groupuser->isMoblePermitted($username, $groupid, $form, $role, $isreport);
}

function form_paging(){
    $data = array(
        'm_groupuser' => 'm_groupusers',
        'm_user' => 'm_users',
        'm_province' => 'm_provinces',
        'm_district' => 'm_districts',
        'm_subdistrict' => 'm_subdistricts',
        'm_formsetting' => 'm_formsettings',
        'm_company' => 'm_companies',
        'm_village' => 'm_villages',
        'm_subvillage' => 'm_subvillages',
        'm_disaster' => 'm_disasters',
        'm_infrastructurecategory' => 'm_infrastructurecategories',
        'm_infrastructure' => 'm_infrastructures',
        'm_livestock' => 'm_livestocks',
        'm_equipment' => 'm_equipments',
        'm_villagedisaster' => 'm_villagedisasters',
        'm_impact' => 'm_impacts',
        'm_familycard' => 'm_familycards',
        'm_disasterschool' => 'm_disasterschools',
        'm_instance' => 'm_instances',
        'm_capability' => 'm_capabilities',
        'm_community' => 'm_communities',
        'm_volunteer' => 'm_volunteers',
        'm_uom' => 'm_uoms',
        'm_warehouse' => 'm_warehouses',
        'm_item' => 'm_items',
        't_disasterreport' => 't_disasterreports',
        'm_form' => 'm_forms',
        't_disasteroccur' => 't_disasteroccurs',
        'm_safedistance' => 'm_safedistances',
        'm_earlywarning' => 'm_earlywarnings',
        't_inoutitem' => 't_inoutitems',
        'm_employee' => 'm_employees',
        'm_occupation' => 'm_occupations',
        'm_userlocation' => 'm_userlocations',
        'm_company' => 'm_companies',
        'm_pocketbook' => 'm_pocketbooks',
    );
    return $data;
}

function report_paging(){
    $data = array(
        'Disaster' => 'Disaster',
        'Population' => 'Population',
        'InOutItem' => 'In Out Item',
    );
    return $data;
}