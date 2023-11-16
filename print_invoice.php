<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "core_pos");
if (!$conn) {
    echo "Failed to connect to MySQL";
    exit();
}

?>
<?php

$query1 = "SELECT * FROM products";
$products = $conn->query($query1);

$query3 = "SELECT * FROM customers";
$customers = $conn->query($query3);

$invoice_id = $_GET['invoice_no'];

$invoices = "SELECT * FROM invoice WHERE invoice_no='$invoice_id'";
$result_invoice = $conn->query($invoices);
$row_invoice = mysqli_fetch_array($result_invoice);



$multi_join = "SELECT idd.id AS invoice_det_id, idd.customer_id, idd.product_id, idd.unit_id, idd.price, idd.quantity, idd.value, idd.invoice_no AS invoice_det_no, pd.id AS product_id, pd.name AS product_name
FROM invoice_details AS idd
INNER JOIN invoice AS iv ON iv.invoice_no = idd.invoice_no
INNER JOIN products AS pd ON pd.id = idd.product_id
WHERE iv.customer_name = idd.customer_id";

$join_data = $conn->query($multi_join);

?>
<?php ob_start(); ?>
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
    <style type="text/css" media="print">
        @page {
            size: auto;
            margin: 0mm;
        }

        body {
            background-color: #FFFFFF;
            margin: 0px;
        }
    </style>

</head>

<body>
    <div class="container" id='printable_div_id'>
        <div class="card">
            <div class="card-header">
                <h3 class="text-center text-primary">Invoice</h3>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <?php foreach ($customers as $customer) : ?>
                            <?php if ($customer['id'] === $row_invoice['customer_name']) : ?>
                                <h6 class="text-capitalize">Customer Name: <?php echo ($customer['name']); ?></h6>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <h6 class="text-capitalize">Invoice No: E-<?php echo ($row_invoice['invoice_no']); ?></h6>
                        <h6 class="text-capitalize">Invoice Date: <?php echo ($row_invoice['invoice_date']); ?></h6>
                    </div>

                </div>

                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Item</th>
                                <th class="right">Unit</th>
                                <th class="right">Unit Price</th>
                                <th class="right">Quantity</th>
                                <th class="right">Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($join_data as $product_all) : ?>
                                <?php if ($row_invoice['invoice_no'] === $product_all['invoice_det_no']) : ?>
                                    <tr>
                                        <td><label><?php echo $i; ?></label></td>
                                        <td><label class="text-capitalize">

                                                <?php foreach ($products as $product) : ?>
                                                    <?php if ($product['id'] === $product_all['product_id']) : ?>

                                                        <?php echo $product['name'] ?>

                                                    <?php endif; ?>
                                                <?php endforeach; ?>

                                            </label>
                                        </td>

                                        <td><label class="text-capitalize">

                                                <?php echo $product_all['unit_id'] ?>

                                            </label>
                                        </td>
                                        <td><label>৳ <?php echo $product_all['price'] ?></label></td>
                                        <td><label><?php echo $product_all['quantity'] ?></label></td>
                                        <td class="right"><label>৳ <?php echo $product_all['value'] ?></label></td>


                                    </tr>
                                    <?php $i++; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-7 col-sm-4">

                    </div>

                    <div class="col-lg-5 col-sm-5 ml-auto" style="width: 41.666667%;">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td class="left">
                                        <strong>Subtotal</strong>
                                    </td>
                                    <td class="right">৳ <?php echo ($row_invoice['total_value']); ?></td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Discount (0%)</strong>
                                    </td>
                                    <td class="right">৳ 00</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>VAT (0%)</strong>
                                    </td>
                                    <td class="right">৳ 00</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Total</strong>
                                    </td>
                                    <td class="right">
                                        <strong>৳ <?php echo ($row_invoice['total_value']); ?></strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-5"></div>
        <div class="col-md-1"><button class="btn btn-success" onClick="printdiv('printable_div_id');">PRINT</button></div>
        <div class="col-md-1"></div>
        <div class="col-md-1"><button class="btn btn-success" onClick="closewindow();">Close</button></div>
    </div>
    <script>
        function printdiv(elem) {
            var header_str = '<html><head><title>' + document.title + '</title></head><body>';
            var footer_str = '</body></html>';
            var new_str = document.getElementById(elem).innerHTML;
            var old_str = document.body.innerHTML;
            document.body.innerHTML = header_str + new_str + footer_str;
            window.print();
            document.body.innerHTML = old_str;
            return false;
        }

        function closewindow() {
            window.close();
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>