<?php
namespace App\model;

require_once('App/lib/Database.php');

use App\Lib\Database\DatabaseConnection;

class ConversationRepository
{
    public DatabaseConnection $connection;

    public function __construct() {
        $this->connection = new DatabaseConnection();
    }

    public function getConversationById(int $user_id, int $id_recipient)
    {
        $statement = $this->connection->getConnection()->prepare(
            'SELECT * FROM conversations, users WHERE (id_sender = ? AND id_recipient = ?) OR (id_recipient = ? AND id_sender = ?)'
        );
        $statement->execute([$user_id, $id_recipient, $user_id, $id_recipient]);

        return $statement->fetch();
    }

    public function firstnameByRecipient(int $id_recipient)
    {
        $statement = $this->connection->getConnection()->prepare(
            'SELECT * FROM users WHERE id = ?'
        );
        $statement->execute([$id_recipient]);

        return $statement->fetch();
    }
}