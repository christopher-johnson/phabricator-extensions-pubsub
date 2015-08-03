<?php

/**
 * Defines PubSub's static resources.
 */
final class CelerityPubSubResources extends CelerityResourcesOnDisk {

  public function getName() {
    return 'pubsub';
  }

  public function getPathToResources() {
    return $this->getSprintPath('../rsrc');
  }

  public function getPathToMap() {
    return $this->getSprintPath('celerity/map.php');
  }

  /**
   * @param string $to_file
   */
  private function getSprintPath($to_file) {
    return (phutil_get_library_root('pubsub')).'/'.$to_file;
  }

}
