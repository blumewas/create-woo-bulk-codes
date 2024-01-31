<?php

namespace Andreasschneider\CreateWooBulkCodes\Admin;

use Andreasschneider\CreateWooBulkCodes\Actions\CreateCouponCode;

if ( ! defined( 'ABSPATH' ) ) {
    die( '' );
}

class AdminAjax
{
    public function generateCodes() {
        if( isset( $_POST['nonce'] ) && wp_verify_nonce( $_POST['nonce'], 'create_bulk_codes_nonce') ) {

            $emails = explode("\n", $_POST['emails'] ?? '');
            $amount = intval($_POST['amount'] ?? 0, 10);
            $title = $_POST['title'] ?? '';
            $category = $_POST['product_category'] ?? '';

            $errors = [];
            if ( empty(trim($_POST['emails'] ?? '')) ) {
                $errors[] = __('Please enter at least one email address');
            }

            if ( empty($title) ) {
                $errors[] = __('Please enter a title');
            }

            if ( empty($amount) ) {
                $errors[] = __('Please enter an amount');
            }

            if ( empty($category) ) {
                $errors[] = __('Please select a category');
            }

            if ( ! empty($errors) ) {
                wp_send_json([
                    'message' => __('Please fix the following errors'),
                    'errors' => $errors,
                ], 400);
                exit;
            }

            $coupons = [];

            foreach ($emails as $email) {
                $email = trim($email);

                if ( ! empty( $email ) ) {
                    $coupon = (new CreateCouponCode)($email, $amount, [$category]);

                    $coupons[$email] = $coupon->get_code()  ;

                    // TODO send email
                    wp_mail(
                        $email,
                        "Dein Persönlicher Gutscheincode für $title",
                        'Dein Persönlicher Gutscheincode lautet: ' . $coupon->get_code()
                    );
                }
            }

            wp_send_json([
                'message' => __('Codes created successfully'),
                'coupons' => $coupons,
            ]);
            exit;
        } else {
            wp_send_json_error([
                'message' => __('Invalid nonce'),
            ], 403);
            exit;
        }
    }
}
