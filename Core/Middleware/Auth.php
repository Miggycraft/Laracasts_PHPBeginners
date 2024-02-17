<?php

namespace Core\Middleware;

class Auth
{
    public function handle()
    {
        if (empty($_SESSION['user']) ?? false) {
            header('location: /');
            exit();
        }
    }
}
