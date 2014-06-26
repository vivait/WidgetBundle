<?php

namespace Vivait\WidgetBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class WidgetCompilerPass implements CompilerPassInterface
{
	public function process(ContainerBuilder $container)
	{
		if (!$container->hasDefinition('vivait.widget.provider')) {
			return;
		}

		$definition = $container->getDefinition(
			'vivait.widget.provider'
		);

		$taggedServices = $container->findTaggedServiceIds(
			'vivait.widget'
		);

		foreach ($taggedServices as $id => $attributes) {
			$definition->addMethodCall(
				'addWidget',
				array(new Reference($id))
			);
		}
	}
}