<?php
/*
Plugin Name: IMGD Plugin
Plugin URI: http://imgdigital.com.ar/imgd_options
Description: Este es un Plug-in para para mi Framework via piklist
Version: 1.3
Author: Federico Reinoso
Author URI: http://imgdigital.com.ar
Text Domain: imgd
Domain Path: languages/
Plugin Type: Piklist
License: GPL2
*/

/**
 * Check if Piklist is activated and installed
 */
add_action('init', 'imgd_init_function');
function imgd_init_function()
{
    if(is_admin())
    {
        include_once(plugin_dir_path(__FILE__).'class-piklist-checker.php');

        if (!piklist_checker::check(__FILE__))
        {
            return;
        }
    }
}

/**
 * Loading Translation
 */
function imgd_plugin_init() {
    $plugin_dir = basename(dirname(__FILE__)).'/languages';
    //echo '<h1>'.$plugin_dir.'</h1>';
    load_plugin_textdomain( 'imgd', false, $plugin_dir );
}
add_action('plugins_loaded', 'imgd_plugin_init');


/**
 * IMGD Options Setting Page
 *
 * Define la página que tiene las definiciones para el Plug-in
 *
 * @param $pages
 * @return array
 */
function imgd_plugin_setting_pages($pages)
{
    $pages[] = array(
        'page_title' => __('IMGD Options','imgd')
        ,'menu_title' => __('IMGD Options', 'imgd')
        ,'capability' => 'manage_options'
        ,'menu_slug' => 'opciones_imgd'
        ,'setting' => 'opciones_imgd'
        ,'single_line' => true
        ,'default_tab' => 'Home'
        ,'save_text' => __('Guardar Settings','imgd')
    );

    return $pages;
}
add_filter('piklist_admin_pages', 'imgd_plugin_setting_pages');
