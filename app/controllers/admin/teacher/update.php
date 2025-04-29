<?php

use App\Models\Teacher;

$id        = $_POST['id'];
$subjectId = trim($_POST['subject_id']);
$userId    = trim($_POST['user_id']);
$idNumber  = trim($_POST['id_number']);

$errors = [];

if (empty($subjectId) || !is_numeric($subjectId)) {
	$errors['subject_id'] = 'Valid subject is required';
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

$existing = Teacher::where('id_number', '=', $idNumber)->first();
if ($existing && $existing->id != $id) {
	$errors['id_number'] = 'This ID number is already in use';
}

if (empty($errors)) {
	Teacher::update($id, [
		'subject_id' => $subjectId,
		'user_id'    => $userId,
		'id_number'  => $idNumber,
	]);
	redirect('/teachers');
} else {
	$teacher = Teacher::find($id);
	view('teachers/edit', [
		'title'   => 'Edit Teacher',
		'teacher' => $teacher,
		'errors'  => $errors,
	]);
	exit;
}
