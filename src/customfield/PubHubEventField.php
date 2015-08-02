<?php

final class PubSubEventField extends PubSubProjectCustomField {

  private $textproxy;

  public function __construct() {
    $this->textproxy = $this->getTextFieldProxy($this, $this->getFieldName(),
        $this->getFieldDescription());
  }

  // == General field identity stuff
  public function getFieldKey() {
    return 'isdc:pubsub:event';
  }

  public function getFieldName() {
    return 'PubSub Event';
  }

  public function getFieldDescription() {
    return 'Published Event';
  }

  public function renderPropertyViewValue(array $handles) {
    return $this->renderTextProxyPropertyViewValue($this->textproxy, $handles);
  }

}

