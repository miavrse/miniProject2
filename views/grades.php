<?php include __DIR__ . "/includes/header.php"; ?>


<div class="d-flex justify-content-between align-items-center mb-3">

    <h3 class="mb-0">
        Grade Management System
    </h3>

</div>


<!-- =========================
     SUCCESS MESSAGE
     ========================= -->

<?php if (isset($_SESSION['success'])): ?>

    <div class="alert alert-success">

        <?= htmlspecialchars($_SESSION['success']); ?>

    </div>

    <?php unset($_SESSION['success']); ?>

<?php endif; ?>


<!-- =========================
     ERROR MESSAGE
     ========================= -->

<?php if (isset($_SESSION['error'])): ?>

    <div class="alert alert-danger">

        <?= htmlspecialchars($_SESSION['error']); ?>

    </div>

    <?php unset($_SESSION['error']); ?>

<?php endif; ?>



<!-- =========================
     CREATE STUDENT
     ========================= -->

<div class="card mb-4 shadow-sm">

    <div class="card-header bg-success text-white">

        <h5 class="mb-0">
            Add New Student Record
        </h5>

    </div>


    <div class="card-body">


        <form
            action="index.php?action=add_student"
            method="POST"
            id="addStudentForm"
            class="row g-3"
        >


            <!-- NAME -->
            <div class="col-md-3">

                <label class="form-label">
                    Name
                </label>

                <input
                    type="text"
                    name="name"
                    class="form-control"
                    required
                >

            </div>


            <!-- IC -->
            <div class="col-md-3">

                <label class="form-label">
                    NRIC
                </label>

                <input
                    type="text"
                    name="ic"
                    class="form-control"
                    placeholder="Without -"
                    required
                >

            </div>


            <!-- PROGRAM -->
            <div class="col-md-3">

                <label class="form-label">
                    Program
                </label>

                <input
                    type="text"
                    name="program"
                    class="form-control"
                    required
                >

            </div>


            <!-- MARKS -->
            <div class="col-md-2">

                <label class="form-label">
                    Marks
                </label>

                <input
                    type="number"
                    name="marks"
                    class="form-control"
                    min="0"
                    max="100"
                    required
                >

            </div>


            <!-- BUTTON -->
            <div class="col-md-1 d-flex align-items-end">

                <button
                    type="submit"
                    class="btn btn-success w-100"
                >
                    Add
                </button>

            </div>


        </form>

    </div>

</div>



<!-- =========================
     READ STUDENTS
     ========================= -->

<div class="card shadow-sm">

    <div class="card-header bg-dark text-white">

        <h5 class="mb-0">
            Student Records
        </h5>

    </div>


    <div class="card-body p-0">

        <div class="table-responsive">


            <table class="table table-bordered table-striped mb-0">

                <thead class="table-dark">

                    <tr>

                        <th>ID</th>

                        <th>Name</th>

                        <th>NRIC</th>

                        <th>Program</th>

                        <th>Marks</th>

                        <th width="180">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>


                <?php if (empty($allStudents)): ?>

                    <tr>

                        <td
                            colspan="6"
                            class="text-center py-4"
                        >
                            No student records found.
                        </td>

                    </tr>


                <?php else: ?>


                    <?php foreach ($allStudents as $row): ?>


                    <tr>

                        <td>
                            <?= htmlspecialchars($row['id']); ?>
                        </td>


                        <td>
                            <?= htmlspecialchars($row['name']); ?>
                        </td>


                        <td>
                            <?= htmlspecialchars($row['ic']); ?>
                        </td>


                        <td>
                            <?= htmlspecialchars($row['program']); ?>
                        </td>


                        <td>
                            <?= htmlspecialchars($row['marks']); ?>
                        </td>


                        <td>


                            <!-- UPDATE -->
                            <button
                                type="button"
                                class="btn btn-sm btn-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#editModal<?= $row['id']; ?>"
                            >
                                Edit
                            </button>


                            <!-- DELETE -->
                            <form
                                action="index.php?action=delete_student"
                                method="POST"
                                class="d-inline delete-form"
                            >

                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?= $row['id']; ?>"
                                >

                                <button
                                    type="submit"
                                    class="btn btn-sm btn-danger"
                                >
                                    Delete
                                </button>

                            </form>


                        </td>

                    </tr>



                    <!-- =========================
                         UPDATE MODAL
                         ========================= -->

                    <div
                        class="modal fade"
                        id="editModal<?= $row['id']; ?>"
                        tabindex="-1"
                        aria-hidden="true"
                    >

                        <div class="modal-dialog">

                            <div class="modal-content">


                                <form
                                    action="index.php?action=update_student"
                                    method="POST"
                                    class="edit-student-form"
                                >


                                    <div class="modal-header">

                                        <h5 class="modal-title">
                                            Edit Student Record
                                        </h5>

                                        <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal"
                                        ></button>

                                    </div>


                                    <div class="modal-body">


                                        <!-- ID -->
                                        <input
                                            type="hidden"
                                            name="id"
                                            value="<?= $row['id']; ?>"
                                        >


                                        <!-- NAME -->
                                        <div class="mb-3">

                                            <label class="form-label">
                                                Name
                                            </label>

                                            <input
                                                type="text"
                                                name="name"
                                                class="form-control"
                                                value="<?= htmlspecialchars($row['name']); ?>"
                                                required
                                            >

                                        </div>


                                        <!-- IC -->
                                        <div class="mb-3">

                                            <label class="form-label">
                                                NRIC
                                            </label>

                                            <input
                                                type="text"
                                                name="ic"
                                                class="form-control"
                                                value="<?= htmlspecialchars($row['ic']); ?>"
                                                required
                                            >

                                        </div>


                                        <!-- PROGRAM -->
                                        <div class="mb-3">

                                            <label class="form-label">
                                                Program
                                            </label>

                                            <input
                                                type="text"
                                                name="program"
                                                class="form-control"
                                                value="<?= htmlspecialchars($row['program']); ?>"
                                                required
                                            >

                                        </div>


                                        <!-- MARKS -->
                                        <div class="mb-3">

                                            <label class="form-label">
                                                Marks
                                            </label>

                                            <input
                                                type="number"
                                                name="marks"
                                                class="form-control"
                                                value="<?= htmlspecialchars($row['marks']); ?>"
                                                min="0"
                                                max="100"
                                                required
                                            >

                                        </div>


                                    </div>


                                    <div class="modal-footer">

                                        <button
                                            type="button"
                                            class="btn btn-secondary"
                                            data-bs-dismiss="modal"
                                        >
                                            Cancel
                                        </button>


                                        <button
                                            type="submit"
                                            class="btn btn-primary"
                                        >
                                            Save Changes
                                        </button>

                                    </div>


                                </form>

                            </div>

                        </div>

                    </div>


                    <?php endforeach; ?>

                <?php endif; ?>


                </tbody>

            </table>

        </div>

    </div>

</div>


<?php include __DIR__ . "/includes/footer.php"; ?>