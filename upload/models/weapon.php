<?php

require_once(dirname(__FILE__) . "/item.php");
require_once(dirname(__FILE__) . "/item_type.php");
require_once(dirname(__FILE__) . "/../managers/weapons_manager.php");

class Weapon extends Item {
    public $damage;

    public function __construct($item_id, $item_type, $item_name, $item_description, $item_buy_price, $item_sell_price, $item_buyable, $weapon_damage) {
        $this->damage = $weapon_damage;
        parent::__construct($item_id, $item_type, $item_name, $item_description, $item_buy_price, $item_sell_price, $item_buyable);
    }

    public static function from_mysqli_array($r)
    {
        return new Weapon(
            $r['itmid'],
            ItemType::objects()->get($r['itmtype']),
            $r['itmname'],
            $r['itmdesc'],
            $r['itmbuyprice'],
            $r['itmsellprice'],
            $r['itmbuyable'],
            $r['damage']
        );
    }

    public static function objects() {
        return new WeaponsManager();
    }
}