<?php
$conn = mysqli_connect("localhost", "root", "", "core_pos");
if (!$conn) {
    echo "Failed to connect to MySQL";
    exit();
}

$query1 = "SELECT p.name,i.product_id,p.id
FROM products AS p
INNER JOIN inventory AS i ON i.product_id = p.id";
$products = $conn->query($query1);

$query3 = "SELECT * FROM customers";
$customers = $conn->query($query3);

$query11 = "SELECT * FROM inventory";
$inventories = $conn->query($query11);

$invoice_id = $_GET['invoice_no'];

$query4 = "SELECT * FROM invoice"; 
$invoice = $conn->query($query4);

$invoices = "SELECT * FROM draft_invoice WHERE invoice_no='$invoice_id'";
$result_invoice = $conn->query($invoices);
$row_invoice = mysqli_fetch_array($result_invoice);

$invoice_array = array();

foreach($invoice as $inv){
    array_push($invoice_array,$inv['invoice_no']);
}


$multi_join = "SELECT idd.id AS invoice_det_id, idd.customer_id, idd.product_id, idd.unit_id, idd.price, idd.quantity, idd.value, idd.invoice_no AS invoice_det_no, pd.id AS product_id, pd.name,i.quantity AS inventory_quantity
FROM draft_invoice_details AS idd
INNER JOIN draft_invoice AS iv ON iv.invoice_no = idd.invoice_no
INNER JOIN products AS pd ON pd.id = idd.product_id
INNER JOIN inventory AS i ON i.product_id = idd.product_id
WHERE iv.customer_name = idd.customer_id";

$join_data = $conn->query($multi_join);
$product_q_array = array(); 
foreach($join_data as $product_quantity){
    if($product_quantity['invoice_det_no']===$invoice_id){
    array_push($product_q_array,$product_quantity['quantity']);
    }
}

// print_r($product_q_array);

if (isset($_POST['update'])) {
    $customer_name = $_POST['customer_name'];
    $invoice_date = $_POST['date'];
    $invoice_no = $_POST['invoice_no'];
    $total_value = $_POST['total_value'];

    $sn = $_POST['sn_up'];
    $product_names = $_POST['product'];
    $units = $_POST['unit'];
    $unit_prices = $_POST['unit_price'];
    $quantities = $_POST['quantity'];
    $values = $_POST['value'];
    
    foreach($quantities as $quantities_check){
        if($quantities_check<0){
            $_SESSION['status'] = "Quantity Must be gather then 0 !!";
            header("Location:index.php?page=invoice_draft_list");
            exit;
        }
    }

    for ($i = 0; $i < count($sn); $i++) {
        $product_name = $product_names[$i];
        $unit = $units[$i];
        $unit_price = $unit_prices[$i];
        $quantity = $quantities[$i];
        $value = $values[$i];
        if(!in_array($invoice_no,$invoice_array)){
        if($quantity > $product_q_array[$i] ){
            $query6="SELECT * FROM inventory WHERE product_id = '$product_name'";
            $result = mysqli_fetch_assoc($conn->query($query6));
            $current_quantity = $quantity - $product_q_array[$i];
            $update_quantity = $result['quantity'] - $current_quantity;
            $query7 ="UPDATE inventory SET quantity = '$update_quantity' WHERE product_id = '$product_name'";
            mysqli_query($conn, $query7);
        }else if($quantity < $product_q_array[$i] ){
            $query6="SELECT * FROM inventory WHERE product_id = '$product_name'";
            $result = mysqli_fetch_assoc($conn->query($query6));
            $current_quantity = $product_q_array[$i]-$quantity ;
            $update_quantity = $result['quantity'] + $current_quantity;
            $query7 ="UPDATE inventory SET quantity = '$update_quantity' WHERE product_id = '$product_name'";
            mysqli_query($conn, $query7);
        }else if($quantity == $product_q_array[$i] ){
            $query6="SELECT * FROM inventory WHERE product_id = '$product_name'";
            $result = mysqli_fetch_assoc($conn->query($query6));
            $update_quantity = $result['quantity'] - $quantity;
            $query7 ="UPDATE inventory SET quantity = '$update_quantity' WHERE product_id = '$product_name'";
            mysqli_query($conn, $query7);
        }

        $query4 = "INSERT INTO invoice_details (customer_id, invoice_no,product_id,unit_id, price, quantity, value) VALUES ('$customer_name', '$invoice_no','$product_name', '$unit', '$unit_price', '$quantity', '$value')";
        mysqli_query($conn, $query4);
    }else{
        $_SESSION['status'] = "Invoice Number Same !!";
        header("Location:index.php?page=invoice_draft_list");
        exit;
    }
    }
    if(!in_array($invoice_no,$invoice_array)){
    $query5 = "INSERT INTO invoice (customer_name,invoice_date,invoice_no,total_value) VALUES ('$customer_name','$invoice_date','$invoice_no','$total_value')";

    if ($conn->query($query5)) {
        $query11 = "DELETE FROM draft_invoice WHERE invoice_no = $invoice_id";
        $conn->query($query11);
        $query12 = "DELETE FROM draft_invoice_details WHERE invoice_no = $invoice_id";
        $conn->query($query12);
        $_SESSION['status'] = "Invoice Created";
        header("Location:index.php?page=invoice_list");
    } else {
        $_SESSION['status'] = "Creation Failed";
        header("Location:index.php?page=add_invoice");
    }
}else{
    $_SESSION['status'] = "Invoice Number Same !!";
    header("Location:index.php?page=invoice_draft_list");
    exit;
}
    
}

if (isset($_POST['draft'])) {
    $customer_name = $_POST['customer_name'];
    $invoice_date = $_POST['date'];
    $invoice_no = $_POST['invoice_no'];
    $total_value = $_POST['total_value'];

    $sn = $_POST['sn_up'];
    $pd_id = $_POST['pd_id'];
    $pd_id_no = count($pd_id);
    $product_names = $_POST['product'];
    $units = $_POST['unit'];
    $unit_prices = $_POST['unit_price'];
    $quantities = $_POST['quantity'];
    $values = $_POST['value'];

    // print_r($product_names);
    //     exit;

    foreach($quantities as $quantities_check){
        if($quantities_check<0){
            $_SESSION['status'] = "Quantity Must be gather then 0 !!";
            header("Location:index.php?page=invoice_draft_list");
            exit;
        }
    }

    for ($i = 0; $i < count($sn); $i++) {
        $product_name = $product_names[$i];
        $unit = $units[$i];
        $unit_price = $unit_prices[$i];
        $quantity = $quantities[$i];
        $value = $values[$i];
        
        $query2 = "UPDATE draft_invoice_details SET customer_id = '$customer_name', invoice_no = '$invoice_no',product_id = '$product_name',unit_id='$unit',price = '$unit_price',quantity='$quantity ',value='$value'  WHERE invoice_no=$invoice_id and id = $pd_id[$i]";
        mysqli_query($conn, $query2);
        if($i>=$pd_id_no){
        $query4 = "INSERT INTO draft_invoice_details (customer_id, invoice_no,product_id,unit_id, price, quantity, value) VALUES ('$customer_name', '$invoice_no','$product_name', '$unit', '$unit_price', '$quantity', '$value')";
        mysqli_query($conn, $query4);
        }
    }
    $query1 = "UPDATE draft_invoice SET customer_name = '$customer_name', invoice_date = '$invoice_date',invoice_no = '$invoice_no',total_value='$total_value' WHERE invoice_no=$invoice_id ";


    if ($conn->query($query1)) {
        $_SESSION['status'] = "Invoice Draft Updated";
        header("Location:index.php?page=invoice_draft_list");
    } else {
        $_SESSION['status'] = "Creation Failed";
        header("Location:index.php?page=invoice_draft_list");
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
                    <span>Update Invoice Draft</span>
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
                                            <a href="index.php?page=invoice_draft_list" class="btn btn-success float-right">List of Invoice Draft</a>
                                        </div>
                                    </div>
                                </div>
                                <form action="" class="mt-3" id="add_name" method="POST">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Customer Name:</label>
                                            <select name="customer_name" required id="text" class="form-control text-capitalize">
                                                <option value="" class="text-capitalize">Choose Customer Name</option>

                                                <?php foreach ($customers as $customer) : ?>
                                                    <option value="<?php echo (int)$customer['id']; ?>" <?php if ($customer['id'] === $row_invoice['customer_name']) : echo "selected"; endif; ?> class="text-capitalize"> <?php echo ($customer['name']); ?> </option>
                                                <?php endforeach; ?>

                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="date" class="col-form-labe">Invoice Date:</label>

                                            <input type="date" class="form-control" placeholder="Date" name="date" value="<?php echo ($row_invoice['invoice_date']); ?>">


                                        </div>

                                        <div class="col-md-4">
                                            <label for="invoice_no">Invoice No:</label>
                                            <input type="text" name="invoice_no" placeholder="Invoice No" required class="form-control" value="<?php echo ($row_invoice['invoice_no']); ?>" readonly>

                                        </div>
                                    </div>
                                    <table class="table table-borderless table-responsive mt-5" id="dynamic_field">
                                        <?php $i = 1;
                                        foreach ($join_data as $product_all) : ?>
                                            <?php if ($row_invoice['invoice_no'] === $product_all['invoice_det_no']) : ?>
                                                <tr>
                                                    <input type="hidden" name="pd_id[]" value="<?= $product_all['invoice_det_id'] ?>" />
                                                    <td><label>SN::</label><input type="text" name="sn_up[]" class="form-control sn" value="<?php echo $i; ?>" readonly/></td>
                                                    <td><label>Product Name:</label>
                                                        <select name="product[]" required id="text" class="form-control text-capitalize">
                    
                                                                <option value="<?php echo $product_all['product_id'] ?>" class="text-capitalize"><?php echo $product_all['name'] ?></option>
                                                           
                                                        </select>
                                                    </td>

                                               <td><label>Unit:</label><input type="text" name="unit[]" class="unit form-control" placeholder="Unit" value="<?php echo $product_all['unit_id'] ?>" readonly /></td>
                                               <td><label>Price:</label><input type="number" name="unit_price[]" placeholder="Enter Price" class="unit_price form-control" value="<?php echo $product_all['price'] ?>" readonly  /></td>
                                               <?php foreach ($inventories as $inventory) : ?>
                                                <?php if($inventory['quantity'] === $product_all['inventory_quantity']): ?>
                                               <td><label>Available Quantity:</label><input type="text" name="avilable_quantity[]" class="avilable_quantity form-control" placeholder="A.Quantity" value="<?php echo $product_all['inventory_quantity'] ?>" readonly /></td>
                                               <?php endif; ?>
                                               <?php endforeach; ?>
                                               <td><label>Quantity:</label><input type="number" name="quantity[]" placeholder="Quantity" class="quantity form-control" value="<?php echo $product_all['quantity'] ?>"  /></td>
                                               <td><label>Value:</label><input type="number" name="value[]" placeholder="value" class="sub_total_price form-control" value="<?php echo $product_all['value'] ?>"  readonly /></td>

                                                </tr>
                                                <?php $i++; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        <td colspan="3"></td>
                                        <td><button type="button" name="add" id="add_update_invoice" class="btn btn-primary mt-4 ml"><i class="fa fa-plus" aria-hidden="true"></i></button></td>
                                    </table>
                                    <div class="row">
                                        <div class="col-md-9"></div>
                                        <div class="col-md-3">
                                            <label>Total Price:</label>
                                            <input type="text" id="total_price" name="total_value" placeholder="Total Value" class="form-control" readonly value="<?php echo ($row_invoice['total_value']); ?>"  />
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-4"><input type="submit" class="samplewidth btn btn-success" name="update" id="submit" value="Final Submit"></div>
                                        <div class="col-md-2"></div>
                                        <div class="col-md-4"><input type="submit" class="samplewidth btn btn-warning" name="draft" id="submit" value="Draft And Update"></div>
                                        
                                        <div class="col-md-1"></div>
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