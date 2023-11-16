<?php
$conn = mysqli_connect("localhost", "root", "", "core_pos");
if (!$conn) {
    echo "Failed to connect to MySQL";
    exit();
}

$output = '';

// This part for User Search.....Start
if (isset($_POST['user'])) {
    $search = $_POST['user'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_name LIKE '%$search%'");
    


$stmt->execute();
$result = $stmt->get_result();
$n = 1;
if ($result->num_rows > 0) {
    $output = "<thead>
                    <tr>
                    <th class='text-center' style='width: 50px;'>#</th>
                    <th class='text-center'> User Name</th>
                    <th class='text-center'> Phone</th>
                    <th class='text-center'> Email</th>
                    <th class='text-center'> User Type</th>
                    <th class='text-center'> Created At </th>
                    <th class='text-center'> Updated At </th>
                    <th class='text-center'> Status</th>
                    <th class='text-center' style='width: 100px;'> Actions </th>
                    </tr>
                </thead>
                <tbody>";
    while ($row = $result->fetch_assoc()) {
        $output .= "<tr>
                    <td class='text-center'>" . $n++ . "</td>
                    <td class='text-center'>" . $row['user_name'] . "</td>
                    <td class='text-center'>" . $row['phone'] . "</td>
                    <td class='text-center'>" . $row['email'] . "</td>
                    <td class='text-center'>" . $row['user_type'] . "</td>
                    <td class='text-center'>" . $row['created_at'] . "</td>
                    <td class='text-center'>" . $row['updated_at'] . "</td>
                    <td class='text-center'>" . $row['status'] . "</td>
                    <td class='text-center'>
                  <div class='btn-group'>
                    <a href='index.php?page=edit_user&id=" . $row['id'] . "' class='btn btn-info btn-xs'  title='Edit' data-toggle='tooltip'>
                      <span ><i class='fa fa-pencil-square-o' aria-hidden='true'></i></span>
                    </a>
                    <a href='index.php?page=delete_user&id=" . $row['id'] . "' class='btn btn-danger btn-xs'  title='Delete' data-toggle='tooltip'>
                      <span><i class='fa fa-trash-o' aria-hidden='true'></i></span>
                    </a>
                  </div>
                </td>
                  </tr>";
    }
    $output .= "</tbody>";
    echo $output;
} else {
  echo '<img class="rounded mx-auto d-block" src="images/data_not_found.jpg" alt="">';
}

}

// This part for User Search.....end

// This part for Brand Search.....Start

if (isset($_POST['brand'])) {
  $search = $_POST['brand'];
  $stmt = $conn->prepare("SELECT * FROM brands WHERE brand_name LIKE '%$search%'");
  

$stmt->execute();
$result = $stmt->get_result();
$n = 1;
if ($result->num_rows > 0) {
  $output = "<thead>
                  <tr>
                      <th class='text-center' style='width: 50px;'>#</th>
                      <th class='text-center'> Brand Name</th>
                      <th class='text-center'> Created At </th>
                      <th class='text-center'> Updated At </th>
                      <th class='text-center' style='width: 100px;'> Actions </th>
                  </tr>
              </thead>
              <tbody>";
  while ($row = $result->fetch_assoc()) {
      $output .= "<tr>
                  <td class='text-center'>" . $n++ . "</td>
                  <td class='text-center'>" . $row['brand_name'] . "</td>
                  <td class='text-center'>" . $row['created_at'] . "</td>
                  <td class='text-center'>" . $row['updated_at'] . "</td>
                  <td class='text-center'>
                <div class='btn-group'>
                  <a href='index.php?page=edit_brand&id=" . $row['id'] . "' class='btn btn-info btn-xs'  title='Edit' data-toggle='tooltip'>
                    <span ><i class='fa fa-pencil-square-o' aria-hidden='true'></i></span>
                  </a>
                  <a href='index.php?page=delete_brand&id=" . $row['id'] . "' class='btn btn-danger btn-xs'  title='Delete' data-toggle='tooltip'>
                    <span><i class='fa fa-trash-o' aria-hidden='true'></i></span>
                  </a>
                </div>
              </td>
                </tr>";
  }
  $output .= "</tbody>";
  echo $output;
} else {
  echo '<img class="rounded mx-auto d-block" src="images/data_not_found.jpg" alt="">';
}
}
// This part for Brand Search.....end


// This part for Measurement Search.....start

if (isset($_POST['measurement'])) {
  $search = $_POST['measurement'];
  $stmt = $conn->prepare("SELECT * FROM measurements WHERE measurement_name LIKE '%$search%'");
  

$stmt->execute();
$result = $stmt->get_result();
$n = 1;
if ($result->num_rows > 0) {
  $output = "<thead>
                  <tr>
                  <th class='text-center' style='width: 50px;'>#</th>
                  <th class='text-center'> Measurement Name</th>
                  <th class='text-center'> Created At </th>
                  <th class='text-center'> Updated At </th>
                  <th class='text-center'> Status</th>
                  <th class='text-center' style='width: 100px;'> Actions </th>
                  </tr>
              </thead>
              <tbody>";
  while ($row = $result->fetch_assoc()) {
      $output .= "<tr>
                  <td class='text-center'>" . $n++ . "</td>
                  <td class='text-center'>" . $row['measurement_name'] . "</td>
                  <td class='text-center'>" . $row['created_at'] . "</td>
                  <td class='text-center'>" . $row['updated_at'] . "</td>
                  <td class='text-center'>" . $row['status'] . "</td>
                  <td class='text-center'>
                <div class='btn-group'>
                  <a href='index.php?page=edit_measurement&id=" . $row['id'] . "' class='btn btn-info btn-xs'  title='Edit' data-toggle='tooltip'>
                    <span ><i class='fa fa-pencil-square-o' aria-hidden='true'></i></span>
                  </a>
                  <a href='index.php?page=delete_measurement&id=" . $row['id'] . "' class='btn btn-danger btn-xs'  title='Delete' data-toggle='tooltip'>
                    <span><i class='fa fa-trash-o' aria-hidden='true'></i></span>
                  </a>
                </div>
              </td>
                </tr>";
  }
  $output .= "</tbody>";
  echo $output;
} else {
  echo '<img class="rounded mx-auto d-block" src="images/data_not_found.jpg" alt="">';
}
}
// This part for Measurement Search.....end

// This part for Customer Search.....Start

if (isset($_POST['customer'])) {
  $search = $_POST['customer'];
  $stmt = $conn->prepare("SELECT * FROM customers WHERE name LIKE '%$search%'");
  

$stmt->execute();
$result = $stmt->get_result();
$n = 1;
if ($result->num_rows > 0) {
  $output = "<thead>
                  <tr>
                  <th class='text-center' style='width: 50px;'>#</th>
                  <th class='text-center'> Name</th>
                  <th class='text-center'> Phone</th>
                  <th class='text-center'>  Email</th>
                  <th class='text-center'> Address</th>
                  <th class='text-center'> Gender</th>
                  <th class='text-center'> Created At </th>
                  <th class='text-center'> Updated At </th>
                  <th class='text-center'> Status</th>
                  <th class='text-center' style='width: 100px;'> Actions </th>
                  </tr>
              </thead>
              <tbody>";
  while ($row = $result->fetch_assoc()) {
      $output .= "<tr>
                  <td class='text-center'>" . $n++ . "</td>
                  <td class='text-center'>" . $row['name'] . "</td>
                  <td class='text-center'>" . $row['phone'] . "</td>
                  <td class='text-center'>" . $row['email'] . "</td>
                  <td class='text-center'>" . $row['address'] . "</td>
                  <td class='text-center'>" . $row['gender'] . "</td>
                  <td class='text-center'>" . $row['created_at'] . "</td>
                  <td class='text-center'>" . $row['updated_at'] . "</td>
                  <td class='text-center'>" . $row['status'] . "</td>
                  <td class='text-center'>
                <div class='btn-group'>
                  <a href='index.php?page=edit_customer&id=" . $row['id'] . "' class='btn btn-info btn-xs'  title='Edit' data-toggle='tooltip'>
                    <span ><i class='fa fa-pencil-square-o' aria-hidden='true'></i></span>
                  </a>
                  <a href='index.php?page=delete_customer&id=" . $row['id'] . "' class='btn btn-danger btn-xs'  title='Delete' data-toggle='tooltip'>
                    <span><i class='fa fa-trash-o' aria-hidden='true'></i></span>
                  </a>
                </div>
              </td>
                </tr>";
  }
  $output .= "</tbody>";
  echo $output;
} else {
  echo '<img class="rounded mx-auto d-block" src="images/data_not_found.jpg" alt="">';
}
}
// This part for Customer Search.....end

// This part for Product Search.....start

if (isset($_POST['product'])) {
  $search = $_POST['product'];
  $stmt = $conn->prepare("SELECT p.name, p.id, p.brand_id, p.barcode, p.category_id, p.subcategory_id, p.product_image, p.measure_purchase_id, p.measure_sale_id, p.status, b.brand_name, c.category_name, s.sub_category_name, p.created_at, p.updated_at, m1.measurement_name AS purchase_measurement, m2.measurement_name 
  AS sale_measurement FROM products AS p INNER JOIN brands AS b ON p.brand_id = b.id INNER JOIN category AS c ON p.category_id = c.id 
  INNER JOIN sub_category AS s ON p.subcategory_id = s.id INNER JOIN measurements AS m1 ON p.measure_purchase_id = m1.id INNER JOIN measurements AS m2 ON p.measure_sale_id = m2.id WHERE name LIKE '%$search%'");
  
$stmt->execute();
$result = $stmt->get_result();
$n = 1;
if ($result->num_rows > 0) {
  $output = "<thead>
                  <tr>
                    <th class='text-center' style='width: 50px;'>#</th>
                    <th class='text-center'> Name</th>
                    <th class='text-center'> Brand Name</th>
                    <th class='text-center'> Barcode</th>
                    <th class='text-center'>  Category Name</th>
                    <th class='text-center'> Sub Category Name</th>
                    <th class='text-center'> Product Image</th>
                    <th class='text-center'>Purchase Measurement</th>
                    <th class='text-center'>Sell Measurement</th>
                    <th class='text-center'> Created At </th>
                    <th class='text-center'> Updated At </th>
                    <th class='text-center'> Status</th>
                    <th class='text-center' style='width: 100px;'> Actions </th>
                  </tr>
              </thead>
              <tbody>";
  while ($row = $result->fetch_assoc()) {
    $output .= "<tr>
    <td class='text-center'>" . $n++ . "</td>
    <td class='text-center'>" . $row['name'] . "</td>
    <td class='text-center'>" . $row['brand_name'] . "</td>
    <td class='text-center'>" . $row['barcode'] . "</td>
    <td class='text-center'>" . $row['category_name'] . "</td>
    <td class='text-center'>" . $row['sub_category_name'] . "</td>
    <td >";
    $imagePath = 'images/' . $row['product_image'];
    if (file_exists($imagePath)) {
      $output .= '<img width="100px" height="100px" src="' . $imagePath . '" alt="" />';
    } else {
      $output .= 'Image not found';
    }
    $output .= "</td>
    <td >" . $row['purchase_measurement'] . "</td>
    <td >" . $row['sale_measurement'] . "</td>
    <td >" . $row['created_at'] . "</td>
    <td >" . $row['updated_at'] . "</td>
    <td >" . $row['status'] . "</td>
    <td class='text-center'>
      <div class='btn-group'>
        <a href='index.php?page=edit_product&id=" . $row['id'] . "' class='btn btn-info btn-xs' title='Edit' data-toggle='tooltip'>
          <span ><i class='fa fa-pencil-square-o' aria-hidden='true'></i></span>
        </a>
        <a href='index.php?page=delete_product&id=" . $row['id'] . "' class='btn btn-danger btn-xs' title='Delete' data-toggle='tooltip'>
          <span><i class='fa fa-trash-o' aria-hidden='true'></i></span>
        </a>
      </div>
    </td>
  </tr>";
  }
  $output .= "</tbody>";
  echo $output;
} else {
  echo '<img class="rounded mx-auto d-block" src="images/data_not_found.jpg" alt="">';
}
}
// This part for Product Search.....end

// This part for product prices Search.....Start

if (isset($_POST['product_price'])) {
  $search = $_POST['product_price'];
  $stmt = $conn->prepare("SELECT pp.product_id,pp.id,pp.product_price,pp.created_at,pp.updated_at,p.name
  FROM product_price AS pp
  INNER JOIN products AS p ON pp.product_id = p.id WHERE name LIKE '%$search%'");
  

$stmt->execute();
$result = $stmt->get_result();
$n = 1;
if ($result->num_rows > 0) {
  $output = "<thead>
                  <tr>
                  <th class='text-center' style='width: 50px;'>#</th>
                  <th class='text-center'> Product Name</th>
                  <th class='text-center'> Product Price</th>
                  <th class='text-center'> Created At </th>
                  <th class='text-center'> Updated At </th>
                  <th class='text-center' style='width: 100px;'> Actions </th>
                  </tr>
              </thead>
              <tbody>";
  while ($row = $result->fetch_assoc()) {
      $output .= "<tr>
                  <td class='text-center'>" . $n++ . "</td>
                  <td class='text-center'>" . $row['name'] . "</td>
                  <td class='text-center'>" . $row['product_price'] . "</td>
                  <td class='text-center'>" . $row['created_at'] . "</td>
                  <td class='text-center'>" . $row['updated_at'] . "</td>
                  <td class='text-center'>
                <div class='btn-group'>
                  <a href='index.php?page=edit_product_price&id=" . $row['id'] . "' class='btn btn-info btn-xs'  title='Edit' data-toggle='tooltip'>
                    <span ><i class='fa fa-pencil-square-o' aria-hidden='true'></i></span>
                  </a>
                  <a href='index.php?page=delete_product_price&id=" . $row['id'] . "' class='btn btn-danger btn-xs'  title='Delete' data-toggle='tooltip'>
                    <span><i class='fa fa-trash-o' aria-hidden='true'></i></span>
                  </a>
                </div>
              </td>
                </tr>";
  }
  $output .= "</tbody>";
  echo $output;
} else {
  echo '<img class="rounded mx-auto d-block" src="images/data_not_found.jpg" alt="">';
}
}
// This part for product prices Search.....end

// This part for category Search.....Start

if (isset($_POST['category'])) {
  $search = $_POST['category'];
  $stmt = $conn->prepare("SELECT * FROM category WHERE category_name LIKE '%$search%'");
  

$stmt->execute();
$result = $stmt->get_result();
$n = 1;
if ($result->num_rows > 0) {
  $output = "<thead>
                  <tr>
                  <th class='text-center' style='width: 50px;'>#</th>
                  <th class='text-center'> Category Name</th>
                  <th class='text-center'> Created At </th>
                  <th class='text-center'> Updated At </th>
                  <th class='text-center' style='width: 100px;'> Actions </th>
                  </tr>
              </thead>
              <tbody>";
  while ($row = $result->fetch_assoc()) {
      $output .= "<tr>
                  <td class='text-center'>" . $n++ . "</td>
                  <td class='text-center'>" . $row['category_name'] . "</td>
                  <td class='text-center'>" . $row['created_at'] . "</td>
                  <td class='text-center'>" . $row['updated_at'] . "</td>
                  <td class='text-center'>
                <div class='btn-group'>
                  <a href='index.php?page=edit_category&id=" . $row['id'] . "' class='btn btn-info btn-xs'  title='Edit' data-toggle='tooltip'>
                    <span ><i class='fa fa-pencil-square-o' aria-hidden='true'></i></span>
                  </a>
                  <a href='index.php?page=delete_category&id=" . $row['id'] . "' class='btn btn-danger btn-xs'  title='Delete' data-toggle='tooltip'>
                    <span><i class='fa fa-trash-o' aria-hidden='true'></i></span>
                  </a>
                </div>
              </td>
                </tr>";
  }
  $output .= "</tbody>";
  echo $output;
} else {
  echo '<img class="rounded mx-auto d-block" src="images/data_not_found.jpg" alt="">';
}
}
// This part for category Search.....end

// This part for sub category Search.....Start

if (isset($_POST['sub_category'])) {
  $search = $_POST['sub_category'];
  $stmt = $conn->prepare("SELECT s.id,s.sub_category_name, s.category_id,s.created_at,s.updated_at, c.category_name
  FROM sub_category AS s
  INNER JOIN category AS c ON s.category_id = c.id WHERE sub_category_name LIKE '%$search%'");
  

$stmt->execute();
$result = $stmt->get_result();
$n = 1;
if ($result->num_rows > 0) {
  $output = "<thead>
                  <tr>
                  <th class='text-center' style='width: 50px;'>#</th>
                  <th class='text-center'> Sub-Category Name</th>
                  <th class='text-center'> Category Name</th>
                  <th class='text-center'> Created At </th>
                  <th class='text-center'> Updated At </th>
                  <th class='text-center' style='width: 100px;'> Actions </th>
                  </tr>
              </thead>
              <tbody>";
  while ($row = $result->fetch_assoc()) {
      $output .= "<tr>
                  <td class='text-center' style='width: 50px;'>" . $n++ . "</td>
                  <td class='text-center'>" . $row['sub_category_name'] . "</td>
                  <td class='text-center'>" . $row['category_name'] . "</td>
                  <td class='text-center'>" . $row['created_at'] . "</td>
                  <td class='text-center'>" . $row['updated_at'] . "</td>
                  <td class='text-center'>
                <div class='btn-group'>
                  <a href='index.php?page=edit_subcategory&id=" . $row['id'] . "' class='btn btn-info btn-xs'  title='Edit' data-toggle='tooltip'>
                    <span ><i class='fa fa-pencil-square-o' aria-hidden='true'></i></span>
                  </a>
                  <a href='index.php?page=delete_subcategory&id=" . $row['id'] . "' class='btn btn-danger btn-xs'  title='Delete' data-toggle='tooltip'>
                    <span><i class='fa fa-trash-o' aria-hidden='true'></i></span>
                  </a>
                </div>
              </td>
                </tr>";
  }
  $output .= "</tbody>";
  echo $output;
} else {
  echo '<img class="rounded mx-auto d-block" src="images/data_not_found.jpg" alt="">';
}
}
// This part for sub category Search.....end

// This part for supplier Search.....Start

if (isset($_POST['supplier'])) {
  $search = $_POST['supplier'];
  $stmt = $conn->prepare("SELECT s.id,s.supplier_name, s.phone,s.email,s.address,s.brand_id,s.status,s.created_at,s.updated_at, b.brand_name
  FROM supplier AS s
  INNER JOIN brands AS b ON s.brand_id = b.id WHERE supplier_name LIKE '%$search%'");
  

$stmt->execute();
$result = $stmt->get_result();
$n = 1;
if ($result->num_rows > 0) {
  $output = "<thead>
                  <tr>
                    <th class='text-center' style='width: 50px;'>#</th>
                    <th class='text-center'> Supplier Name</th>
                    <th class='text-center'> Phone</th>
                    <th class='text-center'> Email</th>
                    <th class='text-center'> Address</th>
                    <th class='text-center'> Brand Name</th>
                    <th class='text-center'> Created At </th>
                    <th class='text-center'> Updated At </th>
                    <th class='text-center'> Status</th>
                    <th class='text-center' style='width: 100px;'> Actions </th>
                  </tr>
              </thead>
              <tbody>";
  while ($row = $result->fetch_assoc()) {
      $output .= "<tr>
                  <td class='text-center' style='width: 50px;'>" . $n++ . "</td>
                  <td class='text-center'>" . $row['supplier_name'] . "</td>
                  <td class='text-center'>" . $row['phone'] . "</td>
                  <td class='text-center'>" . $row['email'] . "</td>
                  <td class='text-center'>" . $row['address'] . "</td>
                  <td class='text-center'>" . $row['brand_name'] . "</td>
                  <td class='text-center'>" . $row['created_at'] . "</td>
                  <td class='text-center'>" . $row['updated_at'] . "</td>
                  <td class='text-center'>" . $row['status'] . "</td>
                  <td class='text-center'>
                <div class='btn-group'>
                  <a href='index.php?page=edit_supplier&id=" . $row['id'] . "' class='btn btn-info btn-xs'  title='Edit' data-toggle='tooltip'>
                    <span ><i class='fa fa-pencil-square-o' aria-hidden='true'></i></span>
                  </a>
                  <a href='index.php?page=delete_supplier&id=" . $row['id'] . "' class='btn btn-danger btn-xs'  title='Delete' data-toggle='tooltip'>
                    <span><i class='fa fa-trash-o' aria-hidden='true'></i></span>
                  </a>
                </div>
              </td>
                </tr>";
  }
  $output .= "</tbody>";
  echo $output;
} else {
  echo '<img class="rounded mx-auto d-block" src="images/data_not_found.jpg" alt="">';
}
}
// This part for supplier Search.....end


// This part for store Search.....Start

if (isset($_POST['store'])) {
  $search = $_POST['store'];
  $stmt = $conn->prepare("SELECT * FROM store WHERE store_name LIKE '%$search%'");
  

$stmt->execute();
$result = $stmt->get_result();
$n = 1;
if ($result->num_rows > 0) {
  $output = "<thead>
                  <tr>
                    <th class='text-center' style='width: 50px;'>#</th>
                    <th class='text-center'> Store Name</th>
                    <th class='text-center'> Status</th>
                    <th class='text-center'> Created At </th>
                    <th class='text-center'> Updated At </th>
                    <th class='text-center' style='width: 100px;'> Actions </th>
                  </tr>
              </thead>
              <tbody>";
  while ($row = $result->fetch_assoc()) {
      $output .= "<tr>
                  <td class='text-center' style='width: 50px;'>" . $n++ . "</td>
                  <td class='text-center'>" . $row['store_name'] . "</td>
                  <td class='text-center'>" . $row['status'] . "</td>
                  <td class='text-center'>" . $row['created_at'] . "</td>
                  <td class='text-center'>" . $row['updated_at'] . "</td>
                  <td class='text-center'>
                <div class='btn-group'>
                  <a href='index.php?page=edit_store&id=" . $row['id'] . "' class='btn btn-info btn-xs'  title='Edit' data-toggle='tooltip'>
                    <span ><i class='fa fa-pencil-square-o' aria-hidden='true'></i></span>
                  </a>
                  <a href='index.php?page=delete_store&id=" . $row['id'] . "' class='btn btn-danger btn-xs'  title='Delete' data-toggle='tooltip'>
                    <span><i class='fa fa-trash-o' aria-hidden='true'></i></span>
                  </a>
                </div>
              </td>
                </tr>";
  }
  $output .= "</tbody>";
  echo $output;
} else {
  echo '<img class="rounded mx-auto d-block" src="images/data_not_found.jpg" alt="">';
}
}
// This part for store Search.....end

// This part for inventory Search.....Start

if (isset($_POST['inventory'])) {
  $search = $_POST['inventory'];
  $stmt = $conn->prepare("SELECT i.id,i.product_id,P.category_id,P.brand_id,i.quantity,i.store_id,i.status,i.created_at,i.updated_at,p.name,c.category_name,b.brand_name,s.store_name
  FROM inventory AS i
  INNER JOIN products AS p ON p.id = i.product_id
  INNER JOIN category AS c ON c.id = P.category_id
  INNER JOIN brands AS b ON b.id = P.brand_id
  INNER JOIN store AS s ON s.id = i.store_id WHERE name LIKE '%$search%'");
  

$stmt->execute();
$result = $stmt->get_result();
$n = 1;
if ($result->num_rows > 0) {
  $output = "<thead>
                  <tr>
                    <th class='text-center' style='width: 50px;'>#</th>
                    <th class='text-center'> Product Name</th>
                    <th class='text-center'> Category</th>
                    <th class='text-center'> Brand</th>
                    <th class='text-center'> Quantity</th>
                    <th class='text-center'> Store Name</th>
                    <th class='text-center'> Status</th>
                    <th class='text-center'> Created At </th>
                    <th class='text-center'> Updated At </th>
                    <th class='text-center' style='width: 100px;'> Actions </th>
                  </tr>
              </thead>
              <tbody>";
  while ($row = $result->fetch_assoc()) {
      $output .= "<tr>
                  <td class='text-center' style='width: 50px;'>" . $n++ . "</td>
                  <td class='text-center'>" . $row['name'] . "</td>
                  <td class='text-center'>" . $row['category_name'] . "</td>
                  <td class='text-center'>" . $row['brand_name'] . "</td>
                  <td class='text-center'>" . $row['quantity'] . "</td>
                  <td class='text-center'>" . $row['store_name'] . "</td>
                  <td class='text-center'>" . $row['status'] . "</td>
                  <td class='text-center'>" . $row['created_at'] . "</td>
                  <td class='text-center'>" . $row['updated_at'] . "</td>
                  <td class='text-center'>
                <div class='btn-group'>
                  <a href='index.php?page=edit_inventory&id=" . $row['id'] . "' class='btn btn-info btn-xs'  title='Edit' data-toggle='tooltip'>
                    <span ><i class='fa fa-pencil-square-o' aria-hidden='true'></i></span>
                  </a>
                  <a href='index.php?page=delete_inventory&id=" . $row['id'] . "' class='btn btn-danger btn-xs'  title='Delete' data-toggle='tooltip'>
                    <span><i class='fa fa-trash-o' aria-hidden='true'></i></span>
                  </a>
                </div>
              </td>
                </tr>";
  }
  $output .= "</tbody>";
  echo $output;
} else {
  echo '<img class="rounded mx-auto d-block" src="images/data_not_found.jpg" alt="">';
}
}
// This part for inventory Search.....end

// This part for purchase Search.....Start

if (isset($_POST['purchase'])) {
  $search = $_POST['purchase'];
  $stmt = $conn->prepare("SELECT p.id,p.supplier_name,p.parchase_date,p.referance,p.total_amount,p.created_at,p.updated_at,s.supplier_name, s.id
  FROM parchase AS p
  INNER JOIN supplier AS s ON p.supplier_name = s.id WHERE CONCAT(s.supplier_name,referance) LIKE '%$search%'");

$multi_join = "SELECT ps.id AS purchase_id, ps.supplier_id,ps.product_name,ps.quantity,ps.referance,ps.unit_price,ps.sub_total_price,p.supplier_name,pd.name
FROM parchase_details AS ps
INNER JOIN parchase AS p ON p.supplier_name = ps.supplier_id and ps.referance = p.referance
INNER JOIN products AS pd ON pd.id = ps.product_name ";

$join_data = $conn->query($multi_join);
  

$stmt->execute();
$result = $stmt->get_result();
$n = 1;
if ($result->num_rows > 0) {
  $output = "<thead>
                  <tr>
                    <th class='text-center' style='width: 50px;'>#</th>
                    <th class='text-center'> Supplier Name</th>
                    <th class='text-center'> Purchase Date</th>
                    <th class='text-center'> Reference No</th>
                    <th class='text-center'> Product Name</th>
                    <th class='text-center'> Product Quantity</th>
                    <th class='text-center'> Unit Price</th>
                    <th class='text-center'> Sub Total Price</th>
                    <th class='text-center'> Total Price</th>
                    <th class='text-center'> Created At </th>
                    <th class='text-center'> Updated At </th>
                    <th class='text-center' style='width: 100px;'> Actions </th>
                  </tr>
              </thead>
              <tbody>";
  while ($row = $result->fetch_assoc()) {
      $output .= "<tr>
                  <td class='text-center' style='width: 50px;'>" . $n++ . "</td>
                  <td class='text-center'>" . $row['supplier_name'] . "</td>
                  <td class='text-center'>" . $row['parchase_date'] . "</td>
                  <td class='text-center'>" . $row['referance'] . "</td>
                  <td class='text-center'>
                      <table class='table table-bordered'>";
      
      $productTable = '';
      foreach ($join_data as $product) {
        if ($row['referance'] === $product['referance']) {
          $productTable .= "<tr><td>" . $product['name'] . "</td></tr>";
        }
      }

      $output .= $productTable . "</table></td>";
      
      $output .= "<td class='text-center'>
                      <table class='table table-bordered'>";
      
      $quantityTable = '';
      foreach ($join_data as $product) {
        if ($row['referance'] === $product['referance']) {
          $quantityTable .= "<tr><td>" . $product['quantity'] . "</td></tr>";
        }
      }

      $output .= $quantityTable . "</table></td>";
      
      $output .= "<td class='text-center'>
                      <table class='table table-bordered'>";
      
      $unitPriceTable = '';
      foreach ($join_data as $product) {
        if ($row['referance'] === $product['referance']) {
          $unitPriceTable .= "<tr><td>" . $product['unit_price'] . "</td></tr>";
        }
      }

      $output .= $unitPriceTable . "</table></td>";
      
      $output .= "<td class='text-center'>
                      <table class='table table-bordered'>";
      
      $subTotalPriceTable = '';
      foreach ($join_data as $product) {
        if ($row['referance'] === $product['referance']) {
          $subTotalPriceTable .= "<tr><td>" . $product['sub_total_price'] . "</td></tr>";
        }
      }

      $output .= $subTotalPriceTable . "</table></td>
                  <td class='text-center'>" . $row['total_amount'] . "</td>
                  <td class='text-center'>" . $row['created_at'] . "</td>
                  <td class='text-center'>" . $row['updated_at'] . "</td>
                  <td class='text-center'>
                <div class='btn-group'>
                  <a href='index.php?page=edit_purchase&referance=" . $row['referance'] . "' class='btn btn-info btn-xs'  title='Edit' data-toggle='tooltip'>
                    <span ><i class='fa fa-pencil-square-o' aria-hidden='true'></i></span>
                  </a>
                  <a href='index.php?page=delete_purchase&referance=" . $row['referance'] . "' class='btn btn-danger btn-xs'  title='Delete' data-toggle='tooltip'>
                    <span><i class='fa fa-trash-o' aria-hidden='true'></i></span>
                  </a>
                </div>
              </td>
                </tr>";
  }
  $output .= "</tbody>";
  echo $output;
} else {
  echo '<img class="rounded mx-auto d-block" src="images/data_not_found.jpg" alt="">';
}
}
// This part for purchase Search.....end

// This part for invoice Search.....Start

if (isset($_POST['invoice'])) {
  $search = $_POST['invoice'];
  $stmt = $conn->prepare("SELECT i.id,i.customer_name,i.invoice_date,i.invoice_no,i.total_value,i.created_at,i.updated_at,c.name, c.id
  FROM invoice AS i
  INNER JOIN customers AS c ON i.customer_name = c.id WHERE CONCAT(c.name,i.invoice_no) LIKE '%$search%'");

  $multi_join = "SELECT idd.id AS invoice_det_id, idd.customer_id, idd.product_id, idd.unit_id, idd.price, idd.quantity, idd.value, idd.invoice_no, pd.id AS product_id, pd.name
  FROM invoice_details AS idd
  INNER JOIN invoice AS iv ON iv.invoice_no = idd.invoice_no
  INNER JOIN products AS pd ON pd.id = idd.product_id
  WHERE iv.customer_name = idd.customer_id";

  $join_data = $conn->query($multi_join);
  

$stmt->execute();
$result = $stmt->get_result();
$n = 1;
if ($result->num_rows > 0) {
  $output = "<thead>
                  <tr>
                    <th class='text-center' style='width: 50px;'>#</th>
                    <th class='text-center'> Customer Name</th>
                    <th class='text-center'> Invoice Date</th>
                    <th class='text-center'> Invoice No</th>
                    <th class='text-center'> Product Name</th>
                    <th class='text-center'> Unit</th>
                    <th class='text-center'> Unit Price</th>
                    <th class='text-center'> Quantity</th>
                    <th class='text-center'> Value</th>
                    <th class='text-center'> Total Value</th>
                    <th class='text-center'> Created At </th>
                    <th class='text-center'> Updated At </th>
                    <th class='text-center' style='width: 100px;'> Actions </th>
                  </tr>
              </thead>
              <tbody>";
  while ($row = $result->fetch_assoc()) {
      $output .= "<tr>
                  <td class='text-center' style='width: 50px;'>" . $n++ . "</td>
                  <td class='text-center'>" . $row['name'] . "</td>
                  <td class='text-center'>" . $row['invoice_date'] . "</td>
                  <td class='text-center'>" . $row['invoice_no'] . "</td>
                  <td class='text-center'>
                      <table class='table table-bordered'>";
      
      $productTable = '';
      foreach ($join_data as $product) {
        if ($row['invoice_no'] === $product['invoice_no']) {
          $productTable .= "<tr><td>" . $product['name'] . "</td></tr>";
        }
      }

      $output .= $productTable . "</table></td>";
      
      $output .= "<td class='text-center'>
                      <table class='table table-bordered'>";
      
      $unitTable = '';
      foreach ($join_data as $product) {
        if ($row['invoice_no'] === $product['invoice_no']) {
          $unitTable .= "<tr><td>" . $product['unit_id'] . "</td></tr>";
        }
      }

      $output .= $unitTable . "</table></td>";
      
      $output .= "<td class='text-center'>
                      <table class='table table-bordered'>";
      
      $priceTable = '';
      foreach ($join_data as $product) {
        if ($row['invoice_no'] === $product['invoice_no']) {
          $priceTable .= "<tr><td>" . $product['price'] . "</td></tr>";
        }
      }

      $output .= $priceTable . "</table></td>";
      
      $output .= "<td class='text-center'>
                      <table class='table table-bordered'>";
      
      $quantityTable = '';
      foreach ($join_data as $product) {
        if ($row['invoice_no'] === $product['invoice_no']) {
          $quantityTable .= "<tr><td>" . $product['quantity'] . "</td></tr>";
        }
      }

      $output .= $quantityTable . "</table></td>";

      $output .= "<td class='text-center'>
                      <table class='table table-bordered'>";
      
      $valueTable = '';
      foreach ($join_data as $product) {
        if ($row['invoice_no'] === $product['invoice_no']) {
          $valueTable .= "<tr><td>" . $product['value'] . "</td></tr>";
        }
      }

      $output .= $valueTable . "</table></td>
                  <td class='text-center'>" . $row['total_value'] . "</td>
                  <td class='text-center'>" . $row['created_at'] . "</td>
                  <td class='text-center'>" . $row['updated_at'] . "</td>
                  <td class='text-center'>
                <div class='btn-group'>
                  <a href='index.php?page=edit_invoice&invoice_no=" . $row['invoice_no'] . "' class='btn btn-info btn-xs'  title='Edit' data-toggle='tooltip'>
                    <span ><i class='fa fa-pencil-square-o' aria-hidden='true'></i></span>
                  </a>
                  <a href='index.php?page=delete_invoice&invoice_no=" . $row['invoice_no'] . "' class='btn btn-danger btn-xs'  title='Delete' data-toggle='tooltip'>
                    <span><i class='fa fa-trash-o' aria-hidden='true'></i></span>
                  </a>
                  <a href='print_invoice.php?invoice_no=" . $row['invoice_no'] . " ' target='_blank' class='btn btn-success btn-xs'  title='print' data-toggle='tooltip'>
                    <span><i class='fa fa-print' aria-hidden='true'></i></span>
                  </a>
                </div>
              </td>
                </tr>";
  }
  $output .= "</tbody>";
  echo $output;
} else {
  echo '<img class="rounded mx-auto d-block" src="images/data_not_found.jpg" alt="">';
}
}
// This part for invoice Search.....end
?>
