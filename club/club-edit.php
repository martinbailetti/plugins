<?php

        global $wpdb;
        $uid = $_REQUEST["uid"];
        
        $sql = "SELECT id, apellidos, nombre, correo, codigo, estado
            FROM wp_club_socios where id=$uid";

        $socio = $wpdb->get_row($sql);
        
?>
        <form id="club-edit-form" action="" method="post" novalidate="novalidate" >
        <h2>Editar Usuario</h2>
<?php if(isset($_REQUEST["n"]) && $_REQUEST["n"]==1){ ?>
        <div id="message" class="updated notice is-dismissible"><p>Nuevo socio agregado.</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Descartar este aviso.</span></button></div>
<?php } ?>
<?php if(isset($_REQUEST["n"]) && $_REQUEST["n"]==2){ ?>
        <div id="message" class="updated notice is-dismissible"><p>Los datos han sido actualizados.</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Descartar este aviso.</span></button></div>
<?php } ?>

        <table class="form-table">

        <tr class="user-last-name-wrap">
            <th><label for="nombre">Nombre *</label></th>
            <td><input type="text" class="regular-text" id="nombre" name="nombre" value="<?php echo $socio->nombre; ?>" /></td>
        </tr>

        <tr class="user-last-name-wrap">
            <th><label for="apellidos">Apellido *</label></th>
            <td><input type="text" class="regular-text" id="apellidos" name="apellidos" value="<?php echo $socio->apellidos; ?>" /></td>
        </tr>

        <tr class="user-last-name-wrap">
            <th><label for="correo">Correo *</label></th>
            <td><input type="text" class="regular-text" id="correo" name="correo" value="<?php echo $socio->correo; ?>" /></td>
        </tr>

        <tr class="user-last-name-wrap">
            <th><label for="codigo">Código *</label></th>
            <td><input type="text" class="regular-text" id="codigo" name="codigo" value="<?php echo $socio->codigo; ?>" /></td>
        </tr>

       
        <tr class="user-last-name-wrap">
            <th></th>
            <td></td>
        </tr>

        </table>
        <input name="execute" value="update" type="hidden">
        <input name="user_id" value="<?php echo $socio->id; ?>" type="hidden">
        <p class="submit"><input name="submit" id="submit" class="button button-primary" value="Actualizar" type="submit"> <a href="<?php echo admin_url('admin.php'.'?page=club_page') ?>" class="button">Cancelar</a></p>
        </form>
