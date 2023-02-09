<?php
namespace App\model;

require_once('App/lib/Database.php');

use App\Lib\Database\DatabaseConnection;

class HobbyRepository
{
    public DatabaseConnection $connection;

    public function __construct() {
        $this->connection = new DatabaseConnection();
    }

    public function getHobbies(): array
    {
        $statement = $this->connection->getConnection()->prepare(
            'SELECT * FROM hobbies'
        );
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getHobbiesByUser(int $id)
    {
        $statement = $this->connection->getConnection()->prepare(
            'SELECT * FROM users_hobbies LEFT JOIN users ON users_hobbies.id_user = users.id LEFT JOIN hobbies ON users_hobbies.id_hobby = hobbies.id WHERE users.id = ?'
        );
        $statement->execute([$id]);
        return $statement->fetchAll();
    }

    public function getLastHobby()
    {
        $statement = $this->connection->getConnection()->prepare(
            'SELECT * FROM hobbies ORDER BY id DESC LIMIT 1'
        );
        $statement->execute();
        return $statement->fetch();
    }

    public function createHobby(string $inputHobby)
    {
        $statement = $this->connection->getConnection()->prepare(
          'INSERT INTO hobbies(name) VALUES(?)'
        );
        $affectedLines = $statement->execute([$inputHobby]);

        return ($affectedLines > 0);
    }
}