<?php
    $conn = mysqli_connect("localhost", "root", "", "core_pos");

    // Check connection
    if (!$conn) {
        echo "Failed to connect to MySQL";
        exit();
    }
    $sql="SELECT p.measure_sale_id,p.id,m.measurement_name
            FROM products AS p
            INNER JOIN measurements AS m ON m.id=p.measure_sale_id
            WHERE p.id={$_POST["pid"]}";
        $res=$conn->query($sql);
        if($res->num_rows>0){
            $row=$res->fetch_assoc();
            echo $row["measurement_name"];
        }
        else{
            echo "0";
        }

    ?>