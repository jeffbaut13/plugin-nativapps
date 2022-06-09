<div class="wrap">
<?php

    echo "<h1>". get_admin_page_title() . "</h1>";

    $all_plugins = get_plugins();

    foreach($all_plugins as $i){

        if($i['Name'] == "Libreria Online"){
            echo "Nombre del Autor del plugin: "."<b>".$i['Author']."</b>";
        }
    }
    echo "<br>";
?>
    <div>
        <h2>Redes Sociales Nativapps</h2>
    </div>
<?php
    echo '<a style="display:inline-block;margin-bottom:20px;border-radius:10px;padding:5px 15px; color:white; background:#539eff; border:none; text-decoration: none;" target="_blank" href="https://www.facebook.com/nativapps"> Facebook nativapps </a>';
    echo "<br>";
    echo '<a style="display:inline-block;margin-bottom:20px;border-radius:10px;padding:5px 15px; color:white; background:#9953ff; border:none; text-decoration: none;" target="_blank" href="https://www.instagram.com/nativapps"> Instagram nativapps </a>';
    echo "<br>";
    echo '<a style="display:inline-block;margin-bottom:20px;border-radius:10px;padding:5px 15px; color:white; background:#00459f; border:none; text-decoration: none;" target="_blank" href="https://www.linkedin.com/company/nativapps-inc"> Linkedin nativapps </a>';
?>
</div>
