<?php

final class PubSubResponse extends AphrontStandaloneHTMLResponse {
  private $view;

  public function setView() {
    $this->view;
    return $this;
  }

  protected function getResources() {}

  protected function getResponseTitle() {
    return pht('PubSub Response');
  }

  protected function getResponseBodyClass() {
    return '';
  }

  protected function getResponseBody() {}

  protected function buildPlainTextResponseString() {
    return pht(
        'Event Published to Phabricator Successfully');
  }


}
