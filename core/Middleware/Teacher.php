<?php
namespace Core\Middleware;

class Teacher
{
    public function handle()
    {
        if (! isset($_SESSION['user']) || $_SESSION['user']->role !== 'teacher') {
            $_SESSION['error'] = 'You must be logged in as a teacher to access this page';
            redirect('/login');
        }
    }
}
