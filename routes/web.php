<?php

$router->get('/', 'pages/index.php');

$router->get('/login', 'session/create.php');
$router->post('/login', 'session/store.php');

$router->get('/logout', 'session/destroy.php')->only('auth'); 

$router->get('/profile/{id}/edit', 'profile/edit.php')->only('auth');
$router->put('/profile/{id}/update', 'profile/update.php')->only('admin');
$router->delete('/profile/{id}/delete', 'profile/delete.php')->only('admin');
$router->put('/profile/{id}/password', 'profile/password.php')->only('admin');
$router->post('/profile/{id}/upload', 'profile/upload.php')->only('auth');

$router->get('/grades', 'grades/index.php')->only('student', 'teacher');

$router->get('/subjects', 'admin/subjects.php')->only('admin');
$router->get('/students', 'admin/students.php')->only('admin');