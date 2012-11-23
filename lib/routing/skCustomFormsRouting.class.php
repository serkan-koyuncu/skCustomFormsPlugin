<?php

/*
 * This file is part of the symfony package.
 * (c) Serkan Koyuncu <serkan@koyuncu.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @package    skCustomForms
 * @subpackage plugin
 * @author     Serkan Koyuncu <serkan@koyuncu.org>
 * @version    SVN: $Id: sfGuardRouting.class.php 25546 2009-12-17 23:27:55Z Jonathan.Wage $
 */
class skCustomFormsRouting
{

  /**
   * Listens to the routing.load_configuration event.
   *
   * @param sfEvent An sfEvent instance
   * @static
   */
  static public function addRouteForCustomForms(sfEvent $event) {
    $r = $event->getSubject();
    $r->prependRoute('sk_custom_form', new sfRoute('/:sf_culture/sk_custom_form/:id', array('module' => 'skCustomForms', 'action' => 'save'), array('id' => '\d+', 'sf_culture' => self::getCultureRegex())));
  }

  /**
   * Adds an sfDoctrineRouteCollection collection to manage contacts.
   *
   * @param sfEvent $event
   * @static
   */
  static public function addRouteForCustomFormsAdmin(sfEvent $event) {
  	$event->getSubject()->prependRoute('sk_custom_forms_admin', new skCustomFormsDoctrineRouteCollection(array(
      'name'                => 'sk_custom_forms_admin',
      'model'               => 'skForm',
      'module'              => 'skCustomFormsAdmin',
      'prefix_path'         => 'sk_custom_forms_admin',
      'with_wildcard_routes' => true,
      'collection_actions'  => array('filter' => 'post', 'batch' => 'post'),
      'requirements'        => array(),
    )));
  }

  static public function getCultureRegex()
  {
    $arr = sfConfig::get('app_sk_custom_forms_plugin_cultures_enabled', array('en'=>'English'));

    return '(?:'.join('|', array_keys($arr)).')';
  }


}