<?php
/*
MCCodes FREE
inventory.php Rev 1.1.0
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
require_once(dirname(__FILE__) . "/services/inventory_service.php");
$user = User::get($userid);
require "header.php";
$h = new Header();
$h->startheaders();
include "mysql.php";
global $c;
$user->check_level();
$h->userdata($user);
$h->menuarea();


$inventory = InventoryService::get_inventory_for_user($user);
if (InventoryService::count_user_items($user) == 0)
{
    print "<b>You have no items!</b>";
}
else
{
    print
            "<b>Your items are listed below.</b><br />
<table width=100%><tr style='background-color:gray;'><th>Item</th><th>Sell Value</th><th>Total Sell Value</th><th>Links</th></tr>";
    $lt = "";
    foreach($inventory as $inv_item) {
        if ($lt != $inv_item->item->item_type->name)
        {
            $lt = $inv_item->item->item_type->name;
            print
                    "\n<tr style='background: gray;'><th colspan=4>{$lt}</th></tr>";
        }
        print "<tr><td>{$inv_item->item->name}";
        if ($inv_item->quantity > 1)
        {
            print "&nbsp;x{$inv_item->quantity}";
        }
        print "</td><td>\${$inv_item->item->sell_price}</td><td>";
        print "$" . ($inv_item->item->sell_price * $inv_item->quantity);
        print
                "</td><td>[<a href='iteminfo.php?ID={$inv_item->item->id}'>Info</a>] [<a href='itemsend.php?ID={$inv_item->id}'>Send</a>] [<a href='itemsell.php?ID={$inv_item->id}'>Sell</a>] [<a href='imadd.php?ID={$inv_item->id}'>Add To Market</a>]";
        if ($inv_item->item->item_type->name == 'Food' || $inv_item->item->item_type->name == 'Medical')
        {
            print " [<a href='itemuse.php?ID={$inv_item->id}'>Use</a>]";
        }
        if ($inv_item->item->name == 'Nuclear Bomb')
        {
            print " [<a href='nuclearbomb.php'>Use</a>]";
        }
        print "</td></tr>";
    }
    print "</table>";
}
$h->endpage();
