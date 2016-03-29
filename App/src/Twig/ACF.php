<?php
namespace App\Twig;

use Twig_Extension;

class ACF extends Twig_Extension
{

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('get_field', function ($selector, $post_id = false, $format_value = true) {
                return get_field($selector, $post_id, $format_value);
            }),
        );
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return __CLASS__;
    }
}