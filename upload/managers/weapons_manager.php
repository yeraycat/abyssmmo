<?php

require_once(dirname(__FILE__) . "/base_manager.php");
require_once(dirname(__FILE__) . "/items_manager.php");

class WeaponsManager extends ItemsManager {
    protected static $foreign_key = "item_id";

    public function get($pk, $prefetch=NULL) {
        $default_relationships = [['tablenameA'=> static::$tablename, 'tablenameB' => 'weapons', 'local_key'=> static::$pkfield, 'foreign_key' => static::$foreign_key]];
        $prefetch = $prefetch && count($prefetch) ? array_merge($default_relationships, $prefetch) : $default_relationships;
        return Weapon::from_mysqli_array(BaseManager::get($pk, $prefetch));
    }

    public function filter($filter_name, $params, $order_by="", $order_dir="", $limit=NULL) {
        switch($filter_name) {
            default:
                return $this->all($order_by, $order_dir, NULL, NULL, $limit);
        }
    }

    public function create_weapon($item_type, $item_name, $item_description, $item_buy_price, $item_sell_price, $item_buyable, $damage) {
        return $this->create(new Weapon(NULL, $item_type, $item_name, $item_description, $item_buy_price, $item_sell_price, $item_buyable, $damage));
    }

    public function insert($weapon) {
        $specific_tablename = "weapons";
        $generic_tablename = self::$tablename;
        $pkfield = self::$pkfield;
        $foreign_key = self::$foreign_key;
        $item_id = $weapon->id ? $weapon->id : NULL;
        $item_type = $weapon->item_type->id;
        $query = "INSERT INTO {$generic_tablename} 
            ({$pkfield}, itmtype, itmname, itmdesc, itmbuyprice, itmsellprice, itmbuyable) 
            VALUES ($item_id, {$item_type}, '{$weapon->name}', '{$weapon->description}', {$weapon->buy_price}, {$weapon->sell_price}, {$weapon->buyable});";
        parent::no_result_query($query);
        $query = "INSERT INTO {$specific_tablename} 
            ({$foreign_key}, damage) 
            VALUES ($item_id, {$weapon->damage});";
        parent::no_result_query($query);
    }

    public function update($weapon) {
        $specific_tablename = "weapons";
        $generic_tablename = self::$tablename;
        $pkfield = self::$pkfield;
        $foreign_key = self::$foreign_key;
        $item_id = $weapon->id;
        $item_type = $weapon->item_type->id;
        $item_name = $weapon->name;
        $item_desc = $weapon->description;
        $query = "UPDATE {$generic_tablename} 
            SET itmtype={$item_type}, itmname='{$item_name}', itmdesc='{$item_desc}', itmbuyprice={$weapon->buy_price}, itmsellprice={$weapon->sell_price}, itmbuyable={$weapon->buyable} 
            WHERE {$pkfield}={$item_id};";
        parent::no_result_query($query);
        $query = "UPDATE {$specific_tablename} 
            SET damage={$weapon->damage}
            WHERE {$foreign_key}={$item_id};";
        parent::no_result_query($query);
    }

    
}