
<?php
$conn = mysqli_connect("localhost","root","","core_pos");

// Check connection
if (!$conn) {
  echo "Failed to connect to MySQL";
  exit();
}
?>
<?php
$product_id=$_GET['id'];
$query1="SELECT * FROM products WHERE id='{$product_id}'";
$result1=$conn->query($query1);
$product= mysqli_fetch_array($result1);

//for brand
$query2 = "SELECT * FROM brands";
$brands = $conn->query($query2);
// $brands= mysqli_fetch_array($result2);

//for category
$query3 = "SELECT * FROM category";
$category = $conn->query($query3);

//for sub-category
$query4 = "SELECT * FROM sub_category";
$sub_category = $conn->query($query4);

//for purchase measurement
$query5 = "SELECT * FROM measurements";
$measurement_purchase = $conn->query($query5);

//for sale measurement
$query6 = "SELECT * FROM measurements";
$measurement_sale = $conn->query($query6);
?>

<?php 
$targetfolder='images/';
if(isset($_POST['update_product'])){
    $product_name = $_POST['name'];
    $product_brand = $_POST['brand_id'];
    $product_barcode = $_POST['barcode'];
    $product_category = $_POST['category_id'];
    $product_sub_category = $_POST['subcategory_id'];
    $product_purchaseMeasure = $_POST['measure_purchase_id'];
    $product_sellMeasure = $_POST['measure_sale_id'];
    $product_status = $_POST['status'];
    if(!empty($_FILES["product_image"]["name"])){
        $fileName= basename($_FILES["product_image"]["name"]);
        $filePath = $targetfolder . $fileName;
        //check the file extension type
        $fileType=pathinfo($filePath, PATHINFO_EXTENSION);
        //allowed file types
        $allowType=array('jpg','png','gif');
        //match the data inside the array with the extension
        if(in_array($fileType, $allowType)){
         //move the inage with temporary name to target folder
         if(move_uploaded_file($_FILES["product_image"]["tmp_name"], $filePath)){
             
            
             $update_product= "UPDATE products SET name= '$product_name', brand_id= '$product_brand',barcode='$product_barcode', category_id='$product_category',subcategory_id='$product_sub_category', product_image='$fileName', measure_purchase_id='$product_purchaseMeasure', measure_sale_id='$product_sellMeasure', status='$product_status' where id= $product_id ";
     
         if($conn->query($update_product)){
             $_SESSION['status']="Product Updated";
             header("Location:index.php?page=product_list");
         }
         else{
             $_SESSION['status']="Creation Failed!";
             header("Location:index.php?page=product_list");
         }
         }
     
        }

       }
       else {
        // If don't want to change the image then the query will be executed
        $update_product = "UPDATE products SET name='$product_name', brand_id='$product_brand', barcode='$product_barcode', category_id='$product_category', subcategory_id='$product_sub_category', measure_purchase_id='$product_purchaseMeasure', measure_sale_id='$product_sellMeasure', status='$product_status' WHERE id=$product_id";

        if ($conn->query($update_product)) {
            $_SESSION['status'] = "Product Updated";
            header("Location: index.php?page=product_list");
        } else {
            $_SESSION['status'] = "Update Failed!";
            header("Location: index.php?page=product_list");
        }
    }
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span> Update Product</span>
                </strong>
            </div>
            <div class="page-content">
                <div class="ibox">
                    <div class="ibox-head">
                    </div>
                    <div class="ibox-body">
                        <div class="row mt-5">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-sm-9"></div>
                                    <div class="col sm-3">
                                        <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                                            <a href="index.php?page=product_list" class="btn btn-success float-right">List of Product</a>
                                        </div>
                                    </div>
                                </div>

                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-row">
                                        <!-- <div class="col-md-1"></div> -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="full_name" class="col-form-label">Product Name:</label>
                                                <input type="text" name="name" placeholder="Product Name" required class="form-control" value="<?php echo $product['name'] ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="col-form-label">Brand Name:</label>
                                                <select name="brand_id" id="text" class="form-control text-capitalize">
                                                    <option value="" class="text-capitalize">Choose a Brand</option>
                                                    <?php foreach ($brands as $brand_data) { ?>
                                                        <option value="<?php echo $brand_data['id'] ?>" <?php if($brand_data['id'] === $product['brand_id'] ): echo "selected"; endif; ?> class="text-capitalize"><?php echo $brand_data['brand_name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="barcode" class="col-form-label">Barcode:</label>
                                                <input type="text" name="barcode" placeholder="Barcode" required class="form-control" value="<?php echo $product['barcode'] ?>">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                            <div class="col-md-4">
                                                <label class="col-form-label">Category:</label>
                                                <select name="category_id" id="text" class="form-control text-capitalize">
                                                    <option value="" class="text-capitalize">Choose a Category</option>
                                                    <?php foreach ($category as $categoryData) { ?>
                                                        <option value="<?php echo $categoryData['id'] ?>" <?php if($categoryData['id'] === $product['category_id'] ): echo "selected"; endif; ?> class="text-capitalize"><?php echo $categoryData['category_name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="col-form-label">Sub-Category:</label>
                                                <select name="subcategory_id" id="text" class="form-control text-capitalize">
                                                    <option value="" class="text-capitalize">Choose a Sub-Category</option>
                                                    <?php foreach ($sub_category as $sub_categoryData) { ?>
                                                        <option value="<?php echo $sub_categoryData['id'] ?>" <?php if($sub_categoryData['id'] === $product['subcategory_id'] ): echo "selected"; endif; ?> class="text-capitalize"><?php echo $sub_categoryData['sub_category_name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="Photo" class="col-form-label">Photo:</label>
                                                <input type="file" name="product_image" placeholder="Upload Image" class="form-control" value="<?php echo $product['product_image'] ?>">
                                            </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-4">
                                            <label class="col-form-label">Purchase Measurement:</label>
                                            <select name="measure_purchase_id" id="text" class="form-control text-capitalize">
                                                <option value="" class="text-capitalize">Choose a Measurement</option>
                                                <?php foreach ($measurement_purchase as $measure_purchase) { ?>
                                                    <option value="<?php echo $measure_purchase['id'] ?>" <?php if($measure_purchase['id'] === $product['measure_purchase_id'] ): echo "selected"; endif; ?> class="text-capitalize"><?php echo $measure_purchase['measurement_name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="col-form-label">Sale Measurement:</label>
                                            <select name="measure_sale_id" id="text" class="form-control text-capitalize">
                                                <option value="" class="text-capitalize">Choose a Measurement</option>
                                                <?php foreach ($measurement_sale as $measure_sale) { ?>
                                                    <option value="<?php echo $measure_sale['id'] ?>" <?php if($measure_sale['id'] === $product['measure_sale_id'] ): echo "selected"; endif; ?> class="text-capitalize"><?php echo $measure_sale['measurement_name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4 ">
                                            <label for="status" class="col-form-label">Status:</label>
                                            <select name="status" required class="form-control">
                                                <option value="">Choose a Status</option>
                                                <option value="active"<?php if($product['status']=== 'active') echo 'selected'; ?>>Active</option>
                                                <option value="inactive"<?php if($product['status']=== 'inactive') echo 'selected'; ?>>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-3 ">
                                        <label class="col-sm-4 col-form-label"></label>
                                        <div class="col-sm-4">
                                            <button type="submit" name="update_product" class=" samplewidth btn btn-primary btn-block">Update</button>
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
