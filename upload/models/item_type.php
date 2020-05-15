<?php

require_once(dirname(__FILE__) . "/../mysql.php");

class ItemType {

    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }

    public static function create_from_mysqli_array($r) {
        return new ItemType(
            $r['itmtypeid'],
            $r['itmtypename']
        );
    }

    public static function get_all($order_by='itmtypeid', $order_dir='ASC') {
        global $c;
        $query = "SELECT * FROM itemtypes ORDER BY {$order_by} {$order_dir}";
        $q = mysqli_query(
            $c,
            $query
        ) or die(mysqli_error($c));
        $result = [];
        while ($r = mysqli_fetch_array($q))
        {
            array_push($result, self::create_from_mysqli_array($r));
        }
        mysqli_free_result($q);
        return $result;
    }

    public static function exists($id) {
        global $c;
        $query = "SELECT * FROM itemtypes WHERE itmtypeid={$id}";
        $q = mysqli_query(
            $c,
            $query
        );
        $num_rows = mysqli_num_rows($q);
        mysqli_free_result($q);
        return $num_rows != 0;
    }
}