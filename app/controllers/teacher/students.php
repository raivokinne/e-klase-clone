<?php

// Get students for a specific class
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header('Content-Type: application/json');

    $class   = $_GET['class'] ?? '';
    $subject = $_GET['subject'] ?? '';

    if (empty($class)) {
        http_response_code(400);
        echo json_encode(['error' => 'Class parameter is required']);
        exit;
    }

    $studentsFile = BASE_PATH . '/database/students.json';

    if (! file_exists($studentsFile)) {
        http_response_code(404);
        echo json_encode(['error' => 'Students data not found']);
        exit;
    }

    $studentsData = json_decode(file_get_contents($studentsFile), true);

    if (! isset($studentsData[$class])) {
        echo json_encode([]);
        exit;
    }

    $students = $studentsData[$class];

    // If subject is specified, filter grades for that subject
    if (! empty($subject)) {
        foreach ($students as &$student) {
            $subjectGrades = array_filter($student['grades'], function ($grade) use ($subject) {
                return $grade['subject'] === $subject;
            });
            $student['grades'] = array_values($subjectGrades);
        }
    }

    echo json_encode($students);
    exit;
}

// Add a new grade
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    $jsonData = file_get_contents('php://input');
    $data     = json_decode($jsonData, true);

    if (! $data || ! isset($data['student_id']) || ! isset($data['subject']) || ! isset($data['grade']) || ! isset($data['class'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid data provided']);
        exit;
    }

    $studentsFile = BASE_PATH . '/database/students.json';

    if (! file_exists($studentsFile)) {
        http_response_code(404);
        echo json_encode(['error' => 'Students data not found']);
        exit;
    }

    $studentsData = json_decode(file_get_contents($studentsFile), true);

    if (! isset($studentsData[$data['class']])) {
        http_response_code(404);
        echo json_encode(['error' => 'Class not found']);
        exit;
    }

    $classStudents = &$studentsData[$data['class']];
    $studentIndex  = array_search($data['student_id'], array_column($classStudents, 'id'));

    if ($studentIndex === false) {
        http_response_code(404);
        echo json_encode(['error' => 'Student not found']);
        exit;
    }

    $student      = &$classStudents[$studentIndex];
    $subjectIndex = array_search($data['subject'], array_column($student['grades'], 'subject'));

    if ($subjectIndex === false) {
        // Add new subject grades
        $student['grades'][] = [
            'subject' => $data['subject'],
            'grades'  => [$data['grade']],
            'average' => $data['grade'],
        ];
    } else {
        // Add grade to existing subject
        $student['grades'][$subjectIndex]['grades'][] = $data['grade'];
        $grades                                       = $student['grades'][$subjectIndex]['grades'];
        $student['grades'][$subjectIndex]['average']  = array_sum($grades) / count($grades);
    }

    if (file_put_contents($studentsFile, json_encode($studentsData, JSON_PRETTY_PRINT))) {
        echo json_encode([
            'success' => true,
            'message' => 'Grade added successfully',
            'data'    => $student,
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to save grade']);
    }
    exit;
}
