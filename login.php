<?php
session_start();
$conn = mysqli_connect("localhost","root","","core_pos");
?>

<?php

if(isset($_POST['login'])){

$email = $_POST['email'];
$password = $_POST['password'];

$user_check = mysqli_query($conn,"SELECT * FROM users WHERE email = '$email'");

    if(mysqli_num_rows($user_check)>0){

    $row = mysqli_fetch_assoc($user_check);
    if($email == $row['email']){
        if(md5($password) === $row['password']){
            $_SESSION['email'] = $email;
            header("Location:index.php");
        }
        else{
            $password_wrong = "Wrong password";
        }
    }
}else{
    $email_error = "Email Wrong";
}






}


?>















<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <style>
 body {
    margin: 0;
    padding: 0;
    font-family: sans-serif;
    background-image: linear-gradient(to right, #b92b27, #1565c0)
}

.card{
    margin: 10px;
    border:none;
    position: relative;
}

.box {
    width: 500px;
    padding: 40px;
    position: absolute;
    top: 50%;
    left: 30%;
    background: black;
    text-align: center;
    transition: 0.25s;
    margin-top: 100px
}

.box input[type="text"],
.box input[type="password"] {
    border: 0;
    background: none;
    display: block;
    margin: 20px auto;
    text-align: center;
    border: 2px solid #3498db;
    padding: 10px 10px;
    width: 250px;
    outline: none;
    color: white;
    border-radius: 24px;
    transition: 0.25s
}

.box h1 {
    color: white;
    text-transform: uppercase;
    font-weight: 500
}

.box input[type="text"]:focus,
.box input[type="password"]:focus {
    width: 300px;
    border-color: #2ecc71
}

.box input[type="submit"] {
    border: 0;
    background: none;
    display: block;
    margin: 20px auto;
    text-align: center;
    border: 2px solid #2ecc71;
    padding: 14px 40px;
    outline: none;
    color: white;
    border-radius: 24px;
    transition: 0.25s;
    cursor: pointer
}

.box input[type="submit"]:hover {
    background: #2ecc71
}
.clr{
    color: white;
}

    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <form action="login.php" method="POST" class="box">
                        <h1>User Login</h1>
                        <input type="text" name="email" placeholder="Email" required>
                        <input type="password" name="password" placeholder="Password" required>
                        <input type="submit" name="login" value="Login">
                        <?php if(isset($email_error)){echo '<div class="clr alert alert-danger col-md-5">'.$email_error.'</div>';} ?>
                        <?php if(isset($password_wrong)){echo '<div class="clr alert alert-danger col-md-5">'.$password_wrong.'</div>';} ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>