<?php
/*
MCCodes FREE
index.php Rev 1.1.0
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
require "global_func.php";
if ($_SESSION['loggedin'] == 0)
{
    header("Location: login.php");
    exit;
}
$userid = $_SESSION['userid'];
require_once(dirname(__FILE__) . "/models/user.php");
$user = User::get($userid);


$user->check_level();
$fm = money_formatter($user->money);
$cm = money_formatter($user->crystals, '');
$exp = (int) ($user->exp / $user->get_exp_needed() * 100);
$ts = $user->user_stats->strength + $user->user_stats->agility
        + $user->user_stats->guard + $user->user_stats->labour
        + $user->user_stats->IQ;
$formatted_stats = [];
$formatted_stats['strank'] = get_rank($user->user_stats->strength, 'strength');
$formatted_stats['agirank'] = get_rank($user->user_stats->agility, 'agility');
$formatted_stats['guarank'] = get_rank($user->user_stats->guard, 'guard');
$formatted_stats['labrank'] = get_rank($user->user_stats->labour, 'labour');
$formatted_stats['IQrank'] = get_rank($user->user_stats->IQ, 'IQ');
$tsrank = get_rank($ts, 'strength+agility+guard+labour+IQ');
$formatted_stats['strength'] = number_format($user->user_stats->strength);
$formatted_stats['agility'] = number_format($user->user_stats->agility);
$formatted_stats['guard'] = number_format($user->user_stats->guard);
$formatted_stats['labour'] = number_format($user->user_stats->labour);
$formatted_stats['IQ'] = number_format($user->user_stats->IQ);
$ts = number_format($ts);

include(dirname(__FILE__) . "/views/home.php");

