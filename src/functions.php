<?php
require_once __DIR__.'/../App/bootstrap.php';

/** @var $container \Symfony\Component\DependencyInjection\Container */
/** @var $twig \Twig_Environment */
$twig = $container->get('twig.environment');

// register scripts/styles
add_action('wp_enqueue_scripts', function() use($container) {
    foreach($container->getParameter('wordpress.styles', []) as $args) {
        wp_register_style($args['id'], $container->getParameterBag()->resolveValue($args['source']), $args['deps'], false, 'all');
        wp_enqueue_style($args['id']);
    }

    foreach($container->getParameter('wordpress.scripts', []) as $args) {
        wp_register_script($args['id'], $container->getParameterBag()->resolveValue($args['source']), $args['deps'], false, $args['header']);
        wp_enqueue_script($args['id']);
    }
});

// always start a session
add_action('init', function () use($container) {
    if (!session_id()) {
        session_start();
    }

    if($container->hasParameter('wordpress.post_types')) {
        foreach ($container->getParameter('wordpress.post_types', []) as $post_type => $args) {
            register_post_type($post_type, $args);
        }
    }
});

// load languages directory
add_action('plugins_loaded', function () {
    load_plugin_textdomain('supertheme', false, get_template_directory().'/languages');
});

// logo for ACF options page
add_action('admin_head', function () use ($twig){
    echo $twig->render('admin/dashicons.html.twig');
});

// login logo
add_action('login_head', function () use($twig) {
    echo $twig->render('admin/login.html.twig');
});

// referral widget
add_action('wp_dashboard_setup', function () use($twig) {
    wp_add_dashboard_widget(
        'referral_dashboard_widget',
        'RECEIVE $500 in CASH FOR A WEBSITE REFERRAL!!',
        function () use($twig) {
            echo $twig->render('admin/referral.html.twig');
        }
    );
});

add_action('after_setup_theme', function() use($container) {
    // image sizes from config
    foreach ($container->getParameter('wordpress.image_sizes', []) as $imageSize) {
        call_user_func_array('add_image_size', $imageSize);
    }

    // theme suppoer
    foreach ($container->getParameter('wordpress.theme_support', []) as $support) {
        add_theme_support($support);
    }

    // theme suppoer
    foreach ($container->getParameter('wordpress.sidebars', []) as $sidebar) {
        register_sidebar($sidebar);
    }

    // menus from config
    register_nav_menus($container->getParameter('wordpress.menus', []));
});