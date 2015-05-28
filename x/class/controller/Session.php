<?php
/** 
 * Class to manage application sessions.
 * @author J.C. Thomas Rogers III
 * @version 0.5
 * @version created 2015-05-03
 * @version last updated 2015-05-03
 * @copyright (c) 2015, J.C. Thomas Rogers III
 */
class Session 
{
    protected $dbx;
    protected $sessionId;
   
    public function __construct() 
    {
        $this->setDbx();
        $this->setSessionId();
    }
    public function getSessionId()
    {
        return $this->sessionId;
    }
    
    public function setDbx(){
        $prmDsn = 'pgsql:dbname=x;host=localhost';
        $prmUser = 'app';
        $prmPwd = 'app';
        try {
            $this->dbx = new DbConnect($prmDsn, $prmUser, $prmPwd);
        } catch (Exception $e){
            echo 'connection failed: ' . $e->getMessage();
        }
    }
       
    public function setSessionId()
    {
        $this->sessionId = filter_input(INPUT_COOKIE,'PHPSESSID', FILTER_CALLBACK, array('options' => '\X\Blf\validateSessionId'));
        if($this->sessionId == ''){
            header('Location: ' . \X\Blc\REDIRECTSECURE);
        }  else {
            // register this session in the application
            $sessionId = $this->getSessionId();
            if($this->isValidSession($sessionId)){
                $this->updateSessionRcd($sessionId);
            }   else {
                $this->createSessionRcd($sessionId);
            }
        } 
    }
    
    public function isValidSession($sessionId)
    {
        $quotedSessionId = $this->dbx->dbQuote($sessionId);
        $pst = file_get_contents(\X\Blc\FILEPATH . 'fw/sql/pst_isValidSession.sql');
        $sql = "EXECUTE pst_isvalidsession({$quotedSessionId})";        
        $this->dbx->dbQuery($pst);
        $rs = $this->dbx->dbQuery($sql);
        $knt = 0;
        foreach($rs as $row){
            $knt = isset($row['knt']) ? $row['knt'] : 0;
            return $knt;
        }
    }
    public function createSessionRcd($sessionId)
    {
        $quotedSessionId = $this->dbx->dbQuote($sessionId);
        $pst = file_get_contents(\X\Blc\FILEPATH . 'fw/sql/pst_createSessionRcd.sql');
        $sql = "EXECUTE pst_createsessionrcd ({$quotedSessionId})";
        $this->dbx->dbQuery($pst);
        $this->dbx->dbQuery($sql);
    }

    public function updateSessionRcd($sessionId)
    {
        $quotedSessionId = $this->dbx->dbQuote($sessionId);
        $pst = file_get_contents(\X\Blc\FILEPATH . 'fw/sql/pst_updateSessionRcd.sql');
        $sql = "EXECUTE pst_updatesessionrcd ({$quotedSessionId})";
        $this->dbx->dbQuery($pst);
        $this->dbx->dbQuery($sql);
    }
}
