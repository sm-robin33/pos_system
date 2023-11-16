
<?php
$conn = mysqli_connect("localhost","root","","core_pos");
if (!$conn) {
  echo "Failed to connect to MySQL";
  exit();
}
?>
  
<?php
$inventory_id = $_GET['id'];
$query = "DELETE FROM inventory WHERE id = $inventory_id";
$result = $conn->query($query);
if($result){
    $_SESSION['status'] = "Inventory Deleted";
    header("Location:index.php?page=inventory_list");
}else{
    $_SESSION['status'] = "Deletation Failed";
    header("Location:index.php?page=inventory_list");
}
?>
