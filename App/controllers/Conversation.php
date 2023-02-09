<?php

namespace App\Controllers;

require_once('App/model/User.php');
require_once('App/model/Conversation.php');

use App\model\ConversationRepository;
use App\model\MessagingRepository;
use App\model\UserRepository;

class Conversation
{
    public function execute(array $input)
    {
        $conversationRepository = new ConversationRepository();

        // On créait la conversation si le formulaire est envoyé
        if (isset($input['send'])) {
            if (!empty($input['message'])) {

            } else {
                $errors = "Vous devez";
            }
        }

        // Dans tous les cas on récupère la liste des conversations
        if ((isset($_GET['method']) && $_GET['method'] == "new") && isset($_GET['id_recipient'])) {
            $conversationById = $conversationRepository->getConversationById($_SESSION['user_id'], $_GET['id_recipient']);
            if (empty($conversationById)) {
                header('Location: index.php?action=conversation&method=read&id_conversation' . $conversationById['id']);
            } else {
                $firstnameByRecipient = $conversationRepository->firstnameByRecipient($_GET['id_recipient']);
            }
        } elseif ((isset($_GET['method']) && $_GET['method'] == "read") && isset($_GET['id_conversation'])) {
            // Dans ce cas précis :
                // Si une conversation avec l'id existe déjà
                    // On récupère la liste des messages appartenants à cette conversations
                // Sinon
                    // Au choix : on affiche une erreur ou on redirige
            echo "ok";
        }
        require('templates/conversation.php');
    }
}