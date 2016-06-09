<?php
require_once __DIR__.'/App/bootstrap.php';

$themeSettingsPage = new \Supertheme\WordPress\ThemeSettingsPage(
    $container->get('form'),
    $container->get('twig.environment')
);
$themeSettingsPage->register();

add_filter('wp_headers', function ($headers) {
    return $headers;
});

add_action('init', function () {
    if (!session_id()) {
        session_start();
    }
});

add_action('plugins_loaded', function () {
    load_plugin_textdomain('supertheme', false, get_template_directory().'/languages');
});

// logo for ACF options page
add_action('admin_head', function () {
    $rootURI = get_template_directory_uri();
    echo <<<HTML
    <style type="text/css">
        .dashicons-sayenko {
            background-image: url('$rootURI/options-icon.png');
            background-size: 18px;
            background-position: 10px center;
            background-repeat: no-repeat;
        }
    </style>
HTML;
});

// login logo
add_action('login_head', function () {
    $rootURI = get_template_directory_uri();
    echo <<<HTML
    <style type="text/css">
        h1 a {
            background-image: url('$rootURI/logo.png') !important;
            background-size: contain !important;
            width: 320px !important;
            height: 120px !important;
       }
    </style>
HTML;
});


// referral widget
add_action('wp_dashboard_setup', function () {
    wp_add_dashboard_widget(
        'referral_dashboard_widget',
        'RECEIVE $500 in CASH FOR A WEBSITE REFERRAL!!',
        function () {
            echo <<<HTML
                <a href='http://www.sayenkodesign.com'>
                    <img alt='Seattle Web Design' src='http://www.sayenkodesign.com/wp-content/uploads/2014/08/Sayenko-Design-WP-Referral-Bonus-460.jpg' width='100%'>
                </a>
                </br>
                </br>
                Simply introduce us via email along with the prospects phone number.
                Email introductions can be sent to
                <a href='mailto:mike@sayenkodesign.com'>mike@sayenkodesign.com</a>
HTML;
        }
    );
});
