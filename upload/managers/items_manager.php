<?php

require_once(dirname(__FILE__) . "/base_manager.php");
require_once(dirname(__FILE__) . "/../models/item.php");

class ItemsManager extends BaseManager
{
    protected static $pkfield = "itmid";
    protected static $tablename = "items";
    protected static $default_order_by = "itmid";

    public function get($pk)
    {
        return Item::from_mysqli_array(parent::get($pk));
    }

    public function all($order_by = "", $order_dir = "")
    {
        $results = parent::all($order_by, $order_dir);
        $all_item_types = [];
        foreach ($results as $r) {
            array_push($all_item_types, Item::from_mysqli_array($r));
        }
        return $all_item_types;
    }

    public function insert($item)
    {
        $tablename = self::$tablename;
        $pkfield = self::$pkfield;
        $item_id = $item->id ? $item->id : NULL;
        $item_type = $item->item_type->id;
        $query = "INSERT INTO {$tablename} 
            ({$pkfield}, itmtype, itmname, itmdesc, itmbuyprice, itmsellprice, itmbuyable) 
            VALUES ($item_id, {$item_type}, '{$item->name}', '{$item->description}', {$item->buy_price}, {$item->sell_price}, {$item->buyable});";
        parent::no_result_query($query);
    }

    public function update($item)
    {
        $tablename = self::$tablename;
        $pkfield = self::$pkfield;
        $item_id = $item->id;
        $item_type = $item->item_type->id;
        $item_name = $item->name;
        $item_desc = $item->description;
        $query = "UPDATE {$tablename} 
            SET itmtype={$item_type}, itmname='{$item_name}', itmdesc='{$item_desc}', itmbuyprice={$item->buy_price}, itmsellprice={$item->sell_price}, itmbuyable={$item->buyable} 
            WHERE {$pkfield}={$item_id};";
        parent::no_result_query($query);
    }
}
