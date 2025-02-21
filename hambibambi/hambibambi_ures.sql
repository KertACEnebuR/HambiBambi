CREATE TABLE `Users` (
  `user_id` int PRIMARY KEY AUTO_INCREMENT,
  `address_id` int,
  `full_name` varchar(255),
  `email` varchar(255),
  `password` varchar(255),
  `phone_number` varchar(255),
  `regitration_date` date
);

CREATE TABLE `Products` (
  `product_id` int PRIMARY KEY AUTO_INCREMENT,
  `product_category_id` int,
  `quantity_unit_id` int,
  `product_name` varchar(255),
  `price` int,
  `description` varchar(255),
  `picture` varchar(255)
);

CREATE TABLE `Quantity_Units` (
  `quantity_unit_id` int PRIMARY KEY AUTO_INCREMENT,
  `quantity_unit_value` varchar(255)
);

CREATE TABLE `Product_Categories` (
  `product_category_id` int PRIMARY KEY AUTO_INCREMENT,
  `product_group_id` int,
  `product_category_name` text
);

CREATE TABLE `Product_Groups` (
  `product_group_id` int PRIMARY KEY AUTO_INCREMENT,
  `product_group_name` text
);

CREATE TABLE `Baskets` (
  `basket_id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int,
  `order_id` int,
  `designation` varchar(255),
  `quantity` int
);

CREATE TABLE `Orders` (
  `order_id` int PRIMARY KEY AUTO_INCREMENT,
  `product_id` int,
  `user_id` int,
  `payment_id` int,
  `order_status_id` int,
  `order_date` datetime,
  `delivery_date` datetime
);

CREATE TABLE `Order_Statuses` (
  `order_status_id` int PRIMARY KEY AUTO_INCREMENT,
  `status` varchar(255)
);

CREATE TABLE `Payments` (
  `payment_id` int PRIMARY KEY AUTO_INCREMENT,
  `payment_method` varchar(255)
);

CREATE TABLE `Reviews` (
  `review_id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int,
  `product_id` int,
  `description` varchar(255),
  `review_date` datetime
);

CREATE TABLE `Counties` (
  `county_id` int PRIMARY KEY AUTO_INCREMENT,
  `county_name` text
);

CREATE TABLE `Admin` (
  `admin_id` int PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(255),
  `password` varchar(255)
);

CREATE TABLE `Settlements` (
  `settlement_id` int PRIMARY KEY AUTO_INCREMENT,
  `county_id` int,
  `settlement_name` text,
  `postcode` int
);

CREATE TABLE `Addresses` (
  `address_id` int PRIMARY KEY AUTO_INCREMENT,
  `settlement_id` int,
  `street_name` varchar(255),
  `house_number` varchar(255)
);
ALTER TABLE `Baskets` ADD CONSTRAINT UNIQUE (`order_id`);

ALTER TABLE `Users` ADD FOREIGN KEY (`address_id`) REFERENCES `Addresses` (`address_id`);

ALTER TABLE `Products` ADD FOREIGN KEY (`product_category_id`) REFERENCES `Product_Categories` (`product_category_id`);

ALTER TABLE `Products` ADD FOREIGN KEY (`quantity_unit_id`) REFERENCES `Quantity_Units` (`quantity_unit_id`);

ALTER TABLE `Product_Categories` ADD FOREIGN KEY (`product_group_id`) REFERENCES `Product_Groups` (`product_group_id`);

ALTER TABLE `Baskets` ADD FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`);

ALTER TABLE `Orders` ADD FOREIGN KEY (`order_id`) REFERENCES `Baskets` (`order_id`);

ALTER TABLE `Orders` ADD FOREIGN KEY (`product_id`) REFERENCES `Products` (`product_id`);

ALTER TABLE `Orders` ADD FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`);

ALTER TABLE `Orders` ADD FOREIGN KEY (`payment_id`) REFERENCES `Payments` (`payment_id`);

ALTER TABLE `Orders` ADD FOREIGN KEY (`order_status_id`) REFERENCES `Order_Statuses` (`order_status_id`);

ALTER TABLE `Reviews` ADD FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`);

ALTER TABLE `Reviews` ADD FOREIGN KEY (`product_id`) REFERENCES `Products` (`product_id`);

ALTER TABLE `Settlements` ADD FOREIGN KEY (`county_id`) REFERENCES `Counties` (`county_id`);

ALTER TABLE `Addresses` ADD FOREIGN KEY (`settlement_id`) REFERENCES `Settlements` (`settlement_id`);
