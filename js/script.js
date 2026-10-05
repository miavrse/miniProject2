document.addEventListener("DOMContentLoaded", function () {

    const loginForm = document.getElementById("loginForm");

    if (loginForm) {

        loginForm.addEventListener("submit", function (event) {

            const ic = document.getElementById("loginIC");
            const password = document.getElementById("loginPassword");


            if (ic.value.trim() === "") {

                event.preventDefault();

                ic.classList.add("is-invalid");

                alert("Please enter your NRIC.");

                return;
            }


            if (password.value.trim() === "") {

                event.preventDefault();

                password.classList.add("is-invalid");

                alert("Please enter your password.");

                return;
            }

        });
    }


    const passwordForm =
        document.getElementById("passwordForm");

    if (passwordForm) {

        passwordForm.addEventListener(
            "submit",
            function (event) {

                const newPassword =
                    document.getElementById("newPassword");

                const confirmPassword =
                    document.getElementById("confirmPassword");


                if (newPassword.value.length < 6) {

                    event.preventDefault();

                    alert(
                        "New password must be at least 6 characters."
                    );

                    return;
                }


                if (
                    newPassword.value !==
                    confirmPassword.value
                ) {

                    event.preventDefault();

                    alert(
                        "New passwords do not match."
                    );

                    return;
                }

            }
        );
    }


    const deleteForms =
        document.querySelectorAll(".delete-form");


    deleteForms.forEach(function (form) {

        form.addEventListener("submit", function (event) {

            const confirmed = confirm(
                "Are you sure you want to permanently delete this student record?"
            );


            if (!confirmed) {

                event.preventDefault();

            }

        });

    });


    const addForm =
        document.getElementById("addStudentForm");


    if (addForm) {

        addForm.addEventListener(
            "submit",
            function (event) {

                const marks =
                    addForm.querySelector(
                        "input[name='marks']"
                    );


                if (
                    marks.value < 0 ||
                    marks.value > 100
                ) {

                    event.preventDefault();

                    alert(
                        "Marks must be between 0 and 100."
                    );

                }

            }
        );

    }


});