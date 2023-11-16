
    
<?php
$conn = mysqli_connect("localhost","root","","core_pos");

// Check connection
if (!$conn) {
  echo "Failed to connect to MySQL";
  exit();
}
?>
<?php 
if(isset($_POST['add_customer'])){
    $customer_name= $_POST['name'];
    $customer_phone= $_POST['phone'];
    $customer_email= $_POST['email'];
    $customer_address= $_POST['address'];
    $customer_gender= $_POST['gender'];
    $customer_status= $_POST['status'];
    $query= "INSERT INTO customers (name, phone, email,address, gender, status  ) VALUES ('{$customer_name}', '$customer_phone', '$customer_email', '$customer_address','$customer_gender','$customer_status') ";
    if($conn->query($query)){
        $_SESSION['status'] = "Customer Created";
        header("Location:index.php?page=customer_list");
      }else{
        $_SESSION['status'] = "Creation Failed";
        header("Location:index.php?page=add_customer");
      }
    }

?>

<div class="row">
   <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Create New Customer</span>
         </strong>
        </div>
        <div class="page-content">
        <div class="ibox">
      <div class="ibox-head">
      </div>
      <div class="ibox-body">
          <div class="row mt-5">
              <div class="col-md-12">
                <div class="row">
                <div class="col-sm-9"></div>
                <div class="col-sm-3">
                    <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                    <a href="index.php?page=customer_list" class="btn btn-success float-right">List of Customers</a>
                  </div>
                </div>
                </div>
                
                  <form action="" method="post" enctype="multipart/form-data">
    
                      <div class="form-row">
                      <div class="row">
                        <div class="col-md-1"></div>
                       <div class="col-md-4">
                          <label for="full_name" class="col-form-label">Full name:</label>
                            <input type="text" name="name" placeholder="Full Name" required class="form-control">
                          </div>
                          <div class="col-md-2 mt-3"></div>
                      <div class="col-md-4 mt-2">
                        <label for="phone_no" class="col-form-label">Phone No:</label>
                        
                          <input type="number" name="phone" placeholder="Phone No" 
                          class="form-control" required pattern="[0-9]{11}" title="Phone number must be 10 digits">
                        </div>
                        <div class="col-md-1"></div>
                      </div>
                      <div class="row">
                        <div class="col-md-1"></div>
                    <div class="col-md-4 mt-2">
                          <label for="email" class="col-form-label">Email:</label>
                            <input type="email" name="email" placeholder="Email"
                            class="form-control" required>
                          </div>
                          <div class="col-md-2 mt-3"></div>
                      <div class="required col-md-4 mt-2">
                        <label for="address" class="col-form-label">Address:</label>
                          <input type="text" name="address" placeholder="Address" 
                          class="form-control" required pattern=".{5,}" title="Address must be at least 5 characters long">
                        </div>
                        <div class="col-md-1"></div>
                      </div>
                      <div class="row">
                        <div class="col-md-1 mt-3"></div>
                      <div class="required col-md-4 mt-2">
                        <label for="gender" class="col-form-label">Gender:</label>
                          <select name="gender" required class="form-control">
                            <option value="">Choose Your Gender</option>
                            <option value="male">Male</option>
                        <option value="female">Female</option>
                          </select>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-4 mt-3">
                          <label for="status" class="col-form-label">Status:</label>
                            <select name="status" required class="form-control">
                              <option value="">Choose a Status</option>
                              <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                            </select>
                          </div>
                    <div class="col-md-1"></div>
                      </div>
                    <div class="form-group row mt-5 ">
                      <label class="col-sm-4 col-form-label"></label>
                      <div class="col-sm-4">
                          <button type="submit" name="add_customer" class=" samplewidth btn btn-primary btn-block">Submit</button>
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