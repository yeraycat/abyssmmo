<?php
/*
MCCodes FREE
loggedin.php Rev 1.1.0
Copyright (C) 2005-2012 Dabomstew

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

session_start();


if ($_SESSION['loggedin'] == 0)
{
    header("Location: login.php");
    exit;
}
$userid = $_SESSION['userid'];
require "global_func.php";
include "mysql.php";
require_once(dirname(__FILE__) . "/models/user.php");
require_once(dirname(__FILE__) . "/models/paper_content.php");
require_once(dirname(__FILE__) . "/services/settings_service.php");

$GAME_NAME = SettingsService::get_game_name();
$user = User::get($userid);
require "header.php";
$h = new Header();
$h->startheaders();

global $c;

$user->check_level();
$h->userdata($user);
$h->menuarea();
print
        "<h1>You have logged on, {$user->username}!</h1>
<h2>Welcome back, your last visit was: {$user->get_last_visit()}.</h2>";
$content = PaperContent::get_paper_content()->content;
print "{$GAME_NAME} Latest News:<br />
$content
";
$h->endpage();
