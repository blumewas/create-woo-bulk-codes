<?php

namespace Andreasschneider\CreateWooBulkCodes\Admin;

class CreateCouponsView
{
    public function __construct()
    {
        add_action('admin_enqueue_scripts', [$this, 'registerViewAssets']);

        add_action('admin_menu', [$this, 'register']);
    }

    public function registerViewAssets($hook)
    {
        if ($hook != 'marketing_page_create_bulk_codes') {
            return;
        }

        wp_enqueue_style('boot_css', CREATE_WOO_BULK_CODES_URL.'/resources/css/admin.css');
        wp_enqueue_script('boot_js', CREATE_WOO_BULK_CODES_URL.'/resources/js/admin.js');

        wp_localize_script('boot_js', 'wp_vars', [
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('create_bulk_codes_nonce'),
        ]);
    }

    public function register()
    {
        add_submenu_page(
            'woocommerce-marketing',
            'Create Bulk Codes',
            'Create Bulk Codes',
            'manage_woocommerce',
            'create_bulk_codes',
            [$this, 'renderView'],
            6
        );

    }

    public function renderView()
    {
        require_once CREATE_WOO_BULK_CODES_PATH.'/resources/views/admin-page.php';
    }
}
