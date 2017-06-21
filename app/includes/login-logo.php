<?php
use Timber\Timber;

add_action('login_head', function ()  {
    if (function_exists('acf_add_options_page') && $login_image = get_field('logo', 'option')) {
        Timber::render('admin/login.html.twig', ['logo' => $login_image]);
    }
});
