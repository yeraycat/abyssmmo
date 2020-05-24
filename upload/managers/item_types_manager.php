<?php

require_once(dirname(__FILE__) . "/base_manager.php");
require_once(dirname(__FILE__) . "/../models/item_type.php");

class ItemTypesManager extends BaseManager {
    protected static $pkfield = "itmtypeid";
    protected static $tablename = "itemtypes";
    protected static $default_order_by = "itmtypeid";
    
    public function get($pk) {
        return ItemType::from_mysqli_array(parent::get($pk));
    }

    public function all($order_by="", $order_dir="") {
        $results = parent::all($order_by, $order_dir);
        $all_item_types = [];
        foreach($results as $r) {
            array_push($all_item_types, ItemType::from_mysqli_array($r));
        }
        return $all_item_types;
    }

    public function insert($item_type) {
        $tablename = self::$tablename;
        $itemtype_id = $item_type->id ? $item_type->id : NULL;
        $itemtype_name = $item_type->name;
        $query = "INSERT INTO {$tablename} (itmtypeid, itmtypename) VALUES ($itemtype_id, '{$itemtype_name}');" ;
        parent::no_result_query($query);
    }

    public function update($item_type) {
        $tablename = self::$tablename;
        $pkfield = self::$pkfield;
        $itemtype_id = $item_type->id;
        $itemtype_name = $item_type->name;
        $query = "UPDATE {$tablename} SET itmtypename={$itemtype_name} WHERE {$pkfield}={$itemtype_id};";
        parent::no_result_query($query);
    }

}