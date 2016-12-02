<?php


        $uid = $_REQUEST["uid"];


        $user = get_user_by("ID", $uid);
        $user_info = get_userdata($uid);
    
            
    ?>
        <form id="your-profile" action="" method="post" novalidate="novalidate" >
        <h2>Editar Usuario</h2>

        <table class="form-table">

        <tr class="user-last-name-wrap">
            <th><label>Nombre</label></th>
            <td><input type="text" id="first_name" name="first_name" value="<?php echo $user_info->first_name; ?>" /></td>
        </tr>

        <tr class="user-last-name-wrap">
            <th><label>Apellido</label></th>
            <td><input type="text" id="last_name" name="last_name" value="<?php echo $user_info->last_name; ?>" /></td>
        </tr>

        <tr class="user-last-name-wrap">
            <th><label>Correo</label></th>
            <td><input type="text" id="user_email" name="user_email" value="<?php echo $user->user_email; ?>" /></td>
        </tr>

        <tr class="user-last-name-wrap">
            <th><label>DNI</label></th>
            <td><input type="text" id="code" name="code" value="<?php echo $user_info->code; ?>" /></td>
        </tr>

       
        <tr class="user-last-name-wrap">
            <th></th>
            <td></td>
        </tr>

        </table>
        <input name="update" value="update" type="hidden">
        <input name="user_id" value="<?php echo $user->ID; ?>" type="hidden">
        <p class="submit"><input name="submit" id="submit" class="button button-primary" value="Actualizar usuario" type="submit"></p>
        </form>
