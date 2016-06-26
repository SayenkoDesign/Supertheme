<?php
namespace Supertheme\WordPress;

use Walker_Nav_Menu;

class DrillDownMenuWalker extends Walker_Nav_Menu
{
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"vertical menu\">\n";
    }
}