<?php

namespace Core\Middleware;

use Core\Session;

class Admin
{
    public function handle()
    {
        if (!$_SESSION['user'] || $_SESSION['user']['role'] !== 'admin') {
            redirect('/');
        }
    }
}
