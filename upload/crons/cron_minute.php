<?php

require_once(dirname(__FILE__) . "/../mysql.php");
require_once(dirname(__FILE__) . "/../services/settings_service.php");

$cron_code = SettingsService::get_cron_code();
if ($argc == 2)
{
    if ($argv[1] != $cron_code)
    {
        exit;
    }
}
else if (!isset($_GET['code']) || $_GET['code'] !== $cron_code)
{
    exit;
}
mysqli_query($c, "UPDATE users SET hospital=hospital-1 WHERE hospital>0");

