<?php

use App\Models\Student;

$id       = $_POST['id'];
$class    = trim($_POST['class']);
$userId   = trim($_POST['user_id']);
$idNumber = trim($_POST['id_number']);

$errors = [];

if (empty($class)) {
	$errors['class'] = 'Class is required';
} elseif (strlen($class) < 2) {
	$errors['class'] = 'Class must be at least 2 characters';
} elseif (strlen($class) > 10) {
	$errors['class'] = 'Class must be at most 10 characters';
}

if (empty($userId) || !is_numeric($userId)) {
	$errors['user_id'] = 'Valid user ID is required';
}

if (empty($idNumber)) {
	$errors['id_number'] = 'ID number is required';
} elseif (strlen($idNumber) < 3) {
	$errors['id_number'] = 'ID number must be at least 3 characters';
} elseif (strlen($idNumber) > 20) {
	$errors['id_number'] = 'ID number must be at most 20 characters';
}

$existing = Student::where('id_number', '=', $idNumber)->get();
if ($existing && $existing['id'] != $id) {
	$errors['id_number'] = 'This ID number is already in use';
}

if (empty($errors)) {
	Student::update($id, [
		'class'     => $class,
		'user_id'   => $userId,
		'id_number' => $idNumber,
	]);
	redirect('/management');
} else {
	$student = Student::find($id);
	view('admin/management/edit.student', [
		'title'   => 'Edit Student',
		'student' => $student,
		'errors'  => $errors,
	]);
}
