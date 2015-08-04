<?php

final class PubSubEventTableView extends Phobject {

  private $tableData;

  public function setTableData ($table_data) {
    $this->tableData = $table_data;
    return $this;
  }

  public function buildEventsTable () {
    $id = 'event-list';
    Javelin::initBehavior('pubsub-events-table', array(
        'hardpoint' => $id,
    ), 'pubsub');
    $projects_table = id(new SprintTableView($this->tableData->getRows()))
        ->setHeaders(
            array(
                'ref',
                'before',
                'after',
                'compare',
                'repo',
                'message',
                'time',
            ))
        ->setTableId('event-list')
        ->setClassName('display');

    $projects_table = id(new PHUIBoxView())
        ->appendChild($projects_table)
        ->addMargin(PHUI::MARGIN_LARGE);

    return $projects_table;
  }

}

