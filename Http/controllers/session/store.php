<?php

use Core\App;
use Core\Authenticator;
use Core\Database;
use Http\Forms\LoginForm;
use Core\Session;

$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

$form = (LoginForm::validate(
    [
        'email' => $email,
        'password' => $password,
    ]
));

$auth = new Authenticator();

if ($auth->attempt($email, $password)) {
    redirect('/');
}

if ($auth->wrong_email) {
    $form->addError('email', 'No matching email found');
}

if ($auth->wrong_pass) {
    $form->addError('password', 'Password is incorrect!');
}

Session::flash('errors', $form->getErrors());
return redirect('/login');
