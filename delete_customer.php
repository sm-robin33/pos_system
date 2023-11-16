<?php ob_start(); 
$_SESSION['status'] = "Customer Deleted";
?>
<?php
$conn = mysqli_connect("localhost","root","","core_pos");
if (!$conn) {
  echo "Failed to connect to MySQL";
  exit();
}
?>
<?php
$customer_id= $_GET['id'];
$query="DELETE FROM customers where id=$customer_id "; 
if($conn->query(($query))){
    echo $_SESSION ['status'];
    header("Location:index.php?page=customer_list");
}
else{
    echo "Deletion Failed!";
    header("Location:index.php?page=index.php?page=customer.list");
}
?>
<?php ob_flush(); ?>