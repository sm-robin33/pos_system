
<?php
$conn = mysqli_connect("localhost","root","","core_pos");
if (!$conn) {
  echo "Failed to connect to MySQL";
  exit();
}
?>
  
<?php
$brand_id = $_GET['id'];
$query = "DELETE FROM brands WHERE id = $brand_id";
$result = $conn->query($query);
if($result){
    $_SESSION['status'] = "Brand Deleted";
    header("Location:index.php?page=brand_list");
}else{
    $_SESSION['status'] = "Deletation Failed";
    header("Location:index.php?page=brand_list");
}
?>
