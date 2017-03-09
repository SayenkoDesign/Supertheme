<?php
require_once __DIR__.'/app/bootstrap.php';
use Timber\Timber;

/** @var $timber Timber */
$timber = $container->get('timber');
$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;
$templates = ['archive.html.twig', 'index.html.twig'];

if (post_password_required($post->ID)) {
    array_unshift($templates, 'single-password.html.twig');
} else {
    array_unshift($templates, 'single.html.twig');
    array_unshift($templates, 'single-'.$post->post_type.'.html.twig');
    array_unshift($templates, 'single-'.$post->ID.'.html.twig');
}

$timber::render($templates, $context);