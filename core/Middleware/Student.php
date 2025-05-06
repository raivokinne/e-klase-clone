<?php

namespace Core\Middleware;

class Student
{
    public function handle()
    {
        if (!$_SESSION['user'] || $_SESSION['user']->role !== 'student') {
            redirect('/');
        }
    }
}
