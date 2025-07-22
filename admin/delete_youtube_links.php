<?php
include("../dbconnection.php");
$sql = "DELETE FROM you_tube_links WHERE ID='" . $_GET["ID"] . "'";
if (mysqli_query($con, $sql)) {
    echo  '<script>alert("Record deleted successfully")<scipt>';
      header("Location:display_youtube_links.php");
} else {
    echo '<script>alert("Error deleting record: " . mysqli_error($conn))</scipt>';
}
mysqli_close($con);
?>