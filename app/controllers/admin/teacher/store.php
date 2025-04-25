<?php 
use App\Models\Teacher;
use App\Models\User;

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$id_number = $_POST['id_number'];
$email = $_POST['email'];
$subject_id = $_POST['subject_id'];
$password = $_POST['password'];

if (empty($first_name) || empty($last_name) || empty($id_number) || empty($email) || empty($subject_id) || empty($password)) {
    $_SESSION['error'] = 'All fields are required';
    redirect('/management?section=teacher');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = 'Invalid email format';
    redirect('/management?section=teacher');
}

if (strlen($password) < 8) {
    $_SESSION['error'] = 'Password must be at least 8 characters';
    redirect('/management?section=teacher');
}

if (User::where('email', '=', $email)->first()) {
    $_SESSION['error'] = 'Email already exists';
    redirect('/management?section=teacher');
}

User::create([
    'first_name' => $first_name,
    'last_name' => $last_name,
    'email' => $email,
    'password' => password_hash($password, PASSWORD_DEFAULT),
    'role' => 'teacher'
]);

$user = User::where('email', '=', $email)->get();

Teacher::create([
    'id_number' => $id_number,
    'subject_id' => $subject_id,
    'user_id' => $user['id']
]);

$_SESSION['success'] = 'Teacher created successfully';
redirect('/management?section=teacher');