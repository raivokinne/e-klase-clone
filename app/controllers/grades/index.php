<?php
// Get logged-in student ID from session (you'll need to implement authentication)
$loggedInStudentId = $_SESSION['user']->id ?? null;

// Load grades data from JSON file
$gradesData = loadGradesData();

// Find the logged-in student's data
$studentData = findStudentById($gradesData, $loggedInStudentId);

if (!$studentData) {
    // Student not found, show error
    view('grades/not-found', [
        'title' => 'Student Not Found'
    ]);
    exit;
}

// Pass student data to view
view('grades/index', [
    'title' => 'My Grades - ' . $studentData['name'],
    'student' => $studentData,
    'class' => $studentData['class']
]);

/**
 * Load grades data from JSON file
 */
function loadGradesData() {
    $jsonFile = BASE_PATH . '/database/students.json';

    if (!file_exists($jsonFile)) {
        throw new Exception('Grades data file not found');
    }

    $jsonContent = file_get_contents($jsonFile);
    $data = json_decode($jsonContent, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Invalid JSON data: ' . json_last_error_msg());
    }

    return $data;
}

/**
 * Find student by ID across all classes
 */
function findStudentById($gradesData, $studentId) {
    foreach ($gradesData as $className => $students) {
        foreach ($students as $student) {
            if ($student['id'] == $studentId) {
                $student['class'] = $className;
                return $student;
            }
        }
    }
    return null;
}

/**
 * Calculate overall average for a student (European 1-10 scale)
 */
function calculateOverallAverage($grades) {
    if (empty($grades)) return 0;

    $totalAverage = 0;
    $subjectCount = count($grades);

    foreach ($grades as $subject) {
        $totalAverage += $subject['average'];
    }

    return round($totalAverage / $subjectCount, 2);
}

/**
 * Convert numerical grade to European letter grade
 */
function getLetterGrade($average) {
    if ($average >= 9.0) return 'A+';
    if ($average >= 8.5) return 'A';
    if ($average >= 7.5) return 'B+';
    if ($average >= 6.5) return 'B';
    if ($average >= 5.5) return 'C+';
    if ($average >= 4.5) return 'C';
    if ($average >= 3.5) return 'D+';
    if ($average >= 2.5) return 'D';
    if ($average >= 1.5) return 'E';
    return 'F';
}

/**
 * Get grade color based on European standards
 */
function getGradeColor($average) {
    if ($average >= 8.5) return 'text-green-700';      // Excellent (A/A+)
    if ($average >= 7.0) return 'text-green-600';      // Very Good (B+/B)
    if ($average >= 5.5) return 'text-blue-600';       // Good (C+/C)
    if ($average >= 4.0) return 'text-yellow-600';     // Satisfactory (D+/D)
    if ($average >= 2.0) return 'text-orange-600';     // Sufficient (E)
    return 'text-red-600';                              // Fail (F)
}

/**
 * Get grade status text (European system)
 */
function getGradeStatus($average) {
    if ($average >= 8.5) return 'Excellent';
    if ($average >= 7.0) return 'Very Good';
    if ($average >= 5.5) return 'Good';
    if ($average >= 4.0) return 'Satisfactory';
    if ($average >= 2.0) return 'Sufficient';
    return 'Insufficient';
}

/**
 * Get ECTS grade equivalent
 */
function getECTSGrade($average) {
    if ($average >= 9.0) return 'A';
    if ($average >= 8.0) return 'B';
    if ($average >= 7.0) return 'C';
    if ($average >= 6.0) return 'D';
    if ($average >= 5.0) return 'E';
    return 'F';
}

/**
 * Check if grade is passing (European standard: ≥4.0)
 */
function isPassing($average) {
    return $average >= 4.0;
}
