<?php

final class PubSubEventController
    extends PubSubController {

    private $projectID;
    private $event;

    public function handleRequest(AphrontRequest $request) {
        try {
        $this->projectID = $request->getURIData('id');
        $this->event = $request->getRequestData();
        $base_uri     = PhabricatorEnv::getEnvConfig('phabricator.base-uri');
        $api_token = PubSubConstants::API_TOKEN;
        $api_parameters =  array(
            'project' => $this->loadProject()->getPHID(),
            'data' => $this->event
        );
        $client = new ConduitClient($base_uri);
        $client->setConduitToken($api_token);

        $result = $client->callMethodSynchronous('pubsub.setevent', $api_parameters);
        } catch (Exception $ex) {
            return new Aphront400Response();
        }
        return $this->setHTMLResponse();
    }

    public function setHTMLResponse() {
        return new PubSubResponse();
    }
    public function loadProject() {
        $project = id(new PhabricatorProjectQuery())
            ->setViewer(PhabricatorUser::getOmnipotentUser())
            ->withIDs(array($this->projectID))
            ->executeOne();
        return $project;
    }

}
