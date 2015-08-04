<?php

final class PubSubEventDataProvider {

  private $events;
  private $rows;

  public function setTransactions ($project_xactions) {
    $this->events = $project_xactions;
    return $this;
  }

  public function execute() {
    $this->buildEventListData();
    return $this;
  }

  public function getRows () {
    return $this->rows;
  }

  private function buildEventListData() {

    $rows = array();
    foreach ($this->events as $event) {
      $row = $this->buildRowSet($event);
      $rows[] = $row;
    }

    $this->rows = $rows;
    return $this;
  }

  private function buildRowSet($event) {
    $values = array();
    $row = array (
      $event['ref'],
      $event['before'],
      $event['after'],
      phutil_tag(
          'a',
          array(
              'href' => $event['compare'],
              'style' => 'font-weight:bold',
          ),
          $event['compare']),
      $event['repository']['name'],
      $event['head_commit']['message'],
      $event['head_commit']['timestamp'],
    );
    return $row;
  }

}
