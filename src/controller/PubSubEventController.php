<?php

final class PubSubEventController
    extends PubSubController {

    private $projectID;

    public function handleRequest(AphrontRequest $request) {
        $this->projectID = $request->getURIData('id');
        $this->event = $request->getURIMap();
        $api_token = PubSubConstants::API_TOKEN;
        $api_parameters =  array(
            'project' => $this->loadProject()->getPHID(),
            'data' => $this->event
        );
        $client = new ConduitClient('http://phab.wmde.de/');
        $client->setConduitToken($api_token);

        $result = $client->callMethodSynchronous('pubsub.setevent', $api_parameters);
    }

    public function loadProject() {
        $project = id(new PhabricatorProjectQuery())
            ->setViewer(PhabricatorUser::getOmnipotentUser())
            ->withIDs(array($this->projectID))
            ->executeOne();
        return $project;
    }

}
