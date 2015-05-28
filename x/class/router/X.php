<?php
/**
* Class to manage X framework operation.
 * @author J.C. Thomas Rogers III
 * @version 0.50
 * @version created 2015-04-30
 * @version last updated: 2015-05-10
 * @copyright (c) 2015, J.C. Thomas Rogers III
 
 */
class X
{
    protected $session;
    protected $instance;
    protected $page;
    protected $property;
 
    function __construct()
    {
        $this->session = new Session();
        $this->instance = new Instance($this->session->getSessionId());
        $this->property['sessionId'] = $this->session->getSessionId();
        $this->property['instanceId'] = $this->instance->getInstanceId();
        $this->property['get'] = filter_input_array(INPUT_GET);
        $this->property['post'] = filter_input_array(INPUT_POST);
        $this->page = new PageTest($this->property);
        print $this->page->getHtml();
    }
}




