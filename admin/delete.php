<?php
require_once __DIR__ . '/../dbconnection.php';

$id = filter_input(INPUT_GET, 'ID', FILTER_VALIDATE_INT);

if ($id) {
    $statement = $conn->prepare('DELETE FROM free_consultation WHERE ID = :id');
    $statement->execute([':id' => $id]);
}

redirect('get_consultation_data.php');
?>
