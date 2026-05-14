<?php
session_start();
require_once __DIR__ . '/../dbconnection.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    redirect('display_image.php');
}

if (isset($_POST['upload']) && !empty($_FILES['image'])) {
    try {
        $image = store_uploaded_image($_FILES['image'], __DIR__ . '/images');
        $statement = $conn->prepare('UPDATE image SET image = :image WHERE id = :id');
        $statement->execute([
            ':image' => $image,
            ':id' => $id,
        ]);

        redirect('display_image.php');
    } catch (Throwable $exception) {
        echo '<script>alert("Problem in updating image")</script>';
    }
}
?>
