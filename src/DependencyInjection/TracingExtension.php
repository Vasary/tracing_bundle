<?php

declare(strict_types=1);

namespace Vasary\TracingBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class TracingExtension extends Extension
{
    private const DEFAULT = [
        'header_name' => 'x-trace-id',
        'log_field_name' => 'x-trace-id',
        'application_name' => 'my_application',
    ];

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');

        $config = $configs[0] + self::DEFAULT;

        $container->setParameter('tracing.header.name', $config['header_name']);
        $container->setParameter('tracing.log.field.name', $config['log_field_name']);
        $container->setParameter('tracing.application.name', $config['application_name']);
    }
}
