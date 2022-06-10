<?php
/*
Plugin Name: Libreria Online
Plugin URI: 
Description: Plugin para incluir una libreria en cualquier parte de tu sitioweb por medio de shortcode
Version: 0.0.1
Author: Jefersson Bautista
*/

//requires

require_once dirname(__FILE__) . '/admin/CPT_libros.php';

function Desactivar(){
    flush_rewrite_rules();
}

register_activation_hook(__FILE__,'Activar');
register_deactivation_hook(__FILE__,'Desactivar');
register_uninstall_hook(__FILE__, 'borrar');

add_action('admin_menu','CrearMenu');

function CrearMenu(){
    add_menu_page(
        'Libreria',//Titulo de la pagina
        'ScanToolWP',// Titulo del menu
        'manage_options', // Capability
        'libreria', //slug
        'MostrarContenido', //contenido
        plugin_dir_url(__FILE__).'admin/img/icon.png',//icono    
    );
    
    add_submenu_page(
        'libreria',//adicion submenu slug padre
        'Dashboard',
        'Dashboard',
        'manage_options',
        'sp_Dashboard',
        'Dashboard_menu'

    );
    add_submenu_page(
        'libreria',//adicion submenu slug padre
        'About',
        'About',
        'manage_options',
        'sp_about',
        'About_menu'
    );
    remove_submenu_page( 'libreria', 'libreria' ); //elimino del submenu el scantoolwp
}


function About_menu(){
    include(plugin_dir_path(__FILE__).'admin/about.php');//archivo externo para mostrar contenido
}

function Dashboard_menu(){
    include(plugin_dir_path(__FILE__).'admin/dashboard.php');//archivo externo para mostrar contenido
}


function css_table(){
    wp_register_style('estilos-css', plugin_dir_url(__FILE__).'admin/css/estilos-props.css', false, '1.0.');
    wp_enqueue_style( 'estilos-css' );
}
add_action( 'wp_enqueue_scripts', 'css_table', 10 );