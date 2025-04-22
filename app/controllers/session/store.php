<?php

use App\Models\User;
use Core\Authenticator;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];

if (empty($email) || empty($password)) {
    $errors['empty'] = 'Field cannot be empty';
}

if (!Validator::email($email)) {
    $errors['email'] = 'Email must be a valid email';
}

$user = User::where('email', '=', $email)->get();

if (!$user) {
    $errors['user'] = 'User does not exist';
    if (count($errors) > 0) {
        return view(
            'auth/login',
            [
                'title' => 'Login',
                'errors' => $errors
            ]
        );
    }
} else {
    (new Authenticator())->attempt($email, $password);

    redirect('/');
}
