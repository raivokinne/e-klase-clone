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
    "SELECT teachers.*, CONCAT(users.first_name, ' ', users.last_name) as teacher_name, subjects.name as subject_name
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
$subject = Subject::find($teacher->subject_id)->get();

if (! $subject) {
    $_SESSION['error'] = 'Subject information not found';
    redirect('/login');
}

// Handle AJAX requests for students
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'get_students') {
    header('Content-Type: application/json');

    $class   = $_GET['class'] ?? '';
    $subject = $_GET['subject'] ?? '';

    if (empty($class)) {
        http_response_code(400);
        echo json_encode(['error' => 'Class parameter is required']);
        exit;
    }

    // Read students from JSON file
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

            if (! empty($subjectGrades)) {
                $student['grades'] = array_values($subjectGrades);
            } else {
                $student['grades'] = [[
                    'subject' => $subject,
                    'grades'  => [],
                    'average' => 0,
                ]];
            }
        }
    }

    echo json_encode($students);
    exit;
}

// Handle adding grades
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    // Get JSON data from request body
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (! $data || ! isset($data['action']) || $data['action'] !== 'add_grade') {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid request']);
        exit;
    }

    $studentId   = $data['student_id'] ?? '';
    $subjectName = $data['subject'] ?? '';
    $grade       = $data['grade'] ?? '';
    $className   = $data['class'] ?? '';

    if (empty($studentId) || empty($subjectName) || empty($grade) || empty($className)) {
        http_response_code(400);
        echo json_encode(['error' => 'Missing required parameters']);
        exit;
    }

    $studentsFile = BASE_PATH . '/database/students.json';

    if (! file_exists($studentsFile)) {
        http_response_code(404);
        echo json_encode(['error' => 'Students data not found']);
        exit;
    }

    $studentsData = json_decode(file_get_contents($studentsFile), true);

    if (! isset($studentsData[$className])) {
        http_response_code(404);
        echo json_encode(['error' => 'Class not found']);
        exit;
    }

    $classStudents = &$studentsData[$className];
    $studentIndex  = array_search($studentId, array_column($classStudents, 'id'));

    if ($studentIndex === false) {
        http_response_code(404);
        echo json_encode(['error' => 'Student not found']);
        exit;
    }

    $student      = &$classStudents[$studentIndex];
    $subjectIndex = array_search($subjectName, array_column($student['grades'], 'subject'));

    if ($subjectIndex === false) {
        // Add new subject grades
        $student['grades'][] = [
            'subject' => $subjectName,
            'grades'  => [floatval($grade)],
            'average' => floatval($grade),
        ];
    } else {
        // Add grade to existing subject
        $student['grades'][$subjectIndex]['grades'][] = floatval($grade);
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

// Get the teacher's schedule from the database
$schedule = [];

// Define time slots
$timeSlots = [
    '08:30 - 09:10',
    '09:10 - 09:50',
    '09:50 - 10:30',
    '10:50 - 11:30',
    '11:30 - 13:10',
    '13:10 - 13:50',
    '14:00 - 14:40',
    '14:40 - 15:20',
    '15:30 - 16:10',
    '16:10 - 16:50',
];

// Initialize schedule with empty arrays for each day and time slot
$days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
foreach ($days as $day) {
    $schedule[$day] = [];
    foreach ($timeSlots as $time) {
        $schedule[$day][$time] = [];
    }
}

// Read schedule from db.json
$dbFile = BASE_PATH . '/database/db.json';
if (file_exists($dbFile)) {
    $fileContent = file_get_contents($dbFile);
    if ($fileContent !== false) {
        $data = json_decode($fileContent, true);
        if ($data && isset($data['stundu_saraksts'])) {
            foreach ($data['stundu_saraksts'] as $class) {
                if (isset($class['dienas'])) {
                    foreach ($class['dienas'] as $day) {
                        $dayName = ucfirst($day['name']); // Convert to proper case

                        if (isset($day['subjects'])) {
                            // First, collect all lessons for this day
                            $dayLessons = [];
                            foreach ($day['subjects'] as $lesson) {
                                if (isset($lesson['teachers']) && $lesson['teachers'] === $teacher->teacher_name) {
                                    $dayLessons[$lesson['id']] = $lesson;
                                }
                            }

                                                // Now place them in the correct time slots based on their IDs
                            ksort($dayLessons); // Sort by ID
                            foreach ($dayLessons as $id => $lesson) {
                                $timeSlotIndex = $id - 1; // ID 1 goes to first slot, ID 2 to second slot, etc.
                                if (isset($timeSlots[$timeSlotIndex])) {
                                    $schedule[$dayName][$timeSlots[$timeSlotIndex]][] = [
                                        'class'   => $class['name'],
                                        'subject' => $lesson['subject'],
                                        'room'    => $lesson['kabinets'],
                                    ];
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

// Get all classes that the teacher teaches
$teacherClasses = [];
foreach ($schedule as $day => $daySchedule) {
    foreach ($daySchedule as $time => $lessons) {
        foreach ($lessons as $lesson) {
            if (! in_array($lesson['class'], $teacherClasses)) {
                $teacherClasses[] = $lesson['class'];
            }
        }
    }
}

view('teacher/curriculum', [
    'title'          => 'My Curriculum',
    'teacher'        => $teacher,
    'subject'        => $subject,
    'schedule'       => $schedule,
    'days'           => $days,
    'timeSlots'      => $timeSlots,
    'teacherClasses' => $teacherClasses,
]);
