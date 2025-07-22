<?php
include("../dbconnection.php");
$sql = "DELETE FROM image WHERE id='" . $_GET["id"] . "'";
if (mysqli_query($con, $sql)) {
    echo  '<script>alert("Record deleted successfully")<scipt>';
      header("Location:display_image.php");
} else {
    echo '<script>alert("Error deleting record: " . mysqli_error($conn))</scipt>';
}
mysqli_close($con);
?>