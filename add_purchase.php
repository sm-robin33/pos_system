

   <?php
    $conn = mysqli_connect("localhost", "root", "", "core_pos");

    if (!$conn) {
        echo "Failed to connect to MySQL";
        exit();
    }
    //   else{
    //     echo "Connection Success";
    //   }
    
    $query1 = "SELECT * FROM products";
    $products = $conn->query($query1);

    $query2 = "SELECT * FROM supplier";
    $suppliers = $conn->query($query2);

    $query3 = "SELECT * FROM parchase";
    $purchase_ref = $conn->query($query3);
    

if (isset($_POST['submit'])) {
    $suppler_name = $_POST['supplier'];
    $purchase_date = $_POST['date'];
    $referance = $_POST['referance'];
    $total_amount = $_POST['total_price'];

    $sn = $_POST['sn'];
    $product_names = $_POST['product'];
    $quantities = $_POST['quantity'];
    $unit_prices = $_POST['unit_price'];
    $sub_unit_prices = $_POST['sub_total_price'];

    // print_r($purchase_ref);
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

    foreach($purchase_ref as $p_referance){
        if($referance === $p_referance['referance']){
            $_SESSION['status'] = "Referance Number is same !!";
            header("Location:index.php?page=add_purchase");
            exit;
        }
    }

    for ($i = 0; $i < count($sn); $i++) {
        $product_name = $product_names[$i];
        $quantity = $quantities[$i];
        $unit_price = $unit_prices[$i];
        $sub_unit_price = $sub_unit_prices[$i];

        
        $query2 = "INSERT INTO parchase_details (supplier_id, parchase_date,referance,product_name, quantity, unit_price, sub_total_price) VALUES ('$suppler_name', '$purchase_date','$referance', '$product_name', '$quantity', '$unit_price', '$sub_unit_price')";
        mysqli_query($conn, $query2);
    }

    $query1 = "INSERT INTO parchase (supplier_name,parchase_date,referance,total_amount) VALUES ('$suppler_name','$purchase_date','$referance','$total_amount')";

    if ($conn->query($query1)) {
        $_SESSION['status'] = "Purchase Created";
        header("Location:index.php?page=purchase_list");
    } else {
        $_SESSION['status'] = "Creation Failed";
        header("Location:index.php?page=add_purchase");
    }
}

if(isset($_POST['draft'])){
    $suppler_name = $_POST['supplier'];
    $purchase_date = $_POST['date'];
    $referance = $_POST['referance'];
    $total_amount = $_POST['total_price'];

    $sn = $_POST['sn'];
    $product_names = $_POST['product'];
    $quantities = $_POST['quantity'];
    $unit_prices = $_POST['unit_price'];
    $sub_unit_prices = $_POST['sub_total_price'];

    // print_r($unit_prices);
    // exit;
    foreach($d_purchase_ref as $d_referance){
        if($referance === $d_referance['referance']){
            $_SESSION['status'] = "Referance Number is same !!";
            header("Location:index.php?page=purchase_list");
            exit;
        }
    }

    foreach ($purchase_ref as $p_reference) {
        if ($reference === $p_reference['reference']) {
            $_SESSION['status'] = "Reference Number is same !!";
            header("Location: index.php?page=add_purchase");
            exit;
        }
    }

    for ($i = 0; $i < count($sn); $i++) {
        $product_name = $product_names[$i];
        $quantity = $quantities[$i];
        $unit_price = $unit_prices[$i];
        $sub_unit_price = $sub_unit_prices[$i];

        $query2 = "INSERT INTO draft_parchase_details (supplier_id, parchase_date,referance, product_name, quantity, unit_price, sub_total_price) VALUES ('$suppler_name', '$purchase_date','$referance', '$product_name', '$quantity', '$unit_price', '$sub_unit_price')";
        mysqli_query($conn, $query2);
    }

    $query1 = "INSERT INTO draft_parchase (supplier_name,parchase_date,referance,total_amount) VALUES ('$suppler_name','$purchase_date','$referance','$total_amount')";

    if ($conn->query($query1)) {
        $_SESSION['status'] = "Draft Created";
        header("Location:index.php?page=draft_list");
    } else {
        $_SESSION['status'] = "Creation Failed";
        header("Location:index.php?page=draft_list");
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
                       <span>Create Purchase</span>
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
                                               <a href="index.php?page=purchase_list" class="btn btn-success float-right">List of Purchase</a>
                                           </div>
                                       </div>
                                   </div>
                                   <form action=""  class="mt-3" id="add_name" method="POST">
                                       <div class="row">
                                           <div class="col-md-4">
                                               <label>Supplier Name:</label>
                                               <select name="supplier" required id="text" class="form-control text-capitalize">
                                                   <option value="" class="text-capitalize">Choose Supplier Name</option>

                                                   <?php foreach ($suppliers as $supplier) : ?>
                                                       <option value="<?php echo $supplier['id'] ?>" class="text-capitalize"><?php echo $supplier['supplier_name'] ?></option>
                                                   <?php endforeach; ?>

                                               </select>
                                           </div>
                                           <div class="col-md-4">
                                               <label for="date" class="col-form-labe">Purchase Date:</label>

                                               <input type="date" class="form-control" placeholder="Date" name="date">


                                           </div>

                                           <div class="col-md-4">
                                               <label for="referance_no">Referance No:</label>
                                               <input type="text" name="referance" placeholder="Referance No" required class="form-control">

                                           </div>
                                       </div>
                                       <table class="table table-bordered table-hover mt-5" id="dynamic_field">
                                           <tr>
                                               <td ><label>SN::</label><input type="text" name="sn[]"  class="form-control sn" value="1" /></td>
                                               <td><label>Product Name:</label>
                                                   <select name="product[]" required id="text" class="form-control text-capitalize">
                                                       <option value="" class="text-capitalize">Choose Product</option>

                                                       <?php foreach ($products as $product) : ?>
                                                           <option value="<?php echo $product['id'] ?>" class="text-capitalize"><?php echo $product['name'] ?></option>
                                                       <?php endforeach; ?>

                                                   </select>
                                               </td>
                                               <td><label>Quantity:</label><input type="number" name="quantity[]" placeholder="Quantity" class="quantity form-control" /></td>
                                               <td><label>Unit Price:</label><input type="number" name="unit_price[]" placeholder="Enter Unit Price" class="unit_price form-control" /></td>
                                               <td><label>Sub Total Price:</label><input type="number" name="sub_total_price[]" placeholder="Sub Total Price" class="sub_total_price form-control" readonly /></td>
                                               <td><button type="button" name="add" id="add" class="btn btn-primary mt-4">Add More</button></td>
                                           </tr>

                                       </table>
                                       <div class="row">
                                           <div class="col-md-9"></div>
                                           <div class="col-md-3">
                                               <label>Total Price:</label>
                                               <input type="text" id="total_price" name="total_price" placeholder="Total Price" class="form-control" readonly />
                                           </div>
                                       </div>
                                       <div class="row mt-5">
                                           <div class="col-md-1"></div>
                                           <div class="col-md-4"><input type="submit" class="samplewidth btn btn-success" name="submit" id="submit" value="Save And Submit"></div>
                                           <div class="col-md-2"></div>
                                           <div class="col-md-4"><input type="submit" class="samplewidth btn btn-warning" name="draft" id="submit" value="Draft And Submit"></div>
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