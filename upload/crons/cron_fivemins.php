<?php

require_once(dirname(__FILE__) . "/../mysql.php");
require_once(dirname(__FILE__) . "/../global_func.php");
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
// update for all users
$allusers_query =
        "UPDATE `users`
        SET `brave` = LEAST(`brave` + ((`maxbrave` / 10) + 0.5), `maxbrave`),
        `hp` = LEAST(`hp` + (`maxhp` / 3), `maxhp`),
        `will` = LEAST(`will` + 10, `maxwill`)";
mysqli_query($c, $allusers_query);
//enerwill update
$en_nd_query =
        "UPDATE `users`
        SET `energy` = LEAST(`energy` + (`maxenergy` / 12.5), `maxenergy`)
        WHERE `donatordays` = 0";
$en_don_query =
        "UPDATE `users`
        SET `energy` = LEAST(`energy` + (`maxenergy` / 6), `maxenergy`)
        WHERE `donatordays` > 0";
mysqli_query($c, $en_nd_query);
mysqli_query($c, $en_don_query);
