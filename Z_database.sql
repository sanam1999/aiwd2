





CREATE DATABASE IF NOT EXISTS `NearByHome` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `NearByHome`;
 

CREATE TABLE `Address` (
  `address_id` varchar(40) NOT NULL,
  `user_id` varchar(40) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `district` varchar(50) DEFAULT NULL,
  `zip_code` varchar(10) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` varchar(100) NOT NULL
) ;
 

INSERT INTO `Address` (`address_id`, `user_id`, `province`, `district`, `zip_code`, `phone_number`, `address`) VALUES
('fasdgfxcdsfasdzfasdfeasdfxcawesdfxc', 'ce4003f1bc48458786fa6d7a8b2b7247', 'dsfzxcdsxf', 'fdsfsdfsdafsda', '123111', '12323432', 'weasdfzxvcesfdczxesdzcxesdcxzewfsdcewfsd');



CREATE TABLE `Liked` (
  `like_id` varchar(40) NOT NULL,
  `user_id` varchar(40) DEFAULT NULL,
  `products_id` varchar(40) DEFAULT NULL,
  `status` varchar(10) DEFAULT ''
) ;


INSERT INTO `Liked` (`like_id`, `user_id`, `products_id`, `status`) VALUES
('1eb9fbda807b49259f4cea84d22da8e0', 'ce4003f1bc48458786fa6d7a8b2b7247', '8fb4b58159994434bedda1dfd58c978a', 'liked'),
('2c29cbd044ab45feb672cc034a095919', 'ce4003f1bc48458786fa6d7a8b2b7247', '102ae69ff7dc46fcb9c58c8cebec26f5', 'liked'),
('3c9aee7c026a43dc9bc0b72217c3c573', 'ce4003f1bc48458786fa6d7a8b2b7247', '472edc4b98b948ecafde96e3ddce2164', 'liked'),
('e1a7b6c4343f49e7a0372edd8036b7ad', 'ce4003f1bc48458786fa6d7a8b2b7247', 'a9d8a2308d20418c99bcd12b1042cf01', 'liked');



CREATE TABLE `Orders` (
  `order_id` varchar(40) NOT NULL,
  `user_id` varchar(40) DEFAULT NULL,
  `product_id` varchar(40) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `status` enum('Pending','Shipped','Delivered','Cancelled') NOT NULL DEFAULT 'Pending',
  `oder_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `quntity` int(2) NOT NULL DEFAULT 1
) ;



INSERT INTO `Orders` (`order_id`, `user_id`, `product_id`, `total`, `price`, `status`, `oder_date`, `quntity`) VALUES
('51ccf090b2044f2da544f7c66c01898e', 'ce4003f1bc48458786fa6d7a8b2b7247', 'a9d8a2308d20418c99bcd12b1042cf01', 245.00, 100.00, 'Shipped', '2024-07-16 12:36:39', 1);


CREATE TABLE `Products` (
  `product_id` varchar(40) NOT NULL,
  `user_id` varchar(40) DEFAULT NULL,
  `category` enum('Electronics','Fashion','Home & Garden','Mobile Phones','Laptops','Cameras','Men''s Clothing','Women''s Clothing','Shoes','Furniture') NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `condition` enum('New','Used','Refurbished') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `imageUrl` varchar(500) NOT NULL DEFAULT 'https://b2861582.smushcdn.com/2861582/wp-content/uploads/2023/02/splash-01-605-v1.png?lossy=2&strip=1&webp=1'
);

INSERT INTO `Products` (`product_id`, `user_id`, `category`, `title`, `description`, `price`, `stock`, `condition`, `created_at`, `imageUrl`) VALUES
('102ae69ff7dc46fcb9c58c8cebec26f5', 'ce4003f1bc48458786fa6d7a8b2b7247', 'Laptops', 'macbook air m1', '2023 macbook air', 1500000.00, 10, 'New', '2024-07-27 12:08:53', 'https://appleasia.lk/wp-content/uploads/2023/04/MacBook-Pro-14inch-Space-Grey-2023-Apple-Asia-1.webp'),
('472edc4b98b948ecafde96e3ddce2164', 'ce4003f1bc48458786fa6d7a8b2b7247', 'Fashion', 'phome', '6gb ram', 1234.00, 12, 'New', '2024-07-25 05:38:51', 'https://b2861582.smushcdn.com/2861582/wp-content/uploads/2023/02/splash-01-605-v1.png?lossy=2&strip=1&webp=1'),
('58cf5fb406f44ab1b957379e60623402', 'ce4003f1bc48458786fa6d7a8b2b7247', 'Cameras', 'g234', 'p900 ', 15000.00, 10, 'New', '2024-07-27 11:48:50', 'https://b2861582.smushcdn.com/2861582/wp-content/uploads/2023/02/splash-01-605-v1.png?lossy=2&strip=1&webp=1'),
('8fb4b58159994434bedda1dfd58c978a', 'ce4003f1bc48458786fa6d7a8b2b7247', 'Laptops', 'macbook pro ', 'macbook pro 2023 8gb ram', 200000.00, 10, 'New', '2024-07-27 11:47:32', 'https://b2861582.smushcdn.com/2861582/wp-content/uploads/2023/02/splash-01-605-v1.png?lossy=2&strip=1&webp=1'),
('a9d8a2308d20418c99bcd12b1042cf01', 'ce4003f1bc48458786fa6d7a8b2b7247', 'Laptops', 'lap', 'asdf', 100.00, 10, 'Refurbished', '2024-07-15 10:10:37', 'https://b2861582.smushcdn.com/2861582/wp-content/uploads/2023/02/splash-01-605-v1.png?lossy=2&strip=1&webp=1'),
('e522020bcd334082859b587216766574', 'ce4003f1bc48458786fa6d7a8b2b7247', 'Cameras', 'macbook air m2', '2023 macbook air', 1500000.00, 10, 'New', '2024-07-27 12:09:12', 'https://b2861582.smushcdn.com/2861582/wp-content/uploads/2023/02/splash-01-605-v1.png?lossy=2&strip=1&webp=1');



CREATE TABLE `Reviews` (
  `review_id` varchar(40) NOT NULL,
  `product_id` varchar(40) DEFAULT NULL,
  `user_id` varchar(40) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `review_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `uname` varchar(50) DEFAULT NULL
) ;



INSERT INTO `Reviews` (`review_id`, `product_id`, `user_id`, `rating`, `comment`, `review_date`, `uname`) VALUES
('1cd632f5942d442c947d69ad2fcea7bd', '102ae69ff7dc46fcb9c58c8cebec26f5', 'ce4003f1bc48458786fa6d7a8b2b7247', 1, 'nice', '2024-07-27 12:10:10', 'sanam');






CREATE TABLE `SystemFeedback` (
  `feedback_id` varchar(40) NOT NULL,
  `user_id` varchar(40) DEFAULT NULL,
  `comment` varchar(250) NOT NULL
) ;


INSERT INTO `SystemFeedback` (`feedback_id`, `user_id`, `comment`) VALUES
('05704e969c324139a4c8b9e74f5852eb', 'ce4003f1bc48458786fa6d7a8b2b7247', 'bye'),
('3491a1d861234795bf9e8891130a90af', 'ce4003f1bc48458786fa6d7a8b2b7247', 'thoispkdf'),
('364f7ad1c4d2496da6e6b44e225ca811', 'ce4003f1bc48458786fa6d7a8b2b7247', 'dsffasd'),
('7cfa8dbbf31746a8b93a525e7d8ba129', 'ce4003f1bc48458786fa6d7a8b2b7247', 'problem in creating accounts'),
('ae1d77f7774f4d9e8df5e7eb03310e30', 'ce4003f1bc48458786fa6d7a8b2b7247', 'dsfasfa'),
('b04dc7d700594b1a8db8e8383ed6d4f6', 'ce4003f1bc48458786fa6d7a8b2b7247', 'dfgdsfgdf'),
('bef36c47fd2f4eaeb2de6588948809dc', 'ce4003f1bc48458786fa6d7a8b2b7247', 'kljdfkljsdffsd'),
('f995126d102f4fc1b939a05a2a658db0', 'ce4003f1bc48458786fa6d7a8b2b7247', 'hi lamai');






CREATE TABLE `Users` (
  `user_id` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ;


INSERT INTO `Users` (`user_id`, `email`, `password_hash`, `name`) VALUES
('c4e118958ab640088213c4edc53b637d', 'sundar@gmail.com', '$2y$10$V0KApotz1HU6tmyLALy99eGsu0AaWuq04SaJhZhrZJyYKQJrYq5Hi', 'sundar'),
('ce4003f1bc48458786fa6d7a8b2b7247', 'sanam@gmail.com', '$2y$10$SyPlFmVg6GiuWGs3W.r.iewQ5e4F/If2cyE/NuDRlhVZ.3s4Wu1Ki', 'sanam');



 
ALTER TABLE `Address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `user_id` (`user_id`);
 
ALTER TABLE `Liked`
  ADD PRIMARY KEY (`like_id`),
  ADD UNIQUE KEY `unik` (`user_id`,`products_id`),
  ADD KEY `products_id` (`products_id`);
 
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);
 
ALTER TABLE `Products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `user_id` (`user_id`);
 
ALTER TABLE `Reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);
 
ALTER TABLE `SystemFeedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `user_id` (`user_id`);
 
ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);
 


 
ALTER TABLE `Address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`);
 
ALTER TABLE `Liked`
  ADD CONSTRAINT `liked_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `liked_ibfk_2` FOREIGN KEY (`products_id`) REFERENCES `Products` (`product_id`);
 
ALTER TABLE `Orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `Products` (`product_id`);
 
ALTER TABLE `Products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`);
 
ALTER TABLE `Reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `Products` (`product_id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`);
 
ALTER TABLE `SystemFeedback`
  ADD CONSTRAINT `systemfeedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ;


