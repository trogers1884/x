<?php
/** 
 * Class create a instance identity.
 * @author J.C. Thomas Rogers III
 * @version 0.5
 * @version created 2015-05-04
 * @version last updated 2015-05-10
 * @copyright (c) 2015, J.C. Thomas Rogers III
 */
class Instance 
{
    protected $dbx;
    protected $sessionId;
    protected $instanceId;
    
    public function __construct($sessionId)
    {
        $this->setDbx();
        $this->sessionId = $sessionId;
        $this->instanceId = UUID::generate(UUID::UUID_RANDOM,UUID::FMT_STRING);
        $this->setInstance($this->getSessionId(), $this->getInstanceId());
    }
    public function getInstanceId()
    {
        return $this->instanceId;
    }
    public function getSessionId()
    {
        return $this->sessionId;
    }

    public function setDbx()
    {
        $prmDsn = 'pgsql:dbname=x;host=localhost';
        $prmUser = 'app';
        $prmPwd = 'app';
        try {
            $this->dbx = new DbConnect($prmDsn, $prmUser, $prmPwd);
        } catch (Exception $e){
            echo 'connection failed: ' . $e->getMessage();
        }
    }
     
    public function setInstance($sessionId, $instanceId)
    {
        if($this->instanceExists($sessionId,$instanceId)){
            $this->updateInstanceRcd($sessionId,$instanceId);
        }   else {
            $this->createInstanceRcd($sessionId,$instanceId);
        }
    }

    public function instanceExists($sessionId,$instanceId)
    {
        $quotedSessionId = $this->dbx->dbQuote($sessionId);
        $quotedInstanceId = $this->dbx->dbQuote($instanceId);
        $pst = file_get_contents(\X\Blc\FILEPATH . 'fw/sql/pst_instanceExists.sql');
        $sql = "EXECUTE pst_instanceexists ({$quotedSessionId},{$quotedInstanceId})";
        $this->dbx->dbQuery($pst);
        $rs = $this->dbx->dbQuery($sql);
        $exists = 0;
        foreach($rs as $row){
            $exists = isset($row['instance_exists']) ? $row['instance_exists'] : 0;
            return $exists;
        }
    }
    
    public function createInstanceRcd($sessionId, $instanceId)
    {
        $quotedSessionId = $this->dbx->dbQuote($sessionId);
        $quotedInstanceId = $this->dbx->dbQuote($instanceId);
        $pst = file_get_contents(\X\Blc\FILEPATH . 'fw/sql/pst_createInstanceRcd.sql');
        $sql = "EXECUTE pst_createinstancercd ({$quotedSessionId},{$quotedInstanceId})";
        $this->dbx->dbQuery($pst);
        $this->dbx->dbQuery($sql);
    }
    
    public function updateInstanceRcd($sessionId, $instanceId)
    {
        $quotedSessionId = $this->dbx->dbQuote($sessionId);
        $quotedInstanceId = $this->dbx->dbQuote($instanceId);
        $pst = file_get_contents(\X\Blc\FILEPATH . 'fw/sql/pst_updateInstanceRcd.sql');
        $sql = "EXECUTE pst_updateinstancercd ({$quotedSessionId},{$quotedInstanceId})";
        $this->dbx->dbQuery($pst);
        $this->dbx->dbQuery($sql);
    }
    
    
}