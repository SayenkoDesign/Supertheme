<?php
use Timber\Timber;
use Timber\Image;

/** @var $container \Symfony\Component\DependencyInjection\Container */
Timber::$locations = $container->getParameterBag()->resolveValue($container->getParameter('twig.paths'));

// global timber context
add_filter('timber_context', function($data) {
    // logos
    $data['favicon'] = new Image(get_field('favicon', 'option') ?: get_field('mobile_logo', 'option')['ID']);
    $data['mobile_logo'] = new Image(get_field('mobile_logo', 'option') ?: get_field('logo', 'option')['ID']);
    $data['alt_logo'] = new Image(get_field('alt_logo', 'option') ?: get_field('logo', 'option')['ID']);
    $data['logo'] = new Image(get_field('logo', 'option')['ID']);
    // sharethis
    $data['sharethis'] = get_field('sharethis_key', 'option');
    // checkers
    $data['is_ssl'] = is_ssl();
    // copyright
    $data['copyright'] = get_field('copyright', 'option');

    return $data;
});