<?php
$conn = mysqli_connect("localhost", "root", "", "core_pos");

if (!$conn) {
    echo "Failed to connect to MySQL";
    exit();
}
//   else{
//     echo "Connection Success";
//   }

$query = "SELECT * FROM users";
$result = $conn->query($query);

$user_array = array();

        foreach($result as $users){
            array_push($user_array,strtolower($users['email']));
        }


if (isset($_POST['add_user'])) {

    $u_name = $_POST['name'];
    $u_phone = $_POST['phone'];
    $u_email = $_POST['email'];
    $u_password = md5($_POST['password']);
    $u_type = $_POST['type'];
    $u_status = $_POST['status'];

    if(!in_array(strtolower($u_email),$user_array)){
    $query = "INSERT INTO users (user_name,phone,email,password,user_type, status) VALUES ('$u_name', '$u_phone','$u_email','$u_password','$u_type','$u_status')";

    if ($conn->query($query)) {
        $_SESSION['status'] = "User Created";
        header("Location:index.php?page=user_list");
    } else {
        $_SESSION['status'] = "Creation Failed";
        header("Location:index.php?page=add_user");
    }
}else{
          $_SESSION['status'] = "User already exist";
          header("Location:index.php?page=add_user");
          exit;
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
                    <span>Create New User</span>
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
                                            <a href="index.php?page=user_list" class="btn btn-success float-right">List of Users</a>
                                        </div>
                                    </div>
                                </div>
                                <form action="" method="post">

                                    <div class="form-row">
                                        <div class="row">
                                            <div class="col-md-1 mt-1"></div>
                                            <div class="col-md-4 mt-1">
                                                <label for="full_name" class="col-form-label">Full name:</label>
                                                <input type="text" name="name" placeholder="Full Name" required class="form-control">

                                            </div>
                                            <div class="col-md-2"></div>
                                            <div class="col-md-4">
                                                <label for="phone_no" class="col-form-label">Phone No:</label>

                                                <input type="number" name="phone" placeholder="Phone No" class="form-control " required>

                                            </div>
                                            <div class="col-md-1"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-1 mt-4"></div>
                                            <div class="col-md-4 mt-3">
                                                <label for="email" class="col-form-label">Email:</label>
                                                <input type="email" name="email" placeholder="Email" class="form-control " required>

                                            </div>
                                            <div class="col-md-2 mt-4"></div>
                                            <div class="col-md-4 mt-3">
                                                <label for="password" class="col-form-label">Password:</label>
                                                <input type="password" name="password" placeholder="Password" class="form-control" required>

                                            </div>
                                            <div class="col-md-1 mt-4"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-1 mt-4"></div>

                                            <div class="col-md-4 mt-4">
                                                <label>Type:</label>
                                                <select name="type" required id="text" class="form-control text-capitalize">
                                                    <option value="" selected class="text-capitalize">Choose User Type</option>
                                                    
                                                        <option value="Admin" class="text-capitalize">Admin</option>
                                                        <option value="Cashier" class="text-capitalize">Cashier</option>
                                                    
                                                </select>
                                            </div>

                                            <div class="col-md-2 mt-4"></div>
                                            <div class="col-md-4 mt-3">
                                                <label for="status" class="col-form-label">Status:</label>
                                                <select name="status" required class="form-control">
                                                    <option value="">Choose a Status</option>

                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>

                                                </select>
                                            </div>
                                            <div class="col-md-1 mt-4"></div>
                                        </div>

                                        <div class="row mt-5 ">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <button type="submit" name="add_user" class="samplewidth btn btn-primary">Create</button>
                                        </div>
                                        <div class="col-md-4"></div>
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