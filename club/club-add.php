
        <form id="club-edit-form" action="" method="post" novalidate="novalidate" >
        <h2>Agregar Socio</h2>
        <table class="form-table">

        <tr class="user-last-name-wrap">
            <th><label for="nombre">Nombre *</label></th>
            <td><input type="text" id="nombre" name="nombre" value="" /></td>
        </tr>

        <tr class="user-last-name-wrap">
            <th><label for="apellidos">Apellidos *</label></th>
            <td><input type="text" id="apellidos" name="apellidos" value="" /></td>
        </tr>

        <tr class="user-last-name-wrap">
            <th><label for="correo">Correo *</label></th>
            <td><input type="text" id="correo" name="correo" value="" /></td>
        </tr>

        <tr class="user-last-name-wrap">
            <th><label for="codigo">Código *</label></th>
            <td><input type="text" id="codigo" name="codigo" value="" /></td>
        </tr>

       
        <tr class="user-last-name-wrap">
            <th></th>
            <td></td>
        </tr>

        </table>
        <input name="execute" value="add" type="hidden">
        <p class="submit"><input name="submit" id="submit" class="button button-primary" value="Agregar" type="submit"> <a href="<?php echo admin_url('admin.php'.'?page=club_page') ?>" class="button">Cancelar</a></p>
        </form>
