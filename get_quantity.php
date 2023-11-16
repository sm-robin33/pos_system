<?php
    $conn = mysqli_connect("localhost", "root", "", "core_pos");

    // Check connection
    if (!$conn) {
        echo "Failed to connect to MySQL";
        exit();
    }
    $sql="SELECT * FROM inventory WHERE product_id={$_POST["pid"]}";
        $res=$conn->query($sql);
        if($res->num_rows>0){
            $row=$res->fetch_assoc();
            echo $row["quantity"];
        }
        else{
            echo "0";
        }

    ?>