<?php
use App\Models\User;
use Core\Session;
use Core\Storage;

$storage = new Storage();
$errors = [];

if (!isset($_FILES['profileImage']) || $_FILES['profileImage']['error'] === UPLOAD_ERR_NO_FILE) {
    $errors['profileImage'] = 'No image was uploaded';
} elseif ($_FILES['profileImage']['error'] !== UPLOAD_ERR_OK) {
    $errorMessages = [
        UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_max_filesize directive in php.ini.",
        UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive in the HTML form.",
        UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded.",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
        UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
        UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload."
    ];
    
    $errorCode = $_FILES['profileImage']['error'];
    $errors['profileImage'] = $errorMessages[$errorCode] ?? "Unknown upload error.";
} else {
    $fileInfo = pathinfo($_FILES['profileImage']['name']);
    $extension = strtolower($fileInfo['extension']);
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    
    if (!in_array($extension, $allowedTypes)) {
        $errors['profileImage'] = "Invalid file type. Please upload a JPG, PNG or GIF image.";
    } else {
        $userId = $_SESSION['user']['id'];
        
        $userDir = 'profile_images/' . $userId;
        $storage->makeDirectory($userDir);
        
        $avatarFilename = 'avatar_' . $userId . '_' . uniqid() . '.' . $extension;
        $avatarPath = $userDir . '/' . $avatarFilename;
        
        $tempPath = $_FILES['profileImage']['tmp_name'];
        if (!$storage->put($avatarPath, file_get_contents($tempPath))) {
            $errors['profileImage'] = "Failed to save uploaded file.";
        } else {
            $avatarUrl = '/storage/' . $avatarPath; 
            
            $result = User::update($userId, ['avatar' => $avatarUrl]);
            
            if (!$result) {
                $errors['profileImage'] = "Failed to update profile in database.";
            } else {
                $_SESSION["user"]["avatar"] = $avatarUrl;
                
                Session::flash('success', "Profile image updated successfully!");
            }
        }
    }
}

if (!empty($errors)) {
    Session::put('avatar-errors', $errors);
} 

redirect('/profile');