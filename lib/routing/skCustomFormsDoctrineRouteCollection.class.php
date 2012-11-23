<?php

/**
 *
 * @author Serkan KOYUNCU <serkan@koyuncu.org>
 *
 */
class skCustomFormsDoctrineRouteCollection extends sfDoctrineRouteCollection {

  protected function getRouteForMembers_list()
  {
    return new $this->routeClass(
      sprintf('%s/:%s/%s.:sf_format', $this->options['prefix_path'], $this->options['column'], 'members_list'),
      array_merge(array('module' => $this->options['module'], 'action' => $this->getActionMethod('members_list'), 'sf_format' => 'html'), $this->options['default_params']),
      array_merge($this->options['requirements'], array('sf_method' => array('put', 'post'))),
      array('model' => $this->options['model'], 'type' => 'object', 'method' => $this->options['model_methods']['object'])
    );
  }

  protected function getRouteForMember_promote()
  {
    return new $this->routeClass(
      sprintf('%s/:%s/%s/:%s.:sf_format', $this->options['prefix_path'], $this->options['column'], 'member_promote', 'member_id'),
      array_merge(array('module' => $this->options['module'], 'action' => $this->getActionMethod('member_promote'), 'sf_format' => 'html'), $this->options['default_params']),
      array_merge($this->options['requirements'], array('sf_method' => array('get', 'put', 'post'))),
      array('model' => $this->options['model'], 'type' => 'object', 'method' => $this->options['model_methods']['object'])
    );
  }

  protected function getRouteForMember_demote()
  {
    return new $this->routeClass(
      sprintf('%s/:%s/%s/:%s.:sf_format', $this->options['prefix_path'], $this->options['column'], 'member_demote', 'member_id'),
      array_merge(array('module' => $this->options['module'], 'action' => $this->getActionMethod('member_demote'), 'sf_format' => 'html'), $this->options['default_params']),
      array_merge($this->options['requirements'], array('sf_method' => array('get', 'put', 'post'))),
      array('model' => $this->options['model'], 'type' => 'object', 'method' => $this->options['model_methods']['object'])
    );
  }

  protected function getRouteForMember_delete()
  {
    return new $this->routeClass(
      sprintf('%s/:%s/%s/:%s.:sf_format', $this->options['prefix_path'], $this->options['column'], 'member_delete', 'member_id'),
      array_merge(array('module' => $this->options['module'], 'action' => $this->getActionMethod('member_delete'), 'sf_format' => 'html'), $this->options['default_params']),
      array_merge($this->options['requirements'], array('sf_method' => array('get', 'put', 'post'))),
      array('model' => $this->options['model'], 'type' => 'object', 'method' => $this->options['model_methods']['object'])
    );
  }

  protected function getRouteForMember_copy()
  {
    return new $this->routeClass(
      sprintf('%s/:%s/%s.:sf_format', $this->options['prefix_path'], $this->options['column'], 'member_copy'),
      array_merge(array('module' => $this->options['module'], 'action' => $this->getActionMethod('member_copy'), 'sf_format' => 'html'), $this->options['default_params']),
      array_merge($this->options['requirements'], array('sf_method' => array('get', 'put', 'post'))),
      array('model' => $this->options['model'], 'type' => 'object', 'method' => $this->options['model_methods']['object'])
    );
  }


  protected function getDefaultActions() {
    $r = parent::getDefaultActions();
    $r[] = 'members_list';
    $r[] = 'member_promote';
    $r[] = 'member_demote';
    $r[] = 'member_delete';
    $r[] = 'member_copy';

    return $r;
  }


}


