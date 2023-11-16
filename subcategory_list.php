<?php
$conn = mysqli_connect("localhost","root","","core_pos");
if (!$conn) {
  echo "Failed to connect to MySQL";
  exit();
}
?>
<?php
$subcategory = "SELECT s.id,s.sub_category_name, s.category_id,s.created_at,s.updated_at, c.category_name
FROM sub_category AS s
INNER JOIN category AS c ON s.category_id = c.id";

$result = $conn->query($subcategory);
?>
<div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
      <div class="panel-heading">
          <strong>
            <span><i class="fa fa-list" aria-hidden="true"></i></span>
            <span>List Of Sub Category</span>
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
                    <a href="index.php?page=add_subcategory" class="btn btn-success float-right">Create Sub Category</a>
                  </div>
                  </div>
                    
                </div>
                <div class="row">
              <div class="col-md-3"></div>
                <div class="col-md-6">
                  <form action="" method="GET">
                    <div class="input-group mb-3">
                      <input type="text" name="search" id="search_text_sub_category" class="form-control" placeholder="Search Sub Category">
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
                <th class="text-center"> Sub-Category Name</th>
                <th class="text-center"> Category Name</th>
                <th class="text-center"> Created At </th>
                <th class="text-center"> Updated At </th>
                <th class="text-center" style="width: 100px;"> Actions </th>
              </tr>
            </thead>
            <tbody>
              
              <tr>
                <?php $n=1; foreach($result as $row): ?>
                <td class="text-center"><?php echo $n++; ?></td>
                <td class="text-center"> <?php echo ($row['sub_category_name']); ?></td>
                <td class="text-center"> <?php echo ($row['category_name']); ?></td>
                <td class="text-center"> <?php echo ($row['created_at']); ?></td>
                <td class="text-center"> <?php echo ($row['updated_at']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="index.php?page=edit_subcategory&id=<?php echo (int)$row['id'];?>" class="btn btn-info btn-xs"  title="Edit" data-toggle="tooltip">
                      <span ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                    </a>
                    <a href="index.php?page=delete_subcategory&id=<?php echo (int)$row['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
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