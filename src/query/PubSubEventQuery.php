<?php

final class PubSubEventQuery extends PubSubDAO {

  private $projectPHID;

  public function setPHID ($project_phid) {
    $this->projectPHID = $project_phid;
    return $this;
  }

  public function getEvents() {
    $object = new PhabricatorProjectCustomFieldStorage();
    $events = $object->loadRawDataWhere('fieldIndex=%s', PubSubConstants::PUBSUB_EVENT_FIELD_INDEX);
    if (!empty($events)) {
      foreach ($events as $array) {
        $event[] = phutil_json_decode(idx($array, 'fieldValue'));
      }
    }
    return $event;
  }
}
