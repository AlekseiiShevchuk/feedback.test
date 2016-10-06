<?php

namespace app;

use app\traits\Policy;

abstract class Model
{
    const TABLE = '';

    public $id;

    public static function findAll($orderBy = null)
    {
        $db = Db::instance();
        $sql = 'SELECT * FROM ' . static::TABLE;
        if (!Policy::isAdmin()) {
            $sql .= ' WHERE valid = 1';
        }
        if($orderBy){
            $sql.= ' ORDER BY ' . $orderBy;
        }

        return $db->query($sql, [], static::class
        );
    }

    public static function findById($id)
    {
        $db = Db::instance();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE id=:id';
        return $db->query($sql, [':id' => $id], static::class)[0];
    }

    public function isNew()
    {
        return empty($this->id);
    }

    public function insert()
    {

        if (!$this->isNew()) {
            return;
        }

        $columns = [];
        $values = [];
        foreach ($this as $k => $v) {
            if ('id' == $k) {
                continue;
            }
            $columns[] = $k;
            $values[':' . $k] = $v;
        }

        $sql = 'INSERT INTO ' . static::TABLE . '
                (' . implode(',', $columns) . ')
                VALUES
                (' . implode(',', array_keys($values)) . ')
                 ';

        $db = Db::instance();
        $db->execute($sql, $values);

    }


}