<?php

final class PubSubEventTableView extends Phobject {

  private $tableData;

  public function setTableData ($table_data) {
    $this->tableData = $table_data;
    return $this;
  }

  public function buildEventsTable () {
    $id = 'event-list';
    $project_name = $this->tableData->getProject()->getName();
    Javelin::initBehavior('pubsub-events-table', array(
        'hardpoint' => $id,
    ), 'pubsub');
    $projects_table = id(new SprintTableView($this->tableData->getRows()))
        ->setHeaders(
            array(
                'Subject',
                'Author',
                'Repository',
                'Branch',
                'Updated',
            ))
        ->setTableId('event-list')
        ->setClassName('display');

    $projects_table = id(new PHUIObjectBoxView())
        ->setHeaderText(pht('GitHub Push Events for '.$project_name))
        ->appendChild($projects_table);

    return $projects_table;
  }

}
