DROP TABLE IF EXISTS `billdetail`;
CREATE TABLE IF NOT EXISTS `billdetail` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `bill_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `quantity` varchar(10) NOT NULL,
  `taka_no` int(10) DEFAULT NULL,
  `rate` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=405 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `bill_data`;
CREATE TABLE IF NOT EXISTS `bill_data` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `product_id` int(10) NOT NULL,
  `quantity` varchar(10) NOT NULL,
  `rate` varchar(10) NOT NULL,
  `cust_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `bill_list`;
CREATE TABLE IF NOT EXISTS `bill_list` (
  `bill_id` int(10) NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(10) NOT NULL,
  `sub_total` varchar(10) NOT NULL,
  `grand_total` varchar(10) NOT NULL,
  `round_off` varchar(10) NOT NULL,
  `cust_id` int(10) NOT NULL,
  `place_of_supply` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `cust_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone_no` varchar(20) DEFAULT NULL,
  `gstin_no` varchar(20) DEFAULT NULL,
  `pan_no` varchar(20) DEFAULT NULL,
  `place_of_supply` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`cust_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `customers` (`name`, `address`, `phone_no`, `gstin_no`, `pan_no`, `place_of_supply`) VALUES
('M R Lace', '1st Floor Plot No. 107/a-b, Jay Narayan Industrial Soc, Anjana Farm, Surat, Gujarat - 394210', '', '24GAPPM6375H1Z4', 'GAPPM6375H', 'Gujarat ( 24 )');

DROP TABLE IF EXISTS `keys_`;
CREATE TABLE IF NOT EXISTS `keys_` (
  `id_no` int(11) NOT NULL,
  `key_val` varchar(19) NOT NULL,
  `valid` int(1) NOT NULL,
  PRIMARY KEY (`id_no`),
  UNIQUE KEY `key_val` (`key_val`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `hsn_no` varchar(10) DEFAULT NULL,
  `rate` varchar(10) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
INSERT INTO `products` (`name`, `hsn_no`, `rate`) VALUES
('R ANMOL', '5602', '250.00');

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(30) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `pass` varchar(50) DEFAULT NULL,
  `key_id` int(11) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `key_id` (`key_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `user_detail`;
CREATE TABLE IF NOT EXISTS `user_detail` (
  `username` varchar(30) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `owner_name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `gstin_no` varchar(20) DEFAULT NULL,
  `pan_no` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `bank_name` varchar(50) DEFAULT NULL,
  `bank_branch_name` varchar(50) DEFAULT NULL,
  `bank_ac_number` varchar(30) DEFAULT NULL,
  `ifsc_code` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `user_detail` (`username`, `company_name`, `owner_name`, `address`, `phone_no`, `gstin_no`, `pan_no`, `email`, `bank_name`, `bank_branch_name`, `bank_ac_number`, `ifsc_code`) VALUES
('admin', 'K P LON JARI', 'Italiya Kalpesh Pravinbhai', 'C-11 UNDERGROUND NARAYAN NAGAR 1 LIMBAYAT Surat, Gujarat - 395012', '9924680167', 'ABCDE1234567890', '123455ABCD', 'kalpesh.italiya7@gmail.com', 'ICICIBANK', 'SURAT UDHANA', '138505502617', 'ICIC0001385');
COMMIT;
