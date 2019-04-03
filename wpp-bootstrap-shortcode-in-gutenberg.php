<?php
/*
	Plugin Name: WPP Bootstrap Shortcode in Gutenberg
	Plugin URI: https://github.com/gnanasekaranl/Bootstrap-Shortcode-in-Gutenberg
	Description: The plugin is a collection of page building WordPress blocks for the new Gutenberg WordPress block editor.
	Version: 1.0
	Author: Gnanasekaran Loganathan
	Author URI: https://github.com/gnanasekaranl
*/


/* If no Wordpress, go home */
if (!defined('ABSPATH')) { exit; }



add_action( 'after_setup_theme', 'bootstrap_shortcode_theme_setup' );
 
if ( ! function_exists( 'bootstrap_shortcode_theme_setup' ) ) {
    function bootstrap_shortcode_theme_setup(){
        //TinyMCE Buttons
        add_action( 'admin_init', 'bootstrap_shortcode_buttons' );
    }
}

 
//TinyMCE Buttons
if ( ! function_exists( 'bootstrap_shortcode_buttons' ) ) {
    function bootstrap_shortcode_buttons() {
        if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
            return;
        }
 
        if ( get_user_option( 'rich_editing' ) !== 'true' ) {
            return;
        }
 
        add_filter( 'mce_external_plugins', 'bootstrap_shortcode_add_buttons' );
        add_filter( 'mce_buttons', 'bootstrap_shortcode_register_buttons' );
    }
}
 
if ( ! function_exists( 'bootstrap_shortcode_add_buttons' ) ) {
    function bootstrap_shortcode_add_buttons( $plugin_array ) {
        $plugin_array['bootstrapshortcode'] = plugin_dir_url( __FILE__ ).'/js/tinymce_buttons.js';
        return $plugin_array;
    }
}
 
if ( ! function_exists( 'bootstrap_shortcode_register_buttons' ) ) {
    function bootstrap_shortcode_register_buttons( $buttons ) {
        array_push( $buttons, 'bootstrapshortcode' );
        return $buttons;
    }
}

//bootrsap library enqueue in admin
function load_custom_wp_admin_style(){
    wp_register_style( 'bootstrap_wp_admin_shortcode_help_css', plugin_dir_url( __FILE__ ).'/js/admin/bootstrap-shortcodes-help.css', false, '3.3.7' );
    wp_enqueue_style( 'bootstrap_wp_admin_shortcode_help_css' );
    wp_register_style( 'bootstrap_wp_admin_shortcode_modal_css', plugin_dir_url( __FILE__ ).'/js/admin/bootstrap-modal.css', false, '3.3.7' );
    wp_enqueue_style( 'bootstrap_wp_admin_shortcode_modal_css' );
    wp_register_script( 'bootstrap_wp_admin_js', plugin_dir_url( __FILE__ ).'/js/admin/bootstrap.js', false, '3.3.7' );
    wp_enqueue_script( 'bootstrap_wp_admin_js' );
}
add_action('admin_enqueue_scripts', 'load_custom_wp_admin_style');
