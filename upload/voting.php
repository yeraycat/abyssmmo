<?php

session_start();

if ($_SESSION['loggedin'] == 0)
{
    header("Location: login.php");
    exit;
}

require_once(dirname(__FILE__) . "/models/setting.php");
require_once(dirname(__FILE__) . "/models/user.php");

$userid = $_SESSION['userid'];
$user = User::get($userid);
$user->check_level();

include(dirname(__FILE__) . "/views/voting.php");