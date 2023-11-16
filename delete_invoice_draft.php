
<?php
$conn = mysqli_connect("localhost","root","","core_pos");
if (!$conn) {
  echo "Failed to connect to MySQL";
  exit();
}
?>
  
<?php
$invoice_id = $_GET['invoice_no'];
$query1 = "DELETE FROM draft_invoice WHERE invoice_no = $invoice_id";
$result1 = $conn->query($query1);
$query = "DELETE FROM draft_invoice_details WHERE invoice_no = $invoice_id";
$result = $conn->query($query);
if($result1 and $result){
    $_SESSION['status'] = "Draft Deleted";
    header("Location:index.php?page=invoice_draft_list");
}else{
    $_SESSION['status'] = "Deletation Failed";
    header("Location:index.php?page=invoice_draft_list");
}
?>