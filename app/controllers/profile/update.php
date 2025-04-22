<?php

use App\Models\User;
use Core\Session;

$name = $_POST['name'];
$email = $_POST['email'];

$errors = [];

if (empty($name)) {
    $errors['name'] = 'Name is required';
} else if (strlen($name) > 255) {
    $errors['name'] = 'Name must be at most 255 characters';
} else if (strlen($name) < 3) {
    $errors['name'] = 'Name must be at least 3 characters';
}

if (empty($email)) {
    $errors['email'] = 'Email is required';
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Email is invalid';
}

if (!empty($errors)) {
    Session::put('info-errors', $errors);
    redirect('/profile');
} else {
    User::update($id, ['name' => $name, 'email' => $email]);
    redirect('/profile');
}
