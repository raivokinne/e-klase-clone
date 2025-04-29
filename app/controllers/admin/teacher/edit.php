<?php

use App\Models\Teacher;
use App\Models\Subject;

if (!$id) {
	$_SESSION['error'] = "No teacher ID provided";
	redirect('/management?section=teacher');
}

$teacher = Teacher::execute(
	"SELECT teachers.*, users.*
     FROM teachers
     INNER JOIN users ON teachers.user_id = users.id
     WHERE teachers.id = :id",
	['id' => $id]
)->get();

if (!$teacher) {
	$_SESSION['error'] = "Teacher not found";
	redirect('/management?section=teacher');
}

$subjects = Subject::all()->getAll();

view('admin/management/edit.teacher', [
	'teacher' => $teacher,
	'subjects' => $subjects,
]);
