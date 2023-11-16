
<?php
$conn = mysqli_connect("localhost","root","","core_pos");
if (!$conn) {
  echo "Failed to connect to MySQL";
  exit();
}
?>
  
<?php
$referance_id = $_GET['referance'];
$query1 = "DELETE FROM draft_parchase WHERE referance = $referance_id";
$result1 = $conn->query($query1);
$query = "DELETE FROM draft_parchase_details WHERE referance = $referance_id";
$result = $conn->query($query);
if($result1 and $result){
    $_SESSION['status'] = "Draft Deleted";
    header("Location:index.php?page=draft_list");
}else{
    $_SESSION['status'] = "Deletation Failed";
    header("Location:index.php?page=draft_list");
}
?>