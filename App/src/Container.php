<?php
namespace App;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class Container extends ContainerBuilder
{
    public function __construct() {
        parent::__construct();
        $this->setParameter('tempalte_dir', get_template_directory());
    }
}