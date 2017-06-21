<?php
add_action('after_setup_theme', function() use($container) {
    // menus from config
    if($container->hasParameter('wordpress.menus')) {
        register_nav_menus($container->getParameter('wordpress.menus'));
    }
});
