<?php

$router->get('/', 'pages/index.php')->only("guest");

$router->get('/login', 'session/create.php')->only("guest");
$router->post('/login', 'session/store.php')->only("guest");

$router->get('/logout', 'session/destroy.php')->only('auth'); 

$router->get('/profile', 'profile/edit.php')->only('student', 'teacher');
$router->put('/profile/{id}/update', 'profile/update.php')->only('student', 'teacher');
$router->delete('/profile/{id}/delete', 'profile/delete.php')->only('student', 'teacher');
$router->put('/profile/{id}/password', 'profile/password.php')->only('student', 'teacher');
$router->post('/profile/{id}/upload', 'profile/upload.php')->only('student', 'teacher');

$router->get('/grades', 'grades/index.php')->only('student', 'teacher');
$router->get('/home', 'home/index.php')->only('student', 'teacher');



$router->get('/subjects', 'admin/subjects.php')->only('admin');
$router->get('/students', 'admin/students.php')->only('admin');