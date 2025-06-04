<?php

use App\Models\Subject;
use App\Models\Teacher;

// Check if user is logged in and is a teacher
if (! isset($_SESSION['user']) || $_SESSION['user']->role !== 'teacher') {
    $_SESSION['error'] = 'You must be logged in as a teacher to access this page';
    redirect('/login');
}

// Get the current teacher's information
$teacher = Teacher::execute(
    "SELECT teachers.*, users.*, subjects.name as subject_name
     FROM teachers
     INNER JOIN users ON teachers.user_id = users.id
     INNER JOIN subjects ON teachers.subject_id = subjects.id
     WHERE users.id = :user_id",
    ['user_id' => $_SESSION['user']->id]
)->get();

if (! $teacher) {
    $_SESSION['error'] = 'Teacher information not found';
    redirect('/login');
}

// Get the teacher's subject
$subject = Subject::find($teacher['subject_id'])->get();

if (! $subject) {
    $_SESSION['error'] = 'Subject information not found';
    redirect('/login');
}

view('teacher/index', [
    'title'   => 'Teacher Dashboard',
    'teacher' => $teacher,
    'subject' => $subject,
]);
