<?php
require_once __DIR__.'/app/bootstrap.php';
use Timber\Timber;
use Timber\User;

/** @var $timber Timber */
$timber = $container->get('timber');
$context = Timber::get_context();
$context['posts'] = Timber::get_posts();
if (isset($wp_query->query_vars['author'])) {
    $author = new User($wp_query->query_vars['author']);
    $context['author'] = $author;
    $context['title'] = 'Author Archives: '.$author->name();
}
$timber::render(['author.html.twig', 'archive.html.twig'], $context);
