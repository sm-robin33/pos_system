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

<!-- Insert data to the database -->
<?php
if(isset($_POST['add_category'])){
  $c_name = $_POST['name'];
  $query = "INSERT INTO category  (category_name) VALUES ('{$c_name}')";
  if($conn->query($query)){
    $_SESSION['status'] = "Category Created";
    header("Location:index.php?page=category_list");
  }else{
    $_SESSION['status'] = "Creation Failed";
    header("Location:index.php?page=add_category");
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
            <span>Create New Category</span>
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
                    <a href="index.php?page=category_list" class="btn btn-success float-right">List of Category</a>
                  </div>
                  </div> 
                </div>
              <form action="" method="post">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <label for="full_name" class="col-sm-3">Category Name:</label>
                  </div>
                <div class="form-group required row mt-2">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                      <input type="text" name="name" placeholder="Full name" required class="form-control">
                    </div>
                    <div class="col-sm-3"></div>
                </div>
                <div class="form-group row mt-5 ">
                    <label class="col-sm-4 col-form-label"></label>
                    <div class="col-sm-3">
                        <button type="submit" name="add_category" class="samplewidth btn btn-primary btn-block">Submit</button>
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