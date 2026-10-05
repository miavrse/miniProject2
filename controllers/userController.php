<?php

public function uploadProfilePic() {
    if (!isset($_SESSION['student_id'])) {
        header("Location: index.php?action=login");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_pic'])) {
        $file = $_FILES['profile_pic'];
        $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        // 1. validate type (.jpg, .jpeg, .png) & size (< 2MB)
        if (!in_array($fileExt, ['jpg', 'jpeg', 'png']) || $file['size'] > 2097152) {
            die("Invalid file type or size exceeds 2MB limit.");
        }

        // 2. secure renaming using uniqid()
        $newFileName = uniqid('profile_', true) . '.' . $fileExt;
        $destPath = './uploads/' . $newFileName;

        if (move_uploaded_file($file['tmp_name'], $destPath)) {
            $this->userModel->updateProfilePic($_SESSION['student_id'], $newFileName);
            header("Location: index.php?action=profile&status=success");
            exit;
        }
    }
}
?>
