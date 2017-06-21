<?php
add_action('init', function () use($container) {
    // always start a session
    if (!session_id()) {
        session_start();
    }
});