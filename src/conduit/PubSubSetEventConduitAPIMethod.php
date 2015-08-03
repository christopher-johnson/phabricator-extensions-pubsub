<?php

final class PubSubSetEventConduitAPIMethod extends PubSubConduitAPIMethod {

  public function getAPIMethodName() {
    return 'pubsub.setevent';
  }

  public function getMethodDescription() {
    return pht('Set PubSubEvent in a Project Custom Field');
  }

  public function defineParamTypes() {
    return array(
        'project' => 'required string ("PHID")',
        'data' => 'required dict',
    );
  }

  public function defineReturnType() {
    return 'dict';
  }

  public function defineErrorTypes() {
    return array();
  }

  protected function execute(ConduitAPIRequest $request) {
    $user = $request->getUser();

    $xactions = array();
    $data = $request->getValue('data');
    //$storage_value = $data['payload'];
    $xactions[] = id(new PhabricatorProjectTransaction())
        ->setTransactionType(PhabricatorTransactions::TYPE_CUSTOMFIELD)
        ->setMetadataValue('customfield:key', 'isdc:pubsub:event')
        ->setOldValue(null)
        ->setNewValue(json_encode($data));

    $editor = id(new PhabricatorProjectTransactionEditor())
        ->setActor($user)
        ->setContinueOnNoEffect(true)
        ->setContentSourceFromConduitRequest($request);

    $project = id(new PhabricatorProjectQuery())
        ->setViewer($user)
        ->withPHIDS(array($request->getValue('project')))
        ->needSlugs(true)
        ->executeOne();

    if (!$project) {
      return null;
    } else {
      $editor->applyTransactions($project, $xactions);
      return;
    }
  }

}
