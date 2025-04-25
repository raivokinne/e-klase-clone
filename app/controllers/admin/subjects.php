<?php
use App\Models\Subject;
use App\Models\Teacher;

$subjects = Subject::all()->getAll();
$teachers = Teacher::execute("SELECT * FROM teachers JOIN users ON teachers.user_id = users.id", [])->getAll();

view('admin/subjects', [
    'title' => 'Subjects',
    'subjects' => $subjects,
    'teachers' => $teachers,
]);