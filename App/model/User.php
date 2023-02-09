<?php
namespace App\model;

require_once('App/lib/Database.php');

use App\Lib\Database\DatabaseConnection;

class UserRepository
{
    public DatabaseConnection $connection;

    public function __construct() {
        $this->connection = new DatabaseConnection();
    }

    public function getUserByMail(string $email)
    {
        $statement = $this->connection->getConnection()->prepare(
            'SELECT * FROM users WHERE email = ?'
        );
        $statement->execute([$email]);
        return $statement->fetch();
    }

    public function createUser(string $lastname, string $firstname, string $birthday, int $age, int $sexe, string $city, string $email, string $password): bool
    {
        $statement = $this->connection->getConnection()->prepare(
          'INSERT INTO users(lastname, firstname, birthday, age, sexe, city, email, password) VALUES(?, ?, ?, ?, ?, ?, ?, ?)'
        );
        $affectedLines = $statement->execute([$lastname, $firstname, $birthday, $age, $sexe, $city, $email, sha1($password)]);

        return ($affectedLines > 0);
    }

    public function getUserByMailAndPassword(string $email, string $password)
    {
        $statement = $this->connection->getConnection()->prepare(
            'SELECT * FROM users WHERE email = ? AND password = ? AND suspended = ?'
        );
        $statement->execute([$email, sha1($password), 0]);
        return $statement->fetch();
    }

    public function updateUserEmail(string $email, int $id): bool
    {
        $statement = $this->connection->getConnection()->prepare(
          'UPDATE users SET email = ? WHERE id = ?'
        );
        $affectedLine = $statement->execute([$email, $id]);

        return ($affectedLine > 0);
    }

    public function getUserById(int $id)
    {
        $statement = $this->connection->getConnection()->prepare(
            'SELECT * FROM users WHERE id = ?'
        );
        $statement->execute([$id]);
        return $statement->fetch();
    }

    public function getUserByPassword(string $password, int $id)
    {
        $statement = $this->connection->getConnection()->prepare(
            'SELECT * FROM users WHERE id = ? AND password = ?'
        );
        $statement->execute([$id, sha1($password)]);
        return $statement->fetch();
    }

    public function udpateUserPassword(string $password, int $id)
    {
        $statement = $this->connection->getConnection()->prepare(
          'UPDATE users SET password = ? WHERE id = ?'
        );
        $affectedLine = $statement->execute([sha1($password), $id]);

        return ($affectedLine > 0);
    }

    public function deleteUserById(int $id): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'UPDATE users SET suspended = ? WHERE id = ?'
        );
        $affectedLine = $statement->execute([1, $id]);

        return ($affectedLine > 0);
    }

    public function addHobbyToUser(int $id, string $hobby)
    {
        $statement = $this->connection->getConnection()->prepare(
            'INSERT INTO users_hobbies(id_user, id_hobby) VALUES(?, ?)'
        );
        $statement->execute([$id, $hobby]);
    }
}