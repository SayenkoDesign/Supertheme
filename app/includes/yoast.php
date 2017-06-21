<?php
// move yoast down
add_filter('wpseo_metabox_prio', function() {
    return 'low';
});