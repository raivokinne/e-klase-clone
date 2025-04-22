<?php

use App\Models\User;
use App\Models\Booking;
use App\Models\Room;
use Core\Session;

$user = User::where('id', '=', $_SESSION['user']['id'])->get();
$orders = Booking::where('user_id', '=', $_SESSION['user']['id'])->getAll();
$rooms = Room::all()->getAll();

foreach ($orders as $key => $order) {
    $rooms[$order['room_id']] = Room::where('id', '=', $order['room_id'])->getAll();
}

$info_errors = Session::get('info-errors');
$password_errors = Session::get('password-errors');
$delete_errors = Session::get('delete-errors');

view('profile/edit', [
    'title' => 'Profile',
    'user' => $user,
    'orders' => $orders,
    'rooms' => $rooms,
    'info_errors' => $info_errors,
    'password_errors' => $password_errors,
    'delete_errors' => $delete_errors
]);
