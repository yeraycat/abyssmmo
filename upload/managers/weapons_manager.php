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
}