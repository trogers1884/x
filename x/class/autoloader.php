<?php
/**
* Class autoloader
 * @author J.C. Thomas Rogers III
 * @version 0.50
 * @version created 2015-05-04
 * @version last updated: 2015-05-10
 * @copyright (c) 2015, J.C. Thomas Rogers III
 */
spl_autoload_register(function ($class) {
    if($class == 'DbConnect'){
        require_once('class/model/DbConnect.php');
    }   else {
        require_once('class/model/DbConnect.php');
        $prmDsn = 'pgsql:dbname=x;host=localhost';
        $prmUser = 'app';
        $prmPwd = 'app';
        try {
           $dbx = new DbConnect($prmDsn, $prmUser, $prmPwd);
        } catch (Exception $e){
           echo 'connection failed: ' . $e->getMessage();
        }
        $quotedClass = $dbx->dbQuote($class);
        $pst = file_get_contents(\X\Blc\FILEPATH . 'fw/sql/pst_autoload.sql');
        $sql = "EXECUTE pst_autoload({$quotedClass})";
        $dbx->dbQuery($pst);
        $rs = $dbx->dbQuery($sql);
        foreach($rs as $row){
            $arrClass[] = $row['classcontainer'];
        }
        foreach($arrClass as $container){
            $requestedClass = 'class/' . $container . '/' . $class . '.php';
            if( file_exists($requestedClass) ){
                require_once($requestedClass);
                break;
            }
        }
    }
});


