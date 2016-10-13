<?php
require_once __DIR__.'/app/bootstrap.php';
use Timber\Timber;

/** @var $timber Timber */
$timber = $container->get('timber');
$templates = ['search.html.twig', 'archive.html.twig', 'index.html.twig'];
$context = Timber::get_context();
$context['title'] = 'Search results for '. get_search_query();
$context['posts'] = Timber::get_posts();
Timber::render($templates, $context);
