<?php

final class PubSubEventData extends PhabricatorProjectDAO
    implements
    PhabricatorApplicationTransactionInterface {

  public function getApplicationTransactionEditor() {
    return new PhabricatorProjectColumnTransactionEditor();
  }

  public function getApplicationTransactionObject() {
    return $this;
  }

  public function getApplicationTransactionTemplate() {
    return new PhabricatorProjectTransaction();
  }

  public function willRenderTimeline(
      PhabricatorApplicationTransactionView $timeline,
      AphrontRequest $request) {

    return $timeline;
  }
}
