<?php
    global $wpdb;


  $tabla = "{$wpdb->prefix}libros";

    if(isset($_POST['btnguardar'])){
      
      $imagen = $_POST['txtimage'];
      $nombre = $_POST['txtnombre'];
      $Genero = $_POST['txtgenero'];
      $autor = $_POST['txtautor'];
      $Fecha_publicacion = $_POST['txtfecha'];

      $datos = [
        'Imagen' => $imagen,
        'Nombre' => $nombre,
        'Genero' => $Genero,
        'Autor' => $autor,
        'Fecha_publicacion' => $Fecha_publicacion,
    ];
    $respuesta =  $wpdb->insert($tabla,$datos);
    }

    $query = "SELECT * FROM $tabla";
    $lista_libros = $wpdb->get_results($query,ARRAY_A);
    if(empty($lista_libros)){
      $lista_libros = array();
  }


?>
<div class="wrap">
  
        <?php
             echo "<h1 class='wp-heading-inline'>" . get_admin_page_title() . "</h1>";
        ?>
        <a id="btnnuevo" class="page-title-action">Ingresar Libro</a>

         <br>

         <div class="container">
          <h3>Shortcode</h3>
          <h4 class="font-weight-normal">Con el siguiente código Podrás implementar una sección de tipo Card con los libros que ingreses: <strong>[cards-libros]</strong></h4>
          <h4 class="font-weight-normal">Si deseas una lista de los libros mas sencilla: <strong>[lista-libros]</strong></h4>
        </div> 

        <br>
         <table class="wp-list-table widefat fixed striped pages">
                <thead>
                    <th >Imagen</th>    
                    <th >Nombre del libro</th>
                    <th >Genero</th>
                    <th >Autor</th>
                    <th >Fecha Publicación</th>
                    <th >Eliminar</th>
                    
                </thead>
                <tbody id="the-list">
                    <?php 
                        foreach ($lista_libros as $key => $value) {
                          $id = $value['ID'];
                         $nombre = $value['Nombre'];
                         $genero = $value['Genero'];
                         $autor = $value['Autor'];
                         $fecha = $value['Fecha_publicacion'];
                         $imagen = $value['Imagen'];
                           echo '
                                <tr>
                                    <td> <img width="50px" src="'.$imagen.'"></td>         
                                    <td>'.$nombre.'</td>
                                    <td>'.$genero.'</td>
                                    <td>'.$autor.'</td>
                                    <td>'.$fecha.'</td>
                                    <td><a data-id="'.$id.'" class="page-title-action">Borrar</a></td>
                                </tr>
                            ';
                        }

                    ?>
                </tbody>
        </table>


 </div>

 <!-- Modal -->
<div class="modal fade" id="modalnuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLongTitle">Agregar Libro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <form method="post">

              <div class="modal-body" style="padding:0">
                  
                        <div class="form-group">
                          <label for="txtnombre" class="col-sm-4 col-form-label" >Nombre del Libro</label>
                          <div class="col-sm-8" style="margin-bottom:10px">
                              <input type="text" id="txtnombre" name="txtnombre" style="width:100%">
                          </div>
                          <label for="txtgenero" class="col-sm-4 col-form-label" >Genero</label>
                          <div class="col-sm-8" style="margin-bottom:10px">
                              <input type="text" id="txtgenero" name="txtgenero" style="width:100%">
                          </div>
                          <label for="txtautor" class="col-sm-4 col-form-label" >Autor</label>
                          <div class="col-sm-8" style="margin-bottom:10px">
                              <input type="text" id="txtautor" name="txtautor" style="width:100%">
                          </div>
                          <label for="txtfecha" class="col-sm-4 col-form-label" >Fecha de Publicación</label>
                          <div class="col-sm-8" style="margin-bottom:10px">
                              <input type="text" id="txtfecha" name="txtfecha" style="width:100%">
                          </div>
                          <label for="txtimage" class="col-sm-4 col-form-label" >Adjuntar Imagen</label>
                          <div class="col-sm-8" style="margin-bottom:10px">
                              <input id="txtimage" type="text" name="txtimage" />
                              <input id="upload-button" type="button" class="button" value="Upload Image" />
                          </div>

          
                        </div>
                        


              </div>
              <div class="modal-footer mt4">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" name="btnguardar" id="btnguardar">Guardar</button>
              </div>
         </form>

    </div>
  </div>
</div>
<?php

