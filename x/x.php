<?php
/** 
 * The loader for the X framework
 * @author J.C. Thomas Rogers III
 * @version 0.50
 * @version created 2015-04-30
 * @version last updated: 2015-05-03
 * @copyright (c) 2015, J.C. Thomas Rogers III
 */
session_start();
include 'baseline/constants.php';
include 'baseline/filterCallback.php';
include 'class/autoloader.php';
$_x = new X();
