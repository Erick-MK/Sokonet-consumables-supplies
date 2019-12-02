<?php

require __DIR__ . '/config/bootstrap.php';
require __DIR__ . '/config/connect.php';

// We use ouput buffering here because we want to modify the headers after
// sending the content when we redirect the user to the login page.
ob_start();
if (!isset($_SESSION['customer']) & empty($_SESSION['customer'])) {
    header('location: login.php');
}

/**
 * Load the template files.
 */
include INC . 'header.php';
include INC . 'nav.php';

$uid = $_SESSION['customerid'];
$cart = $_SESSION['cart'];

/**
 * Get the user data from the Database to pre-populate the form.
 */
$userSql = "SELECT * FROM `usersmeta` WHERE `uid`='$uid'";
$userResult = mysqli_query($connection, $userSql);
$count = $userResult->num_rows;
$r = $userResult->fetch_assoc();

/**
 * We first need to check that $cart is actually set. This would be null if
 * the user is logged out with nothing in their cart.
 */
if (isset($cart)){
    /**
     * We need to get the total value of the cart in order to update the order
     * totals. We have to run the following loop to get a $orderTotal variable.
     */
    foreach ($cart as $key => $value) {
        $orderSql = "SELECT * FROM `products` WHERE `id`='$key'";
        $orderResult = $connection->query($orderSql);
        $order = $orderResult->fetch_assoc();
        $orderTotal = $orderTotal + ($order['price']*$value['quantity']);
    }
}

/**
 * Add or Update the Address details in the Database and process the items in
 * the users Cart for the Checkout page.
 */
if (isset($_POST) && !empty($_POST)) {
    if ($_POST['agree'] == true) {
        $city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
        $firstName = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
        $surname = filter_var($_POST['lname'], FILTER_SANITIZE_STRING);
        $company = filter_var($_POST['company'], FILTER_SANITIZE_STRING);
        $address1 = filter_var($_POST['address1'], FILTER_SANITIZE_STRING);
        $address2 = filter_var($_POST['address2'], FILTER_SANITIZE_STRING);
        // $city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
        $estate = filter_var($_POST['estate'], FILTER_SANITIZE_STRING);
        $phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
        $payment = filter_var($_POST['payment'], FILTER_SANITIZE_STRING);
        // $zip = filter_var($_POST['zipcode'], FILTER_SANITIZE_STRING);

        // Check that all the required details have been completed in the form.
        if (!empty($city) && !empty($firstName) && !empty($surname) && !empty($address1) && !empty($estate) && !empty($phone)) {
            // We either use an UPDATE or INSERT statement depending on whether
            // or not the user has added their address details before.
            if ($count === 1) {
                $addressSql = "UPDATE `usersmeta` SET `city`='$city', `firstname`='$firstName', `lastname`='$surname', `address1`='$address1', `address2`='$address2', `estate`='$estate', `company`='$company', `mobile`='$phone' WHERE `uid`=$uid";
            } elseif ($count === 0) {
                $addressSql = "INSERT INTO `usersmeta` (`city`, `firstname`, `lastname`, `address1`, `address2`, `estate`, `company`, `mobile`, `uid`) VALUES ('$city', '$firstName', '$surname', '$address1', '$address2', '$estate', '$company', '$phone', '$uid')";
            }
            // Setup the Update or Insert query for the usermeta table.
            $addressResult = $connection->query($addressSql);

            // Update or Insert the Address details by saving the data to the
            // usermeta table.
            if ($addressResult === TRUE) {
                // Setup the query for inserting the order to the orders table.
                $orderInsert = "INSERT INTO `orders` (`uid`, `totalprice`, `orderstatus`, `paymentmode`) VALUES ('$uid', '$orderTotal', 'Order Placed', '$payment')";
                $insertResult = $connection->query($orderInsert);

                // Insert the Order to the orders table.
                if ($insertResult === TRUE) {
                    // Get the order id from the last insert to the orders table.
                    $orderId = $connection->insert_id;
                    // Run a loop to get all the products that were added to the
                    // users cart.
                    foreach ($cart as $key => $value) {
                        $itemSql = "SELECT * FROM `products` WHERE `id`='$key'";
                        $itemResult = $connection->query($itemSql);
                        $item = $itemResult->fetch_assoc();
                        // $itemCount = $itemResult->data_seek(0);

                        // Get the product id, price and quantity.
                        $productId = $item['id'];
                        $productPrice = $item['price'];
                        $productQuant = $value['quantity'];

                        // Prepare Insert statement for the orderitems table.
                        $orderItemSql = "INSERT INTO `orderitems` (`pid`, `orderid`, `productprice`, `pquantity`) VALUES ('$productId', '$orderId', '$productPrice', '$productQuant')";
                        $orderItemsResult = $connection->query($orderItemSql);
                        // Insert the products to the orderitems tables.
                        if ($orderItemsResult === FALSE) {
                            echo "There was an error updating your order. Please contact support.";
                        }
                    }
                    // If our queries ran successfully then we redirect the user
                    // to the recently placed order page.
                    if ($orderItemsResult === TRUE) {
                        unset($_SESSION['cart']);
                        header("location: view-order.php?id=$orderId");
                    }
                } // end $insertResult which also inserts order items.
            } // end $addressResult which also inserts the main order.
        } // End of Checking Post Variables.
    } // End the check if the T&C's were agreed to.
} // End the check to see if we are dealing with POST data only.

/**
 * Flush the object cache.
 */
ob_flush();
?>
<!-- SHOP CONTENT -->
<section id="content">
    <div class="content-blog">
        <div class="page_header text-center">
            <h2>Order Checkout</h2>
            <p><?php echo getenv('STORE_TAGLINE'); ?></p>
        </div>
    <?php if (!empty($cart)) { ?>
        <form method="post">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="billing-details">
                            <h3 class="uppercase">Shipping Details</h3>
                            <br>
                            <p>Fields marked in <i style="color:tomato;">*</i> are required fields and therefore need to completed.</p>
                            <br>
                            <label class="">City <i style="color:tomato;">*</i></label>
                            <select name="city" class="form-control" required>
                            <?php
                            if (!empty($r['city'])) {
                                echo '<option value="'.$r['city'].'" style="form-control-plaintext">'.$r['city'].'</option>';
                            } else {
                                ?>
                                <option value="">Select one of operational Cities</option>
                                <option value="Nairobi">Nairobi</option>
                                <option value="Eldoret">Eldoret</option>
                                <option value="Nakuru">Nakuru</option>
                                <option value="Thika">Thika</option>
                                
                                <?php
                            } ?>
                            </select>
                            <div class="clearfix space20"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>First Name <i style="color:tomato;">*</i></label>
                                    <input name="fname" class="form-control" placeholder="" value="<?php if (!empty($r['firstname'])) {
                                        echo $r['firstname'];
                                    } elseif (isset($firstName)) {
                                        echo $firstName;
                                    } ?>" type="text" required>
                                </div>
                                <div class="col-md-6">
                                    <label>Last Name <i style="color:tomato;">*</i></label>
                                    <input name="lname" class="form-control" placeholder="" value="<?php if (!empty($r['lastname'])) {
                                        echo $r['lastname'];
                                    } elseif (isset($surname)) {
                                        echo $surname;
                                    } ?>" type="text" required>
                                </div>
                            </div>
                            <div class="clearfix space20"></div>
                            <label>Company Name</label>
                            <input name="company" class="form-control" placeholder="" value="<?php if (!empty($r['company'])) {
                                echo $r['company'];
                            } elseif (isset($company)) {
                                echo $company;
                            } ?>" type="text">
                            <div class="clearfix space20"></div>
                            <label>Address <i style="color:tomato;">*</i></label>
                            <input name="address1" class="form-control" placeholder="Street address" value="<?php if (!empty($r['address1'])) {
                                echo $r['address1'];
                            } elseif (isset($address1)) {
                                echo $address1;
                            } ?>" type="text" required>
                            <div class="clearfix space20"></div>
                            <label>Apartment/unit <i style="color:tomato;">*</i></label>
                            <input name="address2" class="form-control" placeholder="Apartment, suite, unit etc. (optional)" value="<?php if (!empty($r['address2'])) {
                                echo $r['address2'];
                            } elseif (isset($address2)) {
                                echo $address2;
                            } ?>" type="text">
                            <div class="clearfix space20"></div>
                            <!-- <div class="row"> -->
                                <!-- <div class="col-md-4">
                                    <label>City <i style="color:tomato;">*</i></label>
                                    <input name="city" class="form-control" placeholder="City" value="
                                    
                                       // echo $r['city'];
                                    //} elseif (isset($city)) {
                                       // echo $city;
                                    } ?>" type="text" required>
                                </div> -->
                                <div class="col-md-4">
                                    <label>Estate <i style="color:tomato;">*</i></label>
                                    <input name="estate" class="form-control" value="<?php if (!empty($r['estate'])) {
                                        echo $r['estate'];
                                    } elseif (isset($estate)) {
                                        echo $estate;
                                    } ?>" placeholder="Estate" type="text" required>
                                </div>
                                <!-- <div class="col-md-4">
                                    <label>Postcode <i style="color:tomato;">*</i></label>
                                    <input name="zipcode" class="form-control" placeholder="Postcode / Zip" value="
                                        // echo $r['zip'];
                                    // } elseif (isset($zip)) {
                                        // echo $zip;
                                    // } ?>" type="text" required>
                                </div> -->
                            <!-- </div> -->
                            <div class="clearfix space20"></div>
                            <label>Phone <i style="color:tomato;">*</i></label>
                            <input name="phone" class="form-control" id="billing_phone" placeholder="" value="<?php if (!empty($r['mobile'])) {
                                echo $r['mobile'];
                            } elseif (isset($phone)) {
                                echo $phone;
                            } ?>" type="text" required>

                        </div>
                    </div>
                </div>

                <div class="space30"></div>
                <h4 class="heading">Your Order</h4>

                <table class="table table-bordered extra-padding">
                    <tbody>
                        <tr>
                            <th>Cart Subtotal</th>
                            <td><span class="amount"><?php echo getenv('STORE_CURRENCY') . $orderTotal; ?></span></td>
                        </tr>
                        <tr>
                            <?php // TODO: Need to make the shipping dynamic by adding shipping options as a configurable option. ?>
                            <th>Shipping and Handling</th>
                            <td>
                                Free Shipping
                            </td>
                        </tr>
                        <tr>
                            <th>Order Total</th>
                            <td><strong><span class="amount"><?php echo getenv('STORE_CURRENCY') . $orderTotal; ?></span></strong> </td>
                        </tr>
                    </tbody>
                </table>

                <div class="clearfix space30"></div>
                <h4 class="heading">Payment Method</h4>
                <div class="clearfix space20"></div>

                <div class="payment-method">
                    <div class="row">

                        <div class="col-md-4">
                            <input name="payment" id="radio1" class="css-checkbox" type="radio" value="cod"><span>Cash On Delivery</span>
                            <div class="space20"></div>
                            <p>Please direct your payment into our bank account. Please use your Order ID as the payment reference. You won't get your order until the funds reflect in our account.</p>
                        </div>
                        <div class="col-md-4">
                            <input name="payment" id="radio2" class="css-checkbox" type="radio"><span value="cheque">Cheque Payment</span>
                            <div class="space20"></div>
                            <p>Please send your cheque to Thika arcade, 2nd floor</p>
                        </div>
                        <div class="col-md-4">
                            <input name="payment" id="radio3" class="css-checkbox" type="radio"><span value="paypal">M-PESA</span>
                            <div class="space20"></div>
                            <p>Pay via M-PESA</p>
                        </div>

                    </div>
                    <div class="space30"></div>

                    <input name="agree" id="checkboxG2" class="css-checkbox" type="checkbox" value="true"><span>I've read and accept the <a href="terms&conditions.php">terms &amp; conditions</a></span>

                    <div class="space30"></div>
                    <input type="submit" class="button btn-lg" value="Pay Now">
                </div>
            </div>
        </form>
                        <?php } elseif (empty($cart)) { ?>
        <!-- There is nothing in the cart to checkout so we display this message. -->
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <h2>Your cart is empty. Please go back and add some items to your cart!</h2>
                </div>
            </div>
            <?php include INC . 'footer.php'; ?>
        </div>
                        <?php } ?>
    </div>
</section>


