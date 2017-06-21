<?php
use Timber\Timber;

add_action('wp_dashboard_setup', function () {
    wp_add_dashboard_widget(
        'referral_dashboard_widget',
        'RECEIVE $500 in CASH FOR A WEBSITE REFERRAL!!',
        function () {
            Timber::render('admin/referral.html.twig');
        }
    );
});