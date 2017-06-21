<?php
add_action('init', function () use($container) {
    // replace jquery
    if (!is_admin() && !in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'))) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', get_stylesheet_directory_uri().'/web/libs/jquery/dist/jquery.min.js', false, false);
        wp_enqueue_script('jquery');
    }
});