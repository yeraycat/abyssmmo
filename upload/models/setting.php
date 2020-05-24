<?php

require_once(dirname(__FILE__) . "/../mysql.php");
require_once(dirname(__FILE__) . "/base_model.php");
require_once(dirname(__FILE__) . "/../managers/settings_manager.php");

class Setting extends BaseModel {

    public $id;
    public $value;

    public function __construct($id, $value) {
        $this->id = $id;
        $this->value = $value;
    }

    public static function from_mysqli_array($mysqli_array)
    {
        return new Setting($mysqli_array['settingID'], $mysqli_array['settingVALUE']);
    }

    public static function objects() {
        return new SettingsManager();   
    }

}