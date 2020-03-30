<?php
/*
MCCodes FREE
docrime.php Rev 1.1.0
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
require "header.php";
$h = new headers;
$h->startheaders();
include "mysql.php";
global $c;
$is = mysqli_query(
    $c,
    "SELECT u.*,us.* FROM users u LEFT JOIN userstats us ON u.userid=us.userid WHERE u.userid=$userid"
) or die(mysqli_error($c));
$ir = mysqli_fetch_array($is);

check_level();
$fm = money_formatter($ir['money']);
$cm = money_formatter($ir['crystals'], '');
$lv = date('F j, Y, g:i a', $ir['laston']);
$h->userdata($ir, $lv, $fm, $cm);
$h->menuarea();
$_GET['c'] = abs((int) $_GET['c']);
if (!$_GET['c']) {
    print "Invalid crime";
} else {
    $q = mysqli_query($c, "SELECT * FROM crimes WHERE crimeID={$_GET['c']}");
    if (mysqli_num_rows($q) == 0) {
        echo 'Invalid crime.';
        $h->endpage();
        exit;
    }
    $r = mysqli_fetch_array($q);
    if ($ir['brave'] < $r['crimeBRAVE']) {
        print "You do not have enough Brave to perform this crime.";
    } else {
        $ec =
                "\$sucrate="
                        . str_replace(array("LEVEL", "EXP", "WILL", "IQ"),
                                array($ir['level'], $ir['exp'], $ir['will'],
                                        $ir['IQ']), $r['crimePERCFORM']) . ";";
        eval($ec);
        print $r['crimeITEXT'];
        $ir['brave'] -= $r['crimeBRAVE'];
        mysqli_query(
            $c,
            "UPDATE users SET brave={$ir['brave']} WHERE userid=$userid"
        );
        if (rand(1, 100) <= $sucrate) {
            print
                    str_replace("{money}", $r['crimeSUCCESSMUNY'],
                            $r['crimeSTEXT']);
            $ir['money'] += $r['crimeSUCCESSMUNY'];
            $ir['exp'] += (int) ($r['crimeSUCCESSMUNY'] / 8);
            mysqli_query(
                $c,
                "UPDATE users SET money={$ir['money']},exp={$ir['exp']} WHERE userid=$userid"
            );
        } else {
            print $r['crimeFTEXT'];
        }
        print
                "<br /><a href='docrime.php?c={$_GET['c']}'>Try Again</a><br />
<a href='criminal.php'>Crimes</a>";
    }
}

$h->endpage();