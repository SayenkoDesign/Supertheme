<?php
require_once __DIR__.'/app/bootstrap.php';
use Timber\Timber;

/** @var $timber Timber */
$timber = $container->get('timber');
$context = Timber::get_context();
$context['posts'] = Timber::get_posts();
$timber::render('404.html.twig', $context);
