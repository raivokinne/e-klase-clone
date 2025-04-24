<?php
use App\Models\User;
use Core\Session;

error_log("Session in profile/edit.php: " . json_encode($_SESSION));

if(!isset($_SESSION['user']) || !isset($_SESSION['user']['id'])) {
    header('Location: /login');
    exit();
}

$user = User::where('id', '=', $_SESSION['user']['id'])->get();

if (!$user) {
    error_log("User not found with ID: " . $_SESSION['user']['id']);
    header('Location: /login');
    exit();
}

$info_errors = Session::get('info-errors');
$password_errors = Session::get('password-errors');
$delete_errors = Session::get('delete-errors');

view('profile/edit', [
    'title' => 'Profile',
    'user' => $user,
    'id' => $id,
    'info_errors' => $info_errors,
    'password_errors' => $password_errors,
    'delete_errors' => $delete_errors
]);