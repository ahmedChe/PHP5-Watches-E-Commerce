<?php
/**
 * Created by PhpStorm.
 * User: !l-PazZ0
 * Date: 03/01/2016
 * Time: 23:58
 */
include ("../Include/Session.php");
$session->detruire();
header("location:index.php");
?>