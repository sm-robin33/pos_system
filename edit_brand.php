
<?php
$conn = mysqli_connect("localhost","root","","core_pos");
if (!$conn) {
  echo "Failed to connect to MySQL";
  exit();
}
?>
  
<?php
$brand_id = $_GET['id'];
$query = "SELECT * FROM brands WHERE id='$brand_id'";
$result = $conn->query($query);
$row = mysqli_fetch_array($result);

if(isset($_POST['edit_brand'])){
  $b_name = $_POST['name'];
  $query = "UPDATE brands SET brand_name = '$b_name' WHERE id = $brand_id ";
  if($conn->query($query)){
    $_SESSION['status'] = "Brand Updated";
    header("Location:index.php?page=brand_list");
  }else{
    $_SESSION['status'] = "Update Failed";
    header("Location:index.php?page=edit_brand");
  }
}





?>

<!-- HTML to show to edit the data -->
<div class="row">
</div>
  <div class="row">
  <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span>Update Brand</span>
         </strong>
        </div>
        <div class="page-content">
  <div class="ibox">
      <div class="ibox-body">
          <div class="row">
              <div class="col-md-12">
                <div class="row mt-5">
                  <div class="col-sm-9"></div>
                  <div class="col-sm-3">
                  <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                    <a href="index.php?page=brand_list" class="btn btn-success float-right">List of Brands</a>
                  </div>
                  </div> 
                </div>
              <form action="" method="post">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <label for="full_name" class="col-sm-3">Brand Name:</label>
                  </div>
                <div class="form-group required row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                      <input type="text" name="name" placeholder="Full name" required class="form-control" value="<?php echo $row['brand_name']; ?>">
                    </div>
                    <div class="col-sm-3"></div>
                </div>
                <div class="form-group row mt-5 ">
                    <label class="col-sm-4 col-form-label"></label>
                    <div class="col-sm-3">
                        <button type="submit" name="edit_brand" class="samplewidth btn btn-danger btn-block">Update</button>
                    </div>
                </div>
             </form>
              </div>
          </div>
      </div>
  </div>
</div>
      </div>
    </div>
  </div>

