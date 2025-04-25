<?php

use App\Models\Classes;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Subject;

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

$subjects = Subject::all()->getAll();
$classes = Classes::all()->getAll();

view('admin/management', [
    'title' => 'Students',
    'teachers' => $teachers,
    'students' => $students,
    'subjects' => $subjects,
    'classes' => $classes
]);