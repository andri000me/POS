<?php

// define('DS', DIRECTORY_SEPARATOR, true);
// define('BASE_PATH', __DIR__ . DS, TRUE);

$app		= System\App::instance();
$app->request  	= System\Request::instance();
$app->route	= System\Route::instance($app->request);

$route		= $app->route;

/**
 * Your routes go here
 * see Nezamy route for more info at https://nezamy.com/Route/
 * 
 */
$route->get('/', 'App\Controllers\Login@index');
$route->get('/home', 'App\Controllers\Home@index');
$route->get('/changeLanguage', 'App\Controllers\M_user@changelanguage');

$route->get('/Forbidden', 'App\Controllers\Error@forbidden');

$route->group('/welcome', function () {
    $this->get('/', 'App\Controllers\Welcome@index');
    $this->get('/filter', 'App\Controllers\Welcome@filter');
});

$route->group('/setting', function () {
    $this->get('/', 'App\Controllers\M_form@index');
    $this->post('/saveitemstock', 'App\Controllers\M_form@saveitemstock');
    $this->post('/saveitemtransfer', 'App\Controllers\M_form@saveitemtransfer');
    $this->post('/saveitemreceive', 'App\Controllers\M_form@saveitemreceive');
});

$route->group('/test', function () {
    $this->get('/', 'App\Controllers\Test@index');
});

$route->group('/login', function () {
    $this->get('/', 'App\Controllers\Login@index');
    $this->post('/dologin', 'App\Controllers\Login@dologin');
    $this->get('/dologout', 'App\Controllers\Login@dologout');
});


$route->group('/reports', function () {
    $this->get('/', 'App\Controllers\Report@index');
    $this->get('/getAllData', 'App\Controllers\Report@getAllData');
});

$route->group('/mgroupuser', function () {
    $this->get('/', 'App\Controllers\M_groupuser@index');
    $this->get('/add', 'App\Controllers\M_groupuser@add');
    $this->post('/addsave', 'App\Controllers\M_groupuser@addsave');
    $this->get('/edit/?', 'App\Controllers\M_groupuser@edit');
    $this->post('/editsave', 'App\Controllers\M_groupuser@editsave');
    $this->post('/delete', 'App\Controllers\M_groupuser@delete');
    $this->get('/editrole/?', 'App\Controllers\M_groupuser@editrole');
    $this->post('/saverole', 'App\Controllers\M_groupuser@saverole');
    $this->post('/savereportrole', 'App\Controllers\M_groupuser@savereportrole');
    $this->get('/editreportrole/?', 'App\Controllers\M_groupuser@editreportrole');
    $this->get('/getAllData', 'App\Controllers\M_groupuser@getAllData');
    $this->get('/getDataModal', 'App\Controllers\M_groupuser@getDataModal');
});


$route->group('/muser', function () {
    $this->get('/', 'App\Controllers\M_user@index');
    $this->get('/add', 'App\Controllers\M_user@add');
    $this->post('/addsave', 'App\Controllers\M_user@addsave');
    $this->get('/edit/?', 'App\Controllers\M_user@edit');
    $this->post('/editsave', 'App\Controllers\M_user@editsave');
    $this->post('/delete', 'App\Controllers\M_user@delete');
    $this->get('/getAllData', 'App\Controllers\M_user@getAllData');
    $this->get('/getDataModal', 'App\Controllers\M_user@getDataModal');
});

$route->group('/mcategory', function () {
    $this->get('/', 'App\Controllers\M_category@index');
    $this->get('/add', 'App\Controllers\M_category@add');
    $this->post('/addsave', 'App\Controllers\M_category@addsave');
    $this->get('/edit/?', 'App\Controllers\M_category@edit');
    $this->post('/editsave', 'App\Controllers\M_category@editsave');
    $this->post('/delete', 'App\Controllers\M_category@delete');
    $this->get('/getAllData', 'App\Controllers\M_category@getAllData');
    $this->get('/getDataModal', 'App\Controllers\M_category@getDataModal');
});

$route->group('/mwarehouse', function () {
    $this->get('/', 'App\Controllers\M_warehouse@index');
    $this->get('/add', 'App\Controllers\M_warehouse@add');
    $this->post('/addsave', 'App\Controllers\M_warehouse@addsave');
    $this->get('/edit/?', 'App\Controllers\M_warehouse@edit');
    $this->post('/editsave', 'App\Controllers\M_warehouse@editsave');
    $this->post('/delete', 'App\Controllers\M_warehouse@delete');
    $this->get('/getAllData', 'App\Controllers\M_warehouse@getAllData');
    $this->get('/getDataModal', 'App\Controllers\M_warehouse@getDataModal');
});

$route->group('/muom', function () {
    $this->get('/', 'App\Controllers\M_uom@index');
    $this->get('/add', 'App\Controllers\M_uom@add');
    $this->post('/addsave', 'App\Controllers\M_uom@addsave');
    $this->get('/edit/?', 'App\Controllers\M_uom@edit');
    $this->post('/editsave', 'App\Controllers\M_uom@editsave');
    $this->post('/delete', 'App\Controllers\M_uom@delete');
    $this->get('/getAllData', 'App\Controllers\M_uom@getAllData');
    $this->get('/getDataModal', 'App\Controllers\M_uom@getDataModal');
    $this->get('/getModalByItem/?', 'App\Controllers\M_uom@getModalByItem');
});

$route->group('/mitem', function () {
    $this->get('/', 'App\Controllers\M_item@index');
    $this->get('/add', 'App\Controllers\M_item@add');
    $this->post('/addsave', 'App\Controllers\M_item@addsave');
    $this->get('/edit/?', 'App\Controllers\M_item@edit');
    $this->post('/editsave', 'App\Controllers\M_item@editsave');
    $this->post('/delete', 'App\Controllers\M_item@delete');
    $this->get('/getAllData', 'App\Controllers\M_item@getAllData');
    $this->get('/getDataModal', 'App\Controllers\M_item@getDataModal');
});

$route->group('/muomconversion', function () {
    $this->get('/?', 'App\Controllers\M_uomconversion@index');
    $this->get('/add/?', 'App\Controllers\M_uomconversion@add');
    $this->post('/addsave', 'App\Controllers\M_uomconversion@addsave');
    $this->get('/edit/?', 'App\Controllers\M_uomconversion@edit');
    $this->post('/editsave', 'App\Controllers\M_uomconversion@editsave');
    $this->post('/delete', 'App\Controllers\M_uomconversion@delete');
    $this->get('/getAllData/?', 'App\Controllers\M_uomconversion@getAllData');
    $this->get('/getDataModal/?', 'App\Controllers\M_uomconversion@getDataModal');
    $this->post('/getData', 'App\Controllers\M_uomconversion@getData');
    $this->post('/getDataById', 'App\Controllers\M_uomconversion@getDataById');
});

$route->group('/titemstock', function () {
    $this->get('/', 'App\Controllers\T_itemstock@index');
    $this->get('/add', 'App\Controllers\T_itemstock@add');
    $this->post('/addsave', 'App\Controllers\T_itemstock@addsave');
    $this->get('/edit/?', 'App\Controllers\T_itemstock@edit');
    $this->get('/copy/?', 'App\Controllers\T_itemstock@copy');
    $this->post('/editsave', 'App\Controllers\T_itemstock@editsave');
    $this->post('/delete', 'App\Controllers\T_itemstock@delete');
    $this->get('/getAllData', 'App\Controllers\T_itemstock@getAllData');
    $this->get('/getDataModal', 'App\Controllers\T_itemstock@getDataModal');
});

$route->group('/titemstockdetail', function () {
    $this->get('/?', 'App\Controllers\T_itemstockdetail@index');
    $this->get('/add/?', 'App\Controllers\T_itemstockdetail@add');
    $this->post('/addsave', 'App\Controllers\T_itemstockdetail@addsave');
    $this->get('/edit/?', 'App\Controllers\T_itemstockdetail@edit');
    $this->post('/editsave', 'App\Controllers\T_itemstockdetail@editsave');
    $this->post('/delete', 'App\Controllers\T_itemstockdetail@delete');
    $this->get('/getAllData/?', 'App\Controllers\T_itemstockdetail@getAllData');
    $this->get('/getDataModal', 'App\Controllers\T_itemstockdetail@getDataModal');
});

$route->group('/titemtransfer', function () {
    $this->get('/', 'App\Controllers\T_itemtransfer@index');
    $this->get('/add', 'App\Controllers\T_itemtransfer@add');
    $this->post('/addsave', 'App\Controllers\T_itemtransfer@addsave');
    $this->get('/edit/?', 'App\Controllers\T_itemtransfer@edit');
    $this->get('/copy/?', 'App\Controllers\T_itemtransfer@copy');
    $this->post('/editsave', 'App\Controllers\T_itemtransfer@editsave');
    $this->post('/delete', 'App\Controllers\T_itemtransfer@delete');
    $this->get('/getAllData', 'App\Controllers\T_itemtransfer@getAllData');
    $this->get('/getDataModal', 'App\Controllers\T_itemtransfer@getDataModal');
    $this->get('/getDataModalItemTransfer/?', 'App\Controllers\T_itemtransfer@getDataModalItemTransfer');
});

$route->group('/titemtransferdetail', function () {
    $this->get('/?', 'App\Controllers\T_itemtransferdetail@index');
    $this->get('/add/?', 'App\Controllers\T_itemtransferdetail@add');
    $this->post('/addsave', 'App\Controllers\T_itemtransferdetail@addsave');
    $this->get('/edit/?', 'App\Controllers\T_itemtransferdetail@edit');
    $this->post('/editsave', 'App\Controllers\T_itemtransferdetail@editsave');
    $this->post('/delete', 'App\Controllers\T_itemtransferdetail@delete');
    $this->get('/getAllData/?', 'App\Controllers\T_itemtransferdetail@getAllData');
    $this->get('/getDataModal', 'App\Controllers\T_itemtransferdetail@getDataModal');
});


$route->group('/titemreceive', function () {
    $this->get('/', 'App\Controllers\T_itemreceive@index');
    $this->get('/add', 'App\Controllers\T_itemreceive@add');
    $this->post('/addsave', 'App\Controllers\T_itemreceive@addsave');
    $this->get('/edit/?', 'App\Controllers\T_itemreceive@edit');
    $this->get('/copy/?', 'App\Controllers\T_itemreceive@copy');
    $this->post('/editsave', 'App\Controllers\T_itemreceive@editsave');
    $this->post('/delete', 'App\Controllers\T_itemreceive@delete');
    $this->get('/getAllData', 'App\Controllers\T_itemreceive@getAllData');
    $this->get('/getDataModal', 'App\Controllers\T_itemreceive@getDataModal');
});

$route->group('/titemreceivedetail', function () {
    $this->get('/?', 'App\Controllers\T_itemreceivedetail@index');
    $this->get('/add/?', 'App\Controllers\T_itemreceivedetail@add');
    $this->post('/addsave', 'App\Controllers\T_itemreceivedetail@addsave');
    $this->get('/edit/?', 'App\Controllers\T_itemreceivedetail@edit');
    $this->post('/editsave', 'App\Controllers\T_itemreceivedetail@editsave');
    $this->post('/delete', 'App\Controllers\T_itemreceivedetail@delete');
    $this->get('/getAllData/?', 'App\Controllers\T_itemreceivedetail@getAllData');
    $this->get('/getDataModal', 'App\Controllers\T_itemreceivedetail@getDataModal');
    $this->post('/addDetailJson', 'App\Controllers\T_itemreceivedetail@addDetailJson');
});

$route->group('/mshop', function () {
    $this->get('/', 'App\Controllers\M_shop@index');
    $this->get('/add', 'App\Controllers\M_shop@add');
    $this->post('/addsave', 'App\Controllers\M_shop@addsave');
    $this->get('/edit/?', 'App\Controllers\M_shop@edit');
    $this->post('/editsave', 'App\Controllers\M_shop@editsave');
    $this->post('/delete', 'App\Controllers\M_shop@delete');
    $this->get('/getAllData', 'App\Controllers\M_shop@getAllData');
    $this->get('/getDataModal', 'App\Controllers\M_shop@getDataModal');
    $this->get('/getItemTransferShopModal', 'App\Controllers\M_shop@getItemTransferShopModal');
});

$route->end();
