<?php

namespace Core\Middleware;

class Guest
{
    public function handle()
    {
        if (!empty($_SESSION['user']) ?? false) {
            header('location: /');
            exit();
        }
    }
}
