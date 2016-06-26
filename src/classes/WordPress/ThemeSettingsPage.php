<?php
namespace Supertheme\WordPress;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ThemeAbstractSettingsPage
 * @package Supertheme\WordPress
 */
class ThemeSettingsPage extends AbstractSettingsPage
{
    /**
     * @return string
     */
    public function getOptionName()
    {
        return 'supertheme_options';
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return 'Settings Admin';
    }

    /**
     * @return string
     */
    public function getMenuTitle()
    {
        return 'Theme Settings';
    }

    /**
     * @return string
     */
    public function getMenuSlug()
    {
        return 'theme-settings';
    }

    public function getIcon()
    {
        return 'dashicons-sayenko';
    }

    /**
     * @inheritdoc
     */
    public function renderPage()
    {
        $builder = $this->buildForm($this->factory->getFormFactory()->createNamedBuilder(null));
        $form = $builder->getForm();
        $view = $form->createView();

        echo $this->twig->render('admin/options/settings.html.twig', [
            'form' => $view,
            'title' => $this->menuTitle,
        ]);
    }

    /**
     * @inheritdoc
     */
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

    /**
     * @param $input array values automatically retrieved from form.
     * @return array return associative array of sanitized and validated values to save
     */
    public function sanitize($input)
    {
        $builder = $this->buildForm($this->factory->getFormFactory()->createNamedBuilder(null));
        $form = $builder->getForm();
        $form->handleRequest(Request::createFromGlobals());
        if($form->getClickedButton()->getName() == 'clear_cache') {
            if($cache = $this->twig->getCache()) {
                $fs = new Filesystem();
                $fs->remove($cache);
            }
            
            return $this->values;
        } else if ($form->isValid()) {
            $data = $form->getData();
            $input['universal_analytics'] = sanitize_text_field($data['universal_analytics']);
            $input['tracking_id'] = sanitize_text_field($data['tracking_id']);
            $input['facebook'] = esc_url_raw($data['facebook']);
            $input['linkedin'] = esc_url_raw($data['linkedin']);
            $input['pinterest'] = esc_url_raw($data['pinterest']);
            $input['instagram'] = esc_url_raw($data['instagram']);
            $input['youtube'] = esc_url_raw($data['youtube']);
            $input['admin_logo'] = esc_url_raw($data['admin_logo']);
            $input['mobile_logo'] = esc_url_raw($data['mobile_logo']);
            $input['favicon'] = esc_url_raw($data['favicon']);
            $input['logo'] = esc_url_raw($data['logo']);

            return $input;
        }

        return [];
    }

    /**
     * @param FormBuilderInterface $builder
     * @return FormBuilderInterface
     */
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder
            ->setAction('options.php')
            ->setData($this->values ?: null)
            // hidden
            ->add('option_page', Type\HiddenType::class, [
                'data' => esc_attr($this->menuSlug),
            ])
            ->add('action', Type\HiddenType::class, [
                'data' => 'update',
            ])
            ->add('_wpnonce', Type\HiddenType::class, [
                'data' => wp_create_nonce($this->menuSlug."-options"),
            ])
            ->add('_wp_http_referer', Type\HiddenType::class, [
                'data' => esc_attr(wp_unslash($_SERVER['REQUEST_URI'])),
            ])
            // clear cache
            ->add('clear_cache', Type\SubmitType::class)
            // logo
            ->add('admin_logo', Type\UrlType::class)
            ->add('logo', Type\UrlType::class)
            ->add('mobile_logo', Type\UrlType::class)
            ->add('favicon', Type\UrlType::class)
            // analytics
            ->add('universal_analytics', Type\CheckboxType::class, [
                'label' => 'Enable Universal Analytics',
                'required' => false,
                'data' => (bool) $this->values['universal_analytics'],
            ])
            ->add('tracking_id', Type\TextType::class)
            // social
            ->add('facebook', Type\UrlType::class, [
                'required' => false,
            ])
            ->add('twitter', Type\UrlType::class, [
                'required' => false,
            ])
            ->add('linkedin', Type\UrlType::class, [
                'required' => false,
            ])
            ->add('pinterest', Type\UrlType::class, [
                'required' => false,
            ])
            ->add('instagram', Type\UrlType::class, [
                'required' => false,
            ])
            ->add('youtube', Type\UrlType::class, [
                'required' => false,
            ])
            ->add('submit', Type\SubmitType::class, [
                'label' => 'Save Changes',
            ])
        ;

        return $builder;
    }
}
