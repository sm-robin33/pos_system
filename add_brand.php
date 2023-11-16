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

$brands = "SELECT * FROM brands";
$result = $conn->query($brands);

$brands_array = array();

foreach($result as $brand){
      array_push($brands_array,$brand['brand_name']);
}

if(isset($_POST['add_brand'])){
  $b_name = $_POST['name'];

  if(!in_array($b_name,$brands_array)){
    $query = "INSERT INTO brands (brand_name) VALUES ('{$b_name}')";
    if($conn->query($query)){
      $_SESSION['status'] = "Brand Created";
      header("Location:index.php?page=brand_list");
    }else{
      $_SESSION['status'] = "Creation Failed";
      header("Location:index.php?page=add_brand");
    }
  }else{
    $_SESSION['status'] = "Brand name already exist";
      header("Location:index.php?page=add_brand");
    // $error = "Brand name already exist";
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
            <span>Create New Brand</span>
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
              <form action="add_brand.php" method="post">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <label for="full_name" class="col-sm-3">Brand Name:</label>
                  </div>
                <div class="form-group required row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                      <input type="text" name="name" placeholder="Full name" required class="form-control">
                    </div>
                    <div class="col-sm-3"><?php 
    
                    if(isset($_SESSION['status']))
                    {
                        ?>
                                <strong><?= $_SESSION['status']; ?></strong>
                        <?php 
                    }

                ?></div>
                </div>
                <div class="form-group row mt-5 ">
                    <label class="col-sm-4 col-form-label"></label>
                    <div class="col-sm-2">
                        <button type="submit" name="add_brand" class="samplewidth btn btn-primary btn-block">Submit</button>
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