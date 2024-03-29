

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema ecommerce
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `ecommerce` ;

-- -----------------------------------------------------
-- Schema ecommerce
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ecommerce` DEFAULT CHARACTER SET utf8 ;
USE `ecommerce` ;

-- -----------------------------------------------------
-- Table `ecommerce`.`admin`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ecommerce`.`admin` ;

CREATE TABLE IF NOT EXISTS `ecommerce`.`admin` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(255) NOT NULL,
  `lastname` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_idx` (`email` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ecommerce`.`category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ecommerce`.`category` ;

CREATE TABLE IF NOT EXISTS `ecommerce`.`category` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ecommerce`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ecommerce`.`users` ;

CREATE TABLE IF NOT EXISTS `ecommerce`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `timestamp` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_idx` (`email` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ecommerce`.`orders`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ecommerce`.`orders` ;

CREATE TABLE IF NOT EXISTS `ecommerce`.`orders` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` INT(11) NOT NULL,
  `totalprice` VARCHAR(255) NOT NULL,
  `orderstatus` VARCHAR(255) NOT NULL,
  `paymentmode` VARCHAR(255) NOT NULL,
  `timestamp` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_uid_users_id_idx` (`uid` ASC),
  CONSTRAINT `fk_orders_uid_users_id`
    FOREIGN KEY (`uid`)
    REFERENCES `ecommerce`.`users` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ecommerce`.`products`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ecommerce`.`products` ;

CREATE TABLE IF NOT EXISTS `ecommerce`.`products` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `catid` INT(11) NOT NULL,
  `price` VARCHAR(255) NOT NULL,
  `thumb` VARCHAR(255) NOT NULL,
  `description` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_catid_category_id_idx` (`catid` ASC),
  CONSTRAINT `fk_products_catid_category_id`
    FOREIGN KEY (`catid`)
    REFERENCES `ecommerce`.`category` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ecommerce`.`orderitems`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ecommerce`.`orderitems` ;

CREATE TABLE IF NOT EXISTS `ecommerce`.`orderitems` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `pid` INT(11) NOT NULL,
  `orderid` INT(11) NOT NULL,
  `pquantity` VARCHAR(255) NOT NULL,
  `productprice` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_pid_products_id_idx` (`pid` ASC),
  INDEX `fk_orderid_orders_id_idx` (`orderid` ASC),
  CONSTRAINT `fk_orderitems_orderid_orders_id`
    FOREIGN KEY (`orderid`)
    REFERENCES `ecommerce`.`orders` (`id`),
  CONSTRAINT `fk_orderitems_pid_products_id`
    FOREIGN KEY (`pid`)
    REFERENCES `ecommerce`.`products` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ecommerce`.`ordertracking`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ecommerce`.`ordertracking` ;

CREATE TABLE IF NOT EXISTS `ecommerce`.`ordertracking` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `orderid` INT(11) NOT NULL,
  `status` VARCHAR(255) NOT NULL,
  `message` TEXT NOT NULL,
  `timestamp` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_orderid_orders_id_idx` (`orderid` ASC),
  CONSTRAINT `fk_ordertracking_orderid_orders_id`
    FOREIGN KEY (`orderid`)
    REFERENCES `ecommerce`.`orders` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ecommerce`.`reviews`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ecommerce`.`reviews` ;

CREATE TABLE IF NOT EXISTS `ecommerce`.`reviews` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `pid` INT(11) NOT NULL,
  `uid` INT(11) NOT NULL,
  `review` TEXT NOT NULL,
  `timestamp` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_pid_products_id_idx` (`pid` ASC),
  INDEX `fk_uid_users_id_idx` (`uid` ASC),
  CONSTRAINT `fk_reviews_pid_products_id`
    FOREIGN KEY (`pid`)
    REFERENCES `ecommerce`.`products` (`id`),
  CONSTRAINT `fk_reviews_uid_users_id`
    FOREIGN KEY (`uid`)
    REFERENCES `ecommerce`.`users` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ecommerce`.`usersmeta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ecommerce`.`usersmeta` ;

CREATE TABLE IF NOT EXISTS `ecommerce`.`usersmeta` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` INT(11) NOT NULL,
  `firstname` VARCHAR(255) NOT NULL,
  `lastname` VARCHAR(255) NOT NULL,
  `company` VARCHAR(255) NOT NULL,
  `address1` VARCHAR(255) NOT NULL,
  `address2` VARCHAR(255) NOT NULL,
  `city` VARCHAR(255) NOT NULL,
  `state` VARCHAR(255) NOT NULL,
  `country` VARCHAR(255) NOT NULL,
  `zip` VARCHAR(255) NOT NULL,
  `mobile` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_uid_users_id_idx` (`uid` ASC),
  CONSTRAINT `fk_usersmeta_uid_users_id`
    FOREIGN KEY (`uid`)
    REFERENCES `ecommerce`.`users` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ecommerce`.`wishlist`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ecommerce`.`wishlist` ;

CREATE TABLE IF NOT EXISTS `ecommerce`.`wishlist` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `pid` INT(11) NOT NULL,
  `uid` INT(11) NOT NULL,
  `timestamp` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_uid_users_id_idx` (`uid` ASC),
  INDEX `fk_pid_products_id_idx` (`pid` ASC),
  CONSTRAINT `fk_wishlist_pid_products_id`
    FOREIGN KEY (`pid`)
    REFERENCES `ecommerce`.`products` (`id`),
  CONSTRAINT `fk_wishlist_uid_users_id`
    FOREIGN KEY (`uid`)
    REFERENCES `ecommerce`.`users` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `ecommerce`.`admin`
-- -----------------------------------------------------
START TRANSACTION;
USE `ecommerce`;
INSERT INTO `ecommerce`.`admin` (`id`, `firstname`, `lastname`, `email`, `password`) VALUES (1, 'Justin', 'Hartman', 'justin@hartman.me', '26e0eca228b42a520565415246513c0d');

COMMIT;


-- -----------------------------------------------------
-- Data for table `ecommerce`.`category`
-- -----------------------------------------------------
START TRANSACTION;
USE `ecommerce`;
INSERT INTO `ecommerce`.`category` (`id`, `name`) VALUES (1, 'Mobiles');
INSERT INTO `ecommerce`.`category` (`id`, `name`) VALUES (2, 'Cameras');
INSERT INTO `ecommerce`.`category` (`id`, `name`) VALUES (3, 'Books');

COMMIT;


-- -----------------------------------------------------
-- Data for table `ecommerce`.`users`
-- -----------------------------------------------------
START TRANSACTION;
USE `ecommerce`;
INSERT INTO `ecommerce`.`users` (`id`, `email`, `password`, `timestamp`) VALUES (1, 'justin@hartman.me', '26e0eca228b42a520565415246513c0d', '2018-10-15 12:05:10');
INSERT INTO `ecommerce`.`users` (`id`, `email`, `password`, `timestamp`) VALUES (2, 'justin@22digital.agency', '$2y$10$.eu/GvIuz58XRl/KIlOZl.xO0cH0TH./KmGfoxn/VXAZ5XVTmd.sa', '2018-10-16 22:18:12');

COMMIT;


-- -----------------------------------------------------
-- Data for table `ecommerce`.`orders`
-- -----------------------------------------------------
START TRANSACTION;
USE `ecommerce`;
INSERT INTO `ecommerce`.`orders` (`id`, `uid`, `totalprice`, `orderstatus`, `paymentmode`, `timestamp`) VALUES (1, 2, '80', 'Order Placed', 'cod', '2018-10-16 12:22:36');
INSERT INTO `ecommerce`.`orders` (`id`, `uid`, `totalprice`, `orderstatus`, `paymentmode`, `timestamp`) VALUES (2, 2, '42060', 'Order Placed', 'cod', '2018-10-16 12:27:16');
INSERT INTO `ecommerce`.`orders` (`id`, `uid`, `totalprice`, `orderstatus`, `paymentmode`, `timestamp`) VALUES (3, 2, '21980', 'Cancelled', 'cod', '2018-10-16 14:25:23');
INSERT INTO `ecommerce`.`orders` (`id`, `uid`, `totalprice`, `orderstatus`, `paymentmode`, `timestamp`) VALUES (4, 2, '12965', 'In Progress', 'cod', '2018-10-16 14:28:29');
INSERT INTO `ecommerce`.`orders` (`id`, `uid`, `totalprice`, `orderstatus`, `paymentmode`, `timestamp`) VALUES (5, 2, '7750', 'In Progress', 'cod', '2018-10-16 19:40:34');
INSERT INTO `ecommerce`.`orders` (`id`, `uid`, `totalprice`, `orderstatus`, `paymentmode`, `timestamp`) VALUES (7, 2, '289', 'Order Placed', 'on', '2018-10-16 23:12:18');

COMMIT;


-- -----------------------------------------------------
-- Data for table `ecommerce`.`products`
-- -----------------------------------------------------
START TRANSACTION;
USE `ecommerce`;
INSERT INTO `ecommerce`.`products` (`id`, `name`, `catid`, `price`, `thumb`, `description`) VALUES (1, 'Canon EOS 1300D 18MP Digital SLR Camera (Black) with 18-55mm ISII Lens, 16GB Card and Carry Case', 2, '20990', 'uploads/Canon EOS 200D 24 2MP.jpg', 'The EOS 1300D packs in all the fun of photography, which is why we recommend it to users looking for their very first EOS DSLR camera. It uses an 18-megapixel APS-C size sensor and the DIGIC 4+ image processor');
INSERT INTO `ecommerce`.`products` (`id`, `name`, `catid`, `price`, `thumb`, `description`) VALUES (2, 'Sony DSC W830 Cyber-shot 20.1 MP Point and Shoot Camera (Black) with 8x Optical Zoom, Memory Card and Camera Case', 2, '7590', 'uploads/Sony Alpha a6000 Mirrorless Digital.jpg', 'The Sony DSC W830 Cyber-shot 20.1 MP Point and Shoot Camera (Black) with 8x Optical Zoom is a powerful camera full of features that put it at par with any professional DSLR. It is packed with a super HAD CCD sensor that comes with 20.1 effective megapixel');
INSERT INTO `ecommerce`.`products` (`id`, `name`, `catid`, `price`, `thumb`, `description`) VALUES (3, 'Sony Cyber-shot DSC-H300/BC E32 point & Shoot Digital camera ', 2, '12890', 'uploads/Sony Alpha ILCA-77M2Q 24 3MP.jpg', 'The High zoom camera Sony Cyber-shot H300, with a powerful 35x optical zoom, brings your subject to you for beautiful, precise pictures. A 20.1MP sensor, HD video and creative features, let you capture detailed images and movies with ease. A DSLR-style bo');
INSERT INTO `ecommerce`.`products` (`id`, `name`, `catid`, `price`, `thumb`, `description`) VALUES (4, 'General Knowledge 2018', 3, '16', 'uploads/General Knowledge 2018.jpg', 'An editorial team of highly skilled professionals at Arihant, works hand in glove to ensure that the students receive the best and accurate content through our books. From inception till the book comes out from print, the whole team comprising of authors,');
INSERT INTO `ecommerce`.`products` (`id`, `name`, `catid`, `price`, `thumb`, `description`) VALUES (5, 'The Power of your Subconscious Mind', 3, '99', 'uploads/The Power of your Subconscious Mind.jpg', 'It\'s a very good n very useful book n it should be read by each n every one ...to knw the things that are not aware and know about the mind power .. Super duper book --ByAmazon Customeron 19 March 2018');
INSERT INTO `ecommerce`.`products` (`id`, `name`, `catid`, `price`, `thumb`, `description`) VALUES (6, 'Think and Grow Rich', 3, '75', 'uploads/Think and Grow Rich.jpg', 'An American journalist, lecturer and author, Napoleon Hill is one of the earliest producers of \'personal-success literature . As an author of self-help books, Hill has always abided by and promoted principle of intense and burning passion being the sole k');

COMMIT;


-- -----------------------------------------------------
-- Data for table `ecommerce`.`orderitems`
-- -----------------------------------------------------
START TRANSACTION;
USE `ecommerce`;
INSERT INTO `ecommerce`.`orderitems` (`id`, `pid`, `orderid`, `pquantity`, `productprice`) VALUES (1, 4, 1, '5', '16');
INSERT INTO `ecommerce`.`orderitems` (`id`, `pid`, `orderid`, `pquantity`, `productprice`) VALUES (2, 4, 2, '5', '16');
INSERT INTO `ecommerce`.`orderitems` (`id`, `pid`, `orderid`, `pquantity`, `productprice`) VALUES (3, 1, 2, '2', '20990');
INSERT INTO `ecommerce`.`orderitems` (`id`, `pid`, `orderid`, `pquantity`, `productprice`) VALUES (4, 1, 3, '1', '20990');
INSERT INTO `ecommerce`.`orderitems` (`id`, `pid`, `orderid`, `pquantity`, `productprice`) VALUES (5, 5, 3, '10', '99');
INSERT INTO `ecommerce`.`orderitems` (`id`, `pid`, `orderid`, `pquantity`, `productprice`) VALUES (6, 3, 4, '1', '12890');
INSERT INTO `ecommerce`.`orderitems` (`id`, `pid`, `orderid`, `pquantity`, `productprice`) VALUES (7, 6, 4, '1', '75');
INSERT INTO `ecommerce`.`orderitems` (`id`, `pid`, `orderid`, `pquantity`, `productprice`) VALUES (8, 2, 5, '1', '7590');
INSERT INTO `ecommerce`.`orderitems` (`id`, `pid`, `orderid`, `pquantity`, `productprice`) VALUES (9, 4, 5, '10', '16');
INSERT INTO `ecommerce`.`orderitems` (`id`, `pid`, `orderid`, `pquantity`, `productprice`) VALUES (10, 4, 7, '1', '16');
INSERT INTO `ecommerce`.`orderitems` (`id`, `pid`, `orderid`, `pquantity`, `productprice`) VALUES (11, 6, 7, '1', '75');
INSERT INTO `ecommerce`.`orderitems` (`id`, `pid`, `orderid`, `pquantity`, `productprice`) VALUES (12, 5, 7, '2', '99');

COMMIT;


-- -----------------------------------------------------
-- Data for table `ecommerce`.`ordertracking`
-- -----------------------------------------------------
START TRANSACTION;
USE `ecommerce`;
INSERT INTO `ecommerce`.`ordertracking` (`id`, `orderid`, `status`, `message`, `timestamp`) VALUES (1, 3, 'Cancelled', 'I do not want this item now.', '2018-10-16 17:54:18');
INSERT INTO `ecommerce`.`ordertracking` (`id`, `orderid`, `status`, `message`, `timestamp`) VALUES (2, 4, 'In Progress', ' Order is in Progress', '2018-10-16 13:31:08');
INSERT INTO `ecommerce`.`ordertracking` (`id`, `orderid`, `status`, `message`, `timestamp`) VALUES (3, 5, 'In Progress', ' Order is in Progress', '2018-10-16 19:45:11');

COMMIT;


-- -----------------------------------------------------
-- Data for table `ecommerce`.`reviews`
-- -----------------------------------------------------
START TRANSACTION;
USE `ecommerce`;
INSERT INTO `ecommerce`.`reviews` (`id`, `pid`, `uid`, `review`, `timestamp`) VALUES (1, 1, 2, 'It is an awesome Product!', '2018-10-16 15:18:42');

COMMIT;


-- -----------------------------------------------------
-- Data for table `ecommerce`.`usersmeta`
-- -----------------------------------------------------
START TRANSACTION;
USE `ecommerce`;
INSERT INTO `ecommerce`.`usersmeta` (`id`, `uid`, `firstname`, `lastname`, `company`, `address1`, `address2`, `city`, `state`, `country`, `zip`, `mobile`) VALUES (1, 2, 'Justin', 'Hartman', '22 Digital', '47A Woodgate Road', 'Plumstead', 'Cape Town', 'Western Cape', 'South Africa', '7708', '0722290848');

COMMIT;


-- -----------------------------------------------------
-- Data for table `ecommerce`.`wishlist`
-- -----------------------------------------------------
START TRANSACTION;
USE `ecommerce`;
INSERT INTO `ecommerce`.`wishlist` (`id`, `pid`, `uid`, `timestamp`) VALUES (1, 1, 2, '2018-10-16 16:36:45');
INSERT INTO `ecommerce`.`wishlist` (`id`, `pid`, `uid`, `timestamp`) VALUES (2, 2, 2, '2018-10-16 16:38:07');
INSERT INTO `ecommerce`.`wishlist` (`id`, `pid`, `uid`, `timestamp`) VALUES (3, 3, 2, '2018-10-16 19:42:35');
INSERT INTO `ecommerce`.`wishlist` (`id`, `pid`, `uid`, `timestamp`) VALUES (4, 4, 2, '2018-10-16 22:52:23');

COMMIT;

