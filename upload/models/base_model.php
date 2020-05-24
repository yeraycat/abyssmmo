<?php

abstract class BaseModel {
    protected static $pkfield;
    protected static $tablename;

    public static abstract function from_mysqli_array($mysqli_array);

    public static abstract function objects();

    public function save() {
        if ($this->id && static::objects()->exists($this->id)) {
            static::objects()->update($this);
        } else {
            static::objects()->insert($this);
        }
    }

    public abstract function delete() {
        static::objects()->delete($this->id);
    };
}