<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/student.php';


class GradeController
{

    public function __construct()
    {
        // Only logged-in users can access grade management
        if (!isset($_SESSION['student_id'])) {

            header(
                "Location: index.php?action=login"
            );

            exit();
        }
    }


    // =========================
    // CREATE
    // =========================
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            header(
                "Location: index.php?action=grades"
            );

            exit();
        }


        $name = trim($_POST['name'] ?? '');
        $ic = trim($_POST['ic'] ?? '');
        $program = trim($_POST['program'] ?? '');
        $marks = $_POST['marks'] ?? '';


        // SERVER-SIDE VALIDATION
        if ($name === '') {

            $_SESSION['error'] =
                "Name is required.";

            header(
                "Location: index.php?action=grades"
            );

            exit();
        }


        if ($ic === '') {

            $_SESSION['error'] =
                "IC is required.";

            header(
                "Location: index.php?action=grades"
            );

            exit();
        }


        if ($program === '') {

            $_SESSION['error'] =
                "Program is required.";

            header(
                "Location: index.php?action=grades"
            );

            exit();
        }


        if (
            $marks === '' ||
            !is_numeric($marks) ||
            $marks < 0 ||
            $marks > 100
        ) {

            $_SESSION['error'] =
                "Marks must be between 0 and 100.";

            header(
                "Location: index.php?action=grades"
            );

            exit();
        }


        $db = (new Database())->getConnection();

        $studentModel = new Student($db);


        // CHECK DUPLICATE IC
        if ($studentModel->icExists($ic)) {

            $_SESSION['error'] =
                "This IC already exists.";

            header(
                "Location: index.php?action=grades"
            );

            exit();
        }


        try {

            $studentModel->create(
                $ic,
                $name,
                $program,
                (int)$marks
            );

            $_SESSION['success'] =
                "Student added successfully.";

        } catch (PDOException $e) {

            $_SESSION['error'] =
                "Unable to add student.";
        }


        header(
            "Location: index.php?action=grades"
        );

        exit();
    }


    // =========================
    // UPDATE
    // =========================
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            header(
                "Location: index.php?action=grades"
            );

            exit();
        }


        $id = $_POST['id'] ?? '';
        $name = trim($_POST['name'] ?? '');
        $ic = trim($_POST['ic'] ?? '');
        $program = trim($_POST['program'] ?? '');
        $marks = $_POST['marks'] ?? '';


        // VALIDATE ID
        if (
            $id === '' ||
            !filter_var($id, FILTER_VALIDATE_INT)
        ) {

            $_SESSION['error'] =
                "Invalid student ID.";

            header(
                "Location: index.php?action=grades"
            );

            exit();
        }


        // VALIDATE NAME
        if ($name === '') {

            $_SESSION['error'] =
                "Name is required.";

            header(
                "Location: index.php?action=grades"
            );

            exit();
        }


        // VALIDATE IC
        if ($ic === '') {

            $_SESSION['error'] =
                "IC is required.";

            header(
                "Location: index.php?action=grades"
            );

            exit();
        }


        // VALIDATE PROGRAM
        if ($program === '') {

            $_SESSION['error'] =
                "Program is required.";

            header(
                "Location: index.php?action=grades"
            );

            exit();
        }


        // VALIDATE MARKS
        if (
            $marks === '' ||
            !is_numeric($marks) ||
            $marks < 0 ||
            $marks > 100
        ) {

            $_SESSION['error'] =
                "Marks must be between 0 and 100.";

            header(
                "Location: index.php?action=grades"
            );

            exit();
        }


        $db = (new Database())->getConnection();

        $studentModel = new Student($db);


        // CHECK DUPLICATE IC
        if (
            $studentModel->icExists(
                $ic,
                (int)$id
            )
        ) {

            $_SESSION['error'] =
                "This IC already belongs to another student.";

            header(
                "Location: index.php?action=grades"
            );

            exit();
        }


        try {

            $studentModel->update(
                (int)$id,
                $name,
                $ic,
                $program,
                (int)$marks
            );

            $_SESSION['success'] =
                "Student record updated successfully.";

        } catch (PDOException $e) {

            $_SESSION['error'] =
                "Unable to update student.";
        }


        header(
            "Location: index.php?action=grades"
        );

        exit();
    }


    // =========================
    // DELETE
    // =========================
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            header(
                "Location: index.php?action=grades"
            );

            exit();
        }


        $id = $_POST['id'] ?? '';


        if (
            $id === '' ||
            !filter_var($id, FILTER_VALIDATE_INT)
        ) {

            $_SESSION['error'] =
                "Invalid student ID.";

            header(
                "Location: index.php?action=grades"
            );

            exit();
        }


        $db = (new Database())->getConnection();

        $studentModel = new Student($db);


        try {

            $studentModel->delete((int)$id);

            $_SESSION['success'] =
                "Student record deleted successfully.";

        } catch (PDOException $e) {

            $_SESSION['error'] =
                "Unable to delete student.";
        }


        header(
            "Location: index.php?action=grades"
        );

        exit();
    }
}
?>