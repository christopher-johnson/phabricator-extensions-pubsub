<?php

abstract class PubSubController extends PhabricatorController {

  public function shouldAllowPublic() {
    return true;
  }

}
