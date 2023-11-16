
    
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

$inventory_id = $_GET['id'];
$query1 = "SELECT * FROM inventory WHERE id='$inventory_id'";
$inventory = $conn->query($query1);
$row = mysqli_fetch_assoc($inventory);


$query2 = "SELECT * FROM products";
$products = $conn->query($query2);

$query4 = "SELECT * FROM store";
$stores = $conn->query($query4);

?>
 
<?php
if(isset($_POST['update_inventory'])){
  $p_quantity = $_POST['quantity'];
  $s_id = $_POST['store'];
  $status = $_POST['status'];
  $query = "UPDATE inventory SET quantity='$p_quantity',store_id='$s_id',status='$status' WHERE id = $inventory_id ";

  if($conn->query($query)){
    $_SESSION['status'] = "Inventory Updated";
    header("Location:index.php?page=inventory_list");
  }else{
    $_SESSION['status'] = "Creation Failed";
    header("Location:index.php?page=inventory_list");
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
            <span>Update Inventory</span>
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
                    <a href="index.php?page=inventory_list" class="btn btn-success float-right">List of Inventory</a>
                  </div>
                  </div> 
                </div>
              <form action="" method="post">
              <div class="row">
                <div class="col-md-1"></div>
                    <div class="col-md-4">
                        <label>Product Name</label>
                    <select name="product" required id="text" class="form-control text-capitalize" disabled>
                        <option value=""  class="text-capitalize">Choose Product Name</option>
                         
                        <?php foreach ($products as $product):?>
                          <option value="<?php echo $product['id'] ?>" <?php if($row['product_id'] === $product['id']): echo "selected"; endif; ?> class="text-capitalize"><?php echo $product['name'] ?></option>
                          <?php endforeach; ?>
                        
                    </select>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <label>Quantity</label>
                        <input type="number" name="quantity" placeholder="Quantity" required class="form-control" value="<?php echo $row['quantity'] ?>">
                    </div>
                    
                    <div class="col-md-1"></div>
              </div>
              <div class="row mt-5">
                    <div class="col-md-1"></div>
                    <div class="col-md-4">
                        <label>Store Type</label>
                    <select name="store" required id="text" class="form-control text-capitalize">
                        <option value=""  class="text-capitalize">Choose Store</option>
                         
                        <?php foreach ($stores as $store):?>
                          <option value="<?php echo $store['id'] ?>" <?php if($row['store_id'] === $store['id']): echo "selected"; endif; ?> class="text-capitalize"><?php echo $store['store_name'] ?></option>
                          <?php endforeach; ?>
                        
                    </select>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <label>Status</label>
                            <select name="status" required class="form-control">
                              <option value="" selected>Choose a status</option>
                              <option value="Active" <?php if($row['status'] == 'Active'): echo "selected"; endif;?>>Active</option>
                              <option value="Inactive" <?php if($row['status'] == 'Inactive'): echo "selected"; endif;?>>Inactive</option>
                            </select>
                      </div>
                    <div class="col-md-1"></div>
              </div>
                      
                      <div class="row mt-5 ">
                          <label class="col-sm-4 "></label>
                          <div class="col-sm-4">
                              <button type="submit" name="update_inventory" class="samplewidth btn btn-primary btn-block">Update</button>
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