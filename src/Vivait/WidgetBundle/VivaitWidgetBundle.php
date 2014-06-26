<?php

namespace Vivait\WidgetBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Vivait\WidgetBundle\DependencyInjection\WidgetCompilerPass;

class VivaitWidgetBundle extends Bundle
{
	public function build(ContainerBuilder $container) {
		parent::build($container);

		$container->addCompilerPass(new WidgetCompilerPass());
	}

}
