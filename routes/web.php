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
$router->get('/management', 'admin/management.php')->only('admin');
$router->post('/students', 'admin/student/store.php')->only('admin');
$router->post('/teachers', 'admin/teacher/store.php')->only('admin');
$router->get('/edit_student.php', 'admin/students/edit.php')->only('admin');
$router->get('/delete_student.php', 'admin/students/delete.php')->only('admin');
$router->get('/edit_teacher.php', 'admin/teacher/edit.php')->only('admin');
$router->get('/delete_teacher.php', 'admin/teacher/delete.php')->only('admin');