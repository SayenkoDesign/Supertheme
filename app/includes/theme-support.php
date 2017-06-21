<?php
add_action('after_setup_theme', function() use($container) {
    // theme supports
    if ($container->hasParameter('wordpress.theme_support')) {
        add_theme_support('admin-bar', array('callback' => '__return_false'));
        foreach ($container->getParameter('wordpress.theme_support') as $support) {
            add_theme_support($support);
        }
    }
});