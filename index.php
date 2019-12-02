<?php


/**
 * Check platform requirements.
 */
require __DIR__ . '/config/requirements.php';

/**
 * Load the bootstrap file.
 */
require __DIR__ . '/config/bootstrap.php';

/**
 * Load the template files.
 */
include INC . 'header.php';
include INC . 'nav.php';
?>

<!-- SHOP CONTENT -->
<section id="content">
    <div class="content-blog">
        <div class="container">
            <div class="row">
                <div class="page_header text-center">
                    <h2>Shop</h2>
                    <p>Browse our collection of Consumable goods</p>
                </div>
                <div class="col-md-12">
                        <div id="shop-mason" class="shop-mason-3col">
                            <div class="row">
                            <?php
                            // Get a list of all the products; either for the home page or the
                            // individual category pages.
                            if (isset($_GET['id']) & !empty($_GET['id'])) {
                                $catId = $database->Escape($_GET['id']);
                                $products = $database->select("id, name, thumb, price", "products", "WHERE `catid`='$catId'");
                            } else {
                                $products = $database->select("id, name, thumb, price", "products");
                            }
                            // Run through all the products and display the items.
                            while ($product = $products->fetch_assoc()):
                                // This checks for every third product item in the list and
                                // outputs a clearfix component to ensure our layout renders
                                // as expected and ensures the products all line up correctly.
                                $count++;
                                if ($count % 4 == 0) {
                                    echo '<div class="clearfix space35"></div>';
                                }
                            ?>
                                <div class="shop-item">
                                    <div class="product">
                                        <div class="product-thumb">
                                            <img src="<?php echo getenv('STORE_URL'); ?>/admin/<?php echo $product['thumb']; ?>" class="img-responsive" width="250px" alt="">
                                            <div class="product-overlay">
                                                <span>
                                                    <a href="<?php echo getenv('STORE_URL'); ?>/single.php?id=<?php echo $product['id']; ?>" class="fa fa-link"></a>
                                                    <a href="<?php echo getenv('STORE_URL'); ?>/addtocart.php?id=<?php echo $product['id']; ?>" class="fa fa-shopping-cart"></a>
                                                </span>
                                            </div>
                                        </div>
                                        <?php // TODO: Need to add functionality so people can rate items.  ?>
                                        <!-- <div class="rating">
                                            <span class="fa fa-star act"></span>
                                            <span class="fa fa-star act"></span>
                                            <span class="fa fa-star act"></span>
                                            <span class="fa fa-star act"></span>
                                            <span class="fa fa-star act"></span>
                                        </div> -->
                                        <h2 class="product-title"><a href="<?php echo getenv('STORE_URL'); ?>/single.php?id=<?php echo $product['id']; ?>"><?php echo $product['name']; ?></a></h2>
                                        <div class="product-price"><?php echo getenv('STORE_CURRENCY') . $product['price']; ?><span></span></div>
                                    </div>
                                </div>
                            <?php
                        endwhile; ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <!-- Pagination -->
                    
                    <!-- <div class="page_nav">
                        <a href=""><i class="fa fa-angle-left"></i></a>
                        <a href="" class="active">1</a>
                        <a href="">2</a>
                        <a href="">3</a>
                        <a class="no-active">...</a>
                        <a href="">9</a>
                        <a href=""><i class="fa fa-angle-right"></i></a>
                    </div> -->
                    <!-- End Pagination -->
                </div>
            </div>
        </div>
    </div>
</section>

<?php include INC . 'footer.php'; ?>
