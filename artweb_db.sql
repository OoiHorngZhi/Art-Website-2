-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2023 at 03:01 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `artweb_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
(1, 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(3, 'haha', '7c4a8d09ca3762af61e59520943dc26494f8941b');

-- --------------------------------------------------------

--
-- Table structure for table `auction_table`
--

CREATE TABLE `auction_table` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(10) NOT NULL,
  `image_01` varchar(100) NOT NULL,
  `artists` varchar(500) NOT NULL,
  `artist_details` varchar(500) NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=active,1=hidden	'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auction_table`
--

INSERT INTO `auction_table` (`id`, `name`, `details`, `price`, `image_01`, `artists`, `artist_details`, `isActive`) VALUES
(2, 'Study of Clouds with a Sunset near Rome', 'Dark, swirling clouds loom over a narrow strip of land, gently punctuated by far-off trees and a city skyline. The place is Rome. The weather: an impending rainstorm. The day: a late afternoon within the last decades of the 1700s.', 2500, '64c717ea-b7b1-46ea-900f-b045ee1d62d0_1024.jpg', 'Simon-Joseph-Alexandre-Clément Denis', 'Denis first studied in his native city of Antwerp, with the landscape and animal painter H.-J. Antonissen. The work of Balthasar Paul Ommeganck also influenced his style.\r\n\r\nHe moved to Paris in the 1780s, and soon gained the patronage of genre painter and art dealer Jean-Baptiste-Pierre Lebrun [fr], whose support allowed him to move to Rome in 1786. His paintings there attracted favorable attention, and in 1787 he married a local woman. He remained close to the Flemish community in Rome, and in', 0),
(6, 'The Grand Canyon of the Yellowstone', 'Thomas Moran, The Grand Canyon of the Yellowstone, 1893-1901', 2000, 'yellowstone.webp', 'Thomas Moran', 'Born Bolton, England 1837-died Santa Barbara, CA 1926', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(17, 1, 5, 'Bacon Toll', 1200, 1, 'lynn-chen-desserttoll.jpg'),
(18, 2, 4, 'Washington – President’s House', 1500, 2, 'SAAM-1966.48.62_1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(1, 1, 'haha', 'sky524walker@gmail.com', '0123456', 'haha'),
(2, 1, 'test', 'p19011068@student.newinti.edu.my', '0123456', 'testing '),
(3, 2, 'testing', 'p19011068@student.newinti.edu.my', '0123456', 'testing 1'),
(4, 0, 'testing', 'sky524walker@gmail.com', '0123456', 'testing');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(1, 1, 'haha', '3.375e+8', 'sky524walker@gmail.com', 'cash on delivery', 'flat no. 101, JALAN SENTOSA, TAMAN BUKIT RIA, 111, BUKIT MERTAJAM, PENANG, Malaysia - 14000', 'revan (1111 x 1) - ', 1111, '2023-10-19', 'pending'),
(2, 1, 'haha', '111', 'haha@gmail.com', 'cash on delivery', 'flat no. 101, JALAN SENTOSA, TAMAN BUKIT RIA, 111, BUKIT MERTAJAM, PENANG, Malaysia - 14000', 'revan (1111 x 2) - ', 2222, '2023-10-19', 'completed'),
(3, 2, 'sky', '123456', 'xskywalker989@gmail.com', 'cash on delivery', 'flat no. 101, Jalan sentosa, taman bukit ria, bukit mertajam, penang, malaysia - 14000', 'Washington – President’s House (1500 x 1) - ', 1500, '2023-11-09', 'pending'),
(4, 2, 'sky', '123456', 'xskywalker989@gmail.com', 'cash on delivery', 'flat no. 101, JALAN SENTOSA, taman bukit ria, BUKIT MERTAJAM, PENANG, Malaysia - 14000', 'Bacon Toll (1200 x 1) - ', 1200, '2023-11-10', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(10) NOT NULL,
  `category` varchar(20) NOT NULL,
  `image_01` varchar(100) NOT NULL,
  `artists` varchar(500) NOT NULL,
  `artist_details` varchar(500) NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=active,1=hidden'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `price`, `category`, `image_01`, `artists`, `artist_details`, `isActive`) VALUES
(3, 'Schwender Colosseum in Mariahilfer Straße', 'Enjoy the view of Schwender Colosseum', 1000, 'painting', '525914ldsdl.jpg', 'Ernst Graner', 'Ernst Graner was an Austrian watercolorist born in 1865 in Werdau / Saxony. From 1885-89 he studied at the Vienna Academy with Eduard von Lichtenfels and is considered one of the best-known Viennese watercolorists of his time.', 0),
(4, 'Washington – President’s House', 'Washington--President&#39;s House, 1848', 1500, 'prints', 'SAAM-1966.48.62_1.jpg', ' Isidore Laurent Deroy Copy after Augustus Kollner', 'French, born Paris, France 1797-died Paris, France 1886', 0),
(5, 'Bacon Toll', 'Corgi crossing bacon toll by Lynn Chen ', 1200, 'digitalart', 'lynn-chen-desserttoll.jpg', 'Lynn Chen ', 'Specialized in Illustration, doodles, animation, digital art', 0);

-- --------------------------------------------------------

--
-- Table structure for table `review_table`
--

CREATE TABLE `review_table` (
  `review_id` int(11) NOT NULL,
  `pid` int(100) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_review` text NOT NULL,
  `datetime` int(11) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review_table`
--

INSERT INTO `review_table` (`review_id`, `pid`, `user_name`, `user_review`, `datetime`, `email`) VALUES
(1, 2, 'ooi', 'Bid for RM400', 1699115844, 'sky524walker@gmail.com'),
(2, 2, 'ooi', 'Bid for RM500', 1699273787, 'sky524walker@gmail.com'),
(3, 2, 'test', 'Bid for RM600', 1699273945, 'sky524walker@gmail.com'),
(5, 2, 'testing', 'Bid for RM4000', 1699516689, 'sky524walker@gmail.com'),
(9, 2, 'test', 'test', 1699558061, 'sky524walker@gmail.com'),
(10, 2, 'test', 'test\n', 1699611323, 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `timer`
--

CREATE TABLE `timer` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `h` int(50) NOT NULL,
  `m` int(50) NOT NULL,
  `s` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timer`
--

INSERT INTO `timer` (`id`, `date`, `h`, `m`, `s`) VALUES
(1, '2023-11-10', 8, 21, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'user', 'user@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(2, 'sky', 'xskywalker989@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(3, 'test', 'test@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b');

-- --------------------------------------------------------

--
-- Table structure for table `user_photo`
--

CREATE TABLE `user_photo` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `image_01` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_photo`
--

INSERT INTO `user_photo` (`id`, `user_id`, `name`, `details`, `image_01`) VALUES
(6, 1, 'assassin', 'user', 'wp7326122-assassins-creed-4k-wallpapers.jpg'),
(9, 1, 'testing ', 'testing', 'wallpaperflare.com_wallpaper.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auction_table`
--
ALTER TABLE `auction_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review_table`
--
ALTER TABLE `review_table`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `timer`
--
ALTER TABLE `timer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_photo`
--
ALTER TABLE `user_photo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `auction_table`
--
ALTER TABLE `auction_table`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `review_table`
--
ALTER TABLE `review_table`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_photo`
--
ALTER TABLE `user_photo`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
