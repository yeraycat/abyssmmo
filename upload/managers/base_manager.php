<?php

require_once(dirname(__FILE__) . "/../mysql.php");

abstract class BaseManager {
    protected static $pkfield;
    protected static $tablename;
    protected static $default_order_by;
    protected static $default_order_dir = "ASC";

    public function get($pk) {
        global $c;
        $tablename = static::$tablename;
        $pkfield = static::$pkfield;
        $query = "SELECT * FROM {$tablename} WHERE {$pkfield}={$pk};";
        $q = mysqli_query($c, $query) or die(mysqli_error($c));
        $r = mysqli_fetch_array($q);
        mysqli_free_result($q);
        return $r;
    }

    public function exists($pk) {
        global $c;
        $tablename = static::$tablename;
        $pkfield = static::$pkfield;
        $query = "SELECT * FROM {$tablename} WHERE {$pkfield}={$pk};";
        $q = mysqli_query(
            $c,
            $query
        );
        $num_rows = mysqli_num_rows($q);
        mysqli_free_result($q);
        return $num_rows != 0;
    }

    public function all($order_by="", $order_dir="") {
        global $c;
        $order_by = $order_by ? $order_by : static::$default_order_by;
        $order_dir = $order_dir ? $order_dir : static::$default_order_dir;
        $tablename = static::$tablename;
        $query = "SELECT * FROM {$tablename} ORDER BY {$order_by} {$order_dir};";
        $q = mysqli_query($c, $query) or die(mysqli_error($c));
        $result = [];
        while ($r = mysqli_fetch_array($q))
        {
            array_push($result, $r);
        }
        mysqli_free_result($q);
        return $result;
    }

    // public static abstract function filter($type, $options=NULL);

    public static function query($query) {
        global $c;
        $q = mysqli_query($c, $query) or die(mysqli_error($c));
        $result = [];
        while ($r = mysqli_fetch_array($q))
        {
            array_push($result, $r);
        }
        mysqli_free_result($q);
        return $result;
    }

    public static function no_result_query($query) {
        global $c;
        $q = mysqli_query($c, $query) or die(mysqli_error($c));
        mysqli_free_result($q);
    }

    public abstract function insert($object);

    public abstract function update($object);

    public function delete($pk) {
        global $c;
        $tablename = static::$tablename;
        $pkfield = static::$pkfield;
        $query = "DELETE FROM {$tablename} WHERE {$pkfield}={$pk};";
        $q = mysqli_query($c, $query) or die(mysqli_error($c));
        mysqli_free_result($q);
    }
}
