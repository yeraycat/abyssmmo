<?php

require_once(dirname(__FILE__) . "/base_manager.php");
require_once(dirname(__FILE__) . "/items_manager.php");

class WeaponsManager extends ItemsManager {
    protected static $foreign_key = "item_id";

    public function get($pk, $prefetch=NULL) {
        $default_relationships = [['tablename' => 'weapons', 'local_key'=> static::$pkfield, 'foreign_key' => static::$foreign_key]];
        $prefetch = $prefetch && count($prefetch) ? array_merge($default_relationships, $prefetch) : $default_relationships;
        return Weapon::from_mysqli_array(BaseManager::get($pk, $prefetch));
    }
}