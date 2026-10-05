<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// =========================
// LOAD CONFIG / MODEL / CONTROLLERS
// =========================

require_once __DIR__ . "/config/database.php";
require_once __DIR__ . "/models/student.php";
require_once __DIR__ . "/controllers/authController.php";
require_once __DIR__ . "/controllers/gradeController.php";


// =========================
// GET ACTION
// =========================

$action = $_GET['action'] ?? 'login';


switch ($action) {


    // =========================
    // LOGIN PAGE
    // =========================

    case 'login':

        include __DIR__ . "/views/login.php";

        break;


    // =========================
    // LOGIN PROCESS
    // =========================

    case 'login_process':

        (new AuthController())->login();

        break;


    // =========================
    // PROFILE
    // =========================

    case 'profile':

        if (!isset($_SESSION['student_id'])) {

            header(
                "Location: index.php?action=login"
            );

            exit();
        }


        $db = (new Database())->getConnection();

        $studentModel = new Student($db);

        $studentData = $studentModel->getById(
            $_SESSION['student_id']
        );


        if (!$studentData) {

            session_destroy();

            header(
                "Location: index.php?action=login"
            );

            exit();
        }


        include __DIR__ . "/views/profile.php";

        break;


    // =========================
    // CHANGE PASSWORD
    // =========================

    case 'change_password':

        (new AuthController())->changePassword();

        break;


    // =========================
    // GRADE MANAGEMENT
    // =========================

    case 'grades':

        if (!isset($_SESSION['student_id'])) {

            header(
                "Location: index.php?action=login"
            );

            exit();
        }


        $db = (new Database())->getConnection();

        $studentModel = new Student($db);

        $allStudents = $studentModel->getAll();

        include __DIR__ . "/views/grades.php";

        break;


    // =========================
    // CREATE
    // =========================

    case 'add_student':

        (new GradeController())->store();

        break;


    // =========================
    // UPDATE
    // =========================

    case 'update_student':

        (new GradeController())->update();

        break;


    // =========================
    // DELETE
    // =========================

    case 'delete_student':

        (new GradeController())->delete();

        break;


    // =========================
    // LOGOUT
    // =========================

    case 'logout':

        (new AuthController())->logout();

        break;


    // =========================
    // DEFAULT
    // =========================

    default:

        header(
            "Location: index.php?action=login"
        );

        exit();
}
?>