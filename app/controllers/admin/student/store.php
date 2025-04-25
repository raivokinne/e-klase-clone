<?php 
use App\Models\Student;
use App\Models\User;

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$id_number = $_POST['id_number'];
$email = $_POST['email'];
$class = $_POST['class'];
$password = $_POST['password'];

if (empty($first_name) || empty($last_name) || empty($id_number) || empty($email) || empty($class) || empty($password)) {
    $_SESSION['error'] = 'All fields are required';
    redirect('/management?section=student');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = 'Invalid email format';
    redirect('/management?section=student');
}

if (strlen($password) < 8) {
    $_SESSION['error'] = 'Password must be at least 8 characters';
    redirect('/management?section=student');
}

if (User::where('email', '=', $email)->first()) {
    $_SESSION['error'] = 'Email already exists';
    redirect('/management?section=student');
}

User::create([
    'first_name' => $first_name,
    'last_name' => $last_name,
    'email' => $email,
    'password' => password_hash($password, PASSWORD_DEFAULT),
    'role' => 'student'
]);

$user = User::where('email', '=', $email)->get();

Student::create([
    'id_number' => $id_number,
    'class' => $class,
    'user_id' => $user['id']
]);

$_SESSION['success'] = 'Student created successfully';
redirect('/management?section=student');