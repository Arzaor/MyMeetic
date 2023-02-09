<?php

namespace App\controllers;

require_once('App/model/User.php');
require_once('App/model/Hobby.php');

use App\model\HobbyRepository;
use App\model\UserRepository;

class Search
{
    public function execute() {
        $hobbyRepository = new hobbyRepository();
        $getHobbies = $hobbyRepository->getHobbies();
        require ('templates/search.php');
    }
}