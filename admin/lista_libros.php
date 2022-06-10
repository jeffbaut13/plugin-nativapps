<?php
 //registrer CUSTOM POST TYPE

add_action('init', 'libro_post_type');
function libro_post_type() {
    register_post_type('libro', array(
        'labels' => array(
            'name'                  => _x( 'Libros', 'Post Type General Name', 'libros_domain' ),
            'singular_name'         => _x( 'libro', 'Post Type Singular Name', 'libros_domain' ),
            'menu_name'             => __( 'Libros', 'libros_domain' ),
            'name_admin_bar'        => __( 'Libros', 'libros_domain' ),
            'archives'              => __( 'Archivo de Libros', 'libros_domain' ),
            'attributes'            => __( 'Atributos de Libro', 'libros_domain' ),
            'parent_item_colon'     => __( 'Libro Padre', 'libros_domain' ),
            'all_items'             => __( 'Todos los Libros', 'libros_domain' ),
            'add_new_item'          => __( 'Agregar nuevo Libro', 'libros_domain' ),
            'add_new'               => __( 'Añadir Nuevo', 'libros_domain' ),
            'new_item'              => __( 'Nuevo Libro', 'libros_domain' ),
            'edit_item'             => __( 'Editar Libro', 'libros_domain' ),
            'update_item'           => __( 'Actualizar Libro', 'libros_domain' ),
            'view_item'             => __( 'Ver Libro', 'libros_domain' ),
            'view_items'            => __( 'Ver Libros', 'libros_domain' ),
            'search_items'          => __( 'Buscar Libros', 'libros_domain' ),
            'not_found'             => __( 'No encontrado', 'libros_domain' ),
            'not_found_in_trash'    => __( 'No encontrado en la papelera', 'libros_domain' ),
            'featured_image'        => __( 'Imagen destacada', 'libros_domain' ),
            'set_featured_image'    => __( 'Establecer Imagen Destacada', 'libros_domain' ),
            'remove_featured_image' => __( 'Eliminar la imagen destacada', 'libros_domain' ),
            'use_featured_image'    => __( 'Utilizar como imagen destacada', 'libros_domain' ),
            'insert_into_item'      => __( 'Insertar en el Libro', 'libros_domain' ),
            'uploaded_to_this_item' => __( 'Actualizar en este Libro', 'libros_domain' ),
            'items_list'            => __( 'lista de Libros', 'libros_domain' ),
            'items_list_navigation' => __( 'lista mavegable de Libros', 'libros_domain' ),
            'filter_items_list'     => __( 'Filtro de Lista de Libros', 'libros_domain' ),
        ),
       
        'label'                 => __( 'Libros', 'libros_domain' ),
		'description'           => __( 'Listado de Libros', 'libros_domain' ),
		'labels'                => $labels,
		'supports'              => array('title', 'thumbnail', 'revisions', 'revisions'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-book',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
		'show_in_rest'          => true,
    ));
}
// registro de campos personalizados
add_action( 'init', 'cyb_register_meta_fields' );
function cyb_register_meta_fields() {
  register_meta( 'libro',
               'cyb_autor',
               [
                 'description'      => _x( 'Autor', 'meta description', 'cyb-textdomain' ),
                 'single'           => true,
                 'sanitize_callback' => 'sanitize_text_field',
                 'auth_callback'     => 'aut_call'
               ]
  );

  register_meta( 'libro',
               'cyb_genero',
               [
                 'description'      => _x( 'Genero', 'meta description', 'cyb-textdomain' ),
                 'single'           => true,
                 'sanitize_callback' => 'sanitize_text_field',
                 'auth_callback'     => 'aut_call'
               ]
  );

  register_meta( 'libro',
               'cyb_fecha',
               [
                 'description'      => _x( 'Fecha Publicación', 'meta description', 'cyb-textdomain' ),
                 'single'           => true,
                 'sanitize_callback' => 'sanitize_text_field',
                 'auth_callback'     => 'aut_call'
               ]
  );
  
}


//funcion de callback
function aut_call( $allowed, $meta_key, $libro_id, $user_id, $cap, $caps ) {
  
  if( 'libro' == get_post_type( $post_id ) && current_user_can( 'edit_post', $post_id ) ) {
    $allowed = true;
  } else {
    $allowed = false;
  }

  return $allowed;

}
//añadir campos  
add_action( 'add_meta_boxes', 'cyb_meta_boxes' );
function cyb_meta_boxes() {
    add_meta_box( 'cyb-meta-box', __( 'Información General', 'cyb_textdomain' ), 'cyb_meta_box_callback', 'libro' );
}

function cyb_meta_box_callback( $post ) {

     wp_nonce_field( 'cyb_meta_box', 'cyb_meta_box_noncename' );
     ?>
     <p>
         <label class="label" for="cyb_autor"><?php _e( 'Autor', 'cyb_textdomain' ); ?></label>
         <input  name="cyb_autor" id="cyb_autor" type="text" value="<?php echo esc_attr( get_post_meta( $post->ID, 'cyb_autor', true ) ); ?>">
     </p>

     <p>
         <label class="label" for="cyb_genero"><?php _e( 'Genero', 'cyb_textdomain' ); ?></label>
         <input  name="cyb_genero" id="cyb_genero" type="text" value="<?php echo esc_attr( get_post_meta( $post->ID, 'cyb_genero', true ) ); ?>">
     </p>

     <p>
         <label class="label" for="cyb_fecha"><?php _e( 'fecha de Publicación', 'cyb_textdomain' ); ?></label>
         <input  name="cyb_fecha" id="cyb_fecha" type="text" value="<?php echo esc_attr( get_post_meta( $post->ID, 'cyb_fecha', true ) ); ?>">
     </p>
     <?php

}
//guardar datos base de datos
add_action( 'save_post', 'cyb_save_custom_fields', 10, 2 );
function cyb_save_custom_fields( $post_id, $post ) {
    
    
    if ( ! isset( $_POST['cyb_meta_box_noncename'] ) || ! wp_verify_nonce( $_POST['cyb_meta_box_noncename'], 'cyb_meta_box' ) ) {
        return;
    }
            
    
    if( isset( $_POST['cyb_autor'] ) && $_POST['cyb_autor'] != "" ) {
        update_post_meta( $post_id, 'cyb_autor', $_POST['cyb_autor'] );
    } else {
    
        delete_post_meta( $post_id, 'cyb_autor' );
    }
    
    if( isset( $_POST['cyb_genero'] ) && $_POST['cyb_genero'] != "" ) {
        update_post_meta( $post_id, 'cyb_genero', $_POST['cyb_genero'] );
    } else {
    
        delete_post_meta( $post_id, 'cyb_genero' );
    }

    
    if( isset( $_POST['cyb_fecha'] ) && $_POST['cyb_fecha'] != "" ) {
        update_post_meta( $post_id, 'cyb_fecha', $_POST['cyb_fecha'] );
    } else {
        
        delete_post_meta( $post_id, 'cyb_fecha' );
    }
}

//crear columnas para el dashboard de libros
function columnas_post_type_libro($columnas){
    $columnas = array(
        'cb' => '&lt;input type="checkbox" />',
        'title' => 'Título',
        'cyb_autor' => 'Autor',
        'cyb_genero' => 'Genero',
        'cyb_fecha' => 'Fecha de Publicación',   
    );
    return $columnas;
}
add_filter('manage_edit-libro_columns', 'columnas_post_type_libro') ;

//insertar datos de nbase de datos
function filas_post_type_libro($columna, $post_id){
    global $post;
    switch($columna){
        case 'cyb_genero':
            $data_genero = get_post_meta($post_id, 'cyb_genero');
            foreach($data_genero as $g ){
                echo $g;
            }
            
            break;
        case 'cyb_autor':
            $data_autor = get_post_meta( $post_id, 'cyb_autor' );
            foreach($data_autor as $a ){
                echo $a;
            }	  
            break;
        case 'cyb_fecha':
            $data_fecha = get_post_meta( $post_id, 'cyb_fecha' );
            foreach($data_fecha as $f ){
                echo $f;
            }	    

        default :
        break;
    }
    
}
add_action('manage_libro_posts_custom_column', 'filas_post_type_libro', 2, 10);


/* Assign custom template to event post type*/
function load_event_template( $template ) {
  global $post;
  if ( 'libro' === $post->post_type && locate_template( array( 'single-event.php' ) ) !== $template ) {
      return plugin_dir_path( __FILE__ ) . 'CPT_libros.php';
  }

  return $template;
}

add_filter( 'single_template', 'load_event_template' );