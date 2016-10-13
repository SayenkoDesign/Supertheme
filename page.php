<?php
require_once __DIR__.'/app/bootstrap.php';
use Timber\Timber;
use Timber\Post;

/** @var $timber Timber */
$timber = $container->get('timber');
$context = Timber::get_context();
$post = new Post();
$context['post'] = $post;
Timber::render(['page-'.$post->post_name.'.twig', 'page.html.twig'], $context);
