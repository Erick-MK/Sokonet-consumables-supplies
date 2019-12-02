-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 02, 2019 at 08:00 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `firstname`, `lastname`, `email`, `password`) VALUES
(2, 'barry', 'allen', 'admin@gmail.com', '$2y$10$JeayOQtF13rFtDy89Ipp.OhFfxK3qjHUKkSB8b/ypQuPqCPRpQ2TO');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Toiletry'),
(2, 'Beverages'),
(3, 'snacks'),
(7, 'kitchenware'),
(8, 'etc');

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `pquantity` varchar(255) NOT NULL,
  `productprice` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`id`, `pid`, `orderid`, `pquantity`, `productprice`) VALUES
(1, 4, 1, '5', '16'),
(2, 4, 2, '5', '16'),
(3, 1, 2, '2', '20990'),
(4, 1, 3, '1', '20990'),
(5, 5, 3, '10', '99'),
(7, 6, 4, '1', '75'),
(8, 2, 5, '1', '7590'),
(9, 4, 5, '10', '16'),
(10, 4, 7, '1', '16'),
(11, 6, 7, '1', '75'),
(12, 5, 7, '2', '99'),
(13, 6, 8, '1', '75'),
(14, 4, 8, '1', '16'),
(16, 1, 10, '1', '20990'),
(17, 8, 11, '1', '1200'),
(18, 6, 12, '1', '75'),
(20, 9, 13, '1', '700'),
(21, 6, 14, '1', '75'),
(22, 5, 14, '1', '99'),
(23, 4, 15, '1', '16'),
(24, 9, 15, '1', '700'),
(25, 4, 16, '1', '16'),
(26, 6, 16, '1', '75'),
(27, 6, 17, '1', '75'),
(28, 5, 17, '1', '99'),
(29, 1, 18, '1', '1200'),
(30, 4, 19, '1', '16'),
(31, 5, 19, '1', '99');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `totalprice` varchar(255) NOT NULL,
  `orderstatus` varchar(255) NOT NULL,
  `paymentmode` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `uid`, `totalprice`, `orderstatus`, `paymentmode`, `timestamp`) VALUES
(1, 2, '80', 'Order Placed', 'cod', '2019-10-16 12:22:36'),
(2, 2, '42060', 'Order Placed', 'cod', '2019-10-16 12:27:16'),
(3, 2, '21980', 'Cancelled', 'cod', '2019-10-16 14:25:23'),
(4, 2, '12965', 'In Progress', 'cod', '2019-10-16 14:28:29'),
(5, 2, '7750', 'In Progress', 'cod', '2019-10-16 19:40:34'),
(7, 2, '289', 'Order Placed', 'on', '2019-10-16 23:12:18'),
(8, 20, '91', 'Order Placed', 'cod', '2019-11-29 19:40:16'),
(9, 20, '12890', 'Order Placed', 'on', '2019-11-29 19:42:38'),
(10, 20, '20990', 'Order Placed', 'on', '2019-11-29 19:44:18'),
(11, 20, '1200', 'Order Placed', 'cod', '2019-11-29 20:53:58'),
(12, 21, '12965', 'Order Placed', 'cod', '2019-11-29 23:45:52'),
(13, 21, '700', 'Dispatched', 'on', '2019-11-29 23:55:34'),
(14, 22, '174', 'Order Placed', 'cod', '2019-12-01 15:22:01'),
(15, 22, '716', 'Order Placed', 'cod', '2019-12-02 01:33:03'),
(16, 21, '91', 'Order Placed', 'cod', '2019-12-02 01:35:40'),
(17, 24, '174', 'Order Placed', 'on', '2019-12-02 03:03:18'),
(18, 24, '1200', 'Order Placed', 'on', '2019-12-02 03:35:04'),
(19, 25, '115', 'Order Placed', 'cod', '2019-12-02 15:21:20');

-- --------------------------------------------------------

--
-- Table structure for table `ordertracking`
--

CREATE TABLE `ordertracking` (
  `id` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ordertracking`
--

INSERT INTO `ordertracking` (`id`, `orderid`, `status`, `message`, `timestamp`) VALUES
(1, 3, 'Cancelled', 'I do not want this item now.', '2018-10-16 17:54:18'),
(2, 4, 'In Progress', ' Order is in Progress', '2018-10-16 13:31:08'),
(3, 5, 'In Progress', ' Order is in Progress', '2018-10-16 19:45:11'),
(4, 13, 'Dispatched', ' dty', '2019-12-01 10:52:02');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `catid` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `catid`, `price`, `thumb`, `description`) VALUES
(1, 'nescafe\r\n', 2, '1200', 'uploads/nescafe_outer.jpeg', 'Very high quality 12grams instant coffee\r\n'),
(2, 'heineken 6pack', 2, '1200', 'uploads/heineken-can_6pack.jpeg', 'get your 6 pack can of quality heineken'),
(3, 'wisdom shampoo', 1, '12890', 'uploads/wisdom-shampoo.jpeg', 'makes your hair smooth and shiny\r\n'),
(4, 'Cardiff cotton buds', 1, '16', 'uploads/cardiff-cottonbuds.jpeg', 'Silky smooth cotton buds for your ears\' comfort'),
(5, 'miles_almandoz-liquor', 2, '99', 'uploads/miles_almandoz-liquor.jpeg', 'triple-distilled whiskey'),
(6, 'lifebuoy family soap', 1, '75', 'uploads/lifebuoy-carton.jpeg', 'lifebuoy is a disinfectant and bathing soap'),
(8, 'Pepsi Carton', 2, '1200', 'uploads/pepsi_carton.jpeg', 'Pepsi carton wholesaling at Ksh. 1200'),
(9, 'ahava body cream', 1, '700', 'uploads/ahava-ointment.jpeg', 'purified mineral water');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `review` text NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `pid`, `uid`, `review`, `timestamp`) VALUES
(1, 1, 2, 'It is an awesome Product!', '2019-11-26 15:18:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `timestamp`) VALUES
(1, 'justin@hartman.me', '26e0eca228b42a520565415246513c0d', '2019-10-15 12:05:10'),
(2, 'justin@22digital.agency', '$2y$10$.eu/GvIuz58XRl/KIlOZl.xO0cH0TH./KmGfoxn/VXAZ5XVTmd.sa', '2019-10-16 22:18:12'),
(3, 'elvis@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2019-11-24 23:08:28'),
(4, 'erick@gmail.com', '', '2019-11-24 23:17:16'),
(5, 'elvis3@gmail.com', '', '2019-11-24 23:19:05'),
(6, 'elvis4@gmail.com', '', '2019-11-24 23:20:38'),
(8, 'elvis1@gmail.com', '', '2019-11-25 15:17:32'),
(10, 'elvis6@gmail.com', '', '2019-11-25 22:32:01'),
(11, 'triza@gmail.com', '', '2019-11-25 23:09:02'),
(12, 'waka@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2019-11-26 23:32:06'),
(13, 'mwende@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2019-11-27 12:19:12'),
(14, 'edwin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2019-11-27 13:22:09'),
(15, 'bjorn@gmail.com', '36fdb505d1f4fbedfdcf6c254c904813', '2019-11-28 11:09:23'),
(16, 'amos@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2019-11-28 11:33:41'),
(17, 'kevin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2019-11-29 12:19:20'),
(19, 'me@gmail.com', '$2y$10$w10vL5jRiwaUP8sLsWv8meXWnhV4fRz5XmFFYliNIaU.XyqYjryJu', '2019-11-29 12:57:45'),
(20, 'mule@gmail.com', '$2y$10$jNqOAHXkaL1T7VmputY0YuvKHgrPSPVCWlrnRU7/JgeeB7y2omu6y', '2019-11-29 16:56:44'),
(21, 'ounyo@gmail.com', '$2y$10$fuk1BwRgVTVKnj2o30eGye7tL7iBdhm9wtzhUCa2iY3o8eEXXIG3e', '2019-11-29 23:42:56'),
(22, 'vicky@gmail.com', '$2y$10$whVL4QXaDuzdV14.ByJdhO7aVKCsJaZARZJPSrzAhT94aws8asHEW', '2019-12-01 14:41:46'),
(24, 'aka@gmail.com', '$2y$10$LPHdYInF7vbuZ9TasENX/ORpJEF6wIns.Vp.7bsGApdS2zsLZCZ9W', '2019-12-02 02:05:28'),
(25, 'ngich@gmail.com', '$2y$10$V5WxNljPQGWJf8WQXef00uPTbFJcMZge5axcdhG1uFJUhw2GjmUN6', '2019-12-02 15:19:06');

-- --------------------------------------------------------

--
-- Table structure for table `usersmeta`
--

CREATE TABLE `usersmeta` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `estate` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usersmeta`
--

INSERT INTO `usersmeta` (`id`, `uid`, `firstname`, `lastname`, `company`, `address1`, `address2`, `city`, `estate`, `mobile`) VALUES
(1, 2, 'Justin', 'Hartman', '22 Digital', '47A Woodgate Road', 'Plumstead', 'Cape Town', 'Western Cape', '0722290848'),
(2, 20, 'tyfuqwe', 'ewty', 'tuiweio', '4353', 'uyfoi', 'fuy', 'wsyuy', '5463'),
(3, 21, 'elvis', 'mambo', 'pentagon', '2342', 'beaver ', 'nairobi', 'ohio', '0721974175'),
(4, 22, 'Victor', 'Mugo', 'Mathogothanio', '1234', 'Base', 'Thika', 'Runda', '0734251678'),
(5, 24, 'Horeb', 'Anwar', 'Blight & Gloom', '567', 'PeeKay', 'Nairobi', 'Kisii', '0776538294'),
(6, 25, 'ngich', 'x', 'chura', '654', 'abc', 'Eldoret', 'runda', '0783452637');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `pid`, `uid`, `timestamp`) VALUES
(1, 1, 2, '2019-10-16 16:36:45'),
(2, 2, 2, '2019-10-16 16:38:07'),
(3, 3, 2, '2019-10-16 19:42:35'),
(4, 4, 2, '2019-10-16 22:52:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_idx` (`email`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pid_products_id_idx` (`pid`),
  ADD KEY `fk_orderid_orders_id_idx` (`orderid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_uid_users_id_idx` (`uid`);

--
-- Indexes for table `ordertracking`
--
ALTER TABLE `ordertracking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orderid_orders_id_idx` (`orderid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_catid_category_id_idx` (`catid`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pid_products_id_idx` (`pid`),
  ADD KEY `fk_uid_users_id_idx` (`uid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_idx` (`email`);

--
-- Indexes for table `usersmeta`
--
ALTER TABLE `usersmeta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_uid_users_id_idx` (`uid`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_uid_users_id_idx` (`uid`),
  ADD KEY `fk_pid_products_id_idx` (`pid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `ordertracking`
--
ALTER TABLE `ordertracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `usersmeta`
--
ALTER TABLE `usersmeta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `fk_orderitems_orderid_orders_id` FOREIGN KEY (`orderid`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `fk_orderitems_pid_products_id` FOREIGN KEY (`pid`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_uid_users_id` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);

--
-- Constraints for table `ordertracking`
--
ALTER TABLE `ordertracking`
  ADD CONSTRAINT `fk_ordertracking_orderid_orders_id` FOREIGN KEY (`orderid`) REFERENCES `orders` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_catid_category_id` FOREIGN KEY (`catid`) REFERENCES `category` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_reviews_pid_products_id` FOREIGN KEY (`pid`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `fk_reviews_uid_users_id` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);

--
-- Constraints for table `usersmeta`
--
ALTER TABLE `usersmeta`
  ADD CONSTRAINT `fk_usersmeta_uid_users_id` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `fk_wishlist_pid_products_id` FOREIGN KEY (`pid`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `fk_wishlist_uid_users_id` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
