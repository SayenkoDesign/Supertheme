<?php
use Timber\Timber;

add_action('wp_head', function () {
    if(function_exists('acf_add_options_page') && $googleID = get_field('google_analytics_id', 'option')) {
        Timber::render('admin/google.html.twig', [
            'id' => $googleID,
        ]);
    }
});