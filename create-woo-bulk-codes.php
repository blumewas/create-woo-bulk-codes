<?php
/**
 * Plugin Name:       Create Woo Bulk Codes
 * Plugin URI:        https://github.com/blumewas/create-woo-bulk-codes
 * Description:       Simple WordPress Plugin with Composer and Autoload
 * Version:           0.1
 * Requires at least: 5.7
 * Author:            Andreasschneider
 */
if (! defined('ABSPATH')) {
    exit('');
}

require 'vendor/autoload.php';

define('CREATE_WOO_BULK_CODES_PATH', plugin_dir_path(__FILE__));
define('CREATE_WOO_BULK_CODES_URL', plugins_url('', __FILE__));

use Andreasschneider\CreateWooBulkCodes\CreateBulkCodes;

$header = new CreateBulkCodes();
