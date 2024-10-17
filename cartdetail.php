<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Detail</title>

    <style>
        <style>
        body {
            margin-top: 20px;
            background: #eee;
        }

        h3 {
            font-size: 16px;
        }

        .text-navy {
            color: #1ab394;
        }

        .cart-product-imitation {
            text-align: center;
            padding-top: 30px;
            height: 80px;
            width: 80px;
            background-color: #f8f8f9;
        }

        .product-imitation.xl {
            padding: 120px 0;
        }

        .product-desc {
            padding: 20px;
            position: relative;
        }

        .ecommerce .tag-list {
            padding: 0;
        }

        .ecommerce .fa-star {
            color: #d1dade;
        }

        .ecommerce .fa-star.active {
            color: #f8ac59;
        }

        .ecommerce .note-editor {
            border: 1px solid #e7eaec;
        }

        table.shoping-cart-table {
            margin-bottom: 0;
        }

        table.shoping-cart-table tr td {
            border: none;
            text-align: right;
        }

        table.shoping-cart-table tr td.desc,
        table.shoping-cart-table tr td:first-child {
            text-align: left;
        }

        table.shoping-cart-table tr td:last-child {
            width: 80px;
        }

        .ibox {
            clear: both;
            margin-bottom: 25px;
            margin-top: 0;
            padding: 0;
        }

        .ibox.collapsed .ibox-content {
            display: none;
        }

        .ibox:after,
        .ibox:before {
            display: table;
        }

        .ibox-title {
            -moz-border-bottom-colors: none;
            -moz-border-left-colors: none;
            -moz-border-right-colors: none;
            -moz-border-top-colors: none;
            background-color: #ffffff;
            border-color: #e7eaec;
            border-image: none;
            border-style: solid solid none;
            border-width: 3px 0 0;
            color: inherit;
            margin-bottom: 0;
            padding: 14px 15px 7px;
            min-height: 48px;
        }

        .ibox-content {
            background-color: #ffffff;
            color: inherit;
            padding: 15px 20px 20px 20px;
            border-color: #e7eaec;
            border-image: none;
            border-style: solid solid none;
            border-width: 1px 0;
        }

        .ibox-footer {
            color: inherit;
            border-top: 1px solid #e7eaec;
            font-size: 90%;
            background: #ffffff;
            padding: 10px 15px;
        }
    </style>
    </style>
</head>

<body>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="container">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-md-9">
                    <div class="ibox">
                        <div class="ibox-title">
                            <?php
                            // Sample cart items array
                            $cartItems = []; // Initialize as an empty array

                            // If you have items in the cart, populate the array
                            // Example:
                            $cartItems = [
                                [
                                    'id' => 1,
                                    'name' => 'Desktop publishing software',
                                    'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
                                    'price' => 180.00,
                                    'quantity' => 1,
                                    'original_price' => 230.00
                                ],
                                // Add more items here as needed
                            ];

                            // Count the number of items in the cart
                            $itemCount = count($cartItems);
                            echo '<span class="pull-right">(' . $itemCount . ') items</span>';
                            ?>
                            <h1>Items in your cart</h1>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table shoping-cart-table">
                                    <tbody>
                                        <?php
                                        // Check if there are items in the cart
                                        if ($itemCount > 0) {
                                            foreach ($cartItems as $item) {
                                                echo '<tr id="item' . $item['id'] . '">';
                                                echo '<td width="90"><div class="cart-product-imitation"></div></td>';
                                                echo '<td class="desc">';
                                                echo '<h3><a href="#" class="text-navy">' . htmlspecialchars($item['name']) . '</a></h3>';
                                                echo '<p class="small">' . htmlspecialchars($item['description']) . '</p>';
                                                echo '<div class="m-t-sm">| <a href="#" class="text-muted remove-item"><i class="fa fa-trash"></i> Remove item</a></div>';
                                                echo '</td>';
                                                echo '<td>$' . number_format($item['price'], 2) . '<s class="small text-muted">$' . number_format($item['original_price'], 2) . '</s></td>';
                                                echo '<td width="65"><input type="text" class="form-control" value="' . $item['quantity'] . '"></td>';
                                                echo '<td><h4>$' . number_format($item['price'] * $item['quantity'], 2) . '</h4></td>';
                                                echo '</tr>';
                                            }
                                        } else {
                                            echo '<tr><td colspan="5">Your cart is empty.</td></tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="ibox-content">
                            <a href="./checkout.php"><button class="btn btn-primary pull-right"><i class="fa fa-shopping-cart"></i> Checkout</button></a>
                            <a href="./shop-grid.php"><button class="btn btn-white"><i class="fa fa-arrow-left"></i> Continue shopping</button></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>

</html>
