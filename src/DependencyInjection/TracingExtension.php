<?php

declare(strict_types=1);

namespace Vasary\TracingBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class TracingExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yaml');

        $container->setParameter('tracing.header.name', $configs[0]['header_name']);
        $container->setParameter('tracing.log.field.name', $configs[0]['log_field_name']);
        $container->setParameter('tracing.application.name', $configs[0]['application_name']);
    }
}
