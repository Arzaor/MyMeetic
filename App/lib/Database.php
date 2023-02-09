<?php

namespace App\Lib\Database;

class DatabaseConnection
{
    public ?\PDO $database = null;

    public function getConnection(): \PDO
    {
        if ($this->database === null) {
            $this->database = new \PDO('mysql:host=127.0.0.1:8889;dbname=meetic;charset=utf8', 'root', 'root');
        }
        return $this->database;
    }
}
