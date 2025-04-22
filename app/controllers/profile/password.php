<?php

use App\Models\User;
use Core\Session;

$current_password = $_POST['current_password'];
$new_password = $_POST['password'];
$password_confirmation = $_POST['password_confirmation'];

$errors = [];

if (empty($current_password)) {
    $errors['current_password'] = 'Current password is required';
} else if (strlen($current_password) < 6) {
    $errors['current_password'] = 'Current password must be at least 6 characters';
} else if (strlen($current_password) > 255) {
    $errors['current_password'] = 'Current password must be at most 255 characters';
}

if (empty($new_password)) {
    $errors['password'] = 'New password is required';
} else if (strlen($new_password) < 6) {
    $errors['password'] = 'New password must be at least 6 characters';
} else if (strlen($new_password) > 255) {
    $errors['password'] = 'New password must be at most 255 characters';
}

if (empty($password_confirmation)) {
    $errors['password_confirmation'] = 'Password confirmation is required';
} else if ($new_password !== $password_confirmation) {
    $errors['password_confirmation'] = 'Passwords do not match';
}

$user = User::where('id', '=', $_SESSION['user']['id'])->first();

if (!password_verify($current_password, $user['password'])) {
    $errors['current_password'] = 'Current password is incorrect';
}

if (!empty($errors)) {
    Session::put('password-errors', $errors);
    redirect('/profile');
} else {
    User::update($id, ['password' => password_hash($new_password, PASSWORD_DEFAULT)]);
    redirect('/profile');
}
