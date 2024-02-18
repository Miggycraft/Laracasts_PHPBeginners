<?php

namespace Core;

use Core\Database;
use Core\App;

class Authenticator
{
    protected $user;
    public $wrong_pass = false;
    public $wrong_email = false;

    public function attempt($email, $password)
    {
        $this->user = App::resolve(Database::class)->query(
            'select * from users where email = :email',
            [
                'email' => $email
            ]
        )->find();

        if ($this->user) {
            if (password_verify($password, $this->user['password'])) {
                $this->login([
                    'email' => $email,
                ]);

                // success
                return true;
            }

            // wrong password
            $this->wrong_pass = true;
            return false;
        }

        // no existing email
        $this->wrong_email = true;
        return false;
    }

    public function login($user)
    {
        session_regenerate_id();
        
        Session::put('user', [
            'email'=> $user['email'],
        ]);

    }

    public function logout()
    {
        Session::destroy();
    }
}
