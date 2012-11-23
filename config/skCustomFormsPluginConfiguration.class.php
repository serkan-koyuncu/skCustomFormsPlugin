<?php

/**
 * skCustomFormsPlugin configuration.
 *
 * @package     skCustomFormsPlugin
 * @subpackage  config
 * @author      Serkan Koyuncu <serkan@koyuncu.org>
 * @version     SVN: $Id: PluginConfiguration.class.php 17207 2009-04-10 15:36:26Z Kris.Wallsmith $
 */
class skCustomFormsPluginConfiguration extends sfPluginConfiguration
{
  const VERSION = '1.0.0-DEV';

  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
      if (sfConfig::get('app_sk_custom_forms_plugin_routes_register', true)) {
	    foreach (array('skCustomForms') as $module)
	    {
	      if (in_array($module, sfConfig::get('sf_enabled_modules', array())) && sfConfig::get('app_'.Doctrine_Inflector::tableize($module).'_routes_register', true))
	      {
	        $this->dispatcher->connect('routing.load_configuration', array('skCustomFormsRouting', 'addRouteFor'.str_replace('sk', '', $module)));
	      }
	    }
    }

    foreach (array('skCustomFormsAdmin') as $module)
    {
      if (in_array($module, sfConfig::get('sf_enabled_modules', array())))
      {
        $this->dispatcher->connect('routing.load_configuration', array('skCustomFormsRouting', 'addRouteFor'.str_replace('sk', '', $module)));
      }
    }
  }
}
