<?php include __DIR__ . "/includes/header.php"; ?>

<div class="login-wrapper">

    <div class="login-card">

        <div class="card-header bg-purple text-white text-center py-4">

            <h2 class="mb-1 fw-bold">
                PSP Student Login
            </h2>

            <p class="mb-0">
                Student Portal
            </p>

        </div>


        <div class="card-body p-4">

            <?php if (isset($_SESSION['error'])): ?>

                <div class="alert alert-danger">
                    <?= htmlspecialchars($_SESSION['error']); ?>
                </div>

                <?php unset($_SESSION['error']); ?>

            <?php endif; ?>


            <form
                action="index.php?action=login_process"
                method="POST"
                id="loginForm"
            >

                <div class="mb-3">

                    <label class="form-label fw-bold">
                        NRIC Number
                    </label>

                    <input
                        type="text"
                        name="ic"
                        id="loginIC"
                        class="form-control"
                        placeholder="Enter your NRIC"
                        required
                    >

                </div>


                <div class="mb-4">

                    <label class="form-label fw-bold">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        id="loginPassword"
                        class="form-control"
                        placeholder="Enter your password"
                        required
                    >

                </div>


                <button
                    type="submit"
                    class="btn btn-purple w-100 py-2 fw-bold"
                >
                    Login
                </button>

            </form>

        </div>

    </div>

</div>


<?php include __DIR__ . "/includes/footer.php"; ?>