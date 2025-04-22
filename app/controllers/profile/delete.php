<?php

use App\Models\Booking;
use App\Models\User;
use Core\Session;

$currentPassword = $_POST['current-password'];

$errors = [];

if (empty($currentPassword)) {
    $errors['current-password'] = 'Current password is required';
}

$user = User::where('id', '=', $_SESSION['user']['id'])->get();

if (!password_verify($currentPassword, $user['password'])) {
    $errors['current-password'] = 'Current password is incorrect';
}

if (!empty($errors)) {
    Session::put('delete_errors', $errors);
    redirect('/profile');
}

Booking::deleteByUser($user['id']);
User::delete($user['id']);
redirect('/logout');
