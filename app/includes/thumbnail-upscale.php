<?php
add_filter('image_resize_dimensions', function ($default, $orig_w, $orig_h, $new_w, $new_h, $crop) {
    if(!$crop) {
        return null;
    }

    $size_ratio = max($new_w / $orig_w, $new_h / $orig_h);
    $crop_w = round($new_w / $size_ratio);
    $crop_h = round($new_h / $size_ratio);
    $s_x = floor( ($orig_w - $crop_w) / 2 );
    $s_y = floor( ($orig_h - $crop_h) / 2 );

    if(is_array($crop)) {
        if($crop[0] === 'left') {
            $s_x = 0;
        } else if($crop[0] === 'right') {
            $s_x = $orig_w - $crop_w;
        }
        if($crop[1] === 'top') {
            $s_y = 0;
        } else if($crop[1] === 'bottom') {
            $s_y = $orig_h - $crop_h;
        }
    }

    return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
}, 10, 6);