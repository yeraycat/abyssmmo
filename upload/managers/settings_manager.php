<?php

require_once(dirname(__FILE__) . "/base_manager.php");
require_once(dirname(__FILE__) . "/../models/setting.php");

class SettingsManager extends BaseManager {
    protected static $pkfield = "settingID";
    protected static $tablename = "settings";
    protected static $default_order_by = "settingID";

    public function get($pk, $prefetch=NULL) {
        return Setting::from_mysqli_array(parent::get($pk, NULL, $prefetch, true));
    }

    public function create_setting($id, $value) {
        return $this->create(new Setting($id, $value));
    }

    public function all($order_by="", $order_dir="", $prefetch = NULL) {
        $results = parent::all($order_by, $order_dir, $prefetch);
        $all_item_types = [];
        foreach($results as $r) {
            array_push($all_item_types, Setting::from_mysqli_array($r));
        }
        return $all_item_types;
    }

    public function insert($setting) {
        $tablename = self::$tablename;
        $setting_id = $setting->id;
        $setting_value = $setting->value;
        $query = "INSERT INTO {$tablename} (settingID, settingVALUE) VALUES ($setting_id, '{$setting_value}');" ;
        parent::no_result_query($query);
    }

    public function update($setting) {
        $tablename = self::$tablename;
        $pkfield = self::$pkfield;
        $setting_id = $setting->id;
        $setting_value = $setting->value;
        $query = "UPDATE {$tablename} SET settingVALUE={$setting_value} WHERE {$pkfield}={$setting_id};";
        parent::no_result_query($query);
    }

    public function filter($filter_name, $params, $order_by="", $order_dir="", $limit=NULL) {
        switch($filter_name) {
            default:
                return $this->all($order_by, $order_dir, NULL, NULL, $limit);
        }
    }

}