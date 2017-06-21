<?php
use Timber\Timber;

/** @var $container \Symfony\Component\DependencyInjection\Container */
Timber::$locations = $container->getParameterBag()->resolveValue($container->getParameter('twig.paths'));

// global timber context
add_filter('timber_context', function($data) {
    // logos
    $data['favicon'] = get_field('favicon', 'option') ?: get_field('mobile_logo', 'option');
    $data['mobile_logo'] = get_field('mobile_logo', 'option') ?: get_field('logo', 'option');
    $data['alt_logo'] = get_field('alt_logo', 'option') ?: get_field('logo', 'option');
    $data['logo'] = get_field('logo', 'option');
    // sharethis
    $data['sharethis'] = get_field('sharethis_key', 'option');
    // checkers
    $data['is_ssl'] = is_ssl();
    // copyright
    $data['copyright'] = get_field('copyright', 'option');

    return $data;
});