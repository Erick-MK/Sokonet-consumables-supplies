<?php

require __DIR__ . '/config/bootstrap.php';
require __DIR__ . '/config/connect.php';


include INC . 'header.php';
include INC . 'nav.php';

// Check to see if the cart is in the session data else default to null.
// We do this because the $cart and $count variables are used extensively
// below and will output warnings if we don't.
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
    $count = count($cart);
}
?>


<!-- SHOP CONTENT -->
<section id="content">
    <div class="content-blog">
        <div class="container">
            <div class="row">
                <div class="page_header text-center">
                    <h2>Shopping Cart</h2>
                    <p>See the items in your cart or remove any items you don't want.</p>
                </div>
            <?php if ($count !== 0) { ?>
                <div class="col-md-12">
                    <table class="cart-table table table-bordered">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($cart as $key => $value) {
                                    $cartsql = "SELECT * FROM `products` WHERE `id`=$key";
                                    $cartres = mysqli_query($connection, $cartsql);
                                    $cartr = mysqli_fetch_assoc($cartres);
                            ?>
                            <tr>
                                <td>
                                    <a class="remove" href="<?php echo getenv('STORE_URL'); ?>/delcart.php?id=<?php echo $key; ?>"><i class="fa fa-times"></i></a>
                                </td>
                                <td>
                                    <a href="#"><img src="<?php echo getenv('STORE_URL'); ?>/admin/<?php echo $cartr['thumb']; ?>" alt="" height="90" width="90"></a>
                                </td>
                                <td>
                                    <a href="<?php echo getenv('STORE_URL'); ?>/single.php?id=<?php echo $cartr['id']; ?>"><?php echo substr($cartr['name'], 0 , 30); ?></a>
                                </td>
                                <td>
                                    <span class="amount"><?php echo getenv('STORE_CURRENCY') .  $cartr['price']; ?></span>
                                </td>
                                <td>
                                    <div class="quantity"><?php echo $value['quantity']; ?></div>
                                </td>
                                <td>
                                    <span class="amount"><?php echo getenv('STORE_CURRENCY') .  ($cartr['price']*$value['quantity']); ?></span>
                                </td>
                            </tr>
                            <?php
                                    $total = $total + ($cartr['price']*$value['quantity']);
                                }
                            ?>
                            <tr>
                                <td colspan="6" class="actions">
                                    <!-- <div class="col-md-6">
                                        <div class="coupon">
                                            <label>Coupon:</label><br>
                                            <input placeholder="Coupon code" type="text"><button type="submit">Apply</button>
                                        </div>
                                    </div> -->
                                    <div class="col-md-6">
                                        <div class="cart-btn">
                                            <a href="<?php echo getenv('STORE_URL'); ?>/checkout.php" class="button btn-md" style="color:white;">Checkout</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="cart_totals">
                    <div class="col-md-6 push-md-6 no-padding">
                        <h4 class="heading">Cart Totals</h4>
                        <table class="table table-bordered col-md-6">
                            <tbody>
                                <tr>
                                    <th>Cart Subtotal</th>
                                    <td><span class="amount"><?php echo getenv('STORE_CURRENCY') . $total; ?></span></td>
                                </tr>
                                <tr>
                                    <th>Shipping and Handling</th>
                                    <td>Free Shipping</td>
                                </tr>
                                <tr>
                                    <th>Order Total</th>
                                    <td><strong><span class="amount"><?php echo getenv('STORE_CURRENCY') . $total; ?></span></strong> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php } else { ?>
                <div class="col-md-6 col-md-offset-3">
                    <h2>Please add something to your cart!</h2>
                </div>
            <?php } ?>
            </div>
        </div>
    </div>
</section>

<?php include INC . 'footer.php'; ?>
