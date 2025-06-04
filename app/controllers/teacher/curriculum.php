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

// Get the teacher's schedule from the database
$schedule = [];

// Read schedule from db.json
$dbFile = BASE_PATH . '/database/db.json';
if (file_exists($dbFile)) {
    $fileContent = file_get_contents($dbFile);
    if ($fileContent !== false) {
        $decodedData = json_decode($fileContent, true);
        if ($decodedData && isset($decodedData['stundu_saraksts'])) {
            foreach ($decodedData['stundu_saraksts'] as $class) {
                if (isset($class['dienas'])) {
                    foreach ($class['dienas'] as $day) {
                        if (isset($day['subjects'])) {
                            foreach ($day['subjects'] as $subject) {
                                if (isset($subject['time']) && isset($subject['subject'])) {
                                    $schedule[$day['name']][$subject['time']][] = [
                                        'class'   => $class['name'],
                                        'subject' => $subject['subject'],
                                        'room'    => $subject['room'] ?? 'N/A',
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

if (file_exists($dbFile)) {
    $fileContent = file_get_contents($dbFile);
    if ($fileContent !== false) {
        $data = json_decode($fileContent, true);
        if ($data && isset($data['stundu_saraksts'])) {
            foreach ($data['stundu_saraksts'] as $class) {
                if (isset($class['dienas'])) {
                    foreach ($class['dienas'] as $day) {
                        $dayName = ucfirst($day['name']); // Convert to proper case (e.g., 'friday' to 'Friday')

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

view('teacher/curriculum', [
    'title'     => 'My Curriculum',
    'teacher'   => $teacher,
    'subject'   => $subject,
    'schedule'  => $schedule,
    'days'      => $days,
    'timeSlots' => $timeSlots,
]);

// Add this to your controller after getting the schedule
$students = [];
if (! empty($schedule)) {
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

    // Fetch students for each class
    foreach ($teacherClasses as $className) {
        $classStudents = Student::execute(
            "SELECT students.*, CONCAT(users.first_name, ' ', users.last_name) as student_name,
                    GROUP_CONCAT(grades.grade) as grades
             FROM students
             INNER JOIN users ON students.user_id = users.id
             LEFT JOIN grades ON students.id = grades.student_id AND grades.subject_id = :subject_id
             WHERE students.class = :class_name
             GROUP BY students.id",
            ['class_name' => $className, 'subject_id' => $subject->id]
        )->all();

        $students[$className] = $classStudents;
    }
}

// Add to your view data
view('teacher/curriculum', [
    'title'     => 'My Curriculum',
    'teacher'   => $teacher,
    'subject'   => $subject,
    'schedule'  => $schedule,
    'days'      => $days,
    'timeSlots' => $timeSlots,
    'students'  => $students, // Add this
]);

// In your routes or controller
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_grade') {
    $studentId = $_POST['student_id'];
    $subjectId = $_POST['subject_id'];
    $grade     = $_POST['grade'];

    try {
        Grade::execute(
            "INSERT INTO grades (student_id, subject_id, grade) VALUES (:student_id, :subject_id, :grade)",
            [
                'student_id' => $studentId,
                'subject_id' => $subjectId,
                'grade'      => $grade,
            ]
        );

        echo json_encode(['success' => true, 'message' => 'Grade added successfully']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error adding grade']);
    }
    exit;
}
