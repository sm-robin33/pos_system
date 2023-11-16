<?php
$conn = mysqli_connect("localhost","root","","core_pos");
if (!$conn) {
  echo "Failed to connect to MySQL";
  exit();
}
?>
<?php

 $customer = "SELECT i.id,i.customer_name,i.invoice_date,i.invoice_no,i.total_value,i.created_at,i.updated_at,c.name AS customer_name, c.id
FROM invoice AS i
INNER JOIN customers AS c ON i.customer_name = c.id";

$result = $conn->query($customer);

$multi_join = "SELECT idd.id AS invoice_det_id, idd.customer_id, idd.product_id, idd.unit_id, idd.price, idd.quantity, idd.value, idd.invoice_no AS invoice_det_no, pd.id AS product_id, pd.name AS product_name
FROM invoice_details AS idd
INNER JOIN invoice AS iv ON iv.invoice_no = idd.invoice_no
INNER JOIN products AS pd ON pd.id = idd.product_id
WHERE iv.customer_name = idd.customer_id";

$join_data = $conn->query($multi_join);


// print_r($join_data);
// exit;


?>
<div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
      <div class="panel-heading">
          <strong>
            <span><i class="fa fa-list" aria-hidden="true"></i></span>
            <span>List Of Invoice</span>
         </strong>
        </div>
        <?php 

    if(isset($_SESSION['status']))
    {
        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong> <?= $_SESSION['status']; ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php 
        unset($_SESSION['status']);
    }

?>
      <div class="row mt-5">
                  <div class="col-sm-8"></div>
                  <div class="col-sm-2">
                  <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                    <a href="index.php?page=invoice_draft_list" class="btn btn-success float-right">Draft List</a>
                  </div>
                  </div>
                  <div class="col-sm-2">
                  <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                    <a href="index.php?page=add_invoice" class="btn btn-success float-right">Create Invoice</a>
                  </div>
                  </div>
                    
                </div>
                <div class="row">
              <div class="col-md-3"></div>
                <div class="col-md-6">
                  <form action="" method="GET">
                    <div class="input-group mb-3">
                      <input type="text" name="search" id="search_text_invoice" class="form-control" placeholder="Search Customer Name or Invoice No ">
                    </div>
                  </form>
                </div>
                <div class="col-md-3"></div>
                </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped" id="table_data">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th class="text-center"> Customer Name</th>
                <th class="text-center"> Invoice Date</th>
                <th class="text-center"> Invoice No</th>
                <th class="text-center"> Product Name</th>
                <th class="text-center"> Unit</th>
                <th class="text-center"> Unit Price</th>
                <th class="text-center"> Quantity</th>
                <th class="text-center"> Value</th>
                <th class="text-center"> Total Value</th>
                <th class="text-center"> Created At </th>
                <th class="text-center"> Updated At </th>
                <th class="text-center" style="width: 100px;"> Actions </th>
              </tr>
            </thead>
            <tbody>
              
              <tr>
                <?php $n=1; foreach($result as $row): ?>
                <td class="text-center"><?php echo $n++; ?></td>
                <td class="text-center"><?php echo ($row['customer_name']); ?></td>
                <td class="text-center"><?php echo ($row['invoice_date']); ?> </td>
                <td class="text-center"><?php echo ($row['invoice_no']); ?>  </td>
                
                <td class="text-center">
                    <table class="table table-bordered">
                  <?php foreach($join_data as $product): ?>
                    <?php if($row['invoice_no'] === $product['invoice_det_no']): ?>
                    <tr><td><?php echo ($product['product_name']); ?></td></tr>
                    <?php endif; ?>
                    <?php endforeach;?>
                    </table>
                </td>
                <td class="text-center">
                    <table class="table table-bordered">
                  <?php foreach($join_data as $product): ?>
                    <?php if($row['invoice_no'] === $product['invoice_det_no']): ?>
                    <tr><td><?php echo ($product['unit_id']); ?></td></tr>
                    <?php endif; ?>
                    <?php endforeach;?>
                    </table>
                </td>
                <td class="text-center">
                <table class="table table-bordered">
                  <?php foreach($join_data as $product): ?>
                    <?php if($row['invoice_no'] === $product['invoice_det_no']): ?>
                    <tr><td><?php echo ($product['price']); ?></td></tr>
                    <?php endif; ?>
                    <?php endforeach;?>
                    </table>
               </td>
                <td class="text-center">
                <table class="table table-bordered">
                  <?php foreach($join_data as $product): ?>
                    <?php if($row['invoice_no'] === $product['invoice_det_no']): ?>
                    <tr><td><?php echo ($product['quantity']); ?></td></tr>
                    <?php endif; ?>
                    <?php endforeach;?>
                    </table>
                </td>
                
                <td class="text-center">
                <table class="table table-bordered">
                  <?php foreach($join_data as $product): ?>
                    <?php if($row['invoice_no'] === $product['invoice_det_no']): ?>
                    <tr><td><?php echo ($product['value']); ?></td></tr>
                    <?php endif; ?>
                    <?php endforeach;?>
                    </table>
                </td>
                
                <td class="text-center"><?php echo ($row['total_value']); ?> </td>
                <td class="text-center"> <?php echo ($row['created_at']); ?></td>
                <td class="text-center"> <?php echo ($row['updated_at']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="index.php?page=edit_invoice&invoice_no=<?php echo (int)$row['invoice_no'];?>" class="btn btn-info btn-xs"  title="Edit" data-toggle="tooltip">
                      <span ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                    </a>
                    <a href="index.php?page=delete_invoice&invoice_no=<?php echo (int)$row['invoice_no'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                      <span><i class="fa fa-trash-o" aria-hidden="true"></i></span>
                    </a>
                    <a href="print_invoice.php?invoice_no=<?php echo intval($row['invoice_no']); ?>" target="_blank" class="btn btn-success btn-xs"  title="print" data-toggle="tooltip">
                      <span><i class="fa fa-print" aria-hidden="true"></i></span>
                    </a>
                  </div>
                </td>
              </tr>
              <?php endforeach;?>
            </tbody>
          </tabel>
        </div>
      </div>
    </div>
  </div>