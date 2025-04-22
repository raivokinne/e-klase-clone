<?php

namespace App\controllers\register;

use Core\Validator;
use App\Models\User;
use Core\Authenticator;

$username = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirmation = $_POST['password_confirmation'];

$errors = [];

if (empty($username) || empty($email) || empty($password) || empty($password_confirmation)) {
    $errors['empty'] = 'Field cannot be empty';
}

if (!Validator::string($username)) {
    $errors['username'] = 'Username must be a string';
}

if (!Validator::email($email)) {
    $errors['email'] = 'Email must be a valid email';
}

if (!Validator::checkLength($username, min: 3)) {
    $errors['username'] = 'Username must be at least 3 characters';
}

if (!Validator::checkLength($password, min: 8)) {
    $errors['password'] = 'Password must be at least 8 characters';
}

if (!$password === $password_confirmation) {
    $errors['password_confirmation'] = 'Passwords do not match';
}

$user = User::where('email', '=', $email)->get();

if ($user) {
    $errors['email'] = 'Email already registered';
    return view('auth/register', ['errors' => $errors]);
} else {
    $user = User::create([
        'name' => $username,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'role' => 'user',
    ])->get();

    (new Authenticator())->login($user);

    redirect('/login');
}
