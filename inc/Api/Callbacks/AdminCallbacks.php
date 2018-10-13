<?php 

namespace Inc\Api\Callbacks; 

use \Inc\Base\BaseController;

use \Inc\Api\SettingsApi;


class AdminCallbacks extends BaseController {

    function hmu_plugin () {
        
        require_once( $this->plugin_path."/template/dashboard.php" );
        
    
    }



}