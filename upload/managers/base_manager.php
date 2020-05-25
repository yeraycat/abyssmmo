<?php

require_once(dirname(__FILE__) . "/../mysql.php");

abstract class BaseManager {
    protected static $pkfield;
    protected static $tablename;
    protected static $default_order_by;
    protected static $default_order_dir = "ASC";

    public function get($pk, $conditions=NULL, $prefetch=NULL, $string_id=false) {
        global $c;
        $tablename = static::$tablename;
        $prefetch = $prefetch && count($prefetch) ? $this->generate_joins($prefetch) : '';
        $pkfield = static::$pkfield;
        $pkfield = $prefetch ? "{$tablename}.{$pkfield}" : $pkfield;
        $pk = $string_id ? "'".$pk."'" : $pk;
        $conditions = $conditions && count($conditions) ? $this->generate_where($conditions) : "WHERE {$pkfield}={$pk}";
        $query = "SELECT * FROM {$tablename} {$prefetch} {$conditions};";
        $q = mysqli_query($c, $query) or die(mysqli_error($c));
        $r = mysqli_fetch_array($q);
        mysqli_free_result($q);
        return $r;
    }

    public function get_last_id() {
        global $c;
        return mysqli_insert_id($c);
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

    public function all($order_by="", $order_dir="", $conditions=NULL, $prefetch=NULL, $limit=NULL) {
        global $c;
        $tablename = static::$tablename;
        $prefetch = $prefetch && count($prefetch) ? $this->generate_joins($prefetch) : '';
        $order_by = $order_by ? $order_by : static::$default_order_by;
        $order_dir = $order_dir ? $order_dir : static::$default_order_dir;
        $order_by = $prefetch ? "{$tablename}.{$order_by}" : $order_by;
        $conditions = $conditions && count($conditions) ? $this->generate_where($conditions) : "";
        $limit = $limit ? "LIMIT " . $limit : "";
        $query = "SELECT * FROM {$tablename} {$prefetch} {$conditions} ORDER BY {$order_by} {$order_dir} {$limit};";
        $q = mysqli_query($c, $query) or die(mysqli_error($c));
        $result = [];
        while ($r = mysqli_fetch_array($q))
        {
            array_push($result, $r);
        }
        mysqli_free_result($q);
        return $result;
    }

    public function create($object) {
        $this->insert($object);
        return $this->get(parent::get_last_id());
    }

    public function delete($pk) {
        global $c;
        $tablename = static::$tablename;
        $pkfield = static::$pkfield;
        $query = "DELETE FROM {$tablename} WHERE {$pkfield}={$pk};";
        $q = mysqli_query($c, $query) or die(mysqli_error($c));
        mysqli_free_result($q);
    }

    public abstract function filter($filter_name, $params, $order_by, $order_dir, $limit);

    public abstract function insert($object);

    public abstract function update($object);

    protected function generate_joins($prefetch) {
        $result = "";
        foreach($prefetch as $p) {
            $tablenameA = $p['tablenameA'];
            $tablenameB = $p['tablenameB'];
            $keyA = $p['local_key'];
            $keyB = $p['foreign_key'];
            $join = "LEFT JOIN {$tablenameB} ON {$tablenameA}.{$keyA}={$tablenameB}.{$keyB} ";
            $result = $result . $join;
        }
        
        return $result;
    }

    protected function generate_where($conditions) {
        $result = "WHERE";
        foreach($conditions as $condition) {
            if (isset($condition['logical_operator'])) {
                $result .= " " . $condition['logical_operator'];
            }
            $result .= " " . $condition['condition'] . $condition['value'];
        }
        return $result;
    }

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
}
