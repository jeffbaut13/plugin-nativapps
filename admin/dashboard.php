<div class="wrap">

<?php

    echo "<h1>". get_admin_page_title() . "</h1>";
?>


<?php

?>
    <div>
        <h2>Nombre del Sitio</h2>
    </div>
<?php
    echo "<p>". get_bloginfo('name') . "</p>";
?>
    <div>
        <h2>Url de Instalación</h2>
    </div>
<?php
    echo '<a href="'.get_home_url() . "/wp-admin/setup-config.php".'">URL de Instalación</a>';
?>
    <div>
        <h2>Versión de Wordpress</h2>
    </div>
<?php
    echo "<p>". bloginfo('version') . "</p>";

?>
    <div>
        <h2>URL Wordpress</h2>
    </div>
<?php
    echo '<a href="https://wordpress.com/es/">WORDPRESS<a>';
?>
    <div>
        <h2>Themes Instalados</h2>
    </div>
<?php

$all_themes = wp_get_themes();

foreach($all_themes as $themes){
    
    $my_theme = wp_get_theme();
    $theme = $my_theme->get( 'Name' );
    
    if($themes == $theme  ){
        echo '<strong style="font-wheigth:700">' . $theme . '</strong>';
        echo "<br>" ;
        }else{
        echo $themes['Name'];
        echo "<br>" ;
    }
} ;
?>
    <div>
        <h2>Plugins Instalados</h2>
    </div>
<?php
// Obtener datos de los plugins
$all_plugins = get_plugins();
$plugins_name = array(); 
foreach ( $all_plugins as $plugin ) {
    array_push ($plugins_name, strtolower($plugin['Name']));
}


//mostrar datos de plugins activados
$the_plugs = get_option('active_plugins'); 
$active_plugin = array();


foreach($the_plugs as $key => $value) {
    $string = explode('/',$value); 
    $string = str_replace("-", " ", $string );
    array_push($active_plugin, strtolower($string[0]) );
    echo '<p style="color:green">'.$string[0] .'</p>';
}

//union de arrays para obtener plugins desactivados
$plugins_unidos = array_merge($plugins_name, $active_plugin);

$plugins_unidos = $plugins_unidos;
$plug_2 = array_unique($plugins_unidos);

$plug_comunes1 = array_diff_assoc($plugins_unidos, $plug_2); 
$plug_comunes2 = array_unique($plug_comunes1);    // Eliminamos los elementos repetidos
    sort($plug_comunes2);    // Orden ascendente en array 

$v_unicos1 = array_diff($plugins_unidos, $plug_comunes2); 
    sort($v_unicos1);    // Orden ascendente en array 
$unicos = implode('<br>',$v_unicos1);     // Creamos cadena a partir del array

echo '<p style="color:red">'.$unicos.'</p>';

?>
    <div>
        <h2>Paginas Publicadas</h2>
    </div>

 <?php 
    $pages = get_pages(); 
    foreach ( $pages as $page ) {
        $option = '<a style="display:inline-block; margin-bottom:4px" href="' . get_page_link( $page->ID ) . '">'.$page->post_title.'</a>';
        echo ($option);
        echo "<br>";
  }

?>
    <div>
        <h2>Blogs Disponibles</h2>
    </div>
<?php
  
  $lastposts = get_posts();
  
    foreach ( $lastposts as $post ) {
     echo '<a style="display:inline-block; margin-bottom:4px" href="' . get_page_link( $post->ID ) . '">'.$post->post_title.'</a>';
     echo "<br>";
    }
            

?>

</div>

