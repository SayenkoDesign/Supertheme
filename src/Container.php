<?php
namespace Sayenko;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class Container
 * @package App
 *
 * Container to store configuration and dependencies
 */
class Container extends ContainerBuilder
{
    /**
     * Container constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setParameter('tempalte_dir', get_template_directory());
    }
}
