<?php
add_filter('excerpt_more','__return_false');
add_filter('excerpt_more', function ($more) {
    global $post;
    return ' <a class="read-more" href="'.get_permalink($post->ID).'">Read More</a>';
});

add_filter('the_content_more_link', function () {
    return ' <a class="read-more" href="'.get_permalink().'">Read More</a>';
});