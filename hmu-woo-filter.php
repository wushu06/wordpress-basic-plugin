<?php
/*
Plugin Name: Hook Me Up Woo Filter
Plugin URI:  http://ukcoding.com
Description: import/export woocommerce products using rest api
Version:     1.0.0
Author:      Noureddine Latreche
Text Domain: Hook Me Up
Domain Path: /languages
License:     GPL3

*/
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
define('SITE_ROOT', realpath(dirname(__FILE__)));


/**
 * first we call the files we are using
 */
if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

use Inc\Base\Activate;
use Inc\Base\Deactivate;

function hmu_woo_filter_activate()
{
    Activate::activate();
}
function hmu_woo_filter_deactivate()
{
    Deactivate::deactivate();
}
register_activation_hook(__FILE__, 'hmu_woo_filter_activate');
register_deactivation_hook(__FILE__, 'hmu_woo_filter_deactivate');


if (class_exists('Inc\\Init')) {
    Inc\Init::register_services();
}
