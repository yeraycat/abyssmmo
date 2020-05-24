<?php

require_once(dirname(__FILE__) . "/../mysql.php");
require_once(dirname(__FILE__) . "/base_model.php");
require_once(dirname(__FILE__) . "/../managers/item_types_manager.php");

class ItemType extends BaseModel {

    public static $FOOD = 1;
    public static $MELEE_WEAPON = 3;
    public static $GUN = 4;
    public static $MEDICAL = 5;
    public static $ARMOUR = 7;

    public $id;
    public $name;

    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }

    public static function from_mysqli_array($r) {
        return new ItemType(
            $r[self::$pkfield],
            $r['itmtypename']
        );
    }

    public static function objects() {
        return new ItemTypesManager();
    }

    public function delete() {
        self::objects()->delete($this->id);
    }

}