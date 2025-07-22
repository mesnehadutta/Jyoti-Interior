<?php 
include("../dbconnection.php");


if(isset($_POST["upload"]))
{
    $link=$_POST['link'];
    $description=$_POST['description'];

    $sql="INSERT INTO you_tube_links (link,description) VALUES ('$link','$description')";
    $result=$con->query($sql);

    if($result)
    {
      echo  '<script>alert("Link Added Successfully")</script>';
      

        echo'<script>window.location.href = "youtube.php"</script>';
      
    }

    else
    {
      echo '<script>alert("Problem in adding new record ")</script>';
    }
 }

mysqli_close($con);
?>

