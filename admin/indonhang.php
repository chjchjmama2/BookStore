<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../font-awesome/css/all.css">


</head>

<body>
    <?php

    include '../connect_db.php';
    if (isset($_GET['id'])) {
        $orders = mysqli_query($con, "SELECT orders.name, orders.address, orders.phone, orders.notes, order_detail.*, products.name_product as product_name
        FROM orders
        INNER JOIN order_detail ON orders.id = order_detail.oder_id 
        INNER JOIN products ON products.id_product = order_detail.product_id
        WHERE orders.id = " . $_GET['id']);
        $orders = mysqli_fetch_all($orders, MYSQLI_ASSOC);
    }
    ?>
    <div class="container-fluid">
        <div class="border border-success rounded" style="width: fit-content; margin-left: 35%;padding: 30px;margin-top: 5%; ">
            <h1>Chi tiết đơn hàng</h1>
            <label>Người nhận : </label><span><?= $orders[0]['name'] ?></span><br />
            <label>Điện thoại : </label><span><?= $orders[0]['phone'] ?></span><br />
            <label>Địa chỉ : </label><span><?= $orders[0]['address'] ?></span><br />
            <hr />
            <h3>Danh sách sản phẩm</h3>
            <ul>
                <?php
                $totalQuantity = 0;
                $totalMoney = 0;
                foreach ($orders as $row) { ?>
                    <li>
                        <span class="item-name"><?= $row['product_name'] ?></span>
                        <span class="item-quantity"> - SL : <?= $row['quanlity'] ?> Sản phẩm</span>
                    </li>
                <?php
                    $totalMoney += ($row['price'] * $row['quanlity']);
                    $totalQuantity += $row['quanlity'];
                }
                ?>
            </ul>
            <hr />
            <label>Tổng SL : </label><?= $totalQuantity ?> - <label>Tổng tiền : </label><?= number_format($totalMoney, 0, ",", ".") ?>đ
            <p><label>Ghi chú : </label><?= $orders[0]['notes'] ?></p>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>