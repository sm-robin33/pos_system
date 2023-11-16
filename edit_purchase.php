<?php
$conn = mysqli_connect("localhost", "root", "", "core_pos");
if (!$conn) {
    echo "Failed to connect to MySQL";
    exit();
}
?>
<?php
$all_supplier = "SELECT * FROM supplier";
$row_all_supplier = $conn->query($all_supplier);
$supplier = "SELECT p.id,p.supplier_name,p.parchase_date,p.referance,p.total_amount,p.created_at,p.updated_at,s.supplier_name, s.id AS supplier_id
FROM parchase AS p
INNER JOIN supplier AS s ON p.supplier_name = s.id;";

$result = $conn->query($supplier);


$referance_id = $_GET['referance'];

$purchase = "SELECT * FROM parchase WHERE referance='$referance_id'";
$result_purchase = $conn->query($purchase);
$row_purchase = mysqli_fetch_array($result_purchase);



$multi_join = "SELECT ps.id AS purchase_details_id, ps.supplier_id,ps.product_name,ps.quantity,ps.referance AS ps_referance,ps.unit_price,ps.sub_total_price,p.supplier_name,pd.name,pd.id AS pd_id
FROM parchase_details AS ps
INNER JOIN parchase AS p ON p.supplier_name = ps.supplier_id and ps.referance = p.referance
INNER JOIN products AS pd ON pd.id = ps.product_name ";

$join_data = $conn->query($multi_join);
$row_join_data = mysqli_fetch_array($join_data);

$query = "SELECT * FROM products";
$products = $conn->query($query);

if (isset($_POST['update'])) {
    $suppler_name = $_POST['supplier'];
    $purchase_date = $_POST['date'];
    $referance = $_POST['referance'];
    $total_amount = $_POST['total_price'];

    $sn = $_POST['sn_up'];
    $pd_id = $_POST['pd_id'];
    $pd_id_no = count($pd_id);
    $product_names = $_POST['product'];
    $quantities = $_POST['quantity'];
    $unit_prices = $_POST['unit_price'];
    $sub_unit_prices = $_POST['sub_total_price'];

    // print_r($product_names);
    //     exit;
    foreach($quantities as $quantities_check){
        if($quantities_check<0){
            $_SESSION['status'] = "Quantity Must be gather then 0 !!";
            header("Location:index.php?page=purchase_list");
            exit;
        }
    }

    foreach($unit_prices as $unit_prices_check){
        if($unit_prices_check<0){
            $_SESSION['status'] = "Price Must be gather then 0 !!";
            header("Location:index.php?page=purchase_list");
            exit;
        }
    }

    for ($i = 0; $i < count($sn); $i++) {
        $product_name = $product_names[$i];
        $quantity = $quantities[$i];
        $unit_price = $unit_prices[$i];
        $sub_unit_price = $sub_unit_prices[$i];
        
        $query2 = "UPDATE parchase_details SET supplier_id = '$suppler_name', parchase_date = '$purchase_date',referance = '$referance',product_name='$product_name',quantity = '$quantity',unit_price='$unit_price',sub_total_price='$sub_unit_price'  WHERE referance=$referance_id and id = $pd_id[$i]";
        mysqli_query($conn, $query2);
        if($i>=$pd_id_no){
        $query4 = "INSERT INTO parchase_details (supplier_id, parchase_date,referance,product_name, quantity, unit_price, sub_total_price) VALUES ('$suppler_name', '$purchase_date','$referance', '$product_name', '$quantity', '$unit_price', '$sub_unit_price')";
        mysqli_query($conn, $query4);
        }
    }
    $query1 = "UPDATE parchase SET supplier_name = '$suppler_name', parchase_date = '$purchase_date',referance = '$referance',total_amount='$total_amount' WHERE referance=$referance_id ";


    if ($conn->query($query1)) {
        $_SESSION['status'] = "Purchase Updated";
        header("Location:index.php?page=purchase_list");
    } else {
        $_SESSION['status'] = "Creation Failed";
        header("Location:index.php?page=purchase_list");
    }
}

if (isset($_POST['draft'])) {
    $suppler_name = $_POST['supplier'];
    $purchase_date = $_POST['date'];
    $referance = $_POST['referance'];
    $total_amount = $_POST['total_price'];

    $sn = $_POST['sn_up'];
    $product_names = $_POST['product'];
    $quantities = $_POST['quantity'];
    $unit_prices = $_POST['unit_price'];
    $sub_unit_prices = $_POST['sub_total_price'];

    // print_r($unit_prices);
    // exit;

    foreach($quantities as $quantities_check){
        if($quantities_check<0){
            $_SESSION['status'] = "Quantity Must be gather then 0 !!";
            header("Location:index.php?page=purchase_list");
            exit;
        }
    }

    foreach($unit_prices as $unit_prices_check){
        if($unit_prices_check<0){
            $_SESSION['status'] = "Price Must be gather then 0 !!";
            header("Location:index.php?page=purchase_list");
            exit;
        }
    }

    for ($i = 0; $i < count($sn); $i++) {
        $product_name = $product_names[$i];
        $quantity = $quantities[$i];
        $unit_price = $unit_prices[$i];
        $sub_unit_price = $sub_unit_prices[$i];
        $query2 = "INSERT INTO draft_parchase_details (supplier_id, parchase_date,referance,product_name, quantity, unit_price, sub_total_price) VALUES ('$suppler_name', '$purchase_date','$referance', '$product_name', '$quantity', '$unit_price', '$sub_unit_price')";
        mysqli_query($conn, $query2);
    }

    $query1 = "INSERT INTO draft_parchase (supplier_name,parchase_date,referance,total_amount) VALUES ('$suppler_name','$purchase_date','$referance','$total_amount')";

    if ($conn->query($query1)) {
        $_SESSION['status'] = "Draft Created";
        header("Location:index.php?page=draft_list");
    } else {
        $_SESSION['status'] = "Creation Failed";
        header("Location:index.php?page=purchase_list");
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
                    <span>Update Purchase</span>
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
                                            <a href="index.php?page=purchase_list" class="btn btn-success float-right">List of Purchases</a>
                                        </div>
                                    </div>
                                </div>
                                <form action="" class="mt-3" id="add_name" method="POST">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Supplier Name:</label>
                                            <select name="supplier" required id="text" class="form-control text-capitalize">
                                                <option value="" class="text-capitalize">Choose Supplier Name</option>

                                                <?php foreach ($row_all_supplier as $suppliers) : ?>
                                                    <option value="<?php echo (int)$suppliers['id']; ?>" <?php if ($suppliers['id'] === $row_purchase['supplier_name']) : echo "selected"; endif; ?> class="text-capitalize"> <?php echo ($suppliers['supplier_name']); ?> </option>
                                                <?php endforeach; ?>

                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="date" class="col-form-labe">Purchase Date:</label>

                                            <input type="date" class="form-control" placeholder="Date" name="date" value="<?php echo ($row_purchase['parchase_date']); ?>">


                                        </div>

                                        <div class="col-md-4">
                                            <label for="referance_no">Referance No:</label>
                                            <input type="text" name="referance" placeholder="Referance No" required class="form-control" value="<?php echo ($row_purchase['referance']); ?>" readonly>

                                        </div>
                                    </div>
                                    <table class="table table-bordered table-hover mt-5" id="dynamic_field">
                                        <?php $i = 1;
                                        foreach ($join_data as $product_all) : ?>
                                            <?php if ($row_purchase['referance'] === $product_all['ps_referance']) : ?>
                                                <tr>
                                                    <input type="hidden" name="pd_id[]" value="<?= $product_all['purchase_details_id'] ?>" />
                                                    <td><label>SN::</label><input type="text" name="sn_up[]" class="form-control sn" value="<?php echo $i; ?>" readonly/></td>
                                                    <td><label>Product Name:</label>
                                                        <select name="product[]" required id="text" class="form-control text-capitalize">

                                                                <option value="<?php echo $product_all['pd_id'] ?>" class="text-capitalize"><?php echo $product_all['name'] ?></option>
                                                            
                                                        </select>
                                                    </td>

                                                    <td><label>Quantity:</label><input type="number" name="quantity[]" placeholder="Quantity" class="quantity form-control" value="<?= $product_all['quantity'] ?>" /></td>
                                                    <td><label>Unit Price:</label><input type="number" name="unit_price[]" placeholder="Enter Unit Price" class="unit_price form-control" value="<?= $product_all['unit_price'] ?>" /></td>
                                                    <td><label>Sub Total Price:</label><input type="number" name="sub_total_price[]" placeholder="Sub Total Price" class="sub_total_price form-control" value="<?= $product_all['sub_total_price'] ?>" readonly /></td>

                                                    <!-- <td><button type="button" name="add" id="add" class="btn btn-primary mt-4">Add More</button></td> -->
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        <td colspan="4"></td>
                                        <td><button type="button" name="add" id="add_update" class="btn btn-primary mt-4">Add More</button></td>
                                    </table>
                                    <div class="row">
                                        <div class="col-md-9"></div>
                                        <div class="col-md-3">
                                            <label>Total Price:</label>
                                            <input type="text" id="total_price" name="total_price" placeholder="Total Price" class="form-control" readonly value="<?php echo ($row_purchase['total_amount']); ?>" />
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4"><input type="submit" class="samplewidth btn btn-success" name="update" id="submit" value="Save And Update"></div>
                                        <div class="col-md-4"></div>
                                        <!-- <div class="col-md-4"><input type="submit" class="samplewidth btn btn-warning" name="draft" id="submit" value="Draft And Update"></div> -->
                                        <!-- <div class="col-md-1"></div> -->
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