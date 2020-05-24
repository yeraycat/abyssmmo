<?php

require_once(dirname(__FILE__) . "/base_service.php");
require_once(dirname(__FILE__) . "/../models/weapon.php");

class InventoryService extends BaseService {

    private $user;

    public function __construct($user) {
        $this->user = $user;
    }

    public function get_weapons() {
        $prefetch = [];
        Weapon::objects()->all('name', 'ASC', $prefetch);
    }
}