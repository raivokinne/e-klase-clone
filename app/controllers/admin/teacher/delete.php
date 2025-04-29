<?php

use App\Models\Teacher;
use App\Models\User;

$teacher = Teacher::find($id)->get();

if ($teacher) {
	Teacher::delete($id);

	User::delete($teacher['user_id']);
}

redirect('/management');
