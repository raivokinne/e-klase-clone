<?php

namespace Core\Middleware;

class Admin
{
    public function handle()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            throw new \Exception("User is not an admin");
        }
    }
}
