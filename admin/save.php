<?php
require_once __DIR__ . '/../dbconnection.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Required fields are not set']);
    exit();
}

$id = filter_input(INPUT_GET, 'cid', FILTER_VALIDATE_INT);
if (!$id) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid project ID']);
    exit();
}

$dates = $_POST['date'] ?? [];
$workDoneList = $_POST['work_done'] ?? [];
$workDetailList = $_POST['work_detail'] ?? [];
$pendingAmountList = $_POST['pending_amount'] ?? [];
$existingImages = $_POST['image_name'] ?? [];

try {
    $conn->beginTransaction();

    $deleteStatement = $conn->prepare('DELETE FROM project_description WHERE project_id = :project_id');
    $deleteStatement->execute([':project_id' => $id]);

    $insertStatement = $conn->prepare(
        'INSERT INTO project_description
        (project_id, date1, work_done, work_details, pending_amount, image, image_name)
        VALUES (:project_id, :date1, :work_done, :work_details, :pending_amount, :image, :image_name)'
    );

    foreach ($dates as $key => $value) {
        $date = trim((string) $value);
        $workDone = trim((string) ($workDoneList[$key] ?? ''));
        $workDetail = trim((string) ($workDetailList[$key] ?? ''));
        $pendingAmount = trim((string) ($pendingAmountList[$key] ?? ''));
        $imageName = trim((string) ($existingImages[$key] ?? ''));

        if (isset($_FILES['images']['error'][$key]) && $_FILES['images']['error'][$key] === UPLOAD_ERR_OK) {
            $singleFile = [
                'name' => $_FILES['images']['name'][$key],
                'type' => $_FILES['images']['type'][$key],
                'tmp_name' => $_FILES['images']['tmp_name'][$key],
                'error' => $_FILES['images']['error'][$key],
                'size' => $_FILES['images']['size'][$key],
            ];
            $imageName = store_uploaded_image($singleFile, __DIR__ . '/images');
        }

        $insertStatement->execute([
            ':project_id' => $id,
            ':date1' => $date,
            ':work_done' => $workDone,
            ':work_details' => $workDetail,
            ':pending_amount' => $pendingAmount,
            ':image' => $imageName,
            ':image_name' => $imageName,
        ]);
    }

    $conn->commit();
    echo json_encode(['status' => 'success', 'message' => 'Data added successfully']);
} catch (Throwable $exception) {
    if ($conn->inTransaction()) {
        $conn->rollBack();
    }

    echo json_encode(['status' => 'error', 'message' => 'Failed to save project data']);
}
?>
