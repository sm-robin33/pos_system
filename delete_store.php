
<?php
$conn = mysqli_connect("localhost","root","","core_pos");
if (!$conn) {
  echo "Failed to connect to MySQL";
  exit();
}
?>
  
<?php
$store_id = $_GET['id'];
$query = "DELETE FROM store WHERE id = $store_id";
$result = $conn->query($query);
if($result){
    $_SESSION['status'] = "Store Deleted";
    header("Location:index.php?page=store_list");
}else{
    $_SESSION['status'] = "Deletation Failed";
    header("Location:index.php?page=store_list");
}
?>