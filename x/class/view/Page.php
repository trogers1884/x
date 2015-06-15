<?php
/**
* Class to display a basic page.
 * @author J.C. Thomas Rogers III
 * @version 0.50
 * @version created 2015-04-30
 * @version last updated: 2015-06-14
 * @copyright (c) 2015, J.C. Thomas Rogers III
 */

class Page
{
//    protected $x = 1;
    protected $sessionId;
    protected $instanceId;
    protected $get;
    protected $post;

    protected $html;
    protected $head;
    protected $body;
    
 //   protected $dbMgr = new PDO($dsn, $username, $passwd, $options);

    function __construct($property){
        $this->setSessionId($property['sessionId']);
        $this->setInstanceId($property['instanceId']);
        $this->setGet($property['get']);
        $this->setGet($property['post']);

        $this->setHead();
        $this->setBody();
        $this->setHtml();
    }
    
    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;
    }
    public function getSessionId()
    {
        return $this->sessionId;
    }
    public function setInstanceId($instanceId)
    {
        $this->instanceId = $instanceId;
    }
    public function getInstanceId()
    {
        return $this->instanceId;
    }

    public function setGet($get)
    {
        if(isset($get)){
            $this->get = $get;
        }
    }
    public function getGet()
    {
        return $this->get;
    }     
    
    public function setPost($post){
        if(isset($post)){
            $this->post = $post;
        }
    }
    public function getPost()
    {
        return $this->post;
    }     
    
    public function setHead()
    {
        $this->head = '<head>' .
                '<title>Page Title</title>' .
                '</head>';
    }
    public function getHead()
    {
        return $this->head;
    }
    public function getBody()
    {
        return $this->body;
    }
    public function getHtml()
    {
        return $this->html;
    }
    public function setBody()
    {
        $this->body = '<body>' . 
                $this->getSessionId() . '<br>' .
                $this->getInstanceId() . '<br>' .
                'This is the page body</body>';
        $this->body .= '<br>' .
                '\X\Blc\SERVERNAME: ' . \X\Blc\SERVERNAME . '<br>' .
                '\X\Blc\FILEPATH: ' . \X\Blc\FILEPATH . '<br>' .
                '\X\Blc\WEBROOT: ' . \X\Blc\WEBROOT . '<br>' .
                '\X\Blc\PATH: ' . \X\Blc\PATH . '<br>' .
                '\X\Blc\HTTPADDRESS: ' . \X\Blc\HTTPADDRESS . '<br>' .
                '\X\Blc\HTTPSADDRESS: ' . \X\Blc\HTTPSADDRESS . '<br>' .
                '';
        $this->body .= '<br>';
        foreach($this->getGet() as $getKey => $getValue){
            $this->body .= "GET: {$getKey}: {$getValue}<br>"; 
        }
        foreach($this->getPost() as $postKey => $postValue){
            $this->body .= "Post: {$postKey}: {$postValue}<br>"; 
        }
    }

    public function setHtml()
    {
        $this->html = '<!DOCTYPE html>' . 
                '<html lang="en">' .
                $this->getHead() .
                $this->getBody() .
                '</html>';
    }
}

