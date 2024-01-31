<?php

namespace Andreasschneider\CreateWooBulkCodes;



if ( ! defined( 'ABSPATH' ) ) {
    die( '' );
}

class CreateBulkCodes
{
    public function __construct(){
        add_action('admin_menu', [$this, 'registerMenuPage']);

        add_action('admin_init', [$this, 'addActions']);

        add_action('admin_enqueue_scripts', [$this, 'cstm_css_and_js']);
    }


    function cstm_css_and_js($hook) {
        if ( 'toplevel_page_create-bulk-codes' != $hook ) {
            return;
        }

        wp_enqueue_style('boot_css', plugins_url('../resources/css/admin.css',__FILE__ ));
        wp_enqueue_script('boot_js', plugins_url('../resources/js/admin.js',__FILE__ ));

        wp_localize_script( 'boot_js', 'wp_vars', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce( 'create_bulk_codes_nonce' )
        )
    );
    }

    public function addActions() {
        $adminAjax = new Admin\AdminAjax();

        add_action('wp_ajax_create_bulk_codes', [$adminAjax, 'generateCodes']);
    }

    public function renderMenuPage() {
        require_once __DIR__ . '/../resources/views/admin-page.php';
    }

    public function registerMenuPage() {
        add_menu_page(
            'Create Bulk Codes',
            'Create Bulk Codes',
            'manage_options',
            'create-bulk-codes',
            [$this, 'renderMenuPage'],
            'dashicons-admin-generic',
            6
        );
    }
}
