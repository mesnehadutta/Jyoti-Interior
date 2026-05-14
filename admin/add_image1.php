<?php
require_once __DIR__ . '/../dbconnection.php';

if (isset($_POST['upload'])) {
    $name = trim((string) ($_POST['name'] ?? ''));

    if ($name === '' || empty($_FILES['image'])) {
        echo '<script>alert("Please select a category and image")</script>';
        exit();
    }

    try {
        $image = store_uploaded_image($_FILES['image'], __DIR__ . '/images');
        $statement = $conn->prepare('INSERT INTO image (name, image) VALUES (:name, :image)');
        $statement->execute([
            ':name' => $name,
            ':image' => $image,
        ]);

        echo '<script>alert("Added Successfully")</script>';
        echo '<script>window.location.href = "add_image.php"</script>';
    } catch (Throwable $exception) {
        echo '<script>alert("Problem in adding new record")</script>';
    }
}
?>
