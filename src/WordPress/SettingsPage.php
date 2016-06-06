<?php
namespace Supertheme\WordPress;

use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormFactoryBuilderInterface;
use Symfony\Component\HttpFoundation\Request;

class SettingsPage
{
    protected $title;
    protected $menuTitle;
    protected $capability = 'manage_options';
    protected $menuSlug;
    protected $optionGroup;
    protected $options; // values
    protected $twig;
    protected $factory;

    public function __construct($title, $menuTitle, $menuSlug, FormFactoryBuilderInterface $factory, \Twig_Environment $twig)
    {
        $this->title = $title;
        $this->menuTitle = $menuTitle;
        $this->menuSlug = $menuSlug;
        $this->optionGroup = $this->menuSlug;
        $this->factory = $factory;
        $this->twig = $twig;
        $this->register();
        // Set class property
        $this->options = get_option($this->getOptionName());
    }

    public function setCapability($capability)
    {
        $this->capability = $capability;
        return $this;
    }

    public function setOptionGroup($group)
    {
        $this->optionGroup = $group;
    }

    public function getOptionName()
    {
        return 'supertheme_options';
    }

    public function register()
    {
        add_action('admin_menu', array($this, 'addPage'));
        add_action('admin_init', array($this, 'initPage'));
    }

    public function addPage()
    {
        // This page will be under "Settings"
        add_menu_page(
            $this->title,
            $this->menuTitle,
            $this->capability,
            $this->menuSlug,
            array($this, 'createPage')
        );
    }

    public function createPage()
    {
        $builder = $this->buildForm($this->factory->getFormFactory()->createNamedBuilder(null));
        $form = $builder->getForm();
        $view = $form->createView();

        echo $this->twig->render('admin/options/settings.html.twig', [
            'form' => $view,
            'title' => $this->menuTitle,
        ]);
    }

    public function initPage()
    {
        // register model
        register_setting(
            $this->optionGroup, // Option group
            $this->getOptionName(), // Option name
            [$this, 'sanitize']
        );

        // register views. no defined relationship to model
        add_settings_section(
            'setting_section_id', // ID
            'My Custom Settings', // Title
            '__return_false', // Callback
            $this->menuSlug // Page
        );

        add_settings_field(
            'id_number', // ID
            'ID Number', // Title
            '__return_false', // Callback
            $this->menuSlug, // Page
            'setting_section_id' // Section
        );

        add_settings_field(
            'title',
            'Title',
            '__return_false',
            $this->menuSlug,
            'setting_section_id'
        );
    }

    public function sanitize($input)
    {
        $builder = $this->buildForm($this->factory->getFormFactory()->createNamedBuilder(null));
        $form = $builder->getForm();
        $form->handleRequest(Request::createFromGlobals());
        if($form->isValid()) {
            $data = $form->getData();
            $input['id_number'] = absint($data['id_number']);
            $input['title'] = sanitize_text_field($data['title']);

            return $input;
        }
    }

    public function buildForm(FormBuilderInterface $builder, array $options = [])
    {
        $builder
            ->setAction('options.php')
            ->add('option_page', Type\HiddenType::class, [
                'data' => esc_attr($this->menuSlug),
            ])
            ->add('action', Type\HiddenType::class, [
                'data' => 'update'
            ])
            ->add('_wpnonce', Type\HiddenType::class, [
                'data' => wp_create_nonce($this->menuSlug."-options")
            ])
            ->add('_wp_http_referer', Type\HiddenType::class, [
                'data' => esc_attr(wp_unslash($_SERVER['REQUEST_URI']))
            ])
            ->add('id_number', Type\NumberType::class, [
                'data' => $this->options['id_number']
            ])
            ->add('title', Type\TextType::class, [
                'data' => $this->options['title']
            ])
            ->add('submit', Type\SubmitType::class, [
                'label' => 'Save Changes',
            ])
        ;
        return $builder;
    }
}