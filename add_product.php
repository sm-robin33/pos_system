
<?php
$conn = mysqli_connect("localhost", "root", "", "core_pos");

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
$query1= "SELECT * FROM brands";
$brands=$conn->query($query1);
$query2= "SELECT * FROM category";
$category=$conn->query($query2);
$query3= "SELECT * FROM sub_category";
$sub_category=$conn->query($query3);
$query4= "SELECT * FROM measurements";
$measurement_purchase=$conn->query($query4);
$measurement_sale=$conn->query($query4);

 ?>
<?php
$targetfolder = "images/";
if (isset($_POST['add_product'])){
    $product_name = $_POST['name'];
    $product_brand = $_POST['brand_id'];
    $product_barcode = $_POST['barcode'];
    $product_category = $_POST['category_id'];
    $product_sub_category = $_POST['subcategory_id'];
    $product_purchaseMeasure = $_POST['measure_purchase_id'];
    $product_sellMeasure = $_POST['measure_sale_id'];
    $product_price = $_POST['price'];
    $product_status = $_POST['status'];
    if (!empty($_FILES["product_image"]["name"])){
        $fileName = basename($_FILES["product_image"]["name"]);
        $filePath = $targetfolder . $fileName;
        $fileType = pathinfo($filePath, PATHINFO_EXTENSION);
        $allowType = array('jpg', 'png', 'gif','jpeg');
        if (in_array($fileType, $allowType)){
            if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $filePath)){
                $query = "INSERT INTO products (name, brand_id, barcode, category_id, subcategory_id, product_image, measure_purchase_id, measure_sale_id, status) VALUES ('$product_name', '$product_brand', '$product_barcode', '$product_category', '$product_sub_category', '$fileName', '$product_purchaseMeasure', '$product_sellMeasure', '$product_status')";

                if ($conn->query($query)) {
                    $_SESSION['status'] = "Product Created";
                    header("Location: index.php?page=product_list");
                } else {
                    $_SESSION['status'] = "Creation Failed!";
                    header("Location: index.php?page=add_product");
                }
            }
            else{
                $_SESSION['status'] = "Image upload failed!";
                header("Location: index.php?page=add_product");
            }

        }
        else {
            $_SESSION['status'] = "Invalid file types plz insert jpg, png, gif";
            header("Location: index.php?page=add_product");
        }
    }
    else {
        $_SESSION['status'] = "Please select an image";
        header("Location: index.php?page=add_product");
    }
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Create New Product</span>
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
                                                <input type="text" name="name" placeholder="Product Name" required class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="col-form-label">Brand Name:</label>
                                                <select name="brand_id" id="text" class="form-control text-capitalize">
                                                    <option value="" class="text-capitalize">Choose a Brand</option>
                                                    <?php foreach ($brands as $brand_data) { ?>
                                                        <option value="<?php echo $brand_data['id'] ?>" class="text-capitalize"><?php echo $brand_data['brand_name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="barcode" class="col-form-label">Barcode:</label>
                                                <input type="text" name="barcode" placeholder="Barcode" required class="form-control">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                            <div class="col-md-4">
                                                <label class="col-form-label">Category:</label>
                                                <select name="category_id" id="text" required class="form-control text-capitalize">
                                                    <option value="" class="text-capitalize">Choose a Category</option>
                                                    <?php foreach ($category as $categoryData) { ?>
                                                        <option value="<?php echo $categoryData['id'] ?>" class="text-capitalize"><?php echo $categoryData['category_name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="col-form-label">Sub-Category:</label>
                                                <select name="subcategory_id" id="text" required class="form-control text-capitalize">
                                                    <option value="" class="text-capitalize">Choose a Sub-Category</option>
                                                    <?php foreach ($sub_category as $sub_categoryData) { ?>
                                                        <option value="<?php echo $sub_categoryData['id'] ?>" class="text-capitalize"><?php echo $sub_categoryData['sub_category_name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="Photo" class="col-form-label">Photo:</label>
                                                <input type="file" name="product_image" placeholder="Upload Image" required class="form-control">
                                            </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-4">
                                            <label class="col-form-label">Purchase Measurement:</label>
                                            <select name="measure_purchase_id" id="text" class="form-control text-capitalize">
                                                <option value="" class="text-capitalize">Choose a Measurement</option>
                                                <?php foreach ($measurement_purchase as $measure_purchase) { ?>
                                                    <option value="<?php echo $measure_purchase['id'] ?>" class="text-capitalize"><?php echo $measure_purchase['measurement_name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="col-form-label">Sale Measurement:</label>
                                            <select name="measure_sale_id" id="text" class="form-control text-capitalize">
                                                <option value="" class="text-capitalize">Choose a Measurement</option>
                                                <?php foreach ($measurement_sale as $measure_sale) { ?>
                                                    <option value="<?php echo $measure_sale['id'] ?>" class="text-capitalize"><?php echo $measure_sale['measurement_name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4 ">
                                            <label for="status" class="col-form-label">Status:</label>
                                            <select name="status" required class="form-control">
                                                <option value="">Choose a Status</option>
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-3 ">
                                        <label class="col-sm-4 col-form-label"></label>
                                        <div class="col-sm-4">
                                            <button type="submit" name="add_product" class=" samplewidth btn btn-primary btn-block">Submit</button>
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
