<?php

namespace Core\Middleware;

class Teacher
{
    public function handle()
    {
        if (!$_SESSION['user'] || $_SESSION['user']->role !== 'teacher') {
            redirect('/');
        }
    }
}
