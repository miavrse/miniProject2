<?php include __DIR__ . "/includes/header.php"; ?>


<div class="row">


    <!-- =========================
         STUDENT PROFILE
         ========================= -->

    <div class="col-md-6 mb-4">

        <div class="card shadow-sm h-100">

            <div class="card-header bg-secondary text-white">

                <h5 class="mb-0">
                    Student Profile
                </h5>

            </div>


            <div class="card-body">

                <!-- PROFILE PICTURE DISPLAY -->
                <div class="text-center mb-4">
                    <?php 
                        $avatar = !empty($studentData['profile_pic']) ? $studentData['profile_pic'] : 'default.png';
                    ?>
                    <img src="uploads/<?= htmlspecialchars($avatar); ?>" 
                         alt="Profile Picture" 
                         class="rounded-circle img-thumbnail shadow-sm" 
                         style="width: 140px; height: 140px; object-fit: cover;">
                </div>

                <!-- PROFILE PICTURE UPLOAD FORM -->
                <form action="index.php?action=upload_profile_pic" method="POST" enctype="multipart/form-data" class="mb-4 p-3 bg-light rounded border">
                    <label class="form-label fw-bold">Update Profile Picture</label>
                    <input type="file" name="profile_pic" class="form-control mb-2" accept="image/jpeg, image/jpg, image/png" required>
                    <small class="text-muted d-block mb-2">Max 2MB (.jpg, .jpeg, .png only)</small>
                    <button type="submit" class="btn btn-purple text-white w-100" style="background-color: #6f42c1; border-color: #6f42c1;">
                        Upload Picture
                    </button>
                </form>

                <hr>


                <div class="mb-3">

                    <strong>Name:</strong>

                    <div class="profile-value">

                        <?= htmlspecialchars(
                            $studentData['name']
                        ); ?>

                    </div>

                </div>


                <div class="mb-3">

                    <strong>NRIC:</strong>

                    <div class="profile-value">

                        <?= htmlspecialchars(
                            $studentData['ic']
                        ); ?>

                    </div>

                </div>


                <div class="mb-3">

                    <strong>Program:</strong>

                    <div class="profile-value">

                        <?= htmlspecialchars(
                            $studentData['program']
                        ); ?>

                    </div>

                </div>


                <div>

                    <strong>Marks:</strong>

                    <div class="profile-value">

                        <?= htmlspecialchars(
                            $studentData['marks']
                        ); ?>

                    </div>

                </div>


            </div>

        </div>

    </div>



    <!-- =========================
         CHANGE PASSWORD
         ========================= -->

    <div class="col-md-6 mb-4">

        <div class="card shadow-sm h-100">

            <div class="card-header bg-warning">

                <h5 class="mb-0">
                    Password Exchange Module
                </h5>

            </div>


            <div class="card-body">


                <?php if (isset($_SESSION['error'])): ?>

                    <div class="alert alert-danger">

                        <?= htmlspecialchars(
                            $_SESSION['error']
                        ); ?>

                    </div>

                    <?php unset($_SESSION['error']); ?>

                <?php endif; ?>


                <?php if (isset($_SESSION['success'])): ?>

                    <div class="alert alert-success">

                        <?= htmlspecialchars(
                            $_SESSION['success']
                        ); ?>

                    </div>

                    <?php unset($_SESSION['success']); ?>

                <?php endif; ?>


                <form
                    action="index.php?action=change_password"
                    method="POST"
                    id="passwordForm"
                >


                    <!-- OLD PASSWORD -->
                    <div class="mb-3">

                        <label class="form-label">
                            Old Password
                        </label>

                        <input
                            type="password"
                            name="old_password"
                            class="form-control"
                            required
                        >

                    </div>


                    <!-- NEW PASSWORD -->
                    <div class="mb-3">

                        <label class="form-label">
                            New Password
                        </label>

                        <input
                            type="password"
                            name="new_password"
                            id="newPassword"
                            class="form-control"
                            minlength="6"
                            required
                        >

                        <small class="text-muted">
                            Minimum 6 characters.
                        </small>

                    </div>


                    <!-- CONFIRM PASSWORD -->
                    <div class="mb-3">

                        <label class="form-label">
                            Confirm Password
                        </label>

                        <input
                            type="password"
                            name="confirm_password"
                            id="confirmPassword"
                            class="form-control"
                            minlength="6"
                            required
                        >

                    </div>


                    <button
                        type="submit"
                        class="btn btn-warning w-100"
                    >
                        Update Password
                    </button>


                </form>

            </div>

        </div>

    </div>

</div>


<?php include __DIR__ . "/includes/footer.php"; ?>