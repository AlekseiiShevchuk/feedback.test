<?php

namespace app;

use app\traits\Singleton;

class Db
{
    use Singleton;

    protected $dbh;

    protected function __construct()
    {
        $this->dbh = new \PDO("mysql:host=localhost;dbname=feedbacks", 'root', '');
    }

    public function execute($sql, $params = [])
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($params);
        return $res;
    }

    public function query($sql, $params, $class)
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($params);
        if (false !== $res) {
            return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
        }
        return [];
    }
}