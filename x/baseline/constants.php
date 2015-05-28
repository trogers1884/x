<?php
namespace X\Blc;

/** 
 * Constants definitions
 * @author J.C. Thomas Rogers III
 * @version 0.5
 * @version created 2015-05-10
 * @version last updated 2015-05-10
 * @copyright (c) 2015, J.C. Thomas Rogers III
 */

$serverName = filter_input(INPUT_SERVER,'SERVER_NAME');
$phpSelf = filter_input(INPUT_SERVER,'PHP_SELF');
$webPathInfo = pathinfo($phpSelf,PATHINFO_DIRNAME);
       
$prcWebRoot = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');
$xWebRoot = substr($prcWebRoot,-1) == '/' ? substr($prcWebRoot,0,-1) : $prcWebRoot ;
$xFilePath = "{$xWebRoot}{$webPathInfo}/";
$redirect = "http://{$serverName}{$webPathInfo}/";
$redirectSecure = "https://{$serverName}{$webPathInfo}/";

if($serverName == '54.200.143.217'){
    $redirect = "http://ec2-54-200-143-217.us-west-2.compute.amazonaws.com{$webPathInfo}/";
    $redirectSecure = "https://ec2-54-200-143-217.us-west-2.compute.amazonaws.com{$webPathInfo}/";
}

define(__NAMESPACE__ . '\SERVERNAME',$serverName);
define(__NAMESPACE__ . '\FILEPATH', $xFilePath);
define(__NAMESPACE__ . '\WEBROOT', "{$xWebRoot}/");
define(__NAMESPACE__ . '\PATH', $webPathInfo);
define(__NAMESPACE__ . '\HTTPADDRESS', "http://{$serverName}{$webPathInfo}/");
define(__NAMESPACE__ . '\HTTPSADDRESS', "https://{$serverName}{$webPathInfo}/");
define(__NAMESPACE__ . '\REDIRECT', $redirect);
define(__NAMESPACE__ . '\REDIRECTSECURE', $redirectSecure);

