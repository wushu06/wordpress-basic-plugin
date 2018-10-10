<?php 

namespace Inc\Base; 

use Inc\Base\BaseController;

class Enqueue extends BaseController {

    function register () {

        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
    }

    function enqueue ($hook) {
	    if($hook != 'toplevel_page_hmu_plugin' && $hook != 'hook-me-up_page_import_prices' && $hook != 'hook-me-up_page_cron_task') {
		    return;
	    }

    }

}