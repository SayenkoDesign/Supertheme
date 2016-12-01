<?php
require_once __DIR__.'/../app/bootstrap.php';
use Timber\Timber;

/** @var $container \Symfony\Component\DependencyInjection\Container */
Timber::$locations = $container->getParameterBag()->resolveValue($container->getParameter('twig.paths'));

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
            wp_register_script($args['id'], $container->getParameterBag()->resolveValue($args['source']), $args['deps'], false, !$args['header']);
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

    // replace jquery
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js', false, '2.2.4');
        wp_enqueue_script('jquery');
    }
});

add_action('get_header', function() {
    remove_action('wp_head', '_admin_bar_bump_cb');
});


// logo for ACF options page
add_action('admin_head', function () {
    Timber::render('admin/dashicons.html.twig', [
        'icon' => get_template_directory_uri()."/src/web/images/options-icon.png"
    ]);
});

// login logo
add_action('login_head', function ()  {
    if (function_exists('acf_add_options_page') && $login_image = get_field('logo', 'option')) {
        Timber::render('admin/login.html.twig', ['logo' => $login_image]);
    }
});

// referral widget
add_action('wp_dashboard_setup', function () {
    wp_add_dashboard_widget(
        'referral_dashboard_widget',
        'RECEIVE $500 in CASH FOR A WEBSITE REFERRAL!!',
        function () {
            Timber::render('admin/referral.html.twig');
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

add_action('wp_head', function () {
    if(function_exists('acf_add_options_page') && $googleID = get_field('google_analytics_id', 'option')) {
        Timber::render('admin/google.html.twig', [
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
add_filter('acf/settings/show_admin', function ($show) use($container) {
    return $container->getParameter('wordpress.acf_menu');
});

// global timber context
add_filter('timber/context', function($data) {
    // logos
    $data['favicon'] = get_field('favicon', 'option') ?: get_field('mobile_logo', 'option');
    $data['mobile_logo'] = get_field('mobile_logo', 'option') ?: get_field('logo', 'option');
    $data['alt_logo'] = get_field('alt_logo', 'option') ?: get_field('logo', 'option');
    $data['logo'] = get_field('logo', 'option');
    // sharethis
    $data['sharethis'] = get_field('sharethis_key', 'option');
    // checkers
    $data['is_ssl'] = is_ssl();

    return $data;
});

// move yoast down
add_filter('wpseo_metabox_prio', function() {
    return 'low';
});

/***********************************************************************************************************************
 * ACF
 **********************************************************************************************************************/
if(function_exists('acf_add_local_field_group')){
    $parser = new \Symfony\Component\Yaml\Parser();
    $fields = $parser->parse(file_get_contents(__DIR__.'/../app/config/theme_options.yml'));
    acf_add_local_field_group($fields);
}
