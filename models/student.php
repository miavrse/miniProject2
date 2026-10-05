<?php

class Student
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // =========================
    // LOGIN - GET STUDENT BY IC
    // =========================
    public function getByIC($ic)
    {
        $stmt = $this->conn->prepare(
            "SELECT * FROM students WHERE ic = :ic LIMIT 1"
        );

        $stmt->execute([
            ':ic' => $ic
        ]);

        return $stmt->fetch();
    }


    // =========================
    // GET STUDENT BY ID
    // =========================
    public function getById($id)
    {
        $stmt = $this->conn->prepare(
            "SELECT * FROM students WHERE id = :id LIMIT 1"
        );

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch();
    }


    // =========================
    // READ ALL STUDENTS
    // =========================
    public function getAll()
    {
        $stmt = $this->conn->prepare(
            "SELECT id, ic, name, program, marks
             FROM students
             ORDER BY id DESC"
        );

        $stmt->execute();

        return $stmt->fetchAll();
    }


    // =========================
    // CREATE STUDENT
    // =========================
    public function create($ic, $name, $program, $marks)
    {
        // Default password for newly created student
        $defaultPassword = password_hash(
            "123456",
            PASSWORD_DEFAULT
        );

        $stmt = $this->conn->prepare(
            "INSERT INTO students
            (ic, name, program, password, marks)
            VALUES
            (:ic, :name, :program, :password, :marks)"
        );

        return $stmt->execute([
            ':ic' => $ic,
            ':name' => $name,
            ':program' => $program,
            ':password' => $defaultPassword,
            ':marks' => $marks
        ]);
    }


    // =========================
    // UPDATE STUDENT
    // =========================
    public function update(
        $id,
        $name,
        $ic,
        $program,
        $marks
    ) {
        $stmt = $this->conn->prepare(
            "UPDATE students
             SET name = :name,
                 ic = :ic,
                 program = :program,
                 marks = :marks
             WHERE id = :id"
        );

        return $stmt->execute([
            ':name' => $name,
            ':ic' => $ic,
            ':program' => $program,
            ':marks' => $marks,
            ':id' => $id
        ]);
    }


    // =========================
    // DELETE STUDENT
    // =========================
    public function delete($id)
    {
        $stmt = $this->conn->prepare(
            "DELETE FROM students WHERE id = :id"
        );

        return $stmt->execute([
            ':id' => $id
        ]);
    }


    // =========================
    // UPDATE PASSWORD
    // =========================
    public function updatePassword(
        $id,
        $hashedPassword
    ) {
        $stmt = $this->conn->prepare(
            "UPDATE students
             SET password = :password
             WHERE id = :id"
        );

        return $stmt->execute([
            ':password' => $hashedPassword,
            ':id' => $id
        ]);
    }


    // =========================
    // CHECK DUPLICATE IC
    // =========================
    public function icExists($ic, $excludeId = null)
    {
        if ($excludeId !== null) {

            $stmt = $this->conn->prepare(
                "SELECT id
                 FROM students
                 WHERE ic = :ic
                 AND id != :id
                 LIMIT 1"
            );

            $stmt->execute([
                ':ic' => $ic,
                ':id' => $excludeId
            ]);

        } else {

            $stmt = $this->conn->prepare(
                "SELECT id
                 FROM students
                 WHERE ic = :ic
                 LIMIT 1"
            );

            $stmt->execute([
                ':ic' => $ic
            ]);
        }

        return $stmt->fetch() !== false;
    }

    // =========================
    // UPDATE PROFILE PICTURE
    // =========================
    public function updateProfilePic($id, $filename)
    {
        $stmt = $this->conn->prepare(
            "UPDATE students
             SET profile_pic = :profile_pic
             WHERE id = :id"
        );

        return $stmt->execute([
            ':profile_pic' => $filename,
            ':id' => $id
        ]);
    }
}
?>