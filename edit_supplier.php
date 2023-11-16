<?php
$conn = mysqli_connect("localhost", "root", "", "core_pos");
if (!$conn) {
    echo "Failed to connect to MySQL";
    exit();
}
?>
<?php
$supplier_id = $_GET['id'];

$query_sup = "SELECT * FROM supplier WHERE id='$supplier_id'";
$result_sup = $conn->query($query_sup);
$row_sup = mysqli_fetch_array($result_sup);

$query_brand = "SELECT * FROM brands";
$result_brand = $conn->query($query_brand);

if (isset($_POST['edit_supplier'])) {
    $s_name = $_POST['name'];
    $s_phone = $_POST['phone'];
    $s_email = $_POST['email'];
    $s_address = $_POST['address'];
    $s_brand = $_POST['brand_id'];
    $s_status = $_POST['status'];
    $query = "UPDATE supplier SET supplier_name = '{$s_name}',phone = '{$s_phone}',email = '{$s_email}',address='{$s_address}',brand_id='{$s_brand}',status='{$s_status}'  WHERE id = $supplier_id ";
    if ($conn->query($query)) {
        $_SESSION['status'] = "Supplier Updated";
        header("Location:index.php?page=supplier_list");
    } else {
        $_SESSION['status'] = "Update Failed";
        header("Location:index.php?page=edit_supplier");
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
                    <span>Update Supplier</span>
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
                                            <a href="index.php?page=supplier_list" class="btn btn-success float-right">List of Suppliers</a>
                                        </div>
                                    </div>
                                </div>
                                <form action="" method="post">
                                    <div class="form-row">
                                        <div class="row">
                                            <div class="col-md-1 mt-1"></div>
                                            <div class="col-md-4 mt-1">
                                                <label for="full_name" class="col-form-label">Full name:</label>
                                                <input type="text" name="name" placeholder="Full Name" required class="form-control" value="<?=$row_sup['supplier_name']; ?>">

                                            </div>
                                            <div class="col-md-2"></div>
                                            <div class="col-md-4">
                                                <label for="phone_no" class="col-form-label">Phone No:</label>

                                                <input type="number" name="phone" placeholder="Phone No" class="form-control " required value="<?=$row_sup['phone']; ?>">

                                            </div>
                                            <div class="col-md-1"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-1 mt-4"></div>
                                            <div class="col-md-4 mt-4">
                                                <label for="email" class="col-form-label">Email:</label>
                                                <input type="email" name="email" placeholder="Email" class="form-control " required value="<?=$row_sup['email']; ?>">

                                            </div>
                                            <div class="col-md-2 mt-4"></div>
                                            <div class="col-md-4 mt-4">
                                                <label for="address" class="col-form-label">Address:</label>
                                                <input type="text" name="address" placeholder="Address" class="form-control" required value="<?=$row_sup['address']; ?>">

                                            </div>
                                            <div class="col-md-1 mt-4"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-1 mt-4"></div>

                                            <div class="col-md-4 mt-4">
                                                <label>Brand:</label>
                                                <select name="brand_id" required id="text" class="form-control text-capitalize">
                                                    <option value="" selected class="text-capitalize">Choose Brand Name</option>
                                                    <?php foreach ($result_brand as $brand) : ?>
                                                        <option value="<?php echo (int)$brand['id'] ?>" <?php if($row_sup['brand_id'] === $brand['id']): echo "selected"; endif; ?> class="text-capitalize"><?php echo $brand['brand_name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="col-md-2 mt-4"></div>
                                            <div class="col-md-4 mt-4">
                                                <label for="status" class="col-form-label">Status:</label>
                                                <select name="status" required class="form-control">
                                                    <option value="">Choose a Status</option>
                                                
                                                    <option value="Active" <?php if($row_sup['status'] == 'Active'): echo "selected"; endif;?>>Active</option>
                                                    <option value="Inactive" <?php if($row_sup['status'] == 'Inactive'): echo "selected"; endif;?>>Inactive</option>

                                                </select>
                                            </div>
                                            <div class="col-md-1 mt-4"></div>
                                        </div>

                                        <div class="row mt-5 ">
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4">
                                                <button type="submit" name="edit_supplier" class="samplewidth btn btn-primary">Update</button>
                                            </div>
                                            <div class="col-md-4"></div>
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