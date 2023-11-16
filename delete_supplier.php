<?php
$conn = mysqli_connect("localhost","root","","core_pos");
if (!$conn) {
  echo "Failed to connect to MySQL";
  exit();
}
?>

<?php
$supplier_id = $_GET['id'];
$query = "DELETE FROM supplier WHERE id = $supplier_id";
$result = $conn->query($query);
if($result){
    $_SESSION['status'] = "Supplier Deleted";
    header("Location:index.php?page=supplier_list");
}else{
    $_SESSION['status'] = "Deletation Failed";
    header("Location:index.php?page=supplier_list");
}


?>