<?php
if (! defined('ABSPATH')) exit;  // if direct access


function job_bm_payment_methods()
{

    $methods = array();

    $methods['paypal'] = 'PayPal';
    $methods['2checkout'] = '2Checkout';
    $methods['stripe'] = 'Stripe';

    return apply_filters('job_bm_payment_methods', $methods);
}
