<?php

abstract class PubSubController extends PhabricatorController {

  public function shouldAllowPublic() {
    return true;
  }

  public function buildNavMenu() {
    $nav = id(new AphrontSideNavFilterView())
        ->setBaseURI(new PhutilURI($this->getApplicationURI()))
        ->addLabel(pht('PubSub Events'))
        ->addFilter('list', pht('List'));
    return $nav;
  }

  protected function buildEventsTimeline(
      PhabricatorApplicationTransactionInterface $object,
      PhabricatorApplicationTransactionQuery $query,
      PhabricatorMarkupEngine $engine = null,
      $render_data = array()) {

    $viewer = $this->getRequest()->getUser();
    $xaction = $object->getApplicationTransactionTemplate();
    $view = $xaction->getApplicationTransactionViewObject();

    $pager = id(new AphrontCursorPagerView())
        ->readFromRequest($this->getRequest())
        ->setURI(new PhutilURI(
            '/transactions/showolder/'.$object->getPHID().'/'));

    $xactions = $query
        ->setViewer($viewer)
        ->needComments(true)
        ->executeWithCursorPager($pager);

    $xactions = array_reverse($xactions);
    $events = array();
    $parser = new PhutilJSONParser();
    if ($engine) {
      foreach ($xactions as $xaction) {
        if ($xaction->getComment()) {
          $engine->addObject(
              $xaction->getComment(),
              PhabricatorApplicationTransactionComment::MARKUP_FIELD_COMMENT);
        }
        if ($xaction->getNewValue()) {
          $events[] = json_decode($xaction->getNewValue(), true);
          }
      }
      $engine->process();
      $view->setMarkupEngine($engine);
    }
    return $events;
    //$timeline = $view
    //->setUser($viewer)
    //->setObjectPHID($object->getPHID())
    //->setTransactions($xactions)
    // ->setPager($pager)
    //->setRenderData($render_data)
    //->setQuoteTargetID($this->getRequest()->getStr('quoteTargetID'))
    // ->setQuoteRef($this->getRequest()->getStr('quoteRef'));
    //$object->willRenderTimeline($timeline, $this->getRequest());

    //return $timeline;
  }

  public function loadProject($projectID) {
    $project = id(new PhabricatorProjectQuery())
        ->setViewer(PhabricatorUser::getOmnipotentUser())
        ->withIDs(array($projectID))
        ->executeOne();
    return $project;
  }
}
