<?php

use Core\App;
use Core\Validator;
use Core\Database;

$db = App::resolve(Database::class);
$errors = [];

if (!Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body cannot be more than 1,000 characters.';
}

if (empty($errors)) {
    $db->query('INSERT INTO notes  (body, user_id) VALUES (:body,:user_id)', [
        'body' => $_POST['body'],
        'user_id' => 1,
    ]);

    header('location: /notes');
    die();
}

view("notes/create.view.php", [
    "heading" => "Create a Note",
    'errors' => $errors,
]);
