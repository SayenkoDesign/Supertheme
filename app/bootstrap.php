<?php
$vendor =  __DIR__.'/../vendor/autoload.php';

if(!file_exists($vendor)) {
    trigger_error("You must run composer install in the command line to install PHP dependencies");
}

require_once $vendor;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;

if(!class_exists('\Timber\Timber')) {
    trigger_error("Timber composer library or wordpress plugin is required for this theme.");
}

$container = new ContainerBuilder();
$container->setParameter('template_dir', get_template_directory());
$container->setParameter('template_uri', get_template_directory_uri());
$container->setParameter('WP_DEBUG', WP_DEBUG);

$loader = new YamlFileLoader($container, new FileLocator(get_template_directory()));
$loader->load('app/config/config.yml');
