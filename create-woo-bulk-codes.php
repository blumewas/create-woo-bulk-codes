<?php
/**
 * Plugin Name:       Create Woo Bulk Codes
 * Plugin URI:        https://github.com/blumewas/create-woo-bulk-codes
 * Description:       Simple WordPress Plugin with Composer and Autoload
 * Version:           0.1
 * Requires at least: 5.7
 * Author:            Andreasschneider
 */

if ( ! defined( 'ABSPATH' ) ) {
    die( '' );
}

require "vendor/autoload.php";

use Andreasschneider\CreateWooBulkCodes\CreateBulkCodes;

$header = new CreateBulkCodes();
// $creator = $header->getCreatorName();
