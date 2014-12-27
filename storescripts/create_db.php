<?php

$db_host = "localhost"; 
// Place the username for the MySQL database here 
$db_username = "root";
// Place the password for the MySQL database here 
$db_pass = "";
// Place the name for the MySQL database here 
$db_name = "buycom";

// Run the actual connection here  
$link = mysqli_connect("$db_host","$db_username","$db_pass") or die ("could not connect to mysql");
mysqli_select_db($link,"$db_name") or die ("no database"); 
$query = "
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(24) NOT NULL,
  `password` varchar(24) NOT NULL,
  `last_log_date` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
TRUNCATE TABLE `admin`;
INSERT INTO `admin` (`id`, `username`, `password`, `last_log_date`) VALUES
(1, 'admin', '1234', '2014-12-10');

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `price` varchar(16) NOT NULL,
  `details` text NOT NULL,
  `category` varchar(50) NOT NULL,
  `subcategory` varchar(50) NOT NULL,
  `date_added` date NOT NULL,
  `added_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_name` (`product_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

TRUNCATE TABLE `products`;
INSERT INTO `products` (`id`, `product_name`, `price`, `details`, `category`, `subcategory`, `date_added`, `added_by`) VALUES
(1, 'black pant', '50.50', 'nice original pant form usa', 'Clothing', 'Pants', '2014-12-15', 12),
(3, 'galaxy note edge', '1500', 'new model of note made by samsung in 2014 ', 'Electronics', 'Phones', '2014-12-16', 12),
(4, 'nikon 800', '1200', 'pro camera with 20x zooming ', 'Electronics', 'Cameras And Photos', '2014-12-16', 12),
(5, 'prologic 7.1ch', '500', 'virtual 7.1 Dolby surround headset  ', 'Electronics', 'Computer Accessories', '2014-12-16', 12),
(6, 'building blocks', '500', 'safety toy for kids', 'Toys', 'Kids Toys', '2014-12-17', 12);

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id_array` varchar(255) NOT NULL,
  `payer_email` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `payment_date` varchar(255) NOT NULL,
  `mc_gross` varchar(255) NOT NULL,
  `payment_currency` varchar(255) NOT NULL,
  `txn_id` varchar(255) NOT NULL,
  `receiver_email` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `txn_type` varchar(255) NOT NULL,
  `payer_status` varchar(255) NOT NULL,
  `address_street` varchar(255) NOT NULL,
  `address_city` varchar(255) NOT NULL,
  `address_state` varchar(255) NOT NULL,
  `address_zip` varchar(255) NOT NULL,
  `address_country` varchar(255) NOT NULL,
  `address_status` varchar(255) NOT NULL,
  `notify_version` varchar(255) NOT NULL,
  `verify_sign` varchar(255) NOT NULL,
  `payer_id` varchar(255) NOT NULL,
  `mc_currency` varchar(255) NOT NULL,
  `mc_fee` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `txn_id` (`txn_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

TRUNCATE TABLE `user`;

INSERT INTO `user` (`id`, `fullname`, `username`, `password`, `email`, `date_created`, `date_modified`) VALUES
(2, 'Gayan Madhura', 'Gayan', '21232f297a57a5a743894a0e4a801fc3', 'gayan@gmail.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Niroop Magalage', 'niroop', '47e3bf0f50f05903c4201c92cae2576a', 'nir@gmail.com', '2014-12-27 06:17:25', '2014-12-27 02:05:03'),
(12, 'Admin', 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'admin@gmail.com', NULL, '0000-00-00 00:00:00');

";
$queryArr = explode(';',$query);
foreach ($queryArr as $single_query) {
    mysqli_query($link,$single_query);
}
echo "Done";
?>