<?php
// Assuming $con is your database connection
include('../dbconnection.php');
if (isset($_POST['ID'])) {
    $id = $_POST['ID'];

    // Delete data from project_details table
    $sql1 = "DELETE FROM project_details WHERE id = '$id'";
    $result1=$con->query($sql1);

    // Delete data from project_description table
    $sql2 = "DELETE FROM project_description WHERE project_id = '$id'";
    $result2=$con->query($sql2);

    // Delete data from project_image table
    $sql3 = "DELETE FROM project_image WHERE project_id = '$id'";
    $result3=$con->query($sql3);

    if ($result1 && $result2 && $result3) {
        $response['status'] = 'success';
        $response['message'] = 'Data deleted successfully.';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error deleting data.';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'ID not provided.';
}

// Output response as JSON
echo json_encode($response);
?>
