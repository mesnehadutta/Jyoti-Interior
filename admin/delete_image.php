<?php
require_once __DIR__ . '/../dbconnection.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id) {
    $statement = $conn->prepare('DELETE FROM image WHERE id = :id');
    $statement->execute([':id' => $id]);
}

redirect('display_image.php');
?>
