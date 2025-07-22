<?php 
include("../dbconnection.php");

if(isset($_POST["upload"])) {
    $id=0;
    $id++;
    $project=$_POST['project'];
    $start_date=$_POST['start-date'];
    $end_date=$_POST['end-date'];
    $client_id=$_POST['client_id'];
    $total_amount=$_POST['total_amount'];
    $amount_paid=$_POST['amount_paid'];
    $client_address=$_POST['client_address'];
    
    // Initialize result variables
    $result = $result1 = $result2 = false;

    // Insert project details into project_details table
    $sql="INSERT INTO project_details (project,start_date,end_date,client_id,total_amount,amount_paid,client_address) VALUES ('$project','$start_date','$end_date','$client_id','$total_amount','$amount_paid','$client_address')";
    $result=$con->query($sql);
    
    // Get the last inserted project id
    $last_project_id = $con->insert_id;
        $sql1="INSERT INTO project_description (project_id) VALUES ('$last_project_id')";
                    $result1=$con->query($sql1);
if(isset($_FILES['images']['name']) && count($_FILES['images']['name']) > 0) {
        // Loop through each file
        for($i=0; $i<count($_FILES['images']['name']); $i++) {
            $tmpFilePath = $_FILES['images']['tmp_name'][$i];
            $fileSize = $_FILES['images']['size'][$i]; // Get file size

            // Check if file exists and file size is not more than 4MB
            if($tmpFilePath != "" && $fileSize <= 4 * 1024 * 1024) {
                // Save the file to a directory
                $filePath = "images/" . $_FILES['images']['name'][$i];
                if(move_uploaded_file($tmpFilePath, $filePath)) {
                    // Insert file details into project_description table
                    $image_insert="INSERT INTO project_image (project_id,images) VALUES('$last_project_id','$filePath')";
                    $result2=$con->query($image_insert);
                } else {
                    echo '<script>alert("Error uploading file.")</script>';
                }
            } else {
                echo '<script>alert("File size exceeds 4 MB limit.")</script>';
            }
        }
    }

    if(($result) && ($result1) && ($result2)) {
        echo '<script>alert("Details Added Successfully")</script>';
        echo '<script>window.location.href = "display_project.php"</script>';
    } else {
        echo '<script>alert("Problem in adding new record ")</script>';
        echo '<script>window.location.href = "project_details.php"</script>';
    }
}


mysqli_close($con);
?>
