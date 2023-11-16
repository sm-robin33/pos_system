<?php
$conn = mysqli_connect("localhost","root","","core_pos");
if (!$conn) {
  echo "Failed to connect to MySQL";
  exit();
}
?>

<?php
$subcategory_id = $_GET['id'];
$query = "DELETE FROM sub_category WHERE id = $subcategory_id";
$result = $conn->query($query);
if($result){
    $_SESSION['status'] = "Sub Category Deleted";
    header("Location:index.php?page=subcategory_list");
}else{
    $_SESSION['status'] = "Deletation Failed";
    header("Location:index.php?page=subcategory_list");
}


?>