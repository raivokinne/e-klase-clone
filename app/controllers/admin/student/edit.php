<?php

use App\Models\Student;
use App\Models\Classes;

if (!$id) {
	$_SESSION['error'] = "No student ID provided";
	redirect('/management?section=studnet');
}

$student = Student::execute(
	"SELECT students.*, users.*
     FROM students
     INNER JOIN users ON students.user_id = users.id
     WHERE students.id = :id",
	['id' => $id]
)->get();

if (!$student) {
	$_SESSION['error'] = "Student not found";
	redirect('/management?section=student');
}

$classes = Classes::all()->getAll();

view('admin/management/edit.student', [
	'student' => $student,
	'classes' => $classes,
]);
