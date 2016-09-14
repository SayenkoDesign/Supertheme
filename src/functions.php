<?php
require_once __DIR__.'/../app/bootstrap.php';

/** @var $container \Symfony\Component\DependencyInjection\Container */
/** @var $twig \Twig_Environment */
$twig = $container->get('twig.environment');

/***********************************************************************************************************************
 * Actions
 **********************************************************************************************************************/

// register scripts/styles
add_action('wp_enqueue_scripts', function() use($container) {
    // styles
    if($container->hasParameter('wordpress.styles')) {
        foreach ($container->getParameter('wordpress.styles') as $args) {
            wp_register_style($args['id'], $container->getParameterBag()->resolveValue($args['source']), $args['deps'], false, 'all');
            wp_enqueue_style($args['id']);
        }
    }

    // config
    if($container->hasParameter('wordpress.scripts')) {
        foreach ($container->getParameter('wordpress.scripts') as $args) {
            wp_register_script($args['id'], $container->getParameterBag()->resolveValue($args['source']), $args['deps'], false, $args['header']);
            wp_enqueue_script($args['id']);
        }
    }
});

add_action('init', function () use($container) {
    // always start a session
    if (!session_id()) {
        session_start();
    }

    // post types
    if($container->hasParameter('wordpress.post_types')) {
        foreach ($container->getParameter('wordpress.post_types', []) as $post_type => $args) {
            register_post_type($post_type, $args);
        }
    }

    // options page
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page([
            'page_title' => 'Theme Options',
            'capability' => 'edit_theme_options',
            'icon_url' => 'dashicons-sayenko',
            'position' => 59,
        ]);
    }
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
    // load languages directory
    if($container->hasParameter('wordpress.translations')) {
        load_theme_textdomain('supertheme', $container->getParameter('wordpress.translations'));
    }

    // image sizes from config
    if($container->hasParameter('wordpress.image_sizes')) {
        foreach ($container->getParameter('wordpress.image_sizes') as $name => $imageSize) {
            array_unshift($imageSize, $name);
            call_user_func_array('add_image_size', $imageSize);
        }
    }

    // theme supports
    if($container->hasParameter('wordpress.theme_support')) {
        add_theme_support( 'admin-bar', array( 'callback' => '__return_false') );
        foreach ($container->getParameter('wordpress.theme_support') as $support) {
            add_theme_support($support);
        }
    }

    // theme sidebars
    if($container->hasParameter('wordpress.sidebars')) {
        foreach ($container->getParameter('wordpress.sidebars') as $sidebar) {
            register_sidebar($sidebar);
        }
    }

    // menus from config
    if($container->hasParameter('wordpress.menus')) {
        register_nav_menus($container->getParameter('wordpress.menus'));
    }
});

add_action('admin_menu', function () use($twig) {
    // twig cache link
    if(!$twig->getCache()) {
        return;
    }
    add_menu_page(
        'Rebuild Templates',     // page title
        'Rebuild Templates',     // menu title
        'manage_options',   // capability
        'rebuild-templates',     // menu slug
        function() use($twig) {
            global $title;
            if ($cache = $twig->getCache()) {
                foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($cache), RecursiveIteratorIterator::LEAVES_ONLY) as $file) {
                    if ($file->isFile()) {
                        @unlink($file->getPathname());
                    }
                }
                $success = true;
            } else {
                $success = false;
            }
            echo $twig->render('admin/rebuild-templates.html.twig', [
                'title' => $title,
                'success' => $success,
            ]);
        },
        'dashicons-no-alt',
        75
    );
});

add_action('wp_head', function () use($twig) {
    if(function_exists('acf_add_options_page') && $googleID = get_field('google_analytics_id', 'option')) {
        echo $twig->render('admin/google.html.twig', [
            'id' => $googleID,
        ]);
    }
});

/***********************************************************************************************************************
 * Filters
 **********************************************************************************************************************/

// save acf as json
add_filter('acf/settings/save_json', function ($path) use($container) {
    return $container->getParameterBag()->resolveValue($container->getParameter('wordpress.acf_path'));
});

// show acf menus
add_filter('acf/settings/show_admin', function ($show) use($container){
    return $container->getParameter('wordpress.acf_menu');
});



add_action('get_header', 'my_filter_head');

function my_filter_head() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}