<?php
require_once __DIR__.'/app/bootstrap.php';
require_once __DIR__.'/src/functions.php';

add_filter('timber/context', function($data){
    // logos
    $data['menu'] = new Timber\Menu('primary_menu');

    return $data;
});