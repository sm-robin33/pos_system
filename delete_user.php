<?php
$conn = mysqli_connect("localhost","root","","core_pos");
if (!$conn) {
  echo "Failed to connect to MySQL";
  exit();
}
?>

<?php
$user_id = $_GET['id'];
$query = "DELETE FROM users WHERE id = $user_id";
$result = $conn->query($query);
if($result){
    $_SESSION['status'] = "User Deleted";
    header("Location:index.php?page=user_list");
}else{
    $_SESSION['status'] = "Deletation Failed";
    header("Location:index.php?page=user_list");
}


?>