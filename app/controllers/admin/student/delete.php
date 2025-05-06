<?php

use App\Models\Student;
use App\Models\User;

$student = Student::find($id)->get();

if ($student) {
	Student::delete($id);

	User::delete($student->user_id);
}

redirect('/management');
