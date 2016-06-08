<?php
/**
 * Created by PhpStorm.
 * User: rpark
 * Date: 6/7/2016
 * Time: 11:47 PM
 */

namespace Supertheme\WordPress;


use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormFactoryBuilderInterface;

abstract class SettingsPage
{
    /**
     * @var string Page title
     */
    protected $title;

    /**
     * @var string menu title
     */
    protected $menuTitle;

    /**
     * @var string required capability to view the page
     */
    protected $capability = 'manage_options';

    /**
     * @var string slug for the page
     */
    protected $menuSlug;

    /**
     * @var string group name for the options
     */
    protected $optionGroup;

    /**
     * @var array saved values
     */
    protected $values;

    /**
     * @var \Twig_Environment twig environment to render the page
     */
    protected $twig;

    /**
     * @var FormFactoryBuilderInterface factory instance to create form builders
     */
    protected $factory;

    /**
     * @return string return name to save and retrieve options
     */
    abstract public function getOptionName();

    /**
     * @return null echos the page
     */
    abstract public function renderPage();

    /**
     * @return null called on admin_init. This is where you should register your sections and options
     */
    abstract public function initPage();

    /**
     * @param FormBuilderInterface $builder
     * @return FormBuilderInterface returns the builder after adding settings and fields
     */
    abstract public function buildForm(FormBuilderInterface $builder);

    public function __construct($title, $menuTitle, $menuSlug, FormFactoryBuilderInterface $factory, \Twig_Environment $twig)
    {
        $this->title = $title;
        $this->menuTitle = $menuTitle;
        $this->menuSlug = $menuSlug;
        $this->optionGroup = $this->menuSlug;
        $this->factory = $factory;
        $this->twig = $twig;
        $this->values = get_option($this->getOptionName());
    }

    /**
     * @param $capability string wordpress capability required to view page
     * @return $this
     */
    public function setCapability($capability)
    {
        $this->capability = $capability;
        return $this;
    }

    /**
     * @param $group string set groupo name to the options fields
     * @return $this
     */
    public function setOptionGroup($group)
    {
        $this->optionGroup = $group;
        return $this;
    }

    /**
     * @return array returns the currently saved values
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * adds menu page to wordpress on admin_menu action
     */
    public function addPage()
    {
        // This page will be under "Settings"
        add_menu_page(
            $this->title,
            $this->menuTitle,
            $this->capability,
            $this->menuSlug,
            array($this, 'renderPage')
        );
        wp_enqueue_media();
    }

    /**
     * register the page and initialize it
     */
    public function register()
    {
        add_action('admin_menu', [$this, 'addPage']);
        add_action('admin_init', [$this, 'initPage']);
    }
}
