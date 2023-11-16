

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
   

    $query1 = "SELECT p.name,i.product_id,p.id
    FROM products AS p
    INNER JOIN inventory AS i ON i.product_id = p.id";
    $products = $conn->query($query1);

    // print_r($products);
    // exit;

    $query3 = "SELECT * FROM customers";
    $customers = $conn->query($query3);

    $query4 = "SELECT * FROM invoice"; 
    $invoice = $conn->query($query4);

    $invoice_array = array();

        foreach($invoice as $inv){
            array_push($invoice_array,$inv['invoice_no']);
        }

    $query6 = "SELECT * FROM draft_invoice"; 
    $draft_invoice = $conn->query($query6);


    if(mysqli_num_rows($invoice)>0 or mysqli_num_rows($draft_invoice)>0){

     $query5 = "SELECT * FROM invoice 
     ORDER BY id DESC
     LIMIT 1;";
    $invoice_count = $conn->query($query5);
    $inv_count = mysqli_fetch_assoc($invoice_count);


    $query7 = "SELECT * FROM draft_invoice 
     ORDER BY id DESC
     LIMIT 1;";
    $draft_invoice_count = $conn->query($query7);
    $draft_inv_count = mysqli_fetch_assoc($draft_invoice_count);

        if(mysqli_num_rows($invoice_count) ==0){
            $invoice_number = $draft_inv_count['invoice_no']+1;
        }
        else if(mysqli_num_rows($draft_invoice_count) ==0){
            $invoice_number = $inv_count['invoice_no']+1;
        }else{
            if($inv_count['invoice_no'] > $draft_inv_count['invoice_no']){
                $invoice_number = $inv_count['invoice_no']+1;
            }else{
                $invoice_number = $draft_inv_count['invoice_no']+1;
            }
        }

    }else{
        $invoice_number = 111111;
    }
    ?>

<?php
if (isset($_POST['submit'])) {
    $customer_name = $_POST['customer_name'];
    $invoice_date = $_POST['date'];
    $invoice_no = $_POST['invoice_no'];
    $total_value = $_POST['total_value'];

    $sn = $_POST['sn'];
    $product_names = $_POST['product'];
    $units = $_POST['unit'];
    $unit_prices = $_POST['unit_price'];
    $quantities = $_POST['quantity'];
    $values = $_POST['value'];

    // print_r($sn);
    // exit;

   

    for ($i = 0; $i < count($sn); $i++) {
        $product_name = $product_names[$i];
        $unit = $units[$i];
        $unit_price = $unit_prices[$i];
        $quantity = $quantities[$i];
        $value = $values[$i];
        $query6="SELECT * FROM inventory WHERE product_id = '$product_name'";
        $result = mysqli_fetch_assoc($conn->query($query6));
        if(!in_array($invoice_no,$invoice_array)){
        if($quantity<=$result['quantity'] and $quantity>0){
        $update_quantity = $result['quantity'] - $quantity;
        $query7 ="UPDATE inventory SET quantity = '$update_quantity' WHERE product_id = '$product_name'";
        mysqli_query($conn, $query7);
    
        $query4 = "INSERT INTO invoice_details (customer_id, invoice_no,product_id,unit_id, price, quantity, value) VALUES ('$customer_name', '$invoice_no','$product_name', '$unit', '$unit_price', '$quantity', '$value')";
        mysqli_query($conn, $query4);
        }else{
            $_SESSION['status'] = "over quantity or negetive input not avilable";
            header("Location:index.php?page=add_invoice");
            exit;
            
        }}
    }
    if(!in_array($invoice_no,$invoice_array)){
    if($quantity<=$result['quantity'] and $quantity>0){
    $query5 = "INSERT INTO invoice (customer_name,invoice_date,invoice_no,total_value) VALUES ('$customer_name','$invoice_date','$invoice_no','$total_value')";

    if ($conn->query($query5)) {
        $_SESSION['status'] = "Invoice Created";
        header("Location:index.php?page=invoice_list");
        exit;
    } else {
        $_SESSION['status'] = "Creation Failed";
        header("Location:index.php?page=add_invoice");
        exit;
    }
}
}else{
          $_SESSION['status'] = "Invoice no already exist";
          header("Location:index.php?page=add_invoice");
          exit;
}}

if(isset($_POST['draft'])){
    $customer_name = $_POST['customer_name'];
    $invoice_date = $_POST['date'];
    $invoice_no = $_POST['invoice_no'];
    $total_value = $_POST['total_value'];

    $sn = $_POST['sn'];
    $product_names = $_POST['product'];
    $units = $_POST['unit'];
    $unit_prices = $_POST['unit_price'];
    $quantities = $_POST['quantity'];
    $values = $_POST['value'];

   

    for ($i = 0; $i < count($sn); $i++) {
        $product_name = $product_names[$i];
        $unit = $units[$i];
        $unit_price = $unit_prices[$i];
        $quantity = $quantities[$i];
        $value = $values[$i];

        $query4 = "INSERT INTO draft_invoice_details (customer_id, invoice_no,product_id,unit_id, price, quantity, value) VALUES ('$customer_name', '$invoice_no','$product_name', '$unit', '$unit_price', '$quantity', '$value')";
        mysqli_query($conn, $query4);
    }

    $query5 = "INSERT INTO draft_invoice (customer_name,invoice_date,invoice_no,total_value) VALUES ('$customer_name','$invoice_date','$invoice_no','$total_value')";

    if ($conn->query($query5)) {
        $_SESSION['status'] = "Invoice Draft Created";
        header("Location:index.php?page=invoice_draft_list");
    } else {
        $_SESSION['status'] = "Creation Failed";
        header("Location:index.php?page=add_invoice");
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
                       <span>Create Invoice</span>
                   </strong>
               </div>
               <?php 
                    if (isset($_SESSION['status'])) {
                        ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><?= $_SESSION['status']; ?></strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php
                        unset($_SESSION['status']);
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
                                               <a href="index.php?page=invoice_list" class="btn btn-success float-right">List of Invoice</a>
                                           </div>
                                       </div>
                                   </div>
                                   <form action=""  class="mt-3" id="add_name" method="POST">
                                       <div class="row">
                                           <div class="col-md-4">
                                               <label>Customer Name:</label>
                                               <select name="customer_name" required id="text" class="form-control text-capitalize">
                                                   <option value="" class="text-capitalize">Choose Customer Name</option>

                                                   <?php foreach ($customers as $customer) : ?>
                                                       <option value="<?php echo $customer['id'] ?>" class="text-capitalize"><?php echo $customer['name'] ?></option>
                                                   <?php endforeach; ?>

                                               </select>
                                           </div>
                                           <div class="col-md-4">
                                               <label for="date" class="col-form-labe">Invoice Date:</label>

                                               <input type="date" class="form-control" placeholder="Date" name="date">


                                           </div>

                                           <div class="col-md-4">
                                               <label for="referance_no">Invoice No:</label>
                                               <input type="text" name="invoice_no" placeholder="Invoice No" required class="form-control" value="<?=$invoice_number;?>" readonly>

                                           </div>
                                       </div>
                                       <table class="table table-borderless table-hover mt-5" id="dynamic_field">
                                           <tr>
                                               <td ><label>SN::</label><input type="text" name="sn[]"  class="form-control sn" value="1" /></td>
                                               <td><label>Product Name:</label>
                                                   <select name="product[]" required id="product text" class="pid form-control text-capitalize">
                                                       <option value="" disabled selected class="text-capitalize">Choose Product</option>

                                                       <?php foreach ($products as $product) : ?>
                                                           <option value="<?php echo $product['id'] ?>" class="text-capitalize"><?php echo $product['name'] ?></option>
                                                       <?php endforeach; ?>

                                                   </select>
                                               </td>
                                               <td><label>Unit:</label><input type="text" name="unit[]" class="unit form-control" placeholder="Unit" readonly /></td>
                                               <td><label>Price:</label><input type="number" name="unit_price[]" placeholder="Enter Price" class="unit_price form-control" readonly /></td>
                                               <td><label>Available Quantity:</label><input type="text" name="a_unit[]" class="avilable_quantity form-control" placeholder="A.Quantity" readonly /></td>
                                               <td><label>Quantity:</label><input type="number" name="quantity[]" placeholder="Quantity" class="quantity form-control" /></td>
                                               <td><label>Value:</label><input type="number" name="value[]" placeholder="value" class="sub_total_price form-control" readonly /></td>
                                               <td><button type="button" name="add" id="add_invoice" class="btn btn-primary mt-4"><i class="fa fa-plus" aria-hidden="true"></i></button></td>
                                           </tr>

                                       </table>
                                       <div class="row">
                                           <div class="col-md-9"></div>
                                           <div class="col-md-3">
                                               <label>Total Value:</label>
                                               <input type="text" id="total_price" name="total_value" placeholder="Total value" class="form-control" readonly />
                                           </div>
                                       </div>
                                       <div class="row mt-5">
                                           <div class="col-md-1"></div>
                                           <div class="col-md-4"><input type="submit" class="samplewidth btn btn-success" name="submit" id="submit" value="Create"></div>
                                           <div class="col-md-2"></div>
                                           <div class="col-md-4"><input type="submit" class="samplewidth btn btn-warning" name="draft" id="submit" value="Draft"></div>
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