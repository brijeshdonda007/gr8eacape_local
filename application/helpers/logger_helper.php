<?php
/**
 * Created by PhpStorm.
 * User: eftakhairul
 * Date: 5/11/14
 * Time: 2:46 AM
 */

function doLog($text, $path = null)
{
    // open log file
    $logFileName = empty($path)? "/system_log.text" : $path . "/system_log.text";
    $logger = fopen($logFileName, "a") or die("Could not open log file.");

    fwrite($logger, date("d-m-Y, H:i")." - $text\n") or die("Could not write file!");
    fclose($logger);
}

function emailLogger($to, $subejct, $body)
{
    $logText = '  ||Email address: '.$to.'  ||Subject length: ' . strlen($subejct) . '  ||message length: '.strlen($body);
    doLog($logText, APPPATH .'/logs');
}