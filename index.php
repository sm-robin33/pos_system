<?php ob_start();
session_start();
if (empty($_SESSION['email']) || $_SESSION['email'] == '') {
    header("Location: login.php");
    die();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>core pos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css" />
    <style>
        .type {
            list-style-type: none;
        }

        .samplewidth {
            width: 390px;
        }

        .main_width {
            width: 20%;
        }

        .scrollbox {
            overflow: auto;
        }

        .scrollbox-inner {
            font-size: 18px;
        }

        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-thumb {

            background: aliceblue;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 20%;
            height: 100%;
            display: flex;

            flex-direction: column;
        }

        .sn {
            width: 40px;
        }

        .unit {
            width: 70px;
        }

        .ml {
            margin-left: 92px;
        }
    </style>


</head>

<body>

    <div class="sidebar">
        <div class="logo">
            <i class="fa fa-user-secret" aria-hidden="true"></i>
            <span class="logo-name">Core POS</span>
        </div>

        <ul class="nav-list">
            <li>
                <a href="index.php?page=dashboard">
                    <i class="fa fa-tachometer" aria-hidden="true"></i>
                    <span class="link-name">Dashboard</span>
                </a>
            </li>

            <li>
                <div class="icon-link">
                    <a href="#">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        <span class="link-name">User</span>
                    </a>
                    <i class="fa fa-caret-down arrow" aria-hidden="true"></i>
                </div>

                <ul class="sub-menu">
                    <li><a href="index.php?page=add_user">Create User</a></li>
                    <li><a href="index.php?page=user_list">User List</a></li>
                </ul>
            </li>

            <li>
                <div class="icon-link">
                    <a href="#">
                    <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                        <span class="link-name">Brand</span>
                    </a>
                    <i class="fa fa-caret-down arrow" aria-hidden="true"></i>
                </div>

                <ul class="sub-menu">
                    <li><a href="index.php?page=add_brand">Create Brand</a></li>
                    <li><a href="index.php?page=brand_list">Brand List</a></li>
                </ul>
            </li>

            <li>
                <div class="icon-link">
                    <a href="#">
                    <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                        <span class="link-name">Measurement</span>
                    </a>
                    <i class="fa fa-caret-down arrow" aria-hidden="true"></i>
                </div>

                <ul class="sub-menu">
                    <li><a href="index.php?page=add_measurement">Create Measurement</a></li>
                    <li><a href="index.php?page=measurement_list">Measurement List</a></li>
                </ul>
            </li>

            <li>
                <div class="icon-link">
                    <a href="#">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        <span class="link-name">Customer</span>
                    </a>
                    <i class="fa fa-caret-down arrow" aria-hidden="true"></i>
                </div>

                <ul class="sub-menu">
                    <li><a href="index.php?page=add_customer">Create Customer</a></li>
                    <li><a href="index.php?page=customer_list">Customer List</a></li>
                </ul>
            </li>

            <li>
                <div class="icon-link">
                    <a href="#">
                    <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                        <span class="link-name">Product</span>
                    </a>
                    <i class="fa fa-caret-down arrow" aria-hidden="true"></i>
                </div>

                <ul class="sub-menu">
                    <li><a href="index.php?page=add_product">Create Product</a></li>
                    <li><a href="index.php?page=product_list">Product List</a></li>
                </ul>
            </li>

            <li>
                <div class="icon-link">
                    <a href="#">
                    <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                        <span class="link-name">Product Price</span>
                    </a>
                    <i class="fa fa-caret-down arrow" aria-hidden="true"></i>
                </div>

                <ul class="sub-menu">
                    <li><a href="index.php?page=add_product_price">Add Product Price</a></li>
                    <li><a href="index.php?page=product_price_list">Product Price List</a></li>
                </ul>
            </li>

            <li>
                <div class="icon-link">
                    <a href="#">
                    <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                        <span class="link-name">Category</span>
                    </a>
                    <i class="fa fa-caret-down arrow" aria-hidden="true"></i>
                </div>

                <ul class="sub-menu">
                    <li><a href="index.php?page=add_category">Create Category</a></li>
                    <li><a href="index.php?page=category_list">Category List</a></li>
                </ul>
            </li>

            <li>
                <div class="icon-link">
                    <a href="#">
                    <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                        <span class="link-name">Sub Category</span>
                    </a>
                    <i class="fa fa-caret-down arrow" aria-hidden="true"></i>
                </div>

                <ul class="sub-menu">
                    <li><a href="index.php?page=add_subcategory">Create Sub-Category</a></li>
                    <li><a href="index.php?page=subcategory_list">Sub-Category List</a></li>
                </ul>
            </li>

            <li>
                <div class="icon-link">
                    <a href="#">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        <span class="link-name">Supplier</span>
                    </a>
                    <i class="fa fa-caret-down arrow" aria-hidden="true"></i>
                </div>

                <ul class="sub-menu">
                    <li><a href="index.php?page=add_supplier">Create Supplier</a></li>
                    <li><a href="index.php?page=supplier_list">Supplier List</a></li>
                </ul>
            </li>

            <li>
                <div class="icon-link">
                    <a href="#">
                    <i class="fa fa-home" aria-hidden="true"></i>
                        <span class="link-name">Store</span>
                    </a>
                    <i class="fa fa-caret-down arrow" aria-hidden="true"></i>
                </div>

                <ul class="sub-menu">
                    <li><a href="index.php?page=add_store">Create Store</a></li>
                    <li><a href="index.php?page=store_list">Store List</a></li>
                </ul>
            </li>

            <li>
                <div class="icon-link">
                    <a href="#">
                    <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                        <span class="link-name">Inventory</span>
                    </a>
                    <i class="fa fa-caret-down arrow" aria-hidden="true"></i>
                </div>

                <ul class="sub-menu">
                    <li><a href="index.php?page=add_inventory">Create Inventory</a></li>
                    <li><a href="index.php?page=inventory_list">Inventory List</a></li>
                </ul>
            </li>

            <li>
                <div class="icon-link">
                    <a href="#">
                    <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                        <span class="link-name">Purchase</span>
                    </a>
                    <i class="fa fa-caret-down arrow" aria-hidden="true"></i>
                </div>

                <ul class="sub-menu">
                    <li><a href="index.php?page=add_purchase">Create Purchase</a></li>
                    <li><a href="index.php?page=purchase_list">Purchase List</a></li>
                    <li><a href="index.php?page=draft_list">Purchase Draft List</a></li>
                </ul>
            </li>

            <li>
                <div class="icon-link">
                    <a href="#">
                    <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                        <span class="link-name">Invoice</span>
                    </a>
                    <i class="fa fa-caret-down arrow" aria-hidden="true"></i>
                </div>

                <ul class="sub-menu">
                    <li><a href="index.php?page=add_invoice">Create Invoice</a></li>
                    <li><a href="index.php?page=invoice_list">Invoice List</a></li>
                    <li><a href="index.php?page=invoice_draft_list">Invoice Draft List</a></li>
                </ul>
            </li>

            <li>
                <div class="icon-link">
                    <a href="logout.php">
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                        <span class="link-name">Logout</span>
                    </a>
                </div>
            </li>

    </div>

    <div class="home-section">
        <div class="home-content">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </div>
        <div class="col-sm py-3">
            <?php

            if (isset($_GET['page'])) {
                $page = $_GET['page'] . '.php';
            } else {
                $page = "index.php";
            }

            if (file_exists($page)) {
                require_once $page;
            }

            ?>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="app.js"></script>

    <!-- Add purchase script start -->
    <script>
        $(document).ready(function() {

            var i = 1;
            var length;

            function calculateSubTotal(row) {
                var quantity = parseFloat(row.find('.quantity').val());
                var unitPrice = parseFloat(row.find('.unit_price').val());
                var subTotal = quantity * unitPrice;
                row.find('.sub_total_price').val(subTotal);
            }

            function calculateGrandTotal() {
                var grandTotal = 0;
                $('.sub_total_price').each(function() {
                    grandTotal = grandTotal + parseFloat($(this).val()) || 0;
                });
                $('#total_price').val(grandTotal);
            }


            $("#add").click(function() {
                var productOptions = '<?php foreach ($products as $product_data) { ?>' +
                    '<option value="<?php echo $product_data['id'] ?>" class="text-capitalize"><?php echo $product_data['name'] ?></option>' + '<?php }; ?>';
                i++;
                $('#dynamic_field').append('<tr id="row' + i + '">\
      <td ><label>SN::</label><input type="text" name="sn[]"  class="form-control sn" value="' + i + '" /></td>\
      <td>\
      <label>Product Name:</label>\
      <select name="product[]" required id="text" class="form-control text-capitalize">\
      <option value="" class="text-capitalize">Chose Product</option>' +
                    productOptions +
                    '</select>\
      </td>\
      <td>\
      <label>Quantity:</label>\
      <input type="number" name="quantity[]" placeholder="Quantity" class="form-control quantity" />\
      </td>\
      <td>\
      <label>Unit Price:</label>\
      <input type="number"  name="unit_price[]"  placeholder="Enter Unit Price" class="form-control unit_price"/>\
      </td>\
      <td>\
      <label>Sub Total Price:</label>\
      <input type="number"  name="sub_total_price[]"  placeholder="Enter Total Price" class="form-control sub_total_price" readonly />\
      </td>\
      <td>\
      <button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button>\
      </td>\
      </tr>');
            });

            $(document).on('click', '.btn_remove', function() {

                i--;
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
                calculateGrandTotal();

            });

            $(document).on('input', '.quantity, .unit_price', function() {
                calculateSubTotal($(this).closest('tr'));
                calculateGrandTotal();
            });

            calculateGrandTotal();

        });
    </script>
    <!-- Add purchase script end -->

    <!-- Update purchase script start -->

    <script>
        $(document).ready(function() {

            var k = 0;
            var length;

            function calculateSubTotal(row) {
                var quantity = parseFloat(row.find('.quantity').val());
                var unitPrice = parseFloat(row.find('.unit_price').val());
                var subTotal = quantity * unitPrice;
                row.find('.sub_total_price').val(subTotal);
            }

            function calculateGrandTotal() {
                var grandTotal = 0;
                $('.sub_total_price').each(function() {
                    grandTotal = grandTotal + parseFloat($(this).val()) || 0;
                });
                $('#total_price').val(grandTotal);
            }
            var sno = '<?php $i = 1;
                        foreach ($join_data as $product_all) { ?>' +
                '<?php if ($row_purchase['referance'] === $product_all['ps_referance']) { ?>'
            k++;
            '<?php $i++; ?>'
            '<?php }; ?>'
            '<?php }; ?>';
            $("#add_update").click(function() {
                var productOptions = '<?php foreach ($products as $product_data) { ?>' +
                    '<option value="<?php echo $product_data['id'] ?>" class="text-capitalize"><?php echo $product_data['name'] ?></option>' + '<?php }; ?>';

                k++;
                $('#dynamic_field').append('<tr id="row' + k + '">\
      <td ><label>SN::</label><input type="text" name="sn_up[]"  class="form-control sn" value="' + k + '" /></td>\
      <td>\
      <label>Product Name:</label>\
      <select name="product[]" required id="text" class="form-control text-capitalize">\
      <option value="" class="text-capitalize">Chose Product</option>' +
                    productOptions +
                    '</select>\
      </td>\
      <td>\
      <label>Quantity:</label>\
      <input type="number" name="quantity[]" placeholder="Quantity" class="form-control quantity" />\
      </td>\
      <td>\
      <label>Unit Price:</label>\
      <input type="number"  name="unit_price[]"  placeholder="Enter Unit Price" class="form-control unit_price"/>\
      </td>\
      <td>\
      <label>Total Price:</label>\
      <input type="number"  name="sub_total_price[]"  placeholder="Enter Total Price" class="form-control sub_total_price" readonly />\
      </td>\
      <td>\
      <button type="button" name="remove" id="' + k + '" class="btn btn-danger btn_remove">X</button>\
      </td>\
      </tr>');
            });

            $(document).on('click', '.btn_remove', function() {
                k--;
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
                calculateGrandTotal();

            });

            $(document).on('input', '.quantity, .unit_price', function() {
                calculateSubTotal($(this).closest('tr'));
                calculateGrandTotal();
            });

            calculateGrandTotal();

        });
    </script>

    <!-- update purchase script end -->

    <!-- Add invoice script start -->
    <script>
        $(document).ready(function() {

            var i = 1;
            var length;

            function calculateSubTotal(row) {
                var quantity = parseFloat(row.find('.quantity').val());
                var unitPrice = parseFloat(row.find('.unit_price').val());
                var subTotal = quantity * unitPrice;
                row.find('.sub_total_price').val(subTotal);
            }

            function calculateGrandTotal() {
                var grandTotal = 0;
                $('.sub_total_price').each(function() {
                    grandTotal = grandTotal + parseFloat($(this).val()) || 0;
                });
                $('#total_price').val(grandTotal);
            }


            $("#add_invoice").click(function() {
                var productOptions = '<?php foreach ($products as $product_data) { ?>' +
                    '<option value="<?php echo $product_data['id'] ?>" class="text-capitalize"><?php echo $product_data['name'] ?></option>' + '<?php }; ?>';
                i++;
                $('#dynamic_field').append('<tr id="row' + i + '">\
      <td ><label>SN::</label><input type="text" name="sn[]"  class="form-control sn" value="' + i + '" /></td>\
      <td>\
      <label>Product Name:</label>\
      <select name="product[]" required id="product" class="pid form-control text-capitalize">\
      <option value="" class="text-capitalize">Chose Product</option>' +
                    productOptions +
                    '</select>\
      </td>\
      <td><label>Unit:</label><input type="text" name="unit[]" class="unit form-control" placeholder="Unit" readonly /></td>\
      <td><label>Price:</label><input type="number" name="unit_price[]" placeholder="Enter Price" class="unit_price form-control" readonly /></td>\
      <td><label>Available Quantity:</label><input type="text" name="a_unit[]" class="avilable_quantity form-control" placeholder="A.Quantity" readonly /></td>\
      <td>\
      <label>Quantity:</label>\
      <input type="number" name="quantity[]" placeholder="Quantity" class="form-control quantity" />\
      </td>\
      <td>\
      <label>Value:</label>\
      <input type="number"  name="value[]"  placeholder="value" class="form-control sub_total_price" readonly />\
      </td>\
      <td>\
      <button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button>\
      </td>\
      </tr>');
            });

            $(document).on('click', '.btn_remove', function() {

                i--;
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
                calculateGrandTotal();

            });

            $(document).on('input', '.quantity, .unit_price', function() {
                calculateSubTotal($(this).closest('tr'));
                calculateGrandTotal();
            });

            calculateGrandTotal();

        });
    </script>
    <!-- Add invoice script end -->

    <!-- Update invoice script start -->

    <script>
        $(document).ready(function() {

            var k = 0;
            var length;

            function calculateSubTotal(row) {
                var quantity = parseFloat(row.find('.quantity').val());
                var unitPrice = parseFloat(row.find('.unit_price').val());
                var subTotal = quantity * unitPrice;
                row.find('.sub_total_price').val(subTotal);
            }

            function calculateGrandTotal() {
                var grandTotal = 0;
                $('.sub_total_price').each(function() {
                    grandTotal = grandTotal + parseFloat($(this).val()) || 0;
                });
                $('#total_price').val(grandTotal);
            }
            var sno = '<?php $i = 1;
                        foreach ($join_data as $product_all) { ?>' +
                '<?php if ($row_invoice['invoice_no'] === $product_all['invoice_det_no']) { ?>'
            k++;
            '<?php $i++; ?>'
            '<?php }; ?>'
            '<?php }; ?>';
            $("#add_update_invoice").click(function() {
                var productOptions = '<?php foreach ($products as $product_data) { ?>' +
                    '<option value="<?php echo $product_data['id'] ?>" class="text-capitalize"><?php echo $product_data['name'] ?></option>' + '<?php }; ?>';


                k++;
                $('#dynamic_field').append('<tr id="row' + k + '">\
      <td ><label>SN::</label><input type="text" name="sn_up[]"  class="form-control sn" value="' + k + '" /></td>\
      <td>\
      <label>Product Name:</label>\
      <select name="product[]" required id="text" class="pid form-control text-capitalize">\
      <option value="" disabled selected class="text-capitalize">Chose Product</option>' +
                    productOptions +
                    '</select>\
      </td>\
      <td><label>Unit:</label><input type="text" name="unit[]" class="unit form-control" placeholder="Unit" readonly /></td>\
      <td><label>Price:</label><input type="number" name="unit_price[]" placeholder="Enter Price" class="unit_price form-control" readonly/></td>\
      <td><label>Available Quantity:</label><input type="text" name="a_unit[]" class="avilable_quantity form-control" placeholder="A.Quantity" readonly /></td>\
      <td>\
      <label>Quantity:</label>\
      <input type="number" name="quantity[]" placeholder="Quantity" class="form-control quantity" />\
      </td>\
      <td>\
      <label>Value:</label>\
      <input type="number"  name="value[]"  placeholder="Enter value" class="form-control sub_total_price" readonly />\
      </td>\
      <td>\
      <button type="button" name="remove" id="' + k + '" class="btn btn-danger btn_remove">X</button>\
      </td>\
      </tr>');
            });

            $(document).on('click', '.btn_remove', function() {
                k--;
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
                calculateGrandTotal();

            });

            $(document).on('input', '.quantity, .unit_price', function() {
                calculateSubTotal($(this).closest('tr'));
                calculateGrandTotal();
            });

            calculateGrandTotal();

        });
    </script>
    <!-- Update invoice script end -->

    <script>
        $("body").on("change", ".pid", function() {
            var pid = $(this).val();
            console.log(pid);
            var input = $(this).parents("tr").find(".unit_price");
            $.ajax({
                url: "get_price.php",
                type: "post",
                data: {
                    pid: pid
                },
                success: function(res) {
                    $(input).val(res);
                }
            });
        });

        $("body").on("change", ".pid", function() {
            var pid = $(this).val();
            console.log(pid);
            var input = $(this).parents("tr").find(".unit");
            $.ajax({
                url: "get_unit.php",
                type: "post",
                data: {
                    pid: pid
                },
                success: function(res) {
                    $(input).val(res);
                }
            });
        });

        $("body").on("change", ".pid", function() {
            var pid = $(this).val();
            console.log(pid);
            var input = $(this).parents("tr").find(".avilable_quantity");
            $.ajax({
                url: "get_quantity.php",
                type: "post",
                data: {
                    pid: pid
                },
                success: function(res) {
                    $(input).val(res);
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#search_text_user, #search_text_brand,#search_text_measurement,#search_text_customer,#search_text_product,#search_text_product_price,#search_text_category,#search_text_sub_category,#search_text_supplier,#search_text_store,#search_text_inventory,#search_text_purchase,#search_text_invoice").keyup(function() {
                var search = $(this).val();
                var searchData = {};

                if ($(this).is("#search_text_user")) {
                    searchData.user = search;
                } else if ($(this).is("#search_text_brand")) {
                    searchData.brand = search;
                } else if ($(this).is("#search_text_measurement")) {
                    searchData.measurement = search;
                } else if ($(this).is("#search_text_customer")) {
                    searchData.customer = search;
                } else if ($(this).is("#search_text_product")) {
                    searchData.product = search;
                } else if ($(this).is("#search_text_product_price")) {
                    searchData.product_price = search;
                } else if ($(this).is("#search_text_category")) {
                    searchData.category = search;
                } else if ($(this).is("#search_text_sub_category")) {
                    searchData.sub_category = search;
                } else if ($(this).is("#search_text_supplier")) {
                    searchData.supplier = search;
                } else if ($(this).is("#search_text_store")) {
                    searchData.store = search;
                } else if ($(this).is("#search_text_inventory")) {
                    searchData.inventory = search;
                } else if ($(this).is("#search_text_purchase")) {
                    searchData.purchase = search;
                } else if ($(this).is("#search_text_invoice")) {
                    searchData.invoice = search;
                }

                $.ajax({
                    url: 'config.php',
                    method: 'post',
                    data: searchData,
                    success: function(response) {
                        $("#table_data").html(response);
                    }
                });
            });
        });
    </script>

</body>

</html>
<?php ob_flush(); ?>