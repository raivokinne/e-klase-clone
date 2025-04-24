<?php

use App\Models\Teacher;
use App\Models\Student;

$teachers = Teacher::execute("
    SELECT teachers.*, users.* FROM teachers INNER JOIN users ON teachers.user_id = users.id
    ", [])
    ->getAll();
$students = Student::execute(
    "SELECT students.*, users.*
     FROM students 
     INNER JOIN users ON students.user_id = users.id 
     ",
    []
)->getAll();

view('admin/students', [
    'title' => 'Students',
    'teachers' => $teachers,
    'students' => $students
]);