<?php
/**
 * @author Christopher Johnson
 * @license GPL version 3
 */

final class PubSubApplication extends PhabricatorApplication {

  public function getName() {
    return pht('PubSub');
  }

  public function getBaseURI() {
      return '/pubsub/';
  }

  public function getFontIcon() {
    return 'fa-rss';
  }

  public function getIconName() {
    return 'fa-rss';
  }

  public function getShortDescription() {
    return 'Subscribe to PubSubHubbub Publishers';
  }

  public function getRoutes() {
    return array(
        '/pubsub/' => array(
            '' => 'PubSubListController',
            '(?P<id>[1-9]\d*)' => 'PubSubListController',
            '(?P<action>add|delete)/'.
            '(?P<phid>[^/]+)/' => 'PubSubEditController',
            'event/(?P<id>[1-9]\d*)/' => 'PubSubEventController',
            '/api/(?P<method>[^/]+)' => 'PubSubAPIController',
        ),
    );
  }
}
