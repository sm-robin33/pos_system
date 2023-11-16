<?php
$conn = mysqli_connect("localhost","root","","core_pos");
if (!$conn) {
  echo "Failed to connect to MySQL";
  exit();
}
?>
<?php
$category_id = $_GET['id'];
$query = "DELETE FROM category WHERE id = $category_id";
$result = $conn->query($query);
if($result){
    $_SESSION['status'] = "Category Deleted";
    header("Location:index.php?page=category_list");
}else{
    $_SESSION['status'] = "Deletation Failed";
    header("Location:index.php?page=category_list");
}


?>