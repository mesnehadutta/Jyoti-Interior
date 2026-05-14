<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/dbconnection.php';

if (isset($_POST['submit'])) {
    $userName = trim((string) ($_POST['name'] ?? ''));
    $userEmail = trim((string) ($_POST['email'] ?? ''));
    $userPhone = trim((string) ($_POST['phone'] ?? ''));
    $userMessage = trim((string) ($_POST['message'] ?? ''));

    if ($userName !== '' && $userEmail !== '' && $userPhone !== '' && $userMessage !== '') {
        if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
            echo '
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
            window.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "warning",
                    title: "Invalid Email",
                    text: "Please enter a valid email address.",
                    confirmButtonColor: "#f0ad4e"
                });
            });
            </script>';
        } else {
            try {
                $statement = $conn->prepare(
                    'INSERT INTO free_consultation (name, email, phone, message, default_date)
                     VALUES (:name, :email, :phone, :message, NOW())'
                );
                $statement->execute([
                    ':name' => $userName,
                    ':email' => $userEmail,
                    ':phone' => $userPhone,
                    ':message' => $userMessage,
                ]);

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
            } catch (PDOException $exception) {
                echo '
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                window.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "error",
                        title: "Oops!",
                        text: "Unable to save your message right now.",
                        confirmButtonColor: "#d33"
                    });
                });
                </script>';
            }
        }
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
