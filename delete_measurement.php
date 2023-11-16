<?php ob_start(); ?>
<?php

$_SESSION['status'] = "Measurement Deleted";
?>
<?php
$conn = mysqli_connect("localhost","root","","core_pos");
if (!$conn) {
  echo "Failed to connect to MySQL";
  exit();
}
?>
<?php
$measurement_id=$_GET['id'];
$query= "DELETE FROM measurements WHERE id=$measurement_id";
$result= $conn->query($query);
if($result){
    header("Location:index.php?page=measurement_list");
}
else{
    echo "Deletation Failed";
    header("Location:index.php?page=measurement_list");
}
?>
<?php ob_flush(); ?>