<?php

define('DS', DIRECTORY_SEPARATOR, true);
define('BASE_PATH', __DIR__ . DS, TRUE);

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
});

$route->end();
