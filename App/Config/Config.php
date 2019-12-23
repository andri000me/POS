<?php
defined('BASE_PATH') OR exit('No direct script access allowed');

/**
 * set for you base_url
 * ex : http://localhost/YourDirectory/
 */
$config['base_url'] = 'http://localhost:8889/POS/';


/**
 * default language for application resource
 */
$config['language'] = 'id';

/**  
 * Migration    
 * 
 * if $config['enable_auto_migration'] set True Then you can use Nayo_migration function
 * 
*/
$config['enable_auto_migration'] = TRUE;

/**  
 * Migration 
 * 
 * if $config['enable_auto_seeds'] set True Then you can use Nayo_migration function
 * 
*/
$config['enable_auto_seed'] = TRUE;


/**
 * set true if Use CSRF 
 */
$config['csrf_security'] = FALSE;

/**
 * application key
 * fill it with unique key, ex : 5ddf5470a5e16
 */
$config['app_key'] = "5ddf6696d1468";
