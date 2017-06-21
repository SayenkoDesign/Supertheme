<?php
add_action('after_setup_theme', function() use($container) {
    // load languages directory
    if ($container->hasParameter('wordpress.translations')) {
        load_theme_textdomain('supertheme', $container->getParameter('wordpress.translations'));
    }
});