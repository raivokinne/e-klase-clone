<?php

global $router;

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
$router->get('/management', 'admin/management.php')->only('admin');

// Student routes
$router->post('/students', 'admin/student/store.php')->only('admin');
$router->get('/edit/{id}/student', 'admin/student/edit.php')->only('admin');
$router->get('/delete/{id}/student', 'admin/student/delete.php')->only('admin');
$router->get('/show/{id}/student', 'admin/student/show.php')->only('admin');
$router->put('/update/{id}/student', 'admin/student/update.php')->only('admin');

// Teacher routes
$router->post('/teachers', 'admin/teacher/store.php')->only('admin');
$router->get('/edit/{id}/teacher', 'admin/teacher/edit.php')->only('admin');
$router->post('/update/{id}/teacher', 'admin/teacher/update.php')->only('admin');
$router->get('/delete/{id}/teacher', 'admin/teacher/delete.php')->only('admin');
$router->get('/show/{id}/teacher', 'admin/teacher/show.php')->only('admin');

// Schedule routes
$router->post('/api/schedule/save', 'admin/schedule/save.php')->only('admin');
$router->post('/subjects', 'admin/subjects.php')->only('admin');

// Curriculum routes
$router->get('/curriculum', 'teacher/curriculum.php')->only('teacher');

// Teacher dashboard
$router->get('/teacher', 'teacher/teacher.php')->only('teacher');
