Viva IT - Widget Bundle
============

Extends Knp Menu to allow widgets to be registered and displayed.

Installation
------------
**Using composer**
``` bash
$ composer require viviat/widget-bundle
```

**Enabling bundle**
``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
     = array(
        // ...
        new Vivait\WidgetBundle\VivaitWidgetBundle()
    );
}
```

**Add routing rules (optional)**
``` yml
# app/config/routing.yml
vivait_widget:
  resource: "@VivaitWidgetBundle/Resources/config/routing.yml"
  prefix:   /widget
```

Usage
-----------
To display a 'position' of a widget, use the following:
```twig
	{{ knp_menu_render('homewidget', {
	'template': 'VivaitWidgetBundle:Knp:widget.html.twig',
	'allow_safe_labels': true
	}) }}
```

This example will display all widgets belonging to the 'homewidget' position.

Testing Run
-----------
Unit Test are written with PHPSpec.
