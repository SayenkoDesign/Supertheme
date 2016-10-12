<?php
require_once __DIR__.'/app/bootstrap.php';
use Timber\Timber;

/** @var $timber Timber */
$timber = $container->get('timber');
$context = $timber::get_context();
$context['post'] = Timber::query_post();

$template = 'base.html.twig';

$timber->render($template, $context);