<?php
$conn = mysqli_connect("localhost","root","","core_pos");
if (!$conn) {
  echo "Failed to connect to MySQL";
  exit();
}
?>
<?php

 $supplier = "SELECT p.id,p.supplier_name,p.parchase_date,p.referance,p.total_amount,p.created_at,p.updated_at,s.supplier_name, s.id
FROM parchase AS p
INNER JOIN supplier AS s ON p.supplier_name = s.id";

$result = $conn->query($supplier);

$multi_join = "SELECT ps.id AS purchase_id, ps.supplier_id,ps.product_name,ps.quantity,ps.referance AS ps_referance,ps.unit_price,ps.sub_total_price,p.supplier_name,pd.name
FROM parchase_details AS ps
INNER JOIN parchase AS p ON p.supplier_name = ps.supplier_id and ps.referance = p.referance
INNER JOIN products AS pd ON pd.id = ps.product_name ";

$join_data = $conn->query($multi_join);

?>
<div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
      <div class="panel-heading">
          <strong>
            <span><i class="fa fa-list" aria-hidden="true"></i></span>
            <span>List Of Purchases</span>
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
                    <a href="index.php?page=draft_list" class="btn btn-success float-right">Draft List</a>
                  </div>
                  </div>
                  <div class="col-sm-2">
                  <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                    <a href="index.php?page=add_purchase" class="btn btn-success float-right">Create Parchase</a>
                  </div>
                  </div>
                    
                </div>
                <div class="row">
              <div class="col-md-3"></div>
                <div class="col-md-6">
                  <form action="" method="GET">
                    <div class="input-group mb-3">
                      <input type="text" name="search" id="search_text_purchase" class="form-control" placeholder="Search Purchased Supplier Name or Reference ">
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
                <th class="text-center"> Supplier Name</th>
                <th class="text-center"> Purchase Date</th>
                <th class="text-center"> Reference No</th>
                <th class="text-center"> Product Name</th>
                <th class="text-center"> Product Quantity</th>
                <th class="text-center"> Unit Price</th>
                <th class="text-center"> Sub Total Price</th>
                <th class="text-center"> Total Price</th>
                <th class="text-center"> Created At </th>
                <th class="text-center"> Updated At </th>
                <th class="text-center" style="width: 100px;"> Actions </th>
              </tr>
            </thead>
            <tbody>
              
              <tr>
                <?php $n=1; foreach($result as $row): ?>
                <td class="text-center"><?php echo $n++; ?></td>
                <td class="text-center"><?php echo ($row['supplier_name']); ?></td>
                <td class="text-center"><?php echo ($row['parchase_date']); ?> </td>
                <td class="text-center"><?php echo ($row['referance']); ?>  </td>
                
                <td class="text-center">
                    <table class="table table-bordered">
                  <?php foreach($join_data as $product): ?>
                    <?php if($row['referance'] === $product['ps_referance']): ?>
                    <tr><td><?php echo ($product['name']); ?></td></tr>
                    <?php endif; ?>
                    <?php endforeach;?>
                    </table>
                </td>
                <td class="text-center">
                <table class="table table-bordered">
                  <?php foreach($join_data as $product): ?>
                    <?php if($row['referance'] === $product['ps_referance']): ?>
                    <tr><td><?php echo ($product['quantity']); ?></td></tr>
                    <?php endif; ?>
                    <?php endforeach;?>
                    </table>
                </td>
                <td class="text-center">
                <table class="table table-bordered">
                  <?php foreach($join_data as $product): ?>
                    <?php if($row['referance'] === $product['ps_referance']): ?>
                    <tr><td><?php echo ($product['unit_price']); ?></td></tr>
                    <?php endif; ?>
                    <?php endforeach;?>
                    </table>
               </td>
                <td class="text-center">
                <table class="table table-bordered">
                  <?php foreach($join_data as $product): ?>
                    <?php if($row['referance'] === $product['ps_referance']): ?>
                    <tr><td><?php echo ($product['sub_total_price']); ?></td></tr>
                    <?php endif; ?>
                    <?php endforeach;?>
                    </table>
                </td>
                
                <td class="text-center"><?php echo ($row['total_amount']); ?> </td>
                <td class="text-center"> <?php echo ($row['created_at']); ?></td>
                <td class="text-center"> <?php echo ($row['updated_at']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="index.php?page=edit_purchase&referance=<?php echo (int)$row['referance'];?>" class="btn btn-info btn-xs"  title="Edit" data-toggle="tooltip">
                      <span ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                    </a>
                    <a href="index.php?page=delete_purchase&referance=<?php echo (int)$row['referance'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                      <span><i class="fa fa-trash-o" aria-hidden="true"></i></span>
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