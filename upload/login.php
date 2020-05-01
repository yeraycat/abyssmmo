<?php
/*
MCCodes FREE
login.php Rev 1.1.0
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
require_once(dirname(__FILE__) . "/global_func.php");
require_once(dirname(__FILE__) . "/models/setting.php");
require_once(dirname(__FILE__) . "/views/template/header_component.php");
$GAME_NAME = Setting::get('GAME_NAME')->value;
$GAME_OWNER = Setting::get('GAME_OWNER')->value;
$GAME_DESCRIPTION = Setting::get('GAME_DESCRIPTION')->value;

$ip = ($_SERVER['REMOTE_ADDR']);
if (file_exists('ipbans/' . $ip))
{
    die(
            "<b><span style='color: red; font-size: 120%'>
            Your IP has been banned, there is no way around this.
            </span></b>
            </body></html>");
}

require_once(dirname(__FILE__) . "/views/login.php");

