<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'decohouse';
$port = 3306;

// Create connection
$con = mysqli_connect( 'localhost', 'root', '', 'jyoti_interior', '3306' );


// Check connection
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
} else {
    // Uncomment this line only during testing
    // echo "Database connected successfully<br>";
}
?>
