
<?php
$conn = mysqli_connect("localhost","root","","core_pos");
if (!$conn) {
  echo "Failed to connect to MySQL";
  exit();
}
?>
  
<?php
$price_id = $_GET['id'];
$query = "DELETE FROM product_price WHERE id = $price_id";
$result = $conn->query($query);
if($result){
    $_SESSION['status'] = "Product Price Deleted";
    header("Location:index.php?page=product_price_list");
}else{
    $_SESSION['status'] = "Deletation Failed";
    header("Location:index.php?page=product_price_list");
}
?>