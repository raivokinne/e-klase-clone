<?php

use App\Models\User;
use Core\Session;

$user = User::where('id', '=', $_SESSION['user']['id'])->get();

$info_errors = Session::get('info-errors');
$password_errors = Session::get('password-errors');
$delete_errors = Session::get('delete-errors');

view('profile/edit', [
    'title' => 'Profile',
    'user' => $user,
    'info_errors' => $info_errors,
    'password_errors' => $password_errors,
    'delete_errors' => $delete_errors
]);
