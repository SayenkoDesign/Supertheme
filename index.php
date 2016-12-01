<?php
require_once __DIR__.'/app/bootstrap.php';
use Timber\Timber;

/** @var $timber Timber */
$timber = $container->get('timber');
$context = Timber::get_context();
$context['posts'] = Timber::get_posts();
$templates = ['archive.html.twig', 'index.html.twig'];
if ( is_home() ) {
    array_unshift($templates, 'home.html.twig');
}
$timber::render($templates, $context);
