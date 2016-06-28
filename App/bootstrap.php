<?php
require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;

$container = new ContainerBuilder();
$container->setParameter('template_dir', get_template_directory());
$container->setParameter('template_uri', get_template_directory_uri());
$container->setParameter('WP_DEBUG', WP_DEBUG);

$loader = new YamlFileLoader($container, new FileLocator(get_template_directory()));
$loader->load('app/config/config.yml');
