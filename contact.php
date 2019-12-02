<?php

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
                    <h2>Contact Us</h2>
                    <p>You can contact us using;</p>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="row">
                        <h2>Options</h2>
                        <hr>
                        <div class="col-sm-6">
                            <h4>Email:Sokonet@gmail.com</h4>
                            <br>
                            <h4>Phone: 0773255631</h4>
                            <br>
                            <h4>WhatsApp: 0716168704</h4>
                            <br>
                        </div>
                        <div class="col-sm-6">
                            <h4><a href="mailto:<?php echo getenv('SALES_EMAIL', null); ?>?subject=Website+Enquiry"><?php echo getenv('SALES_EMAIL', null); ?></a></h4>
                            <br>
                            <h4><a href="tel:<?php echo getenv('SALES_TELEPHONE', null); ?>"><?php echo getenv('SALES_TELEPHONE', null); ?></a></h4>
                            <br>
                            <h4><a href="https://api.whatsapp.com/send?phone=<?php echo getenv('SALES_WHATSAPP', null); ?>"><?php echo getenv('SALES_WHATSAPP', null); ?></a></h4>
                            <br>
                        </div>
                    </div>
                    <div class="clearfix space20"></div>
                    <div class="row">
                        <h2>Our Address Details</h2>
                        <hr>
                        <div class="col-sm-12">
                            <h3><?php echo getenv('COMPANY_NAME', null); ?></h3>
                            <br>
                            <p><?php echo getenv('ADDRESS_LINE_ONE', null); ?></p>
                            <p><?php echo getenv('ADDRESS_LINE_TWO', null); ?></p>
                            <p><?php echo getenv('ADDRESS_SUBURB', null); ?></p>
                            <p><?php echo getenv('ADDRESS_CITY', null); ?></p>
                            <p><?php echo getenv('ADDRESS_STATE', null); ?></p>
                            <p><?php echo getenv('ADDRESS_COUNTRY', null); ?></p>
                            <p><?php echo getenv('ADDRESS_POSTAL_CODE', null); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <h2>Come Visit Us</h2>
                    <hr>
                    <!-- <div id="map-pop"></div> -->
                </div>
            </div>
        </div>
    </div>
</section>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo getenv('GOOGLE_MAPS_API_KEY', null); ?>&v=quarterly&callback=initMap" type="text/javascript"></script>
<script src="<?php echo getenv('STORE_URL'); ?>/assets/js/gmap.js"></script>

<?php include INC . 'footer.php'; ?>
