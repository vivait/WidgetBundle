<?php
namespace Vivait\WidgetBundle\Widget;

use Knp\Menu\FactoryInterface;

abstract class WidgetTemplateAbstract implements WidgetInterface {
	public function buildNode(FactoryInterface $factoryInterface) {
		return $factoryInterface->createItem($this->getAlias())
			->setExtra('template', $this->getTemplate());
	}
}