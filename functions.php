<?php
require_once __DIR__.'/app/bootstrap.php';

add_filter('timber/context', function($data){
    // logos
    $data['menu'] = new Timber\Menu('primary_menu');

    return $data;
});

add_action('wp_enqueue_scripts', function(){
    $SP = [];
    $SP['settings'] = [
        "analyticsID" => get_field("google_analytics_id", "option"),
        "universalAnalytics" => true,
    ];
    wp_localize_script( 'app', 'SP', $SP);
});