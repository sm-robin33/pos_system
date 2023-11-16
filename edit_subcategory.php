<?php
$conn = mysqli_connect("localhost","root","","core_pos");
if (!$conn) {
  echo "Failed to connect to MySQL";
  exit();
}
?>
<?php
$subcategory_id = $_GET['id'];

$query_subcat = "SELECT * FROM sub_category WHERE id='$subcategory_id'";
$result_subcat = $conn->query($query_subcat);
$row_subcat = mysqli_fetch_array($result_subcat);

$query_cat = "SELECT * FROM category";
$result_cat = $conn->query($query_cat);

if(isset($_POST['edit_subcategory'])){
    $sb_name = $_POST['name'];
    $sb_category = $_POST['category'];
  $query = "UPDATE sub_category SET sub_category_name = '{$sb_name}',category_id = '{$sb_category}'  WHERE id = $subcategory_id ";
  if($conn->query($query)){
    $_SESSION['status'] = "Sub Category Updated";
    header("Location:index.php?page=subcategory_list");
  }else{
    $_SESSION['status'] = "Update Failed";
    header("Location:index.php?page=edit_subcategory");
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
            <span>Update Sub-Category</span>
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
                    <a href="index.php?page=subcategory_list" class="btn btn-success float-right">List of Sub-Category</a>
                  </div>
                  </div> 
                </div>
              <form action="" method="post">
              <div class="form-group required row mt-2">
                    <div class="col-md-1"></div>
                    <div class="col-md-4">
                    <label>Sub Category Name:</label>
                      <input type="text" name="name" placeholder="Full name" required class="form-control" value="<?php echo $row_subcat['sub_category_name'] ?>">
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                    <label>Categories:</label>
                    <select name="category" id="text" required class="form-control text-capitalize">
                        <option value="" class="text-capitalize">Choose a Category</option>
                        <?php foreach ($result_cat as $cat):?>
                            <option value="<?php echo (int)$cat['id']; ?>" <?php if($row_subcat['category_id'] === $cat['id']): echo "selected"; endif; ?> class="text-capitalize"> <?php echo ($cat['category_name']); ?> </option>
                          <?php endforeach; ?>
                    </select>
                    </div>
                </div>
                <div class="form-group row mt-5 ">
                    <label class="col-sm-4 col-form-label"></label>
                    <div class="col-sm-3">
                        <button type="submit" name="edit_subcategory" class="samplewidth btn btn-primary btn-block">Update</button>
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


