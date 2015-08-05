<?php

final class PubSubListController
    extends PubSubController {

  private $view;

  public function handleRequest(AphrontRequest $request) {
    $projectID = $request->getURIData('id');
    $nav = $this->buildNavMenu();
    $this->view = $nav->selectFilter($this->view, 'list');

    if (!$projectID) {
      return $this->buildApplicationPage(
          $nav,
          array(
              'title' => array(pht('Event List')),
              'device' => true,
          ));
    } else {
      $project = $this->loadProject($projectID);
      $event_model = id(new PubSubEventDataProvider())
          ->setTransactions($this->buildProjectTransactions($project))
          ->setProject($project)
          ->execute();
      $eventlist_table = id(new PubSubEventTableView())
          ->setTableData($event_model)
          ->buildEventsTable();

      $nav->appendChild(
          array(
              $eventlist_table,
          ));
      return $this->buildApplicationPage(
          $nav,
          array(
              'title' => array(pht('Event List')),
              'device' => true,
          ));
    }
  }

  public function buildProjectTransactions(PhabricatorProject $project) {
    $engine = new PhabricatorMarkupEngine();
    $timeline = $this->buildEventsTimeline(
        $project,
        id(new PhabricatorProjectTransactionQuery())
            ->withTransactionTypes(array(PhabricatorTransactions::TYPE_CUSTOMFIELD))
            ->withAuthorPHIDs(array(PubSubConstants::PUBSUB_USER_PHID))
            ->withObjectPHIDs(array($project->getPHID())),
        $engine);

    return $timeline;
  }
}
