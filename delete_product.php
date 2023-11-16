<?php

$_SESSION['status'] = "Product Deleted";
?>
<?php
$conn = mysqli_connect("localhost","root","","core_pos");
if (!$conn) {
  echo "Failed to connect to MySQL";
  exit();
}
?>
<?php
$product_id= $_GET['id'];
$query="DELETE FROM products where id=$product_id "; 
if($conn->query(($query))){
    echo $_SESSION ['status'];
    header("Location:index.php?page=product_list");
}
else{
    echo "Deletion Failed!";
    header("Location:index.php?page=index.php?page=product.list");
}
?>