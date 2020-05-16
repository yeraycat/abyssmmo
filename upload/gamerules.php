<?php
/*
MCCodes FREE
gamerules.php Rev 1.1.0
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
include "mysql.php";


if ($_SESSION['loggedin'] == 0)
{
    header("Location: login.php");
    exit;
}

require_once(dirname(__FILE__) . "/global_func.php");
require_once(dirname(__FILE__) . "/models/setting.php");
require_once(dirname(__FILE__) . "/models/user.php");


$GAME_NAME = Setting::get('GAME_NAME')->value;
$ID1_NAME = Setting::get('ID1_NAME')->value;

$userid = $_SESSION['userid'];
$user = User::get($userid);
$user->check_level();

include(dirname(__FILE__) . "/views/game_rules.php");
