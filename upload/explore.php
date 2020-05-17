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

$GAME_NAME = Setting::get('GAME_NAME')->value;

$user->check_level();
$tresder = (int) rand(100, 999);

include(dirname(__FILE__) . "/views/explore.php");