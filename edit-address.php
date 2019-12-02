<?php

require __DIR__ . '/config/bootstrap.php';


ob_start();
if (!isset($_SESSION['customer']) & empty($_SESSION['customer'])) {
    header('location: login.php');
}

// Flush the output buffering cache.
ob_flush();

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
$userMeta = $database->singleSelect("*", "usersmeta", "WHERE `uid`='$uid'");
// $sql = "SELECT * FROM `usersmeta` WHERE `uid`='$uid'";
// $res = $connection->query($sql);
// $count = $res->num_rows;
// $r = $res->fetch_assoc();

/**
 * Add or Update the Address details in the Database.
 */
if (isset($_POST) && !empty($_POST)) {
    $city   = $database->escape($_POST['city']);
    // $country   = $database->escape($_POST['country']);
    $firstName = $database->escape($_POST['fname']);
    $surname   = $database->escape($_POST['lname']);
    $company   = $database->escape($_POST['company']);
    $address1  = $database->escape($_POST['address1']);
    $address2  = $database->escape($_POST['address2']);
    // $city      = $database->escape($_POST['city']);
    $estate     = $database->escape($_POST['estate']);
    $phone     = $database->escape($_POST['phone']);
    // $zip       = $database->escape($_POST['zipcode']);

    // We either use an UPDATE or INSERT statement depending on whether or not
    // the user has added their address details before.
    if ($count === 1) {
        $sqlStatement = "UPDATE `usersmeta` SET `city`='$city', `firstname`='$firstName', `lastname`='$surname', `address1`='$address1', `address2`='$address2', `estate`='$estate', `company`='$company', `mobile`='$phone' WHERE `uid`=$uid";
    } elseif ($count === 0) {
        $sqlStatement = "INSERT INTO `usersmeta` (`city`, `firstname`, `lastname`, `address1`, `address2`, `estate`, `company`, `mobile`, `uid`) VALUES ('$city', '$firstName', '$surname', '$address1', '$address2', '$estate', '$company', '$phone', '$uid')";
    }
    // Setup the Update or Insert query.
    $queryResult = $connection->query($sqlStatement);

    // Check that all the required details have been completed in the form.
    if (!empty($city) && !empty($firstName) && !empty($surname) && !empty($address1) && !empty($estate) && !empty($phone)) {
        // Update or Insert the Address details by saving the data to MySQL.
        if ($queryResult === TRUE) {
            // Return a success message.
            header("location: edit-address.php?message=success");
        } else {
            // Return a General error message.
            header("location: edit-address.php?message=error");
        }
    } else {
        // Return an error message asking them to fill in all their details.
        header("location: edit-address.php?message=warning");
    }
}
?>


<!-- SHOP CONTENT -->
<section id="content">
    <div class="content-blog">
        <div class="page_header text-center">
            <h2>Update Address</h2>
            <p><?php echo getenv('STORE_TAGLINE'); ?></p>
        </div>
        <form method="post">
            <div class="container">
            <?php if (isset($_GET['message'])) : ?>
                <div class="row">
                <?php if ($_GET['message'] == 'success') : ?>
                    <div class="col-sm-12">
                        <h3 class="uppercase text-center">Address Updated Successfully</h3>
                        <br>
                        <div class="alert alert-success text-center" role="alert">
                            <?php echo "Congratulations, we have successfully updated your Address details."; ?>
                        </div>
                    </div>
                <?php elseif ($_GET['message'] == 'error') : ?>
                    <div class="col-sm-12">
                        <h3 class="uppercase text-center">Failed to Update your Address details</h3>
                        <br>
                        <div class="alert alert-danger text-center" role="alert">
                            <?php echo "There were errors while trying to process your Address details! Please make sure that you have completed all the fields in the Address form below and try again."; ?>
                        </div>
                    </div>
                <?php elseif ($_GET['message'] == 'warning') : ?>
                    <div class="col-sm-12">
                        <h3 class="uppercase text-center">Please fill in all your Details</h3>
                        <br>
                        <div class="alert alert-warning text-center" role="alert">
                            <?php echo "You have not completed all the form fields below and we cannot update your Address. Please make sure that you have completed all the fields in the Address form below and try again."; ?>
                        </div>
                    </div>
                <?php endif; ?>
                </div>
            <?php endif; ?>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="billing-details">
                            <h3 class="uppercase">Update My Address</h3>
                            <br>
                            <p>Fields marked in <i style="color:tomato;">*</i> are required fields and you need to complete them before updating your address.</p>
                            <br>
                            <label class="">City <i style="color:tomato;">*</i></label>
                            <select name="country" class="form-control" required>
                                <?php
                                if (!empty($userMeta['city'])) {
                                    echo '<option value="'.$userMeta['city'].'">'.$userMeta['city'].'</option>';
                                } else {
                                    echo '<option value="">Select City</option>'. "\n";
                                } ?>
                                <option value="Nairobi">Nairobi</option>
                                <option value="Eldoret">Eldoret</option>
                                <option value="Nakuru">Nakuru</option>
                                <option value="Thika">Thika</option>
                               
                            </select>
                            <div class="clearfix space20"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>First Name <i style="color:tomato;">*</i></label>
                                    <input name="fname" class="form-control" placeholder="" value="<?php if (!empty($userMeta['firstname'])) {
                                        echo $userMeta['firstname'];
                                    } elseif (isset($firstName)) {
                                        echo $firstName;
                                    } ?>" type="text" required>
                                </div>
                                <div class="col-md-6">
                                    <label>Last Name <i style="color:tomato;">*</i></label>
                                    <input name="lname" class="form-control" placeholder="" value="<?php if (!empty($userMeta['lastname'])) {
                                        echo $userMeta['lastname'];
                                    } elseif (isset($surname)) {
                                        echo $surname;
                                    } ?>" type="text" required>
                                </div>
                            </div>
                            <div class="clearfix space20"></div>
                            <label>Company Name</label>
                            <input name="company" class="form-control" placeholder="" value="<?php if (!empty($userMeta['company'])) {
                                echo $userMeta['company'];
                            } elseif (isset($company)) {
                                echo $company;
                            } ?>" type="text">
                            <div class="clearfix space20"></div>
                            <label>Address <i style="color:tomato;">*</i></label>
                            <input name="address1" class="form-control" placeholder="Street address" value="<?php if (!empty($userMeta['address1'])) {
                                echo $userMeta['address1'];
                            } elseif (isset($address1)) {
                                echo $address1;
                            } ?>" type="text" required>
                            <div class="clearfix space20"></div>
                            <input name="address2" class="form-control" placeholder="Apartment, suite, unit etc. (optional)" value="<?php if (!empty($userMeta['address2'])) {
                                echo $userMeta['address2'];
                            } elseif (isset($address2)) {
                                echo $address2;
                            } ?>" type="text">
                            <div class="clearfix space20"></div>
                            <div class="row">
                                
                                <div class="col-md-4">
                                    <label>Estate <i style="color:tomato;">*</i></label>
                                    <input name="estate" class="form-control" value="<?php if (!empty($userMeta['estate'])) {
                                        echo $userMeta['estate'];
                                    } elseif (isset($estate)) {
                                        echo $estate;
                                    } ?>" placeholder="estate" type="text" required>
                                </div>
                                
                            </div>
                            <div class="clearfix space20"></div>
                            <label>Phone <i style="color:tomato;">*</i></label>
                            <input name="phone" class="form-control" id="billing_phone" placeholder="" value="<?php if (!empty($userMeta['mobile'])) {
                                echo $userMeta['mobile'];
                            } elseif (isset($phone)) {
                                echo $phone;
                            } ?>" type="text" required>
                            <div class="space30"></div>
                            <input type="submit" class="button btn-md" value="Update Address">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<?php //include INC . 'footer.php'; ?>
