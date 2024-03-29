<?php

namespace Andreasschneider\CreateWooBulkCodes\Actions;

if (! defined('ABSPATH')) {
    exit('');
}

class CreateCouponCode
{
    public function __invoke(
        string $email,
        int $amount,
        array $categories = []
    ): null|\WC_Coupon {

        if ($this->checkIfCouponExists($email)) {
            return null;
        }

        return $this->createCouponCode($email, $amount, $categories);
    }

    private function createCouponCode(string $email, int $amount, array $categories = []): \WC_Coupon
    {
        $coupon = new \WC_Coupon();

        $coupon->set_code(md5($email));

        $coupon->set_discount_type('fixed_cart');

        $coupon->set_amount($amount);
        $coupon->set_description('Code generated for '.$email);

        // categories
        if (! empty($categories)) {
            $coupon->set_excluded_product_categories($categories);
        }

        // set to one since we want to limit code usage to one per customer
        $coupon->set_usage_limit(1);

        $coupon->save();

        return $coupon;
    }

    private function checkIfCouponExists(string $email): bool
    {
        return (bool) \wc_get_coupon_id_by_code(md5($email));
    }

}
