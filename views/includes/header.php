<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>PSP Student Portal</title>


    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!-- Custom CSS -->
    <link
        rel="stylesheet"
        href="css/style.css"
    >

</head>


<body class="bg-light">

<div class="container py-4">


<?php if (isset($_SESSION['student_id'])): ?>

    <nav
        class="navbar navbar-dark bg-purple mb-4 px-3 rounded-4"
    >

        <span class="navbar-brand fw-bold">
            PSP Student Portal
        </span>


        <div class="d-flex gap-2">

            <a
                href="index.php?action=profile"
                class="btn btn-outline-light btn-sm"
            >
                Profile
            </a>


            <a
                href="index.php?action=grades"
                class="btn btn-outline-light btn-sm"
            >
                Grade Management
            </a>


            <a
                href="index.php?action=logout"
                class="btn btn-danger btn-sm"
            >
                Logout
            </a>

        </div>

    </nav>

<?php endif; ?>