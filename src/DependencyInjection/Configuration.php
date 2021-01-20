<?php

declare(strict_types=1);

namespace Vasary\TracingBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\NodeParentInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): NodeParentInterface
    {
        $treeBuilder = new TreeBuilder('tracing');
        $treeBuilder
            ->getRootNode()
                ->children()
                    ->scalarNode('header_name')
                        ->defaultValue('x-trace-id')
                    ->end()
                    ->scalarNode('log_field_name')
                        ->defaultValue('x-trace-id')
                    ->end()
                    ->scalarNode('application_name')
                        ->defaultValue('my_application')
                    ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
