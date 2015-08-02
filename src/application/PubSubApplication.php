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

  public function getIconName() {
    return 'fa-puzzle-piece';
  }

  public function getShortDescription() {
    return 'Subscribe to PubSubHubbub Publishers';
  }

  public function getRoutes() {
    return array(
        '/pubsub/' => array(
            '' => 'PubSubListController',
            '(?P<action>add|delete)/'.
            '(?P<phid>[^/]+)/' => 'PubSubEditController',
            'feed/(?P<id>[1-9]\d*)/' => 'PubSubFeedController',
            '/api/(?P<method>[^/]+)' => 'PubSubAPIController',
        ),
    );
  }
}
