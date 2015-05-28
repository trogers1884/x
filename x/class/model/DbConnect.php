<?php
/** 
 * Class to make database connections.
 * @author J.C. Thomas Rogers III
 * @version 0.50
 * @version created 2015-04-30
 * @version last updated: 2015-05-03
 * @copyright (c) 2015, J.C. Thomas Rogers III
 */

class DbConnect
{
    private $dbConnect;
    private $dbError;

    /**
     * @param String $prmDsn - connection string for PDO DB driver specific 
     * @param String $prmUser - user for the database access 
     * @param String $prmPwd - password for app access to database
     */
    public function __construct(
            $prmDsn
            , $prmUser
            , $prmPwd
        ) 
    {
        try {
            $this->dbConnect = new PDO ($prmDsn, $prmUser, $prmPwd);
        } catch (Exception $e) {
            echo 'connection failed: ' . $e->getMessage();
        }
    }
    
    public function dbQuery($prmSQL)
    {
 //       $dbConnect = $this->dbConnect;
        $rs = $this->dbConnect->query($prmSQL);
        $dbErr = $this->dbConnect->errorInfo();
        if( isset($dbErr[1]) ) {
            echo '<div>PDO::errorInfo(): ' .
            print_r($dbErr, true) . '</div>';
        }   else {
            return $rs;
        }
    }
    
    public function dbQuote($prmString)
    {
        return $this->dbConnect->quote($prmString);
    }
    
}
