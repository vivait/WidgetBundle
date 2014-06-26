<?php
namespace Vivait\WidgetBundle\Widget;

use Knp\Menu\FactoryInterface;
use Vivait\WidgetBundle\Entity\Widget;

abstract class WidgetAbstract implements WidgetInterface {
	/**
	 * @var Widget
	 */
	protected $widget;

	public function setWidget(Widget $widget) {
		$this->widget = $widget;
	}

	public function buildNode(FactoryInterface $factoryInterface) {
		return $factoryInterface->createItem($this->widget->getId())
			->setExtra('template', $this->getTemplate())
			->setExtra('template_args', $this->getTemplateArguments());
	}

	public function getTemplateArguments() {
		return [];
	}

	/**
	 * @inheritDoc
	 */
	public function isActive() {
		return true;
	}
}