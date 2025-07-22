<?php
include('../dbconnection.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') 
{
	$id = $_GET['cid'];
	// Delete existing data for the project
	$delete_query = "DELETE FROM project_description WHERE project_id='$id'";
	$delete_result = mysqli_query($con, $delete_query);
	if ($delete_result) {
		foreach ($_POST['date'] as $key=>$value) {
			
			$date = $_POST['date'][$key];
			$work_dones = $_POST['work_done'][$key];
			$work_details = $_POST['work_detail'][$key];
			$pending_amounts = $_POST['pending_amount'][$key];

			$work_done = mysqli_real_escape_string($con, $work_dones);
			$work_detail = mysqli_real_escape_string($con, $work_details);
			$pending_amount = mysqli_real_escape_string($con, $pending_amounts);

			// if(!empty($_POST['image_name'][$key]))
			// {
			// 	$IMAGE=$_POST['image_name'][$key];
			// }

			// else
			// {
				$sourcePath = $_FILES['images']['tmp_name'][$key];
				$image=$_FILES['images']['name'][$key];
				$targetPath = "images/" .basename($image);
				move_uploaded_file($sourcePath, $targetPath);
				$IMAGE=$_FILES['images']['name'][$key];
				if(empty($IMAGE))
				{
					$IMAGE=$_POST['image_name'][$key];
				}
			// }
				

			$query1="INSERT INTO project_description(project_id,date1,work_done,work_details,pending_amount,image,image_name)VALUES ('$id','$date','$work_done','$work_detail','$pending_amount','$IMAGE','$IMAGE')";
			$inser_query=mysqli_query($con, $query1);
		}	


		$response = array('status' => 'success', 'message' => 'Data added successfully');
		echo json_encode($response);
	} 
	else {
		$response = array('status' => 'error', 'message' => 'Failed to delete existing data');
		echo json_encode($response);
	}
} 
else {
	$response = array('status' => 'error', 'message' => 'Required fields are not set');
	echo json_encode($response);
}

mysqli_close($con);
?>
