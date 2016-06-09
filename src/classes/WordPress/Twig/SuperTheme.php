<?php
namespace Supertheme\WordPress\Twig;

/**
 * Class WordPressExtension
 * @package Supertheme\WordPress\Twig
 */
class SuperTheme
{
    /**
     * @var ACF
     */
    protected $ACF;

    /**
     * @var WordPress
     */
    protected $wordPress;

    /**
     * SuperTheme constructor.
     * @param ACF $acf
     * @param WordPress $wordpress
     */
    public function __construct(ACF $acf, WordPress $wordpress)
    {
        $this->ACF = $acf;
        $this->wordPress = $wordpress;
    }

    /**
     * @return ACF
     */
    public function getACF()
    {
        return $this->ACF;
    }

    /**
     * @return WordPress
     */
    public function getWordPress()
    {
        return $this->wordPress;
    }
}