<?php

require_once(dirname(__FILE__) . "/../models/setting.php");

class SettingsService {

    public const GAME_NAME = 'GAME_NAME';
    public const GAME_OWNER = 'GAME_NAME';
    public const GAME_DESCRIPTION = 'GAME_DESCRIPTION';
    public const PAYPAL = 'PAYPAL';
    public const ID1_NAME = 'ID1_NAME';
    public const CRON_CODE = 'CRON_CODE';

    public static function get_game_name() {
        return Setting::objects()->get(self::GAME_NAME)->value;
    }

    public static function get_game_owner() {
        return Setting::objects()->get(self::GAME_OWNER)->value;
    }

    public static function get_game_description() {
        return Setting::objects()->get(self::GAME_DESCRIPTION)->value;
    }

    public static function get_paypal() {
        return Setting::objects()->get(self::PAYPAL)->value;
    }

    public static function get_id1_name() {
        return Setting::objects()->get(self::ID1_NAME)->value;
    }

    public static function get_cron_code() {
        return Setting::objects()->get(self::CRON_CODE)->value;
    }
}