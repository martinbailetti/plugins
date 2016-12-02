<?php
            global $wpdb;
            
            $sql = "SELECT id, apellidos, nombre
                FROM wp_club_socios where id IN(".implode(',', $_REQUEST["socio"]).')';


            $socios = $wpdb->get_results($sql );


            if(count($socios)){
?>
        <div id="icon-users" class="icon32"><br/></div>
        <h2>Socios</h2>
        <p>¿Deseas eliminar los siguientes registros?</p>

<?php


                echo '<ol>';

                foreach($socios as $o){

                    echo '<li>'.$o->nombre.'<input type="hidden" name="socio[]" value="'.$o->id.'" /></li>';
                    //$wpdb->delete( 'wp_club_socios', array( 'id' => $o ));


                }

                echo '</ol> ';
                echo '<p><a href="'.admin_url('admin.php'.'?page=club_page&execute=deletebulk&ids='.implode('.', $_REQUEST["socio"])).'" class="button button-primary">Eliminar registros</a>  <a href="'.admin_url('admin.php'.'?page=club_page').'" class="button">Cancelar</a></p>';
            }