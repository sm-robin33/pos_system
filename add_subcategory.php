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

$categorys = "SELECT * FROM category";
$result = $conn->query($categorys);
?>
<!-- Insert data to the database -->
<?php

if(isset($_POST['add_subcategory'])){

  $sb_name = $_POST['name'];
  $sb_category = $_POST['category'];
//   $query = "INSERT INTO sub_category (sub_category_name,category_id) VALUES ('{$sb_name}'),'{$sb_category}')";
    $query = "INSERT INTO sub_category (sub_category_name, category_id) VALUES ('$sb_name', '$sb_category')";

  if($conn->query($query)){
    $_SESSION['status'] = "Sub Category Created";
    header("Location:index.php?page=subcategory_list");
  }else{
    $_SESSION['status'] = "Creation Failed";
    header("Location:index.php?page=add_subcategory");
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
            <span>Create New Sub Category</span>
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
                    <a href="index.php?page=subcategory_list" class="btn btn-success float-right">List of Sub Category</a>
                  </div>
                  </div> 
                </div>
              <form action="" method="post">

                <div class="form-group required row mt-2">
                    <div class="col-md-1"></div>
                    <div class="col-md-4">
                    <label>Sub Category Name:</label>
                      <input type="text" name="name" placeholder="Full name" required class="form-control">
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                    <label>Categories:</label>
                    <select name="category" id="text" required class="form-control text-capitalize">
                        <option value=""  class="text-capitalize">Choose a Category</option>
                        <?php foreach ($result as $category):?>
                          <option value="<?php echo (int)$category['id'] ?>" class="text-capitalize"><?php echo $category['category_name'] ?></option>
                          <?php endforeach; ?>
                    </select>
                    </div>
                </div>
                <div class="form-group row mt-5 ">
                    <label class="col-sm-4 col-form-label"></label>
                    <div class="col-sm-3">
                        <button type="submit" name="add_subcategory" class="samplewidth btn btn-primary btn-block">Submit</button>
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