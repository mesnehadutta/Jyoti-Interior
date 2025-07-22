<?php
session_start();  
  // Create database connection
 require_once("../dbconnection.php");
$id=$_GET['id'];
  // Initialize message variable
 //echo $id;

  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
    // Get image name
    $image = $_FILES['image']['name'];// predefined image is image and name is the image format(jpg or png)
    // Get text
    

    // image file directory
    $target = "images/".basename($image);//

    $sql = "UPDATE image SET image='$image'  WHERE id='$id' ";
    // execute query
    //mysqli_query($sql);
    $result=$con->query($sql);
    if($result)
    {

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) { // tmp_name:stores the name of the temporary file, move_uploaded_file() function which moves an uploaded file from its temporary to permanent location
       //echo '<script>alert(" Profile Picture Saved Successfully")</script>';
       echo'<script>window.location.href = "display_image.php"</script>';



    }else{
      echo '<script>alert("Problem in Adding Profile Picture")</script>';
    }
  }
  }


?>