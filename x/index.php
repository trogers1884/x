<?php
session_start();
include 'baseline/constants.php';
$header = 'Location: ' . \X\Blc\REDIRECTSECURE . 'x.php';
header($header);
exit();
//print 'Hello worldz';

