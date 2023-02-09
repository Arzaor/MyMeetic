<?php
namespace App\Controllers;

require_once('App/model/User.php');
require_once('App/model/Hobby.php');

use App\model\HobbyRepository;
use App\model\UserRepository;

class Register
{
    private function validateForm(): array
    {
        $required = ['lastname', 'firstname', 'email', 'password', 'birthday'];
        $errors = [];
        foreach ($required as $field) {
            if (empty($input[$field])) {
                $errors[$field] = "$field is required";
            }
        }
        return $errors;
    }

    public function execute(array $input) {
        $hobbyRepository = new hobbyRepository();
        $userRepository = new UserRepository();

        if (isset($input['register'])) {
            $errors = $this->validateForm();

            if (!(isset($input['hobbies'])) && empty($input['inputHobby'])) {
                $errors['hobby'] = "Vous devez indiquer au minimum un loisir.";
            }

            if (!empty($input['birthday'])) {
                $diff = date_diff(date_create($input['birthday']), date_create(date("Y-m-d")));
                $age = $diff->format("%y");
                if (isset($age) && $age < 18) {
                    $errors['age'] = "Vous devez avoir minimum 18 ans pour vous inscrire.";
                }
            }

            if (!empty($input['email'])) {
                $user = $userRepository->getUserByMail($input['email']);
                if ($user) {
                    $errors['existUser'] = "User exist already";
                }
            }

            if (empty($errors)) {
                if (!empty($input['inputHobby'])) {
                    $hobbyRepository->createHobby($input['inputHobby']);
                }
                $userRepository->createUser($input['lastname'], $input['firstname'], $input['birthday'], $age, $input['sexe'], $input['city'], $input['email'], $input['password']);
                $user = $userRepository->getUserByMail($input['email']);
                if (empty($input['inputHobby'])) {
                    foreach ($input['hobbies'] as $hobby) {
                        $userRepository->addHobbyToUser($user['id'], $hobby);
                    }
                } else {
                    $hobby = $hobbyRepository->getLastHobby();
                    $userRepository->addHobbyToUser($user['id'], $hobby['id']);
                }
                header('Location: index.php');
            }
        }
        $hobbies = $hobbyRepository->getHobbies();
        require ('templates/register.php');
    }
}