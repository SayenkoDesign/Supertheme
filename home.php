<?php
require_once __DIR__.'/app/bootstrap.php';
use Timber\Timber;

/** @var $timber Timber */
$timber = $container->get('timber');
$context = $timber::get_context();
$context['posts'] = $timber::get_posts();
$context['categories'] = Timber::get_terms('category');
$context['title'] = 'Blog';
$timber::render('pages/archive.html.twig', $context);


