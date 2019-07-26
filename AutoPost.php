<?php
/**
 * Plugin Name: AutoPost
 * Description: The plugin makes it easy to automatically set up publishing and unpublishing a post with a specific date. May be repeated during the specified years.
 * Plugin URI:  https://github.com/AndrewPentri/AutoPost-Wordpress
 * Author URI:  https://github.com/AndrewPentri
 * Author:      Agafonov Andrew
 * Version:     1.1
 *
 * Text Domain: ap-trn
 * Domain Path: /lang
 *
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * Network:     false
 */



add_action( 'wp_enqueue_scripts', 'jQuery_load' );
function jQuery_load() {
    wp_deregister_script( 'jquery-core' );
    wp_register_script( 'jquery-core', '//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');
    wp_enqueue_script( 'jquery' );
}
add_action('init','css_connect');
function css_connect(){
    wp_register_style('ap-style', plugins_url('assests/css/ap-style.css', __FILE__));
    wp_enqueue_style('ap-style');
}

add_action('init','datepicker_js');
function datepicker_js(){
    wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_style('jqueryui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css', false, null );
}

add_action('init','js_connect');
function js_connect(){
    wp_enqueue_script( 'setMeta', plugins_url( 'assests/js/editMeta.js', __FILE__ ));
}

require_once("metabox.php");
require_once("datecalc.php");