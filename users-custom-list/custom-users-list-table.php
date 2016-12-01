<?php
/*
Plugin Name: Custom Users List
Plugin URI: http://www.mattvanandel.com/
Description: A highly documented plugin that demonstrates how to create custom List Tables using official WordPress APIs.
Version: 99.4.1
Author: Matt van Andel
Author URI: http://www.mattvanandel.com
License: GPL2
*/



/* == NOTICE ===================================================================
 * Please do not alter this file. Instead: make a copy of the entire plugin, 
 * rename it, and work inside the copy. If you modify this plugin directly and 
 * an update is released, your changes will be lost!
 * ========================================================================== */



/*************************** LOAD THE BASE CLASS *******************************
 *******************************************************************************
 * The WP_List_Table class isn't automatically available to plugins, so we need
 * to check if it's available and load it if necessary. In this tutorial, we are
 * going to use the WP_List_Table class directly from WordPress core.
 *
 * IMPORTANT:
 * Please note that the WP_List_Table class technically isn't an official API,
 * and it could change at some point in the distant future. Should that happen,
 * I will update this plugin with the most current techniques for your reference
 * immediately.
 *
 * If you are really worried about future compatibility, you can make a copy of
 * the WP_List_Table class (file path is shown just below) to use and distribute
 * with your plugins. If you do that, just remember to change the name of the
 * class to avoid conflicts with core.
 *
 * Since I will be keeping this tutorial up-to-date for the foreseeable future,
 * I am going to work with the copy of the class provided in WordPress core.
 */
if(!class_exists('WP_List_Table')){
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}



/************************** CREATE A PACKAGE CLASS *****************************
 *******************************************************************************
 * Create a new list table package that extends the core WP_List_Table class.
 * WP_List_Table contains most of the framework for generating the table, but we
 * need to define and override some methods so that our data can be displayed
 * exactly the way we need it to be.
 * 
 * To display this example on a page, you will first need to instantiate the class,
 * then call $yourInstance->prepare_items() to handle any data manipulation, then
 * finally call $yourInstance->display() to render the table to the page.
 * 
 * Our theme for this list table is going to be movies.
 */
class Custom_Users_List_Table extends WP_List_Table {
    
    /** ************************************************************************
     * Normally we would be querying data from a database and manipulating that
     * for use in your list table. For this example, we're going to simplify it
     * slightly and create a pre-built array. Think of this as the data that might
     * be returned by $wpdb->query()
     * 
     * In a real-world scenario, you would make your own custom query inside
     * this class' prepare_items() method.
     * 
     * @var array 
     **************************************************************************/

  

    var $example_data = array();
    var $concurso_id = "";
    var $categoria_id = "";


    /** ************************************************************************
     * REQUIRED. Set up a constructor that references the parent constructor. We 
     * use the parent reference to set some default configs.
     ***************************************************************************/
    function __construct(){
        global $status, $page;
                
        //Set parent defaults
        parent::__construct( array(
            'singular'  => 'usuario',     //singular name of the listed records
            'plural'    => 'usuarios',    //plural name of the listed records
            'ajax'      => false        //does this table support ajax?
        ) );



        $orderby="n.meta_value";
        $order="asc";

        if(isset($_REQUEST["orderby"])) $orderby=$_REQUEST["orderby"];
        if(isset($_REQUEST["order"])) $order=$_REQUEST["order"];


            $args = array(
                        'post_type'  => 'page', 
                        'post_parent'  => 0, 
                        'posts_per_page' => 1,
                        'orderby' => 'meta_value', 
                        'meta_key' => 'año',
                        'order'=>'DESC',
                        'meta_query' => array(
                                   array(
                                    'key' => '_wp_page_template',
                                    'value' => 'concurso.php'
                                )
                        )
                );

            $concursos = new WP_Query($args);




        global $wpdb;

        
        $sql = "SELECT u.ID, m.meta_value AS last_name, n.meta_value AS first_name, 
            u.user_email, c.meta_value AS code, s.meta_value as status
            FROM wp_users u
            LEFT OUTER JOIN wp_usermeta m ON(m.user_id=u.ID AND m.meta_key='last_name') 
            LEFT OUTER JOIN wp_usermeta n ON(n.user_id=u.ID AND n.meta_key='first_name')
            LEFT OUTER JOIN wp_usermeta c ON(c.user_id=u.ID AND c.meta_key='code') 
            LEFT OUTER JOIN wp_usermeta s ON(s.user_id=u.ID AND s.meta_key='status') ";


        if($orderby != "" && $order!=""){

            $sql .= " order by ".$orderby." ".$order;

        }
        $this->example_data = $wpdb->get_results($sql, ARRAY_A );
        
    }


    /** ************************************************************************
     * Recommended. This method is called when the parent class can't find a method
     * specifically build for a given column. Generally, it's recommended to include
     * one method for each column you want to render, keeping your package class
     * neat and organized. For example, if the class needs to process a column
     * named 'title', it would first see if a method named $this->column_title() 
     * exists - if it does, that method will be used. If it doesn't, this one will
     * be used. Generally, you should try to use custom column methods as much as 
     * possible. 
     * 
     * Since we have defined a column_title() method later on, this method doesn't
     * need to concern itself with any column with a name of 'title'. Instead, it
     * needs to handle everything else.
     * 
     * For more detailed insight into how columns are handled, take a look at 
     * WP_List_Table::single_row_columns()
     * 
     * @param array $item A singular item (one full row's worth of data)
     * @param array $column_name The name/slug of the column to be processed
     * @return string Text or HTML to be placed inside the column <td>
     **************************************************************************/
    function column_default($item, $column_name){
        switch($column_name){
            case 'ID':
            case 'last_name':
                return $this->column_title($item);
            case 'first_name':
                return $item[$column_name];
            case 'user_email':
                return $item[$column_name];
            case 'code':
                return $item[$column_name];
            case 'status':
                return $this->column_status($item);
            default:
                return print_r($item,true); //Show the whole array for troubleshooting purposes
        }
    }


    /** ************************************************************************
     * Recommended. This is a custom column method and is responsible for what
     * is rendered in any column with a name/slug of 'title'. Every time the class
     * needs to render a column, it first looks for a method named 
     * column_{$column_title} - if it exists, that method is run. If it doesn't
     * exist, column_default() is called instead.
     * 
     * This example also illustrates how to implement rollover actions. Actions
     * should be an associative array formatted as 'slug'=>'link html' - and you
     * will need to generate the URLs yourself. You could even ensure the links
     * 
     * 
     * @see WP_List_Table::::single_row_columns()
     * @param array $item A singular item (one full row's worth of data)
     * @return string Text to be placed inside the column <td> (movie title only)
     **************************************************************************/
    function column_title($item){
        
        //Build row actions
        $actions = array(
            'edit'      => sprintf('<a href="?page=%s&action=%s&uid=%s">Edit</a>',$_REQUEST['page'],'edit',$item['ID']),
            'delete'    => sprintf('<a href="?page=%s&action=%s&uid=%s">Delete</a>',$_REQUEST['page'],'delete',$item['ID']),
        );
        
        //Return the title contents
        return sprintf('%1$s <span style="color:silver">%2$s</span>%3$s',
            /*$1%s*/ '',
            /*$2%s*/ $item['last_name'],
            /*$3%s*/ $this->row_actions($actions)
        );
    }

    function column_status($item){
        
        if($item['status']==1)        
            return "activo";
        else
            return "inactivo";
      
    }

    /** ************************************************************************
     * REQUIRED if displaying checkboxes or using bulk actions! The 'cb' column
     * is given special treatment when columns are processed. It ALWAYS needs to
     * have it's own method.
     * 
     * @see WP_List_Table::::single_row_columns()
     * @param array $item A singular item (one full row's worth of data)
     * @return string Text to be placed inside the column <td> (movie title only)
     **************************************************************************/
    function column_cb($item){
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            /*$1%s*/ $this->_args['singular'],  //Let's simply repurpose the table's singular label ("movie")
            /*$2%s*/ $item['ID']                //The value of the checkbox should be the record's id
        );
    }


    /** ************************************************************************
     * REQUIRED! This method dictates the table's columns and titles. This should
     * return an array where the key is the column slug (and class) and the value 
     * is the column's title text. If you need a checkbox for bulk actions, refer
     * to the $columns array below.
     * 
     * The 'cb' column is treated differently than the rest. If including a checkbox
     * column in your table you must create a column_cb() method. If you don't need
     * bulk actions or checkboxes, simply leave the 'cb' entry out of your array.
     * 
     * @see WP_List_Table::::single_row_columns()
     * @return array An associative array containing column information: 'slugs'=>'Visible Titles'
     **************************************************************************/
    function get_columns(){
        $columns = array(
            'cb'        => '<input type="checkbox" />', //Render a checkbox instead of text
            'last_name'    => 'Apellidos',
            'first_name'     => 'Nombre',
            'user_email'     => 'Correo',
            'code'     => 'DNI',
            'status'     => 'Estado'
        );
        return $columns;
    }


    /** ************************************************************************
     * Optional. If you want one or more columns to be sortable (ASC/DESC toggle), 
     * you will need to register it here. This should return an array where the 
     * key is the column that needs to be sortable, and the value is db column to 
     * sort by. Often, the key and value will be the same, but this is not always
     * the case (as the value is a column name from the database, not the list table).
     * 
     * This method merely defines which columns should be sortable and makes them
     * clickable - it does not handle the actual sorting. You still need to detect
     * the ORDERBY and ORDER querystring variables within prepare_items() and sort
     * your data accordingly (usually by modifying your query).
     * 
     * @return array An associative array containing all the columns that should be sortable: 'slugs'=>array('data_values',bool)
     **************************************************************************/
    function get_sortable_columns() {
        $sortable_columns = array(
            'first_name'     => array('n.meta_value',true),     //true means it's already sorted
            'last_name'    => array('m.meta_value',false),
            'user_email'    => array('u.user_email',false),
            'code'    => array('c.meta_value',false),
            'status'  => array('s.meta_value',false)
        );
        return $sortable_columns;
    }


    /** ************************************************************************
     * Optional. If you need to include bulk actions in your list table, this is
     * the place to define them. Bulk actions are an associative array in the format
     * 'slug'=>'Visible Title'
     * 
     * If this method returns an empty value, no bulk action will be rendered. If
     * you specify any bulk actions, the bulk actions box will be rendered with
     * the table automatically on display().
     * 
     * Also note that list tables are not automatically wrapped in <form> elements,
     * so you will need to create those manually in order for bulk actions to function.
     * 
     * @return array An associative array containing all the bulk actions: 'slugs'=>'Visible Titles'
     **************************************************************************/
    function get_bulk_actions() {
        $actions = array(
            'delete'    => 'Delete'
        );
        return $actions;
    }


    /** ************************************************************************
     * Optional. You can handle your bulk actions anywhere or anyhow you prefer.
     * For this example package, we will handle it in the class to keep things
     * clean and organized.
     * 
     * @see $this->prepare_items()
     **************************************************************************/
    function process_bulk_action() {
        
        //Detect when a bulk action is being triggered...
        if( 'delete'===$this->current_action() ) {
            wp_die('Items deleted (or they would be if we had items to delete)!');
        }
        
    }


    /** ************************************************************************
     * REQUIRED! This is where you prepare your data for display. This method will
     * usually be used to query the database, sort and filter the data, and generally
     * get it ready to be displayed. At a minimum, we should set $this->items and
     * $this->set_pagination_args(), although the following properties and methods
     * are frequently interacted with here...
     * 
     * @global WPDB $wpdb
     * @uses $this->_column_headers
     * @uses $this->items
     * @uses $this->get_columns()
     * @uses $this->get_sortable_columns()
     * @uses $this->get_pagenum()
     * @uses $this->set_pagination_args()
     **************************************************************************/
    function prepare_items() {
        global $wpdb; //This is used only if making any database queries

        /**
         * First, lets decide how many records per page to show
         */
        $per_page = 20;
        
        
        /**
         * REQUIRED. Now we need to define our column headers. This includes a complete
         * array of columns to be displayed (slugs & titles), a list of columns
         * to keep hidden, and a list of columns that are sortable. Each of these
         * can be defined in another method (as we've done here) before being
         * used to build the value for our _column_headers property.
         */
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        
        
        /**
         * REQUIRED. Finally, we build an array to be used by the class for column 
         * headers. The $this->_column_headers property takes an array which contains
         * 3 other arrays. One for all columns, one for hidden columns, and one
         * for sortable columns.
         */
        $this->_column_headers = array($columns, $hidden, $sortable);
        
        
        /**
         * Optional. You can handle your bulk actions however you see fit. In this
         * case, we'll handle them within our package just to keep things clean.
         */
        $this->process_bulk_action();
        
        
        /**
         * Instead of querying a database, we're going to fetch the example data
         * property we created for use in this plugin. This makes this example 
         * package slightly different than one you might build on your own. In 
         * this example, we'll be using array manipulation to sort and paginate 
         * our data. In a real-world implementation, you will probably want to 
         * use sort and pagination data to build a custom query instead, as you'll
         * be able to use your precisely-queried data immediately.
         */
        $data = $this->example_data;
                
        
        /**
         * This checks for sorting input and sorts the data in our array accordingly.
         * 
         * In a real-world situation involving a database, you would probably want 
         * to handle sorting by passing the 'orderby' and 'order' values directly 
         * to a custom query. The returned data will be pre-sorted, and this array
         * sorting technique would be unnecessary.
         */
        function usort_reorder($a,$b){
            $orderby = (!empty($_REQUEST['orderby'])) ? $_REQUEST['orderby'] : 'last_name'; //If no sort, default to title
            $order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'asc'; //If no order, default to asc
            $result = strcmp($a[$orderby], $b[$orderby]); //Determine sort order
            return ($order==='asc') ? $result : -$result; //Send final sort direction to usort
        }
        //usort($data, 'usort_reorder');
        
        
        /***********************************************************************
         * ---------------------------------------------------------------------
         * vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
         * 
         * In a real-world situation, this is where you would place your query.
         *
         * For information on making queries in WordPress, see this Codex entry:
         * http://codex.wordpress.org/Class_Reference/wpdb
         * 
         * ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
         * ---------------------------------------------------------------------
         **********************************************************************/
        
                
        /**
         * REQUIRED for pagination. Let's figure out what page the user is currently 
         * looking at. We'll need this later, so you should always include it in 
         * your own package classes.
         */
        $current_page = $this->get_pagenum();
        
        /**
         * REQUIRED for pagination. Let's check how many items are in our data array. 
         * In real-world use, this would be the total number of items in your database, 
         * without filtering. We'll need this later, so you should always include it 
         * in your own package classes.
         */
        $total_items = count($data);
        
        
        /**
         * The WP_List_Table class does not handle pagination for us, so we need
         * to ensure that the data is trimmed to only the current page. We can use
         * array_slice() to 
         */
        $data = array_slice($data,(($current_page-1)*$per_page),$per_page);
        
        
        
        /**
         * REQUIRED. Now we can add our *sorted* data to the items property, where 
         * it can be used by the rest of the class.
         */
        $this->items = $data;
        
        
        /**
         * REQUIRED. We also have to register our pagination options & calculations.
         */
        $this->set_pagination_args( array(
            'total_items' => $total_items,                  //WE have to calculate the total number of items
            'per_page'    => $per_page,                     //WE have to determine how many items to show on a page
            'total_pages' => ceil($total_items/$per_page)   //WE have to calculate the total number of pages
        ) );
    }


}





/** ************************ REGISTER THE TEST PAGE ****************************
 *******************************************************************************
 * Now we just need to define an admin page. For this example, we'll add a top-level
 * menu item to the bottom of the admin menus.
 */
function tt_add_menu_items(){
    
    add_menu_page('Usuarios', 'Usuarios', 'activate_plugins', 'tt_list_test', 'tt_render_list_page','dashicons-universal-access-alt');
} add_action('admin_menu', 'tt_add_menu_items');



function template_redirect(){

    if(isset($_POST["user_id"]) && isset($_POST["update"])){


        if(isset($_POST["habilitado"])){

            update_user_meta($_POST["user_id"], 'habilitado_'.$_POST["concurso_id"], 1);
            update_user_meta($_POST["user_id"], 'fecha_habilitado_'.$_POST["concurso_id"], date("Y-m-d H:i:s") );


        }else{

            delete_user_meta( $_POST["user_id"], 'habilitado_'.$_POST["concurso_id"], 1);
        }

        if(isset($_POST["anecdota_seleccionada"])){
            update_user_meta( $_POST["user_id"], 'anecdota_seleccionada_'.$_POST["concurso_id"], $_POST["anecdota_seleccionada"]);
        }else{

            delete_user_meta( $_POST["user_id"], 'anecdota_seleccionada_'.$_POST["concurso_id"]);


        }
     

        if(isset($_POST["anecdota1_valor"])){
            update_user_meta( $_POST["user_id"], 'anecdota1_valor_'.$_POST["concurso_id"], $_POST["anecdota1_valor"]);
        }

        if(isset($_POST["anecdota2_valor"])){
            update_user_meta( $_POST["user_id"], 'anecdota2_valor_'.$_POST["concurso_id"], $_POST["anecdota2_valor"]);
        }

        if(isset($_POST["anecdota3_valor"])){
            update_user_meta( $_POST["user_id"], 'anecdota3_valor_'.$_POST["concurso_id"], $_POST["anecdota3_valor"]);
        }

        wp_redirect( admin_url('admin.php'.'?action=edit&correo=1&participante='.$_POST["user_id"].'&page='.$_REQUEST["page"]."&con=".$_POST["concurso_id"]) );

    }
} add_action('wp_loaded', 'template_redirect');

   




/** *************************** RENDER TEST PAGE ********************************
 *******************************************************************************
 * This function renders the admin page and the example list table. Although it's
 * possible to call prepare_items() and display() from the constructor, there
 * are often times where you may need to include logic here between those steps,
 * so we've instead called those methods explicitly. It keeps things flexible, and
 * it's the way the list tables are used in the WordPress core.
 */
function tt_render_list_page(){
    

    $action = $_REQUEST["action"];


    ?> 

    <div class="wrap">

    <?php  
     
    if(empty($action)){

        //Create an instance of our package class...
        $testListTable = new Custom_Users_List_Table();
        //Fetch, prepare, sort, and filter our data...
        $testListTable->prepare_items();
 





    ?>       
        
        <div id="icon-users" class="icon32"><br/></div>
        <h2>Usuarios</h2>
        <form method="get">
        <input type="hidden" value="<?php echo $_REQUEST["page"] ?>" name="page" />
<?php 


            $args = array(
                        'post_type'  => 'page', 
                        'post_parent'  => 0, 
                        'posts_per_page' => -1,
                        'orderby' => 'meta_value', 
                        'meta_key' => 'año',
                        'order'=>'DESC',
                        'meta_query' => array(
                                   array(
                                    'key' => '_wp_page_template',
                                    'value' => 'concurso.php'
                                )
                        )
                );



   ?>  
        </form> 
        <!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->
        <form id="movies-filter" method="get">
            <!-- For plugins, we also need to ensure that the form posts back to our current page -->
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
            <!-- Now we can render the completed list table -->
    

            <?php $testListTable->display(); ?>
        </form>
        

    <?php

    }else if($action=="edit"){

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


    <?php

    }else if($action=="export"){

        $orderby="m.meta_value";
       $order="asc";

        if(isset($_REQUEST["orderby"])) $orderby=$_REQUEST["orderby"];
        if(isset($_REQUEST["order"])) $order=$_REQUEST["order"];

        $sql = "SELECT u.ID, u.user_email, m.meta_value AS last_name, n.meta_value AS first_name, 
            u.user_email, c.meta_value AS categoria_id, count(v.umeta_id) as validaciones, x.meta_value as habilitado, w.meta_value as documento_tipo, z.meta_value as documento_numero, y.meta_value as fecha_nacimiento, s.meta_value as sexo, tm.meta_value as telefono_movil, tc.meta_value as telefono_casa, to.meta_value as telefono_oficina,  t.meta_value as nacionalidad, 

            CASE 
            WHEN a.meta_value is not null THEN 'Deshabilitado'
            WHEN g.meta_value is not null THEN 'Ganador'
            WHEN b.meta_value is not null THEN 'Nominado'
            WHEN f.meta_value is not null THEN 'Finalista'
            WHEN h.meta_value is not null THEN 'Habilitado'
            ELSE 'inscrito'
            END as estado_nombre,

            CASE 
            WHEN a.meta_value is not null THEN 1
            ELSE 0
            END as ganador_absoluto,

            DATE_FORMAT(i.meta_value,'%Y-%m-%d') as fecha_inscripcion, 
            DATE_FORMAT(h.meta_value,'%Y-%m-%d') as fecha_habilitado, 
            DATE_FORMAT(f.meta_value,'%Y-%m-%d') as fecha_finalista, 
            DATE_FORMAT(b.meta_value,'%Y-%m-%d') as fecha_nominado, 
            DATE_FORMAT(g.meta_value,'%Y-%m-%d') as fecha_ganador, 
            DATE_FORMAT(a.meta_value,'%Y-%m-%d') as fecha_deshabilitado
            FROM wp_users u
            LEFT OUTER JOIN wp_usermeta v ON(v.user_id=u.ID AND v.meta_key='referencia_ok') 
            LEFT OUTER JOIN wp_usermeta m ON(m.user_id=u.ID AND m.meta_key='last_name_$this->concurso_id') 
            LEFT OUTER JOIN wp_usermeta n ON(n.user_id=u.ID AND n.meta_key='first_name_$this->concurso_id')
            LEFT OUTER JOIN wp_usermeta w ON(w.user_id=u.ID AND w.meta_key='documento_tipo_$this->concurso_id')
            LEFT OUTER JOIN wp_usermeta z ON(z.user_id=u.ID AND z.meta_key='documento_numero_$this->concurso_id')
            LEFT OUTER JOIN wp_usermeta y ON(y.user_id=u.ID AND y.meta_key='fecha_nacimiento_$this->concurso_id')
            LEFT OUTER JOIN wp_usermeta s ON(s.user_id=u.ID AND s.meta_key='sexo_$this->concurso_id')
            LEFT OUTER JOIN wp_usermeta tm ON(tm.user_id=u.ID AND tm.meta_key='telefono_movil_$this->concurso_id')
            LEFT OUTER JOIN wp_usermeta tc ON(tc.user_id=u.ID AND tc.meta_key='telefono_casa_$this->concurso_id')
            LEFT OUTER JOIN wp_usermeta to ON(to.user_id=u.ID AND to.meta_key='telefono_oficina_$this->concurso_id')
            LEFT OUTER JOIN wp_usermeta t ON(t.user_id=u.ID AND t.meta_key='nacionalidad_$this->concurso_id')
            LEFT OUTER JOIN wp_usermeta x ON(x.user_id=u.ID AND x.meta_key='habilitado_$this->concurso_id') 
            INNER JOIN wp_usermeta o ON(o.user_id=u.ID AND o.meta_key='concurso_id')
            INNER JOIN wp_usermeta c ON(c.user_id=u.ID AND c.meta_key='categoria_id_".$this->concurso_id."')
            LEFT OUTER JOIN wp_usermeta e ON(e.user_id=u.ID AND e.meta_key='estado_".$this->concurso_id."')
            LEFT OUTER JOIN wp_usermeta i ON(i.user_id=u.ID AND i.meta_key='fecha_inscripcion_".$this->concurso_id."')
            LEFT OUTER JOIN wp_usermeta h ON(h.user_id=u.ID AND h.meta_key='fecha_habilitado_".$this->concurso_id."')
            LEFT OUTER JOIN wp_usermeta d ON(d.user_id=u.ID AND d.meta_key='fecha_deshabilitado_".$this->concurso_id."')
            LEFT OUTER JOIN wp_usermeta f ON(f.user_id=u.ID AND f.meta_key='fecha_finalista_".$this->concurso_id."')
            LEFT OUTER JOIN wp_usermeta b ON(b.user_id=u.ID AND b.meta_key='fecha_nominado_".$this->concurso_id."')
            LEFT OUTER JOIN wp_usermeta g ON(g.user_id=u.ID AND g.meta_key='fecha_ganador_".$this->concurso_id."')
            LEFT OUTER JOIN wp_usermeta a ON(a.user_id=u.ID AND a.meta_key='fecha_ganador_absoluto_".$this->concurso_id."')";

        $sql .= " where o.meta_value=".$this->concurso_id;
     



        if($this->categoria_id != ""){

            $sql .= " and c.meta_value=".$this->categoria_id;

        }


        $sql .= " group by u.ID, m.meta_value, n.meta_value, 
            u.user_email, c.meta_value, a.meta_value, g.meta_value, b.meta_value, f.meta_value, h.meta_value, i.meta_value, h.meta_value, f.meta_value, b.meta_value, g.meta_value, a.meta_value";

        if($orderby != "" && $order!=""){

            $sql .= " order by ".$orderby." ".$order;

        }

        $usrs = $wpdb->get_results($sql);

        $filename = "reporte_".date("Y-m-d-H-i") ;
        $file_ending = "xls";
        header("Content-Type: application/xls; charset=utf-8");    
        header("Content-Disposition: attachment; filename=$filename.xls");  
        header("Pragma: no-cache"); 
        header("Expires: 0");
      //define separator (defines columns in excel & tabs in word)
        $sep = "\t"; //tabbed character
        //start of printing column names as names of MySQL fields
        echo "Nombre".$sep;
        echo "Apellidos".$sep;
        echo "Tipo de Documento".$sep;
        echo "Número de Documento".$sep;
        echo "Fecha de Nacimiento".$sep;
        echo "Sexo";
        echo "\n";    


        foreach ( $usrs as $u ) {


            echo $u->first_name.$sep;
            echo $u->last_name.$sep;
            echo $u->documento_tipo.$sep;
            echo $u->documento_numero.$sep;
            echo $u->fecha_nacimiento.$sep;
            echo $u->sexo;
            echo "\n";   
          
        }

/*

   $filename = "excelfilename";    

    $file_ending = "xls";
    //header info for browser
    header("Content-Type: application/xls; charset=utf-8");    
    header("Content-Disposition: attachment; filename=$filename.xls");  
    header("Pragma: no-cache"); 
    header("Expires: 0");

 
    //define separator (defines columns in excel & tabs in word)
    $sep = "\t"; //tabbed character
    //start of printing column names as names of MySQL fields
    echo utf8_decode("Nombre").$sep;
    echo "Apellidos".$sep;
    echo "Correo".$sep;
    echo "Curriculum Vitae".$sep;
    echo "Tipo de Documento".$sep;
    echo "Documento".$sep;
    echo utf8_decode("Teléfono Fijo").$sep;
    echo utf8_decode("Teléfono Celular").$sep;
    echo "Registrado".$sep;
    echo utf8_decode("País");
    echo "\n";    



    $list = JobApplicant::getList($_SESSION["langID"]);


    foreach ($list as $o) {
    
        echo utf8_decode($o->applicantName).$sep;
        echo utf8_decode($o->applicantLastName).$sep;
        echo utf8_decode($o->applicantEmail).$sep;
        echo utf8_decode($URL_ROOT."cvs/".$o->applicantFile).$sep;
        echo utf8_decode($o->applicantDocumentType).$sep;
        echo utf8_decode($o->applicantDocumentID).$sep;
        echo utf8_decode($o->applicantPhone).$sep;
        echo utf8_decode($o->applicantPhoneMobile).$sep;
        echo utf8_decode($o->register).$sep;
        echo utf8_decode($o->langName);

        echo "\n";


    }
*/

    }
    ?>

    </div>
    <?php
}


function tt_render_form_page(){



}