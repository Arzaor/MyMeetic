<?php
$db = new PDO('mysql:host=127.0.0.1:8889;dbname=meetic;charset=utf8', 'root', 'root');

if (isset($_POST['cities'])) {
    $updateCities = [];
    foreach ($_POST['cities'] as $city) {
        $updateCities[] = "'" . $city . "'";
    }
}
if (isset($_POST['hobbies'])) {
    $updateHobbies = [];
    foreach ($_POST['hobbies'] as $hobby) {
        $updateHobbies[] = "'" . $hobby . "'";
    }
}

$select = 'SELECT users.id, users.firstname, users.lastname, users.age FROM users_hobbies RIGHT JOIN users ON users.id = users_hobbies.id_user LEFT JOIN hobbies ON hobbies.id = users_hobbies.id_hobby WHERE ';
if ($_POST['sexe'] != -1) {
    $select .= 'sexe = ? ';
}

if ($_POST['age'] == 0) {
    if ($_POST['sexe'] != -1) {
        $select .= 'AND ';
    }
    $select .= '(age >= 18 AND age <= 25) ';
} else if ($_POST['age'] == 1) {
    if ($_POST['sexe'] != -1) {
        $select .= 'AND ';
    }
    $select .= '(age >= 25 AND age <= 35) ';
} else if ($_POST['age'] == 2) {
    if ($_POST['sexe'] != -1) {
        $select .= 'AND ';
    }
    $select .= '(age >= 35 AND age <= 45) ';
} else if ($_POST['age'] == 3) {
    if ($_POST['sexe'] != -1) {
        $select .= 'AND ';
    }
    $select .= '(age > 45) ';
}

if (isset($updateCities) && count($updateCities) > 0) {
    if ($_POST['sexe'] != -1 || $_POST['age'] != -1) {
        $select .= 'AND ';
    }
    $select .= 'city IN (' . implode(',', $updateCities) . ') ';
}

if (isset($updateHobbies) && count($updateHobbies) > 0) {
    if ($_POST['sexe'] != -1 || $_POST['age'] != -1 || (isset($updateCities) && count($updateCities) > 0)) {
        $select .= 'AND ';
    }
    $select .= 'users_hobbies.id_hobby IN (' . implode(',', $updateHobbies) . ') ';
}

if ($_POST['sexe'] != -1 || $_POST['age'] != -1 || (isset($updateCities) && count($updateCities) > 0) || (isset($updateHobbies) && count($updateHobbies) > 0)) {
    $select .= 'AND ';
}

$select .= ' suspended = ? GROUP BY users.id';
$statement = $db->prepare($select);
if ($_POST['sexe'] != -1) {
    $statement->execute([$_POST['sexe'], 0]);
} else {
    $statement->execute([0]);
}

echo json_encode($statement->fetchAll());