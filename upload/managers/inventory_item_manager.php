<?php

require_once(dirname(__FILE__) . "/../models/inventory_item.php");
require_once(dirname(__FILE__) . "/base_manager.php");

class InventoryItemManager extends BaseManager {
    protected static $tablename = "inventory";
    protected static $pkfield = "inv_id";
    protected static $default_order_by = "inv_id";

    public function get($pk, $conditions=NULL, $prefetch=NULL)
    {
        $default_relationships = [
            ['tablenameA' => static::$tablename, 'tablenameB' => 'users', 'local_key'=> 'inv_userid', 'foreign_key' => 'userid'],
            ['tablenameA' => static::$tablename, 'tablenameB' => 'items', 'local_key'=> 'inv_itemid', 'foreign_key' => 'itmid']
        ];
        $prefetch = $prefetch && count($prefetch) ? array_merge($default_relationships, $prefetch) : $default_relationships;
        return InventoryItem::from_mysqli_array(parent::get($pk, NULL, $prefetch));
    }

    public function all($order_by = "", $order_dir = "", $conditions=NULL, $prefetch=NULL, $limit=NULL)
    {
        $default_relationships = [
            ['tablenameA' => static::$tablename, 'tablenameB' => 'users', 'local_key'=> 'inv_userid', 'foreign_key' => 'userid'],
            ['tablenameA' => static::$tablename, 'tablenameB' => 'items', 'local_key'=> 'inv_itemid', 'foreign_key' => 'itmid']
        ];
        $prefetch = $prefetch && count($prefetch) ? array_merge($default_relationships, $prefetch) : $default_relationships;
        $results = parent::all($order_by, $order_dir, $conditions, $prefetch, $limit);
        $all_inventory_items = [];
        foreach ($results as $r) {
            array_push($all_inventory_items, InventoryItem::from_mysqli_array($r));
        }
        return $all_inventory_items;
    }

    public function filter($filter_name, $params, $order_by="", $order_dir="", $limit=NULL) {
        $BY_USER = 'user';
        switch($filter_name) {
            case $BY_USER:
                return $this->filter_by_user($params['user_id'], $order_by, $order_dir, $limit);
            default:
                return $this->all($order_by, $order_dir, NULL, NULL, $limit);
        }
    }

    public function filter_by_user($user_id, $order_by="", $order_dir="", $limit=NULL) {
        $conditions = [['condition' => 'inventory.inv_userid=', 'value' => $user_id]];
        return $this->all($order_by, $order_dir, $conditions, NULL, $limit);
    }

    public function create_inventory_item($item, $user, $quantity) {
        return $this->create(new InventoryItem(NULL, $item, $user, $quantity));
    }

    public function insert($inventory_item)
    {
        $tablename = self::$tablename;
        $pkfield = self::$pkfield;
        $inventory_item_id = $inventory_item->id ? $inventory_item->id : NULL;
        $inventory_item_item = $inventory_item->item->id;
        $inventory_item_user = $inventory_item->user->id;
        $quantity = $inventory_item->quantity;
        $query = "INSERT INTO {$tablename} 
            ({$pkfield}, inv_itemid, inv_userid, inv_qty) 
            VALUES ({$inventory_item_id}, {$inventory_item_item}, {$inventory_item_user}, {$quantity});";
        parent::no_result_query($query);
    }

    public function update($inventory_item)
    {
        $tablename = self::$tablename;
        $pkfield = self::$pkfield;
        $inventory_item_id = $inventory_item->id;
        $inventory_item_item = $inventory_item->item->id;
        $inventory_item_user = $inventory_item->user->id;
        $quantity = $inventory_item->quantity;
        $query = "UPDATE {$tablename} 
            SET inv_itemid={$inventory_item_item}, inv_userid={$inventory_item_user}, inv_qty={$quantity} 
            WHERE {$pkfield}={$inventory_item_id};";
        parent::no_result_query($query);
    }
}