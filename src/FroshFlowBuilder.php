<?php declare(strict_types=1);

namespace Frosh\FlowBuilder;

use Frosh\FlowBuilder\FroshTools\Checker\FlowExecutionErrorChecker;
use Frosh\Tools\Components\Health\Checker\CheckerInterface;
use Shopware\Core\Framework\Plugin;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class FroshFlowBuilder extends Plugin
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        if (interface_exists(CheckerInterface::class)) {
            $definition = new Definition(FlowExecutionErrorChecker::class);
            $definition->setAutowired(true);
            $definition->setAutoconfigured(true);

            $container->setDefinition(FlowExecutionErrorChecker::class, $definition);
        }
    }
}
