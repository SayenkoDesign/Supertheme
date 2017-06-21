<?php
$vendor =  __DIR__.'/../../vendor/autoload.php';

if(!file_exists($vendor)) {
    trigger_error("Cant locate composer autoload file. Did you run composer install?");
}

require_once $vendor;

if(!class_exists('\Timber\Timber')) {
    trigger_error("Timber is required for this theme. It can be installed with their plugin or composer.");
}

if(!function_exists('acf_add_options_page')) {
    trigger_error("ACF plugin is required for this theme.");
}