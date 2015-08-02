<?php

abstract class PubSubDAO extends PhabricatorLiskDAO {

  public function getApplicationName() {
    return 'PubSub';
  }

}
