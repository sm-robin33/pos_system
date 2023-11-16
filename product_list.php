
<?php
$conn = mysqli_connect("localhost","root","","core_pos");

// Check connection
if (!$conn) {
  echo "Failed to connect to MySQL";
  exit();
}
?>
<?php 
$query = "SELECT name, p.id, p.brand_id, p.barcode, p.category_id, p.subcategory_id, p.product_image, p.measure_purchase_id, p.measure_sale_id, p.status, b.brand_name, c.category_name, s.sub_category_name, p.created_at, p.updated_at, m1.measurement_name AS purchase_measurement, m2.measurement_name 
AS sale_measurement FROM products AS p INNER JOIN brands AS b ON p.brand_id = b.id INNER JOIN category AS c ON p.category_id = c.id 
INNER JOIN sub_category AS s ON p.subcategory_id = s.id INNER JOIN measurements AS m1 ON p.measure_purchase_id = m1.id INNER JOIN measurements AS m2 ON p.measure_sale_id = m2.id";
$result = $conn->query($query);

?>
<div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
      <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>List Of Products</span>
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
              <div class="col-sm-10"></div>
              <div class="col-sm-2">
              <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                <a href="index.php?page=add_product" class="btn btn-success float-right">Create Product</a>
              </div>
              </div>
                
            </div>
            <div class="row">
              <div class="col-md-3"></div>
                <div class="col-md-6">
                  <form action="" method="GET">
                    <div class="input-group mb-3">
                      <input type="text" name="search" id="search_text_product" class="form-control" placeholder="Search Product">
                    </div>
                  </form>
                </div>
                <div class="col-md-3"></div>
                </div>
    <div class="panel-body">
      <table class="table table-bordered" id="table_data">
        <thead>
          <tr>
            <th class="text-center" style="width: 50px;">#</th>
            <th class="text-center"> Name</th>
            <th class="text-center"> Brand Name</th>
            <th class="text-center"> Barcode</th>
            <th class="text-center">  Category Name</th>
            <th class="text-center"> Sub Category Name</th>
            <th class="text-center"> Product Image</th>
            <th class="text-center">Purchase Measurement</th>
            <th class="text-center">Sell Measurement</th>
            <th class="text-center"> Created At </th>
            <th class="text-center"> Updated At </th>
            <th class="text-center"> Status</th>
            <th class="text-center" style="width: 100px;"> Actions </th>
          </tr>
        </thead>
        <tbody>
          
          <tr>
            <?php $n=1; foreach($result as $row): ?>
            <td class="text-center"><?php echo $n++; ?></td>
            <td class="text-center"> <?php echo ($row['name']); ?></td>
            <td class="text-center"> <?php echo ($row['brand_name']); ?></td>
            <td class="text-center"> <?php echo ($row['barcode']); ?></td>
            <td class="text-center"> <?php echo ($row['category_name']); ?></td>
            <td class="text-center"> <?php echo ($row['sub_category_name']); ?></td>
            <td class="text-center">
            <?php
            $imagePath = 'images/' . $row['product_image'];
            if (file_exists($imagePath)) {
                echo '<img  width=100px height=100px src="' . $imagePath . '" alt="" />';
            } else {
                echo 'Image not found';
            }
            ?>
           </td>
            <td class="text-center"> <?php echo ($row['purchase_measurement']); ?></td>
            <td class="text-center"> <?php echo ($row['sale_measurement']); ?></td>
            <td class="text-center"> <?php echo ($row['created_at']); ?></td>
            <td class="text-center"> <?php echo ($row['updated_at']); ?></td>
            <td class="text-center"> <?php echo ($row['status']); ?></td>
            <td class="text-center">
              <div class="btn-group">
                <a href="index.php?page=edit_product&id=<?php echo $row['id'];?>" class="btn btn-info btn-xs"  title="Edit" data-toggle="tooltip">
                  <span ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                </a>
                <a href="index.php?page=delete_product&id=<?php echo $row['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
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
