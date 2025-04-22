<?php

$router->get('/', 'pages/index.php');

$router->get('/login', 'session/create.php');
$router->post('/login', 'session/store.php');
$router->get('/logout', 'session/destroy.php')->only('auth'); 

$router->get('/profile', 'profile/edit.php')->only('auth');
$router->put('/profile/{id}/update', 'profile/update.php')->only('auth');
$router->delete('/profile/{id}/delete', 'profile/delete.php')->only('auth');
$router->put('/profile/{id}/password', 'profile/password.php')->only('auth');
$router->post('/profile/{id}/upload', 'profile/upload.php')->only('auth');

$router->get('/grades', 'grades/index.php')->only('auth');