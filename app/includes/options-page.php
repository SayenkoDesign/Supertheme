<?php
add_action('init', function () use($container) {
    // options page
    if (function_exists('acf_add_options_page')) {
        acf_add_options_sub_page([
            'parent_slug' => 'options-general.php',
            'page_title' => 'Theme',
            'capability' => 'edit_theme_options',
        ]);
    }
});
