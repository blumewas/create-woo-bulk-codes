<?php

namespace Andreasschneider\CreateWooBulkCodes;

if (! defined('ABSPATH')) {
    exit('');
}

class CreateBulkCodes
{
    public function __construct()
    {
        add_action('admin_init', [$this, 'addActions']);

        $createCouponsView = new Admin\CreateCouponsView();
    }

    public function addActions()
    {
        $adminAjax = new Admin\AdminAjax();

        add_action('wp_ajax_create_bulk_codes', [$adminAjax, 'generateCodes']);
    }
}
