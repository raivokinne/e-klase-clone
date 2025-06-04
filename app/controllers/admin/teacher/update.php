<?php

use App\Models\Teacher;
use App\Models\User;

$id = $_POST['id'];
$userId = $_POST['user_id'];
$subjectId = $_POST['subject_id'];
$idNumber = $_POST['id_number'];
$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$email = $_POST['email'];z
$password = $_POST['password'] ?? '';
$passwordConfirmation = $_POST['password_confirmation'] ?? '';

$errors = [];

// Validate required fields
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

if (empty($firstName)) {
	$errors['first_name'] = 'First name is required';
}

if (empty($lastName)) {
	$errors['last_name'] = 'Last name is required';
}

if (empty($email)) {
	$errors['email'] = 'Email is required';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	$errors['email'] = 'Invalid email format';
}

// Check if email is already taken by another user
$existingUser = User::where('email', '=', $email)->first();
if ($existingUser && $existingUser->id != $userId) {
	$errors['email'] = 'This email is already taken';
}

// Check if ID number is already taken by another teacher
$existingTeacher = Teacher::where('id_number', '=', $idNumber)->first();
if ($existingTeacher && $existingTeacher->id != $id) {
	$errors['id_number'] = 'This ID number is already taken';
}

// Validate password if provided
if (!empty($password)) {
	if (strlen($password) < 8) {
		$errors['password'] = 'Password must be at least 8 characters';
	} elseif ($password !== $passwordConfirmation) {
		$errors['password'] = 'Passwords do not match';
	}
}

if (empty($errors)) {
	// Update user information
	$userData = [
		'first_name' => $firstName,
		'last_name' => $lastName,
		'email' => $email
	];

	// Add password update if provided
	if (!empty($password)) {
		$userData['password'] = password_hash($password, PASSWORD_DEFAULT);
	}

	User::update($userId, $userData);

	// Update teacher information
	Teacher::update($id, [
		'subject_id' => $subjectId,
		'id_number' => $idNumber
	]);

	$_SESSION['success'] = 'Teacher updated successfully';
	redirect('/management?section=teacher');
} else {
	$_SESSION['error'] = 'Please fix the following errors:';
	$_SESSION['form_errors'] = $errors;
	redirect("/edit/{$id}/teacher");
}
