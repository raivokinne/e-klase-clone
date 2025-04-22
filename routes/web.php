<?php

$router->get('/', 'pages/index.php');

$router->get('/login', 'session/create.php')->only('guest');
$router->get('/register', 'register/create.php')->only('guest');
$router->get('/logout', 'session/destroy.php')->only('auth');
$router->post('/register', 'register/store.php')->only('guest');
$router->post('/login', 'session/store.php')->only('guest');

$router->get('/profile', 'profile/edit.php')->only('auth');
$router->put('/profile/{id}/update', 'profile/update.php')->only('auth');
$router->delete('/profile/{id}/delete', 'profile/delete.php')->only('auth');
$router->put('/profile/{id}/password', 'profile/password.php')->only('auth');

$router->get('/rooms', 'rooms/index.php');
$router->get('/rooms/{id}/show', 'rooms/show.php');
$router->get('/rooms/create', 'rooms/create.php')->only('admin');
$router->post('/rooms', 'rooms/store.php')->only('admin');
$router->get('/rooms/{id}/edit', 'rooms/edit.php')->only('admin');
$router->put('/rooms/{id}/update', 'rooms/update.php')->only('admin');
$router->delete('/rooms/{id}/delete', 'rooms/delete.php')->only('admin');
$router->post('/rooms/{id}/reviews', 'reviews/store.php');

$router->post('/reviews', 'reviews/store.php')->only('auth');
$router->get('/reviews/{id}/edit', 'reviews/edit.php')->only('auth');
$router->put('/reviews/{id}/update', 'reviews/update.php')->only('auth');
$router->delete('/reviews/{id}/delete', 'reviews/delete.php')->only('auth');

$router->post('/bookings', 'bookings/store.php')->only('auth');
$router->put('/bookings/{id}/confirm', 'bookings/confirm.php')->only('admin');
$router->put('/bookings/{id}/cancel', 'bookings/cancel.php')->only('admin');

$router->get('/dashboard', 'dashboard/index.php')->only('admin');
$router->get('/dashboard/users', 'dashboard/users.php')->only('admin');
$router->get('/dashboard/bookings', 'dashboard/bookings.php')->only('admin');
$router->get('/dashboard/reviews', 'dashboard/reviews.php')->only('admin');
$router->get('/dashboard/rooms', 'dashboard/rooms.php')->only('admin');
