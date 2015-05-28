<?php
namespace X\Blf;

/** 
 * Filter Callback Functions for PHP script
 * @author Tom Rogers
 * @version 2015-05-03
 * @copyright (c) 2015, J.C. Thomas Rogers III
 */

function validateSessionId ($value)
{
    $rtnValue = isset($value) ? $value : '';
    return $rtnValue;
}
