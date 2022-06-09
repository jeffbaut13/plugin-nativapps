<?php
   
//shortcode Cards



function shortcode(){
    global $wpdb;
    $tabla = "{$wpdb->prefix}libros";
    $query = "SELECT * FROM $tabla";
    $datos = $wpdb->get_results($query,ARRAY_A);
    ?>
    <div id="large-th">
            <div class="container">
                <h1> A list of books</h1>
                <br>
                <div class="choose">
                    <a href="#list-th"><i class="fa fa-th-list" aria-hidden="true"></i></a>
                    <a href="#large-th"><i class="fa fa-th-large" aria-hidden="true"></i></a>
                </div>
                <div id="list-th">
    <?php

    foreach($datos as $libros=>$value){
        $nombre = $value['Nombre'];
        $genero = $value['Genero'];
        $autor = $value['Autor'];
        $fecha = $value['Fecha_publicacion'];
        $imagen = $value['Imagen'];
         
    ?>
        
                <div class="book read">
                        <div class="cover">
                            <img src="<?php echo $imagen ?>">
                        </div>
                        <div class="description">
                            <p class="title"><?php echo $nombre ?><br>
                                <span class="author"><?php echo $autor ?></span>
                                <span class="fecha"><?php echo "Publicado en: ".$fecha ?></span>
                                <span class="genero"><?php echo $genero ?></span>

                            </p>
                        </div> 
                    </div>

 <?php               
}
 ?>
                </div>
            </div>
        </div>
    <?php

}

add_shortcode("cards-libros","shortcode");

//shortcode list



function shortcode_list(){
    global $wpdb;
    $tabla = "{$wpdb->prefix}libros";
    $query = "SELECT * FROM $tabla";
    $datos = $wpdb->get_results($query,ARRAY_A);
?>
    <div class="main-list-container">
        <h1> A list of books</h1>
<?php
    foreach($datos as $libros=>$value){
        $nombre = $value['Nombre'];
        $genero = $value['Genero'];
        $autor = $value['Autor'];
        $fecha = $value['Fecha_publicacion'];
        $imagen = $value['Imagen'];
?>
    
        
        <div class="d-flex">
            <div width="30%"class="list_container" style="background-image: url('<?php echo $imagen ?>');">
                <!-- <img width="100px" class="img-rounded" src="https://alysbcohen.files.wordpress.com/2015/01/little-princess-book-cover.jpg" alt=""> -->
            </div>
            <div class="title-box">
                <h5 class="title"><?php echo $nombre ?></h5>
                <p class="title"><?php echo $autor ?></p>
                <p class="title"><?php echo $genero ?></p>
                <p class="title"><?php echo "Publicado en: ".$fecha ?></p>
                
            </div>
        </div>
        <hr>
        
        <?php 
    }
    ?>
</div>
<?php
}

add_shortcode("lista-libros","shortcode_list");