<?php

namespace Vivait\WidgetBundle\Provider;
use Knp\Menu\FactoryInterface;
use Knp\Menu\Provider\MenuProviderInterface;
use Vivait\WidgetBundle\Entity\WidgetRepository;
use Vivait\WidgetBundle\Widget\WidgetInterface;
use Vivait\WidgetBundle\Widget\WidgetTemplateInterface;

class WidgetProvider implements MenuProviderInterface
{
	/**
	 * @var WidgetRepository
	 */
	protected $repository;
	/**
	 * @var \Knp\Menu\FactoryInterface
	 */
	private $factory;

	/**
	 * @var array
	 */
	private $widgets = [];

	/**
	 * @param \Vivait\WidgetBundle\Entity\WidgetRepository $repository
	 * @param FactoryInterface $factory the menu factory used to create the menu item
	 */
	public function __construct(WidgetRepository $repository, FactoryInterface $factory)
	{
		$this->repository = $repository;
		$this->factory = $factory;
	}

	/**
	 * @param $alias
	 * @return WidgetInterface
	 * @throws \InvalidArgumentException if the widget does not exists
	 */
	public function getWidget($alias) {
		if (isset($this->widgets[$alias])) {
			return $this->widgets[$alias];
		}

		throw new \InvalidArgumentException(sprintf("There is no widget with the alias '%s'", $alias));
	}

	public function addWidget(WidgetInterface $widgetInterface) {
		if ($widgetInterface instanceOf WidgetTemplateInterface) {
			$this->widgets[$widgetInterface->getParent() .'.'. $widgetInterface->getAlias()] = $widgetInterface;
		}
		else {
			$this->widgets[$widgetInterface->getAlias()] = $widgetInterface;
		}
	}

	/**
	 * Retrieves a menu by its name
	 *
	 * @param string $position
	 * @param array $options
	 * @return \Knp\Menu\ItemInterface
	 * @throws \InvalidArgumentException if the widget does not exists
	 */
	public function get($position, array $options = array())
	{
		$widgets = $this->repository->getWidgetByPosition($position);
		$node    = $this->factory->createItem($position);
		$node->setChildrenAttribute('data-widget', 'sortable');
		$node->setChildrenAttribute('class', 'list-group');

		foreach ($widgets as $widget) {
			$widget_instance = clone $this->getWidget($widget->getAlias());
			$widget_instance->setWidget($widget);

			if ($widget_instance->isActive()) {
				// Load each widget NodeItem from the widget
				$node->addChild($widget_instance->buildNode($this->factory));
			}
		}

		return $node;
	}

	/**
	 * Checks whether a menu exists in this provider
	 *
	 * @param string $position
	 * @param array $options
	 * @return bool
	 */
	public function has($position, array $options = array())
	{
		return true;
	}
}