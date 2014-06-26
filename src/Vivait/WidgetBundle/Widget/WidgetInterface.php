<?php
namespace Vivait\WidgetBundle\Widget;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Vivait\WidgetBundle\Entity\Widget;

interface WidgetInterface {
	public function getTemplate();
	public function getTemplateArguments();
	public function getAlias();
	public function getLabel();

	/**
	 * @param FactoryInterface $factoryInterface
	 * @return ItemInterface
	 */
	public function buildNode(FactoryInterface $factoryInterface);

	/**
	 * @return boolean
	 */
	public function isActive();

	public function setWidget(Widget $widget);
}