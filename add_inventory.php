   <?php
    $conn = mysqli_connect("localhost", "root", "", "core_pos");

    if (!$conn) {
      echo "Failed to connect to MySQL";
      exit();
    }
    //   else{
    //     echo "Connection Success";
    //   }


    $query2 = "SELECT * FROM products";
    $products = $conn->query($query2);

    $query4 = "SELECT * FROM store";
    $stores = $conn->query($query4);

    $query7 = "SELECT * FROM inventory";
    $inventories = $conn->query($query7);

    $product_array = array();

    foreach ($inventories as $inventory) {
      array_push($product_array, $inventory['product_id']);
    }

    if (isset($_POST['add_inventory'])) {
      $p_id = $_POST['product'];
      $p_quantity = $_POST['quantity'];
      $s_id = $_POST['store'];
      $status = $_POST['status'];
      if($p_quantity>=0){
      $query = "INSERT INTO inventory (product_id,quantity,store_id,status) VALUES ('$p_id','$p_quantity','$s_id','$status')";
      if ($conn->query($query)) {
        $_SESSION['status'] = "Inventory Created";
        header("Location:index.php?page=inventory_list");
      } else {
        $_SESSION['status'] = "Creation Failed";
        header("Location:index.php?page=add_inventory");
      }
    }else{
          $_SESSION['error_inventory'] = "Negetive input not avilable";
          header("Location:index.php?page=add_inventory");
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
             <span>Create New Inventory</span>
           </strong>
         </div>

         <?php 
    
    if(isset($_SESSION['error_inventory']))
    {
        ?>
                <strong><?= $_SESSION['error_inventory']; ?></strong>
        <?php 
    }

?>
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
                   <form action="add_inventory.php" method="post">
                     <div class="row">
                       <div class="col-md-1"></div>
                       <div class="col-md-4">
                         <label>Product Name</label>
                         <select name="product" required id="text" class="form-control text-capitalize">
                           <option value="" class="text-capitalize">Choose Product Name</option>

                           <?php foreach ($products as $product) : ?>
                             <?php if (!in_array($product['id'], $product_array)) : ?>
                               <option value="<?php echo $product['id'] ?>" class="text-capitalize"><?php echo $product['name'] ?></option>
                             <?php endif; ?>
                           <?php endforeach; ?>

                         </select>
                       </div>
                       <div class="col-md-2"></div>
                       <div class="col-md-4">
                         <label>Quantity</label>
                         <input type="number" name="quantity" placeholder="Quantity" required class="form-control">
                       </div>

                       <div class="col-md-1"></div>
                     </div>
                     <div class="row mt-5">
                       <div class="col-md-1"></div>
                       <div class="col-md-4">
                         <label>Store Type</label>
                         <select name="store" required id="text" class="form-control text-capitalize">
                           <option value="" class="text-capitalize">Choose Store</option>

                           <?php foreach ($stores as $store) : ?>
                             <option value="<?php echo $store['id'] ?>" class="text-capitalize"><?php echo $store['store_name'] ?></option>
                           <?php endforeach; ?>

                         </select>
                       </div>
                       <div class="col-md-2"></div>
                       <div class="col-md-4">
                         <label>Status</label>
                         <select name="status" required class="form-control">
                           <option value="" selected>Choose a status</option>
                           <option value="Active">Active</option>
                           <option value="Inactive">Inactive</option>
                         </select>
                       </div>
                       <div class="col-md-1"></div>
                     </div>

                     <div class="row mt-5 ">
                       <label class="col-sm-4 "></label>
                       <div class="col-sm-4">
                         <button type="submit" name="add_inventory" class="samplewidth btn btn-primary btn-block">Submit</button>
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