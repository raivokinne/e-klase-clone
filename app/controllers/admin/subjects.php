<?php
use App\Models\Classes;
use App\Models\Subject;
use App\Models\Teacher;

// Handle POST request first
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Content-Type');

    // Get the JSON data from the request body
    $jsonData = file_get_contents('php://input');
    $data     = json_decode($jsonData, true);

    if (! $data || ! isset($data['stundu_saraksts']) || ! is_array($data['stundu_saraksts'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid JSON data structure']);
        exit;
    }

    // Path to db.json file
    $dbFile = BASE_PATH . '/database/db.json';

    // Read existing data if file exists
    $existingData = ['stundu_saraksts' => []];
    if (file_exists($dbFile)) {
        $fileContent = file_get_contents($dbFile);
        if ($fileContent !== false) {
            $decodedData = json_decode($fileContent, true);
            if ($decodedData && isset($decodedData['stundu_saraksts'])) {
                $existingData = $decodedData;
            }
        }
    }

    // Get the new class data
    $newClassData = $data['stundu_saraksts'][0];
    if (! isset($newClassData['name'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Class name is required']);
        exit;
    }

    // Find if class already exists
    $classIndex = -1;
    foreach ($existingData['stundu_saraksts'] as $index => $class) {
        if (isset($class['name']) && $class['name'] === $newClassData['name']) {
            $classIndex = $index;
            break;
        }
    }

    if ($classIndex === -1) {
        // Add new class
        $existingData['stundu_saraksts'][] = $newClassData;
    } else {
        // Update existing class by merging the days
        foreach ($newClassData['dienas'] as $newDay) {
            $dayExists = false;
            foreach ($existingData['stundu_saraksts'][$classIndex]['dienas'] as &$existingDay) {
                if ($existingDay['name'] === $newDay['name']) {
                    // Merge subjects for the same day
                    if (isset($newDay['subjects'])) {
                        if (! isset($existingDay['subjects'])) {
                            $existingDay['subjects'] = [];
                        }
                        $existingDay['subjects'] = array_merge($existingDay['subjects'], $newDay['subjects']);
                    }
                    $dayExists = true;
                    break;
                }
            }

            // If day doesn't exist, add it
            if (! $dayExists) {
                $existingData['stundu_saraksts'][$classIndex]['dienas'][] = $newDay;
            }
        }
    }

    // Ensure the directory exists
    $dir = dirname($dbFile);
    if (! is_dir($dir)) {
        mkdir($dir, 0777, true);
    }

    // Save back to file
    if (file_put_contents($dbFile, json_encode($existingData, JSON_PRETTY_PRINT))) {
        echo json_encode([
            'success' => true,
            'message' => 'Schedule saved successfully',
            'data'    => $existingData,
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to save schedule to file']);
    }
    exit;
}

// Handle GET request - show the view
$subjects = Subject::all()->getAll();
$teachers = Teacher::execute("SELECT * FROM teachers JOIN users ON teachers.user_id = users.id", [])->getAll();
$classes  = Classes::all()->getAll();

view('admin/subjects', [
    'title'    => 'Subjects',
    'subjects' => $subjects,
    'teachers' => $teachers,
    'classes'  => $classes,
]);
