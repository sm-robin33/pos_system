<?php
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

if(isset($_POST['add_store'])){

  $st_name = $_POST['name'];
  $st_status = $_POST['status'];
    $query = "INSERT INTO store (store_name, status) VALUES ('$st_name', '$st_status')";

  if($conn->query($query)){
    $_SESSION['status'] = "Store Created";
    header("Location:index.php?page=store_list");
  }else{
    $_SESSION['status'] = "Creation Failed";
    header("Location:index.php?page=add_store");
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
            <span>Create New Store</span>
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
                    <a href="index.php?page=store_list" class="btn btn-success float-right">List of Store</a>
                  </div>
                  </div> 
                </div>
              <form action="" method="post">

                <div class="form-group required row mt-2">
                    <div class="col-md-1"></div>
                    <div class="col-md-4">
                    <label>Store Name:</label>
                      <input type="text" name="name" placeholder="Full name" required class="form-control">
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                    <label for="status">Status:</label>
                            <select name="status" required class="form-control">
                              <option value="">Choose a Status</option>
                              <option value="Active">Active</option>
                              <option value="Inactive">Inactive</option>
                            </select>
                    </div>
                </div>
                <div class="form-group row mt-5 ">
                    <label class="col-sm-4 col-form-label"></label>
                    <div class="col-sm-3">
                        <button type="submit" name="add_store" class="samplewidth btn btn-primary btn-block">Submit</button>
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