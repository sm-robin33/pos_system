<?php
$conn = mysqli_connect("localhost", "root", "", "core_pos");
if (!$conn) {
    echo "Failed to connect to MySQL";
    exit();
}
?>

<?php
$user_id = $_GET['id'];

$query = "SELECT * FROM users WHERE id='$user_id'";
$result = $conn->query($query);
$row = mysqli_fetch_array($result);


if (isset($_POST['edit_user'])) {
    $u_name = $_POST['name'];
    $u_phone = $_POST['phone'];
    $u_email = $_POST['email'];
    $u_type = $_POST['type'];
    $u_status = $_POST['status'];
    if (!empty($_POST['password'])) {
        $u_password = md5($_POST['password']);
        $query = "UPDATE users SET user_name = '{$u_name}',phone = '{$u_phone}',email = '{$u_email}',password='{$u_password}',user_type='{$u_type}',status='{$u_status}'  WHERE id = $user_id ";
        if ($conn->query($query)) {
            $_SESSION['status'] = "User Updated";
            header("Location:index.php?page=user_list");
        } else {
            $_SESSION['status'] = "Update Failed";
            header("Location:index.php?page=edit_user");
        }
    }
    else{
        $query = "UPDATE users SET user_name = '{$u_name}',phone = '{$u_phone}',email = '{$u_email}',user_type='{$u_type}',status='{$u_status}'  WHERE id = $user_id ";
        if ($conn->query($query)) {
            $_SESSION['status'] = "User Updated";
            header("Location:index.php?page=user_list");
        } else {
            $_SESSION['status'] = "Update Failed";
            header("Location:index.php?page=edit_user");
        }
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
                    <span>Update Supplier</span>
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
                                            <a href="index.php?page=supplier_list" class="btn btn-success float-right">List of Suppliers</a>
                                        </div>
                                    </div>
                                </div>
                                <form action="" method="post">
                                    <div class="form-row">
                                        <div class="row">
                                            <div class="col-md-1 mt-1"></div>
                                            <div class="col-md-4 mt-1">
                                                <label for="full_name" class="col-form-label">Full name:</label>
                                                <input type="text" name="name" placeholder="Full Name" required class="form-control" value="<?= $row['user_name']; ?>">

                                            </div>
                                            <div class="col-md-2"></div>
                                            <div class="col-md-4">
                                                <label for="phone_no" class="col-form-label">Phone No:</label>

                                                <input type="number" name="phone" placeholder="Phone No" class="form-control " required value="<?= $row['phone']; ?>">

                                            </div>
                                            <div class="col-md-1"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-1 mt-4"></div>
                                            <div class="col-md-4 mt-4">
                                                <label for="email" class="col-form-label">Email:</label>
                                                <input type="email" name="email" placeholder="Email" class="form-control " required value="<?= $row['email']; ?>">

                                            </div>
                                            <div class="col-md-2 mt-4"></div>
                                            <div class="col-md-4 mt-4">
                                                <label for="password" class="col-form-label">Password:</label>
                                                <input type="password" name="password" placeholder="Password" class="form-control">

                                            </div>
                                            <div class="col-md-1 mt-4"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-1 mt-4"></div>

                                            <div class="col-md-4 mt-4">
                                                <label>Type:</label>
                                                <select name="type" required id="text" class="form-control text-capitalize">
                                                    <option value="" class="text-capitalize">Choose User Type</option>

                                                    <option value="<?php echo $row['user_type'] ?>" <?php if ($row['user_type'] === 'Admin') : echo "selected";
                                                                                                    endif; ?> class="text-capitalize">Admin</option>
                                                    <option value="<?php echo $row['user_type'] ?>" <?php if ($row['user_type'] === 'Cashier') : echo "selected";
                                                                                                    endif; ?> class="text-capitalize">Cashier</option>
                                                </select>
                                            </div>

                                            <div class="col-md-2 mt-4"></div>
                                            <div class="col-md-4 mt-4">
                                                <label for="status" class="col-form-label">Status:</label>
                                                <select name="status" required class="form-control">
                                                    <option value="">Choose a Status</option>

                                                    <option value="Active" <?php if ($row['status'] == 'Active') : echo "selected";
                                                                            endif; ?>>Active</option>
                                                    <option value="Inactive" <?php if ($row['status'] == 'Inactive') : echo "selected";
                                                                                endif; ?>>Inactive</option>

                                                </select>
                                            </div>
                                            <div class="col-md-1 mt-4"></div>
                                        </div>

                                        <div class="row mt-5 ">
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4">
                                                <button type="submit" name="edit_user" class="samplewidth btn btn-primary">Update</button>
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