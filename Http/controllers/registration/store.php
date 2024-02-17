<?php

use Core\Validator;
use Core\App;
use Core\Database;
use Core\Authenticator;

$email = $_POST['email'];
$password = $_POST['password'];
// validating inputs
$errors = [];
if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address.';
}

if (!Validator::string($password, 7, 255)) {
    $errors['password'] = 'Password must be atleast 7 characters long';
}

if (!empty($errors)) {
    view(
        'registration/create.view.php',
        [
            'errors' => $errors
        ]
    );
}

$db = App::resolve(Database::class);

// checking if the email already exists
$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();

if ($user) {
    // user is already exists
    header('location: /');
    exit();
} else {
    // successful
    $db->query('INSERT INTO users(email, password) VALUES (:email, :password)', [
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
    ]);

    // mark that the user is already logged in
    $_SESSION['user'] = [
        'email' => $email,
    ];

    (new Authenticator)->login(
        [
            'email' => $email,
        ]
    );

    header('location: /');
    exit();
}
