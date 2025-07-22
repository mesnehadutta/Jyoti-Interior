<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'dbconnection.php'; // Ensure this defines $conn properly

if (isset($_POST["submit"])) {
    if (
        !empty($_POST['name']) &&
        !empty($_POST['email']) &&
        !empty($_POST['phone']) &&
        !empty($_POST['message'])
    ) {
        $user_name = $_POST['name'];
        $user_email = $_POST['email'];
        $user_phone = $_POST['phone'];
        $user_msg = $_POST['message'];

        $sql = "INSERT INTO free_consultation (name, email, phone, message, default_date)
                VALUES (?, ?, ?, ?, NOW())";
        $stmt = $con->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssss", $user_name, $user_email, $user_phone, $user_msg);

            if ($stmt->execute()) {
                echo '
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                window.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "success",
                        title: "Thank you!",
                        text: "Message sent successfully!",
                        confirmButtonColor: "#3085d6"
                    }).then(function() {
                        window.location.href = "index.php";
                    });
                });
                </script>';
            } else {
                echo '
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                window.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "error",
                        title: "Oops!",
                        text: "Failed to execute statement.",
                        confirmButtonColor: "#d33"
                    });
                });
                </script>';
            }

            $stmt->close();
        } else {
            echo '
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
            window.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "error",
                    title: "Oops!",
                    text: "Failed to prepare statement.",
                    confirmButtonColor: "#d33"
                });
            });
            </script>';
        }

        $con->close();
    } else {
        echo '
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
        window.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "warning",
                title: "Missing Fields",
                text: "Please fill in all the required fields.",
                confirmButtonColor: "#f0ad4e"
            });
        });
        </script>';
    }
}
?>
