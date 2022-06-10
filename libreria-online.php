<?php
/*
Plugin Name: Libreria Online
Plugin URI: 
Description: Plugin para incluir una libreria en cualquier parte de tu sitioweb por medio de shortcode
Version: 0.0.1
Author: Jefersson Bautista
*/

//requires
require_once dirname(__FILE__) . '/includes/init.php';


function Activar(){
        global $wpdb;

        $sql ="CREATE TABLE IF NOT EXISTS {$wpdb->prefix}libros(
            `ID` INT NOT NULL AUTO_INCREMENT,
                `Nombre` VARCHAR(45) NULL,
                `Genero` VARCHAR(45) NULL,
                `Autor` VARCHAR(45) NULL,
                `Fecha_publicacion` VARCHAR(45) NULL,
                `Imagen` VARCHAR(150) NULL,
                PRIMARY KEY (`ID`));";
    
             $wpdb->query($sql);     

}

function Desactivar(){
    flush_rewrite_rules();
}

register_activation_hook(__FILE__,'Activar');
register_deactivation_hook(__FILE__,'Desactivar');
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
        'libreria', //adicion submenu slug padre
        'Libro', 
        'Libro',
        'manage_options',
        'sp_libros',
        'MostrarContenido'
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

function MostrarContenido(){
    
    include(plugin_dir_path(__FILE__).'admin/lista_libros.php');//archivo externo para mostrar contenido
    
}
function About_menu(){
    include(plugin_dir_path(__FILE__).'admin/about.php');//archivo externo para mostrar contenido
}

function Dashboard_menu(){
    include(plugin_dir_path(__FILE__).'admin/dashboard.php');//archivo externo para mostrar contenido
}

//encolar bootstrap

function EncolarBootstrapJS($hook){

    if($hook != "scantoolwp_page_sp_libros"){
        return ;
    }
    wp_enqueue_script('bootstrapJs',plugins_url('admin/bootstrap/js/bootstrap.min.js',__FILE__),array('jquery'));
}
add_action('admin_enqueue_scripts','EncolarBootstrapJS');


function EncolarBootstrapCSS($hook){
    if($hook != "scantoolwp_page_sp_libros"){
        return ;
    }
    wp_enqueue_style('bootstrapCSS',plugins_url('admin/bootstrap/css/bootstrap.min.css',__FILE__));
}
add_action('admin_enqueue_scripts','EncolarBootstrapCSS');


//encolar js propio

function EncolarJS($hook){
    if($hook != "scantoolwp_page_sp_libros"){
        return ;
    }
    wp_enqueue_media();
    wp_enqueue_script('JsExterno',plugins_url('admin/js/lista_libros.js',__FILE__),array('jquery'));
    wp_localize_script('JsExterno','SolicitudesAjax',[
        'url' => admin_url('admin-ajax.php'),
        'seguridad' => wp_create_nonce('seg')
    ]);
}
add_action('admin_enqueue_scripts','EncolarJS');

function css_table(){
    wp_register_style('estilos-css', plugin_dir_url(__FILE__).'admin/css/estilos-props.css', false, '1.0.');
    wp_enqueue_style( 'estilos-css' );
}
add_action( 'wp_enqueue_scripts', 'css_table', 10 );


//ajax

function EliminarLibro(){
    $nonce = $_POST['nonce'];
    if(!wp_verify_nonce($nonce, 'seg')){
        die('no tiene permisos para ejecutar ese ajax');
    }

    $id = $_POST['id'];
    global $wpdb;
    $tabla = "{$wpdb->prefix}libros";
    $wpdb->delete($tabla,array('ID' =>$id));
    
     return true;
}

add_action('wp_ajax_peticioneliminar','EliminarLibro');


