<?php

declare(strict_types=1);

namespace Vasary\TracingBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Vasary\TracingBundle\DependencyInjection\TracingExtension;

final class TracingBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
    }

    public function getContainerExtension(): ExtensionInterface
    {
        return new TracingExtension();
    }
}
