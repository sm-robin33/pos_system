
<?php
$conn = mysqli_connect("localhost","root","","core_pos");
if (!$conn) {
  echo "Failed to connect to MySQL";
  exit();
}
?>
<?php
$query = "SELECT i.id,i.product_id,P.category_id,P.brand_id,i.quantity,i.store_id,i.status,i.created_at,i.updated_at,p.name AS product_name,c.category_name,b.brand_name,s.store_name
FROM inventory AS i
INNER JOIN products AS p ON p.id = i.product_id
INNER JOIN category AS c ON c.id = P.category_id
INNER JOIN brands AS b ON b.id = P.brand_id
INNER JOIN store AS s ON s.id = i.store_id
";

// $query = "SELECT * FROM inventory";
$inventories = $conn->query($query);
?>
<div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
      <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>List Of Inventories</span>
         </strong>
        </div>
    <?php 
    
    if(isset($_SESSION['status']))
    {
        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['status']; ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php 
        unset($_SESSION['status']);
    }

?>
      <div class="row mt-5">
                  <div class="col-sm-10"></div>
                  <div class="col-sm-2">
                  <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                    <a href="index.php?page=add_inventory" class="btn btn-success float-right">Create Inventory</a>
                  </div>
                  </div>
                    
                </div>
                <div class="row">
              <div class="col-md-3"></div>
                <div class="col-md-6">
                  <form action="" method="GET">
                    <div class="input-group mb-3">
                      <input type="text" name="search" id="search_text_inventory" class="form-control" placeholder="Search Inventory">
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
                <th class="text-center"> Product Name</th>
                <th class="text-center"> Category</th>
                <th class="text-center"> Brand</th>
                <th class="text-center"> Quantity</th>
                <th class="text-center"> Store Name</th>
                <th class="text-center"> Status</th>
                <th class="text-center"> Created At </th>
                <th class="text-center"> Updated At </th>
                <th class="text-center" style="width: 100px;"> Actions </th>
              </tr>
            </thead>
            <tbody>
              
              <tr>
                <?php $n=1; foreach($inventories as $row): ?>
                <td class="text-center"><?php echo $n++; ?></td>
                <td class="text-center"> <?php echo ($row['product_name']); ?></td>
                <td class="text-center"> <?php echo ($row['category_name']); ?></td>
                <td class="text-center"> <?php echo ($row['brand_name']); ?></td>
                <td class="text-center"> <?php echo ($row['quantity']); ?></td>
                <td class="text-center"> <?php echo ($row['store_name']); ?></td>
                <td class="text-center"> <?php echo ($row['status']); ?></td>
                <td class="text-center"> <?php echo ($row['created_at']); ?></td>
                <td class="text-center"> <?php echo ($row['updated_at']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="index.php?page=edit_inventory&id=<?php echo (int)$row['id'];?>" class="btn btn-info btn-xs"  title="Edit" data-toggle="tooltip">
                      <span ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                    </a>
                    <a href="index.php?page=delete_inventory&id=<?php echo (int)$row['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
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