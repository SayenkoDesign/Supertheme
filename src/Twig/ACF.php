<?php
namespace Sayenko\Twig;

use Twig_Extension;

/**
 * Class ACF
 * @package App\Twig
 *
 * Twig extension with commands for advanced custom fields
 */
class ACF extends Twig_Extension
{

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('get_field', function ($selector, $postID = false, $formatValue = true) {
                return get_field($selector, $postID, $formatValue);
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
