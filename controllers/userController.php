<?php

class UserController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new Student($db); 
    }

    public function profile() {
        if (!isset($_SESSION['student_id'])) {
            $_SESSION['student_id'] = 1;
        }

        $studentData = $this->userModel->getStudentById($_SESSION['student_id']);
        
        include __DIR__ . '/../views/profile.php';
    }

    public function uploadProfilePic() {
        if (!isset($_SESSION['student_id'])) {
            $_SESSION['student_id'] = 1;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_pic'])) {
            $file = $_FILES['profile_pic'];
            $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

            // 1. SECURITY & VALIDATION: Type (.jpg, .jpeg, .png) & Size (< 2MB)
            if (!in_array($fileExt, ['jpg', 'jpeg', 'png']) || $file['size'] > 2097152) {
                $_SESSION['error'] = "Invalid file type or size exceeds 2MB limit.";
                header("Location: index.php?action=profile");
                exit;
            }

            // 2. SECURITY & VALIDATION: Secure renaming using uniqid()
            $newFileName = uniqid('profile_', true) . '.' . $fileExt;
            $uploadDir = __DIR__ . '/../uploads/';

            // ensure uploads directory exists
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $destPath = $uploadDir . $newFileName;

            // save file and update database record
            if (move_uploaded_file($file['tmp_name'], $destPath)) {
                $this->userModel->updateProfilePic($_SESSION['student_id'], $newFileName);
                $_SESSION['success'] = "Profile picture updated successfully!";
                header("Location: index.php?action=profile&status=success");
                exit;
            } else {
                $_SESSION['error'] = "Failed to move uploaded file.";
                header("Location: index.php?action=profile");
                exit;
            }
        }
    }
}
?>
