<?php

final class PubSubEventDataProvider {

  private $events;
  private $rows;
  private $project;

  public function setTransactions ($project_xactions) {
    $this->events = $project_xactions;
    return $this;
  }

  public function setProject($project) {
    $this->project = $project;
    return $this;
  }

  public function execute() {
    $this->buildEventListData();
    return $this;
  }

  public function getRows () {
    return $this->rows;
  }

  public function getProject () {
    return $this->project;
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
      phutil_tag(
            'a',
            array(
                'href' => $event['compare'],
                'style' => 'font-weight:bold',
            ),
          $event['head_commit']['message']),
      $event['head_commit']['author']['name'],
      $event['repository']['name'],
      $event['ref'],
      $event['head_commit']['timestamp'],
     );
    return $row;
  }

}
