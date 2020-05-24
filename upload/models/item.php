<?php

require_once(dirname(__FILE__) . "/../mysql.php");
require_once(dirname(__FILE__) . "/base_model.php");
require_once(dirname(__FILE__) . "/item_type.php");
require_once(dirname(__FILE__) . "/../managers/items_manager.php");

class Item extends BaseModel {

    public $id;
    public $item_type;
    public $name;
    public $descrpition;
    public $buy_price;
    public $sell_price;
    public $buyable;

    public function __construct($id, $item_type, $name, $description, $buy_price, $sell_price, $buyable) {
        $this->id = $id;
        $this->item_type = $item_type;
        $this->name = $name;
        $this->description = $description;
        $this->buy_price = $buy_price;
        $this->sell_price = $sell_price;
        $this->buyable = $buyable;
    }

    public static function from_mysqli_array($r) {
        return new Item(
            $r['itmid'],
            ItemType::objects()->get($r['itmtype']),
            $r['itmname'],
            $r['itmdesc'],
            $r['itmbuyprice'],
            $r['itmsellprice'],
            $r['itmbuyable']
        );
    }

    public static function objects() {
        return new ItemsManager();
    }

    public function is_buyable() {
        return !!$this->buyable;
    }

    public function is_food() {
        return $this->item_type->id == ItemType::$FOOD;
    }

    public function is_weapon() {
        $item_type_id = $this->item_type->id;
        return $item_type_id == ItemType::$MELEE_WEAPON || $item_type_id == ItemType::$GUN;
    }

    public function is_medical() {
        return $this->item_type->id == ItemType::$MEDICAL;
    }

    public function is_armour() {
        return $this->item_type->id == ItemType::$ARMOUR;
    }

}