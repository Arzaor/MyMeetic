<?php
require 'vendor/autoload.php';
session_start();

use App\Controllers\Homepage;
use App\controllers\Logout;
use App\Controllers\Conversation;
use App\Controllers\newConversation;
use App\Controllers\Profil;
use App\Controllers\Register;
use App\controllers\Search;

function permission(int $id) {
    if ($id) {
        !(isset($_SESSION['user_id'])) ? header('Location: index.php') : null;
    } else {
        isset($_SESSION['user_id']) ? header('Location: index.php?action=search') : null;
    }
}

try {
    if (isset($_GET['action']) && $_GET['action'] !== '') {
        if ($_GET['action'] === 'homepage') {
            permission(0);
            (new Homepage())->execute($_POST);
        } else if ($_GET['action'] === 'register') {
            permission(0);
            (new Register())->execute($_POST);
        } else if ($_GET['action'] === 'search') {
            permission(1);
            (new Search())->execute($_POST);
        } else if ($_GET['action'] === 'conversation') {
            permission(1);
            (new Conversation())->execute($_POST);
        } else if ($_GET['action'] === 'profil') {
            permission(1);
            (new Profil())->execute($_POST);
        } else if ($_GET['action'] === 'logout') {
            (new Logout())->execute();
        } else {
            throw new Exception("La page que vous recherchez n'existe pas.");
        }
    } else {
        permission(0);
        (new Homepage())->execute($_POST);
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
}
