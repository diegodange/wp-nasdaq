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
    include 'includes/class-wp-suno-shortcodes.php';
    // INCLUDES

    add_action('wp_enqueue_scripts', 'suno_scripts');

}

function suno_menu(){ 
  add_menu_page('Wordpress Nasdaq', 'WP Nasdaq', 'manage_options', 'configuracoes', 'Dashboard::layout', 'dashicons-chart-area', 10);
}


function suno_scripts(){
  wp_enqueue_script('Script_JS', plugin_dir_url(__FILE__) . 'admin/js/script.js', array('jquery'), '2.0.0', true);
}

function suno_activation(){}

function suno_deactivation(){}

function suno_uninstall(){}

function suno_code_head(){}

function suno_code_body(){}