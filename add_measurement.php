<?php ob_start();

$conn = mysqli_connect("localhost","root","","core_pos");

// Check connection
if (!$conn) {
  echo "Failed to connect to MySQL";
  exit();
}
//   else{
//     echo "Connection Success";
//   }
?>
<?php
if(isset($_POST['add_measurement'])){
    $measurement_name= $_POST['name'];
    $measurement_status=$_POST['status'];
    $query= "INSERT INTO measurements (measurement_name, status) Values ('{$measurement_name}', '{$measurement_status}') ";
    if($conn->query($query)){
        $_SESSION['status'] = "Measurement Created";
    header("Location:index.php?page=measurement_list");
  }else{
    $_SESSION['status'] = "Creation Failed";
    header("Location:index.php?page=add_measurement");
  }
 }
?>

<!-- Html screen for brand -->

<div class="row">
</div>
  <div class="row">
  <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span>Create New Measurement</span>
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
                    <a href="index.php?page=measurement_list" class="btn btn-success float-right">List of Measurements</a>
                  </div>
                  </div> 
                </div>
              <form action="add_measurement.php" method="post">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <label for="measurement_name" class="col-sm-3">Measurement Name:</label>
                  </div>
                <div class="form-group required row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                      <input type="text" name="name" placeholder="Measurement Name" required class="form-control">
                    </div>
                    <div class="col-sm-3"></div>
                </div>
                <div class="col-sm-5"></div>
                <div class="row mt-4">
                    <div class="col-sm-3"></div>
                    <label for="status" class="col-sm-3">Status:</label>
                  </div>
                  <div class="form-group required row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                    <select name="status" class="form-control">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                       </select>
                    </div>
                  </div>
                <div class="form-group row mt-5 ">
                    <label class="col-sm-4 col-form-label"></label>
                    <div class="col-sm-3">
                        <button type="submit" name="add_measurement" class="samplewidth btn btn-primary btn-block">Submit</button>
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
  <?php ob_flush(); ?>