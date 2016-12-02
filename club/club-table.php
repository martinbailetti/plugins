 <?php 
        //Create an instance of our package class...
        $testListTable = new Club_List_Table();
        //Fetch, prepare, sort, and filter our data...
        $testListTable->prepare_items();
 
    ?>       
        
        <div id="icon-users" class="icon32"><br/></div>
        <h2>Socios <a href="<?php echo admin_url('admin.php'.'?page=club_page&action=add') ?>" class="page-title-action">Añadir nuevo</a></h2>
<?php if(isset($_REQUEST["n"]) && $_REQUEST["n"]==3){ ?>
        <div id="message" class="updated notice is-dismissible"><p><?php $_REQUEST["q"] ?> socios han sido eliminados.</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Descartar este aviso.</span></button></div>
<?php } ?>

        <!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->
        <form id="movies-filter" method="get" action="<?php echo admin_url('admin.php') ?>">
  
            <!-- For plugins, we also need to ensure that the form posts back to our current page -->
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />

            <?php $testListTable->display(); ?>
        </form>
        