<?php
/*
Plugin Name: Wordpress Nasdaq
Plugin URI: https://www.suno.com.br/
Description: Plugin para Listagem de Ativos Nasdaq
Version: 1.0
Author: Diego Antoniança
Author URI: https://www.suno.com.br/
Text Domain: wpnasdaq
License: GPL2
*/

if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'plugins_loaded', 'suno_plugin_wpnasdaq' );
add_action( 'admin_menu', 'suno_menu' );

function suno_plugin_wpnasdaq() {

    register_activation_hook( __FILE__, 'suno_activation');
    register_deactivation_hook( __FILE__, 'suno_deactivation');
    register_uninstall_hook(__FILE__, 'suno_uninstall');

    // INCLUDES 
    include 'includes/class-wp-suno-dashboard.php';
    include 'includes/class-wp-suno-api.php';
    include 'includes/class-wp-suno-functions.php';
    // INCLUDES

    add_action('wp_enqueue_scripts', 'suno_scripts');
    add_action('admin_enqueue_scripts', 'suno_admin_scripts');
}

function suno_menu(){ 
    add_menu_page('Wordpress Nasdaq', 'WP Nasdaq', 'manage_options', 'configurar-ativo', 'Dashboard::estrutura_form_ativo', 'dashicons-chart-area', 10);
}

function suno_admin_scripts(){
    // SELECT 2
    wp_enqueue_script( 'Select2_4.0.3_JS', plugin_dir_url(__FILE__).'admin/js/select2.min.js', array('jquery') );
    wp_enqueue_style( 'Select2_4.0.3_CSS', plugin_dir_url(__FILE__).'admin/css/select2.min.css' );
    // SELECT 2

    // SCRIPT JS
    wp_enqueue_script('Script_JS', plugin_dir_url(__FILE__).'admin/js/script.js', array('jquery'), '2.0.0', true);
    // SCRIPT JS

    // STYLE CSS
    wp_enqueue_style( 'Dashboard_CSS', plugin_dir_url(__FILE__).'admin/css/dashboard.css');
    // STYLE CSS
}

function suno_scripts(){

    // STYLE CSS
    wp_enqueue_style( 'Style_CSS', plugin_dir_url(__FILE__).'admin/css/style.css');
    // STYLE CSS

    // BOOTSTRAP 5 JS 
    wp_enqueue_script( 'Bootstrap_Min_JS', plugin_dir_url(__FILE__).'admin/js/bootstrap.min.js', array ( 'jquery' ));
    // BOOTSTRAP 5 JS 

    // BOOTSTRAP 5 CSS 
    wp_enqueue_style( 'Bootstrap_Min_CSS', plugin_dir_url(__FILE__).'admin/css/bootstrap.min.css');
    wp_enqueue_style( 'Bootstrap_CSS', plugin_dir_url(__FILE__).'admin/css/bootstrap.css');
    wp_enqueue_style( 'Bootstrap_CSS_Icons', plugin_dir_url(__FILE__).'admin/css/bootstrap-icons.css');         
    // BOOTSTRAP 5 CSS 



}


function suno_activation(){}

function suno_deactivation(){}

function suno_uninstall(){}

function suno_code_head(){}

function suno_code_body(){}