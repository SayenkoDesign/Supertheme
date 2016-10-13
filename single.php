<?php
require_once __DIR__.'/app/bootstrap.php';
use Timber\Timber;

/** @var $timber Timber */
$timber = $container->get('timber');
$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;
if (post_password_required($post->ID)) {
    Timber::render('single-password.html.twig', $context);
} else {
    Timber::render(['single-'.$post->ID.'.html.twig', 'single-'.$post->post_type.'.html.twig', 'single.html.twig'], $context);
}
