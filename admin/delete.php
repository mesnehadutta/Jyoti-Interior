

<?php
include("../dbconnection.php");
$sql = "DELETE FROM free_consultation WHERE ID='" . $_GET["ID"] . "'";
if (mysqli_query($con, $sql)) {
    echo  '<script>alert("Record deleted successfully")<scipt>';
      header("Location:get_consultation_data.php");
} else {
    echo '<script>alert("Error deleting record: " . mysqli_error($conn))</scipt>';
}
mysqli_close($con);
?>