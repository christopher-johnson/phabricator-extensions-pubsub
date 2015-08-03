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
    foreach ($event as $key=>$value) {
      $values[] = str_replace('",', "", trim($value, '"'));
    }
    $rows = array (
      $values[1],
      $values[4],
      phutil_tag(
          'a',
          array(
              'href' => $values[6],
              'style' => 'font-weight:bold',
          ),
          $values[6]),
      $values[14],
      $values[21],
      $values[24],
    );
    return $rows;
  }

}
