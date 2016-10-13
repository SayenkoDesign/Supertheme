<?php
require_once __DIR__.'/app/bootstrap.php';
use Timber\Timber;

/** @var $timber Timber */
$timber = $container->get('timber');
$templates = ['archive.html.twig', 'index.html.twig'];
$context = Timber::get_context();
$context['title'] = 'Archive';
if (is_day()) {
    $context['title'] = 'Archive: '.get_the_date('D M Y');
} else if (is_month()) {
    $context['title'] = 'Archive: '.get_the_date('M Y');
} else if (is_year()) {
    $context['title'] = 'Archive: '.get_the_date('Y');
} else if (is_tag()) {
    $context['title'] = single_tag_title('', false);
} else if (is_category()) {
    $context['title'] = single_cat_title('', false);
    array_unshift($templates, 'archive-'.get_query_var('cat').'.html.twig' );
} else if (is_post_type_archive()) {
    $context['title'] = post_type_archive_title('', false);
    array_unshift($templates, 'archive-'.get_post_type().'.html.twig' );
}
$context['posts'] = Timber::get_posts();
$timber::render($templates, $context);
