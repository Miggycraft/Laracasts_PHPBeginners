<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);

$user = $db->query('select * from users where email = :email', [
    'email' => Session::get('user')['email'],
])->find();

if (empty($user)) {
    // connected but email not existed idk how
    redirect('/');
}

$notes = $db->query('select * from notes where user_id = :user_id', [
    'user_id' => $user['id']
])->findAll();

view("notes/index.view.php", [
    "heading" => "My Notes",
    'notes' => $notes
]);
