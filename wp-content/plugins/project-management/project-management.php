<?php

/*
Plugin Name: Manage Project
Description: Plugin project management for manage member, task,...
Version: 1.0.0
Author: PLe
Author URI: fb.com/phamle21
License: Giấy phép sử dụng của plugin (ví dụ: GPL2)
*/

if (!defined('PROJECT_MANAGEMENT_PATH')) {
    define('PROJECT_MANAGEMENT_PATH', plugin_dir_path(__FILE__));
}
if (!defined('PROJECT_MANAGEMENT_URL')) {
    define('PROJECT_MANAGEMENT_URL', plugin_dir_url(__FILE__));
}

require_once(PROJECT_MANAGEMENT_PATH . 'features/class-project-management-create.php');

// CreateProJectManagement
new CreateProJectManagement();