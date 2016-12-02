 <?php

            global $wpdb;
            
            $sql = "SELECT id, apellidos, nombre
                FROM wp_club_socios where id=".$_REQUEST["uid"];


            $socio = $wpdb->get_row($sql );


?>
        <div id="icon-users" class="icon32"><br/></div>
        <h2>Socios</h2>
        <p>¿Deseas eliminar a <?php echo $socio->nombre." ".$socio->apellidos ?>?</p>

<?php


           
      echo '<p><a href="'.admin_url('admin.php?page=club_page&execute=delete&uid='.$_REQUEST["uid"]).'" class="button button-primary">Eliminar</a>  <a href="'.admin_url('admin.php'.'?page=club_page').'" class="button">Cancelar</a></p>';
        

    ?>

        
    </div>

