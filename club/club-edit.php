<?php

        global $wpdb;
        $uid = $_REQUEST["uid"];

        
        $sql = "SELECT id, apellidos, nombre, correo, codigo, estado
            FROM wp_club_socios where id=$uid";

        $socio = $wpdb->get_row($sql);
        
?>
        <form id="your-profile" action="" method="post" novalidate="novalidate" >
        <h2>Editar Usuario</h2>

        <table class="form-table">

        <tr class="user-last-name-wrap">
            <th><label>Nombre</label></th>
            <td><input type="text" id="nombre" name="nombre" value="<?php echo $socio->nombre; ?>" /></td>
        </tr>

        <tr class="user-last-name-wrap">
            <th><label>Apellido</label></th>
            <td><input type="text" id="apellidos" name="apellidos" value="<?php echo $socio->apellidos; ?>" /></td>
        </tr>

        <tr class="user-last-name-wrap">
            <th><label>Correo</label></th>
            <td><input type="text" id="correo" name="correo" value="<?php echo $socio->correo; ?>" /></td>
        </tr>

        <tr class="user-last-name-wrap">
            <th><label>DNI</label></th>
            <td><input type="text" id="codigo" name="codigo" value="<?php echo $socio->codigo; ?>" /></td>
        </tr>

       
        <tr class="user-last-name-wrap">
            <th></th>
            <td></td>
        </tr>

        </table>
        <input name="execute" value="update" type="hidden">
        <input name="user_id" value="<?php echo $socio->id; ?>" type="hidden">
        <p class="submit"><input name="submit" id="submit" class="button button-primary" value="Actualizar" type="submit"></p>
        </form>
