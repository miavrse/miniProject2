<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/student.php';


class AuthController
{

    // =========================
    // LOGIN
    // =========================
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: ../index.php?action=login");
            exit();
        }

        $ic = trim($_POST['ic'] ?? '');
        $password = $_POST['password'] ?? '';


        // SERVER-SIDE VALIDATION
        if ($ic === '' || $password === '') {

            $_SESSION['error'] =
                "Please enter your IC and password.";

            header("Location: index.php?action=login");
            exit();
        }


        $db = (new Database())->getConnection();

        $studentModel = new Student($db);

        $student = $studentModel->getByIC($ic);


        // CHECK PASSWORD
        if (
            $student &&
            password_verify(
                $password,
                $student['password']
            )
        ) {

            // Prevent session fixation
            session_regenerate_id(true);

            $_SESSION['student_id'] = $student['id'];

            header(
                "Location: index.php?action=profile"
            );

            exit();

        } else {

            $_SESSION['error'] =
                "Invalid IC or password.";

            header(
                "Location: index.php?action=login"
            );

            exit();
        }
    }


    // =========================
    // CHANGE PASSWORD
    // =========================
    public function changePassword()
    {
        if (!isset($_SESSION['student_id'])) {

            header(
                "Location: index.php?action=login"
            );

            exit();
        }


        $oldPass = $_POST['old_password'] ?? '';
        $newPass = $_POST['new_password'] ?? '';
        $confirmPass = $_POST['confirm_password'] ?? '';


        // SERVER-SIDE VALIDATION
        if (
            $oldPass === '' ||
            $newPass === '' ||
            $confirmPass === ''
        ) {

            $_SESSION['error'] =
                "All password fields are required.";

            header(
                "Location: index.php?action=profile"
            );

            exit();
        }


        if (strlen($newPass) < 6) {

            $_SESSION['error'] =
                "New password must be at least 6 characters.";

            header(
                "Location: index.php?action=profile"
            );

            exit();
        }


        if ($newPass !== $confirmPass) {

            $_SESSION['error'] =
                "New passwords do not match.";

            header(
                "Location: index.php?action=profile"
            );

            exit();
        }


        $db = (new Database())->getConnection();

        $studentModel = new Student($db);

        $student = $studentModel->getById(
            $_SESSION['student_id']
        );


        if (!$student) {

            $_SESSION['error'] =
                "Student account not found.";

            header(
                "Location: index.php?action=login"
            );

            exit();
        }


        // VERIFY OLD PASSWORD
        if (
            !password_verify(
                $oldPass,
                $student['password']
            )
        ) {

            $_SESSION['error'] =
                "Old password is incorrect.";

        } else {

            // HASH NEW PASSWORD
            $hashedPassword = password_hash(
                $newPass,
                PASSWORD_DEFAULT
            );


            $studentModel->updatePassword(
                $_SESSION['student_id'],
                $hashedPassword
            );


            $_SESSION['success'] =
                "Password changed successfully.";
        }


        header(
            "Location: index.php?action=profile"
        );

        exit();
    }


    // =========================
    // LOGOUT
    // =========================
    public function logout()
    {
        $_SESSION = [];

        if (ini_get("session.use_cookies")) {

            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        session_destroy();

        header(
            "Location: index.php?action=login"
        );

        exit();
    }
}
?>