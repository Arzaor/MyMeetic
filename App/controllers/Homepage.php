<?php

namespace App\Controllers;

require_once('App/model/User.php');

use App\model\UserRepository;

class Homepage
{
    public function execute(array $input)
    {
        if (isset($input['connexion'])) {
            if (empty($input['email']) || empty($input['password'])) {
                $errors = "Tous les champs sont obligatoires.";
            } else {
                $userRepository = new UserRepository();
                $user = $userRepository->getUserByMailAndPassword($input['email'], $input['password']);
                if ($user) {
                    $_SESSION['user_id'] = $user['id'];
                    header('Location: index.php?action=search');
                } else {
                   $errors = "Vos identifiants n'ont pas été reconnus.";
                }
            }
        }
        require('templates/homepage.php');
    }
}
