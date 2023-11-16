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

$query2 = "SELECT * FROM products";
$products = $conn->query($query2);

$query3 = "SELECT * FROM product_price";
$product_prices = $conn->query($query3);

$product_array = array();

foreach($product_prices as $product_price){
      array_push($product_array,$product_price['product_id']);
}


// $result = mysqli_fetch_array($product_prices);
// print_r($result);



if(isset($_POST['add_product_price'])){

  $p_id = $_POST['product'];
  $p_price = $_POST['price'];
    $query = "INSERT INTO product_price (product_id, product_price) VALUES ('$p_id', '$p_price')";

  if($conn->query($query)){
    $_SESSION['status'] = "Product Price Created";
    header("Location:index.php?page=product_price_list");
  }else{
    $_SESSION['status'] = "Creation Failed";
    header("Location:index.php?page=add_product_price");
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
            <span>Create New Product Price</span>
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
                    <a href="index.php?page=product_price_list" class="btn btn-success float-right">List of Product Price</a>
                  </div>
                  </div> 
                </div>
              <form action="" method="post">

                <div class="form-group required row mt-2">
                    <div class="col-md-1"></div>
                    <div class="col-md-4">
                    <label>Products:</label>
                    <select name="product" id="text" required class="form-control text-capitalize">
                        <option value=""  class="text-capitalize">Choose a Product</option>
                        <?php foreach ($products as $product):?>
                          <?php if(!in_array($product['id'],$product_array)): ?>
                          <option value="<?php echo $product['id'] ?>" class="text-capitalize"><?php echo $product['name'] ?></option>
                          <?php endif; ?>
                          <?php endforeach; ?>
                    </select>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                    <label>Product Price:</label>
                      <input type="number" name="price" placeholder="Enter Price" required class="form-control">
                    </div>
                    
                </div>
                <div class="form-group row mt-5 ">
                    <label class="col-sm-4 col-form-label"></label>
                    <div class="col-sm-3">
                        <button type="submit" name="add_product_price" class="samplewidth btn btn-primary btn-block">Submit</button>
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