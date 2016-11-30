<?php
/**
 * custom option and settings
 */
function wporg_settings_init()
{
    // register a new setting for "wporg" page
    register_setting('wporg', 'wporg_options');
 
    // register a new section in the "wporg" page
    add_settings_section(
        'wporg_section_developers',
        __('Opciones Generales', 'wporg'),
        'wporg_section_developers_cb',
        'wporg'
    );
 
    // register a new field in the "wporg_section_developers" section, inside the "wporg" page
    add_settings_field(
        'wporg_field_type', // as of WP 4.6 this value is used only internally
        // use $args' label_for to populate the id inside the callback
        __('Sistema en', 'wporg'),
        'wporg_field_type_cb',
        'wporg',
        'wporg_section_developers',
        [
            'label_for'         => 'wporg_field_type',
            'class'             => 'wporg_row',
            'wporg_custom_data' => 'custom',
        ]
    );
 
    // register a new field in the "wporg_section_developers" section, inside the "wporg" page
    add_settings_field(
        'wporg_field_ga_uid', // as of WP 4.6 this value is used only internally
        // use $args' label_for to populate the id inside the callback
        __('Google Analytics UID', 'wporg'),
        'wporg_field_ga_uid_cb',
        'wporg',
        'wporg_section_developers',
        [
            'label_for'         => 'wporg_field_ga_uid',
            'class'             => 'wporg_row',
            'wporg_custom_data' => 'custom',
        ]
    );
}
 
/**
 * register our wporg_settings_init to the admin_init action hook
 */
add_action('admin_init', 'wporg_settings_init');
 
/**
 * custom option and settings:
 * callback functions
 */
 
// developers section cb
 
// section callbacks can accept an $args parameter, which is an array.
// $args have the following keys defined: title, id, callback.
// the values are defined at the add_settings_section() function.
function wporg_section_developers_cb($args)
{
    ?>
    <p id="<?= esc_attr($args['id']); ?>"><?= esc_html__('Configura las opciones del sistema.', 'wporg'); ?></p>
    <?php
}
 
// pill field cb
 
// field callbacks can accept an $args parameter, which is an array.
// $args is defined at the add_settings_field() function.
// wordpress has magic interaction with the following keys: label_for, class.
// the "label_for" key value is used for the "for" attribute of the <label>.
// the "class" key value is used for the "class" attribute of the <tr> containing the field.
// you can add custom key value pairs to be used inside your callbacks.
function wporg_field_type_cb($args)
{
    // get the value of the setting we've registered with register_setting()
    $options = get_option('wporg_options');
    // output the field
    ?>
    <select id="<?= esc_attr($args['label_for']); ?>"
            data-custom="<?= esc_attr($args['wporg_custom_data']); ?>"
            name="wporg_options[<?= esc_attr($args['label_for']); ?>]"
    >
        <option value="Desarrollo" <?= isset($options[$args['label_for']]) ? (selected($options[$args['label_for']], 'Desarrollo', false)) : (''); ?>>
            <?= esc_html('Desarrollo', 'wporg'); ?>
        </option>
        <option value="Producción" <?= isset($options[$args['label_for']]) ? (selected($options[$args['label_for']], 'Producción', false)) : (''); ?>>
            <?= esc_html('Producción', 'wporg'); ?>
        </option>
    </select>
    <p class="description">
        <?= esc_html('Selecciona Desarrollo para mostrar las opciones para desarrolladores.', 'wporg'); ?>
    </p>
    <p class="description">
        <?= esc_html('Selecciona Producción para eliminar las opciones de desarrollo.', 'wporg'); ?>
    </p>
    <?php
}

function wporg_field_ga_uid_cb($args)
{
    // get the value of the setting we've registered with register_setting()
    $options = get_option('wporg_options');
    // output the field

    ?>
    <input id="<?= esc_attr($args['label_for']); ?>"
            data-custom="<?= esc_attr($args['wporg_custom_data']); ?>"
            name="wporg_options[<?= esc_attr($args['label_for']); ?>]"
            value="<?php echo $options[$args['label_for']]; ?>"
            placeholder="UA-00000000-1"
    >
     
    <p class="description">
        <?= esc_html('Ingresa el identificador único de Google Analytics.', 'wporg'); ?>
    </p>
    <?php
}
 
/**
 * top level menu
 */
function wporg_options_page()
{
    // add top level menu page
    add_menu_page(
        'WPOrg',
        'Sistema',
        'manage_options',
        'wporg',
        'wporg_options_page_html'
    );
}
 
/**
 * register our wporg_options_page to the admin_menu action hook
 */
add_action('admin_menu', 'wporg_options_page');
 
/**
 * top level menu:
 * callback functions
 */
function wporg_options_page_html()
{
    // check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }
 
    // add error/update messages
 
    // check if the user have submitted the settings
    // wordpress will add the "settings-updated" $_GET parameter to the url
    if (isset($_GET['settings-updated'])) {
        // add settings saved message with the class of "updated"
        add_settings_error('wporg_messages', 'wporg_message', __('Settings Saved', 'wporg'), 'updated');
    }
 
    // show error/update messages
    settings_errors('wporg_messages');
    ?>
    <div class="wrap">
        <h1><?= esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php
            // output security fields for the registered setting "wporg"
            settings_fields('wporg');
            // output setting sections and their fields
            // (sections are registered for "wporg", each field is registered to a specific section)
            do_settings_sections('wporg');
            // output save settings button
            submit_button('Save Settings');
            ?>
        </form>
    </div>
    <?php
}