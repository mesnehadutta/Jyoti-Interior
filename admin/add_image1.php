  <?php
  include('../dbconnection.php');
  // If upload button is clicked ...
  if (isset($_POST['upload'])) 
  {
    $name=$_POST['name'];
    $image = $_FILES['image']['name'];
    $target = "images/".basename($image);

    $sql = "INSERT INTO image (name,image) VALUES ('$name','$image')";
    // execute query
    //mysqli_query($con, $sql); 
    if (mysqli_query($con, $sql))
    {
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) 
    {
        echo'<script>alert("Added Successfully")</script>';
        echo'<script>window.location.href = "add_image.php"</script>';
    }

    }
    else
    {
        echo '<script>alert("Problem in adding new record")</script>';  
    }
  }
?>