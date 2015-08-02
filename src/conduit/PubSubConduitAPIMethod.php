<?php

abstract class PubSubConduitAPIMethod extends ConduitAPIMethod {

  final public function getApplication() {
    return PhabricatorApplication::getByClass('PubSubApplication');
  }

}
