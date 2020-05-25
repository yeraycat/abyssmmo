<?php

require_once(dirname(__FILE__) . "/../models/weapon.php");

class InventoryService {


    public function get_inventory_for_user() {
        
    }

    public function get_weapons() {
        $prefetch = [];
        Weapon::objects()->all('name', 'ASC', $prefetch);
    }
}