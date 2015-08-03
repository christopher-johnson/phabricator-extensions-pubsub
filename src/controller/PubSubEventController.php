<?php

final class PubSubEventController
    extends PubSubController {

    private $projectID;

    public function handleRequest(AphrontRequest $request) {
        try {
        $this->projectID = $request->getURIData('id');
        $data = $request->getPassthroughRequestData();
        $base_uri     = PhabricatorEnv::getEnvConfig('phabricator.base-uri');
        $api_token = PubSubConstants::API_TOKEN;
        $api_parameters =  array(
            'project' => $this->loadProject($this->projectID)->getPHID(),
            'data' => $data
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
}
