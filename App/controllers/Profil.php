<?php

namespace App\Controllers;

require_once('App/model/User.php');
require_once('App/model/Hobby.php');

use App\model\HobbyRepository;
use App\model\UserRepository;

class Profil
{
    public function execute(array $input)
    {
        $userRepository = new UserRepository();
        $user = $userRepository->getUserById($_SESSION['user_id']);

        $hobbyRepository = new HobbyRepository();
        $hobbies = $hobbyRepository->getHobbiesByUser($_SESSION['user_id']);

        if (isset($input['updateEmail'])) {
            if (empty($input['email'])) {
                $errors = "Vous devez indiquer votre nouvel adresse email.";
            } else {
                $userByMail = $userRepository->getUserByMail($input['email']);
                if ($userByMail) {
                    $errors = "Un compte utilise déjà cette adresse email.";
                } else {
                    $success = $userRepository->updateUserEmail($input['email'], $_SESSION['user_id']);
                    if (!$success) {
                        $errors = "Une erreur est survenue lors de la modification de votre adresse email.";
                    } else {
                        header('Location: index.php?action=profil');
                    }
                }
            }
        }

        if (isset($input['updatePassword'])) {
            if (empty($input['oldPassword']) || empty($input['password'])) {
                $errors = "Vous devez indiquer tous les champs du formulaire.";
            } else {
                $userByPassword = $userRepository->getUserByPassword($input['oldPassword'], $_SESSION['user_id']);
                if (!$userByPassword) {
                    $errors = "Votre ancien mot de passe ne correspond pas.";
                } else {
                    $success = $userRepository->udpateUserPassword($input['password'], $_SESSION['user_id']);
                    if (!$success) {
                        $errors = "Une erreur est survenue lors de la modification de votre mot de passe.";
                    } else {
                        header('Location: index.php?action=profil');
                    }
                }
            }
        }

        if (isset($_GET['id'])) {
            if ($_GET['id'] == $_SESSION['user_id']) {
                $userDelete = $userRepository->deleteUserById($_GET['id']);
                if ($userDelete) {
                    header('Location: index.php?action=logout');
                } else {
                    $errors = "Une erreur est survenue lors de la suppresion de votre compte.";
                }
            } else {
                $errors = "Une erreur est survenue lors de la suppresion de votre compte.";
            }
        }
        require('templates/profil.php');
    }
}