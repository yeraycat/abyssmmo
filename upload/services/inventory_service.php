<?php

require_once(dirname(__FILE__) . "/../models/weapon.php");
require_once(dirname(__FILE__) . "/../models/inventory_item.php");

class InventoryService {

    public function get_inventory_for_user($user) {
        return InventoryItem::objects()->filter_by_user($user->id);
    }

    public function get_weapons_for_user() {
        $prefetch = [
            ['tablenameA' => 'weapons', 'local_key' => 'item_id'],
            ['tablenameB' => 'weapons', 'local_key' => 'item_id'],
        ];
        Weapon::objects()->all('name', 'ASC', $prefetch);
    }

    public function get_medicines_for_user($user) {

    }

    public function get_food_for_user($user) {

    }
}