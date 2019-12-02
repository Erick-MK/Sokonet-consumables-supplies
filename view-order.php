<?php

require __DIR__ . '/config/bootstrap.php';

// We use ouput buffering here because we want to modify the headers after
// sending the content when we redirect the user to the login page.
ob_start();
if (!isset($_SESSION['customer']) & empty($_SESSION['customer'])) {
    header('location: login.php');
}

/**
 * Flush the object cache.
 */
ob_flush();

/**
 * Load the template files.
 */
include INC . 'header.php';
include INC . 'nav.php';

$uid = $_SESSION['customerid'];
$cart = $_SESSION['cart'];

/**
 * Get the order ID else redirect user to the my-account page.
 */
if (isset($_GET['id']) & !empty($_GET['id'])) {
    $oid = $_GET['id'];
} else {
    header('location: my-account.php');
}
?>

<!-- SHOP CONTENT -->
<section id="content">
    <div class="content-blog content-account">
        <div class="container">
            <div class="row">
            <?php
                // Query to get the order total amount.
                $ordersTotal = $database->singleSelect("`totalprice`, `orderstatus`, `timestamp`", "`orders`", "WHERE `uid`='$uid' AND `id`='$oid'", "assoc");
                // Query to get all the products that were ordered.
                $orderItem = $database->select("`pid`, `name`, `pquantity`, `productprice`", "`orderitems` `oi`, `orders` `o`", "JOIN `products` `p` WHERE `o`.`uid`='$uid' AND `o`.`id`='$oid' AND `oi`.`orderid`='$oid' AND `oi`.`pid`=`p`.`id`");
                // Check that we have data for the order items.
                if ($orderItem !== null) {
			?>
                <div class="page_header text-center">
                    <h2>Order #<?php echo $oid; ?></h2>
                </div>
                <div class="col-md-12">
                    <h3>Recent Orders</h3>
                    <br>
                    <table class="cart-table account-table table table-bordered">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php while ($orderItems = $orderItem->fetch_assoc()) { ?>
                            <tr>
                                <td>
                                    <a href="<?php echo getenv('STORE_URL'); ?>/single.php?id=<?php echo $orderItems['pid']; ?>"><?php echo substr($orderItems['name'], 0, 25); ?></a>
                                </td>
                                <td>
                                    <?php echo $orderItems['pquantity']; ?>
                                </td>
                                <td>
                                    <?php echo getenv('STORE_CURRENCY') . $orderItems['productprice']; ?>
                                </td>
                                <td>
                                    <?php echo getenv('STORE_CURRENCY') . $orderItems['productprice']*$orderItems['pquantity']; ?>
                                </td>
                            </tr>
                        <?php } ?>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>
                                    Order Total
                                </td>
                                <td>
                                    <?php echo getenv('STORE_CURRENCY') . $ordersTotal['totalprice']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>
                                    Order Status
                                </td>
                                <td>
                                    <?php echo $ordersTotal['orderstatus']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>
                                    Order Placed On
                                </td>
                                <td>
                                    <?php echo $ordersTotal['timestamp']; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
            <?php } else { ?>
                <div class="page_header text-center">
                    <h2>Restricted Access</h2>
                </div>
                <div class="col-md-12">
                    <h3>You do not have access to view this order. Please contact us if you feel this is an error.</h3>
                </div>
                <div class="clearfix"></div>
            <?php } ?>
                    <br>
                    <br>
                    <br>

                    <div class="ma-address">
                        <h3>My Addresses</h3>
                        <p>The following addresses will be used on the checkout page by default.</p>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>My Address <a href="<?php echo getenv('STORE_URL'); ?>/edit-address.php">Edit</a></h4>
                            <?php
                                // Join query to get the users address from the usersmeta table.
                                $userDetails = $database->singleSelect("`u1`.`firstname`, `u1`.`lastname`, `u1`.`address1`, `u1`.`address2`, `u1`.`city`, `u1`.`state`, `u1`.`country`, `u1`.`company`, `u`.`email`, `u1`.`mobile`, `u1`.`zip`", "`users` `u`", "JOIN `usersmeta` `u1` WHERE `u`.`id`=`u1`.`uid` AND `u`.`id`='$uid'", "assoc");

        						// Display the address details is there is one in the usersmeta table.
        						if($userDetails !== 0){
        							echo "<p>".$userDetails['firstname'] ." ". $userDetails['lastname'] ."</p>";
        							echo "<p>".$userDetails['address1'] ."</p>";
        							echo "<p>".$userDetails['address2'] ."</p>";
        							echo "<p>".$userDetails['city'] ."</p>";
        							echo "<p>".$userDetails['state'] ."</p>";
        							echo "<p>".$userDetails['country'] ."</p>";
        							echo "<p>".$userDetails['company'] ."</p>";
        							echo "<p>".$userDetails['zip'] ."</p>";
        							echo "<p>".$userDetails['mobile'] ."</p>";
        							echo "<p>".$userDetails['email'] ."</p>";
        						}
        					?>
                            </div>
                            <div class="col-md-6">
                                <!-- This is a spacer. -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include INC . 'footer.php'; ?>
