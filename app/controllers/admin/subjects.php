<?php
$subjects = \Database\Database::$connection->query("SELECT * FROM subjects")->fetchAll(PDO::FETCH_ASSOC);
$teachers = \Database\Database::$connection->query("SELECT * FROM users WHERE role = 'teacher'")->fetchAll(PDO::FETCH_ASSOC);

view('admin/subjects', [
    'title' => 'Subjects',
    'subjects' => $subjects,
    'teachers' => $teachers,
]);