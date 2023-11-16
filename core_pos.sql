-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2023 at 05:32 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `core_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `created_at`, `updated_at`) VALUES
(26, 'Adidas', '2023-11-02 06:53:49', NULL),
(27, 'Nike', '2023-11-02 06:54:05', '2023-11-02 06:54:13'),
(28, 'Reebok', '2023-11-02 06:54:29', NULL),
(29, 'Puma', '2023-11-02 06:54:47', NULL),
(30, 'Skechers', '2023-11-02 06:55:04', NULL),
(31, 'BMW', '2023-11-02 06:55:10', NULL),
(32, 'Gucci', '2023-11-02 06:55:42', NULL),
(33, 'Pran', '2023-11-02 08:02:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `created_at`, `updated_at`) VALUES
(12, 'Oil', '2023-11-02 07:10:51', NULL),
(13, 'shoe', '2023-11-02 07:12:09', NULL),
(14, 'Chanachur', '2023-11-02 07:12:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone`, `email`, `address`, `gender`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Obaidul Quader', '01776183778', 'obaidulquader@gmail.com', 'Dhanmondi', 'male', 'active', '2023-11-02 07:02:13', NULL),
(5, 'Hussain Muhammad Ershad', '01776183778', 'ershad@gmail.com', 'Bonani', 'male', 'active', '2023-11-02 07:04:08', NULL),
(6, 'Walkout customer', '01776183778', 'walkout@gmail.com', ' Moon', 'female', 'inactive', '2023-11-02 07:07:51', '2023-11-07 13:29:33');

-- --------------------------------------------------------

--
-- Table structure for table `draft_invoice`
--

CREATE TABLE `draft_invoice` (
  `id` int(11) NOT NULL,
  `customer_name` int(100) NOT NULL,
  `invoice_date` varchar(255) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `total_value` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `draft_invoice`
--

INSERT INTO `draft_invoice` (`id`, `customer_name`, `invoice_date`, `invoice_no`, `total_value`, `created_at`, `updated_at`) VALUES
(8, 4, '2023-11-10', '111115', '1710', '2023-11-09 04:53:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `draft_invoice_details`
--

CREATE TABLE `draft_invoice_details` (
  `id` int(11) NOT NULL,
  `customer_id` int(100) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `product_id` int(100) NOT NULL,
  `unit_id` varchar(255) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `draft_invoice_details`
--

INSERT INTO `draft_invoice_details` (`id`, `customer_id`, `invoice_no`, `product_id`, `unit_id`, `price`, `quantity`, `value`, `created_at`, `updated_at`) VALUES
(13, 4, '111115', 10, 'Kg', 342, 5, '1710', '2023-11-09 04:53:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `draft_parchase`
--

CREATE TABLE `draft_parchase` (
  `id` int(11) NOT NULL,
  `supplier_name` int(100) NOT NULL,
  `parchase_date` varchar(255) NOT NULL,
  `referance` varchar(255) NOT NULL,
  `total_amount` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `draft_parchase_details`
--

CREATE TABLE `draft_parchase_details` (
  `id` int(11) NOT NULL,
  `supplier_id` int(100) NOT NULL,
  `parchase_date` varchar(100) NOT NULL,
  `referance` varchar(255) NOT NULL,
  `product_name` bigint(100) NOT NULL,
  `quantity` bigint(100) NOT NULL,
  `unit_price` bigint(100) NOT NULL,
  `sub_total_price` bigint(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `product_id` int(50) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `store_id` int(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `product_id`, `quantity`, `store_id`, `status`, `created_at`, `updated_at`) VALUES
(5, 9, '-298', 3, 'Active', '2023-11-02 08:18:35', '2023-11-09 12:27:18'),
(6, 10, '207', 3, 'Active', '2023-11-02 08:19:07', '2023-11-08 09:47:50'),
(7, 11, '5', 3, 'Active', '2023-11-02 08:19:25', '2023-11-09 13:20:24'),
(8, 12, '197', 3, 'Active', '2023-11-08 11:20:13', '2023-11-09 10:44:49'),
(9, 14, '-2', 3, 'Active', '2023-11-09 12:25:37', '2023-11-09 12:28:04');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `customer_name` int(100) NOT NULL,
  `invoice_date` varchar(255) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `total_value` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `customer_name`, `invoice_date`, `invoice_no`, `total_value`, `created_at`, `updated_at`) VALUES
(19, 4, '2023-11-07', '111111', '28047', '2023-11-07 04:47:15', '2023-11-09 07:03:55'),
(21, 5, '2023-11-08', '111113', '11559', '2023-11-07 06:47:57', '2023-11-09 10:44:49'),
(31, 4, '2023-11-09', '111116', '7998', '2023-11-09 13:20:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` int(11) NOT NULL,
  `customer_id` int(100) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `product_id` int(100) NOT NULL,
  `unit_id` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `value` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `customer_id`, `invoice_no`, `product_id`, `unit_id`, `price`, `quantity`, `value`, `created_at`, `updated_at`) VALUES
(37, 4, '111111', 9, 'Kg', 780, 3, '2340', '2023-11-07 04:47:15', '2023-11-09 07:03:55'),
(38, 4, '111111', 10, 'Kg', 342, 5, '1710', '2023-11-07 04:47:15', NULL),
(39, 4, '111111', 11, 'ps', 3999, 1, '3999', '2023-11-07 05:42:42', NULL),
(41, 5, '111113', 9, 'Kg', 780, 2, '1560', '2023-11-07 06:47:57', NULL),
(44, 4, '111111', 12, 'ps', 9999, 2, '19998', '2023-11-08 11:20:40', NULL),
(45, 5, '111113', 12, 'ps', 9999, 1, '9999', '2023-11-09 10:44:49', NULL),
(54, 4, '111116', 11, 'ps', 3999, 2, '7998', '2023-11-09 13:20:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `measurements`
--

CREATE TABLE `measurements` (
  `id` int(11) NOT NULL,
  `measurement_name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `measurements`
--

INSERT INTO `measurements` (`id`, `measurement_name`, `status`, `created_at`, `updated_at`) VALUES
(7, 'Kg', 'active', '2023-11-02 06:56:44', NULL),
(8, 'ps', 'active', '2023-11-02 06:58:12', '2023-11-07 10:42:44'),
(9, 'ltr', 'active', '2023-11-02 06:58:27', NULL),
(10, 'Ml', 'active', '2023-11-02 06:59:07', NULL),
(11, 'Grm', 'active', '2023-11-02 06:59:28', NULL),
(12, 'Packet', 'active', '2023-11-02 06:59:39', NULL),
(13, 'Carton', 'active', '2023-11-02 07:00:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parchase`
--

CREATE TABLE `parchase` (
  `id` int(11) NOT NULL,
  `supplier_name` int(100) NOT NULL,
  `parchase_date` varchar(255) NOT NULL,
  `referance` varchar(255) NOT NULL,
  `total_amount` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parchase`
--

INSERT INTO `parchase` (`id`, `supplier_name`, `parchase_date`, `referance`, `total_amount`, `created_at`, `updated_at`) VALUES
(60, 5, '2023-11-02', '111111', '488600', '2023-11-02 08:21:01', NULL),
(61, 6, '2023-11-09', '77777', '19998', '2023-11-08 05:27:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parchase_details`
--

CREATE TABLE `parchase_details` (
  `id` int(11) NOT NULL,
  `supplier_id` int(100) NOT NULL,
  `referance` varchar(255) NOT NULL,
  `parchase_date` varchar(255) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `unit_price` varchar(255) NOT NULL,
  `sub_total_price` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parchase_details`
--

INSERT INTO `parchase_details` (`id`, `supplier_id`, `referance`, `parchase_date`, `product_name`, `quantity`, `unit_price`, `sub_total_price`, `created_at`, `updated_at`) VALUES
(103, 5, '111111', '2023-11-02', '9', '350', '780', '273000', '2023-11-02 08:21:01', NULL),
(104, 5, '111111', '2023-11-02', '10', '220', '980', '215600', '2023-11-02 08:21:01', NULL),
(105, 6, '77777', '2023-11-09', '12', '2', '9999', '19998', '2023-11-08 05:27:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `brand_id` bigint(50) NOT NULL,
  `barcode` bigint(50) NOT NULL,
  `category_id` bigint(50) NOT NULL,
  `subcategory_id` bigint(50) NOT NULL,
  `product_image` varchar(5000) NOT NULL,
  `measure_purchase_id` bigint(50) NOT NULL,
  `measure_sale_id` bigint(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `brand_id`, `barcode`, `category_id`, `subcategory_id`, `product_image`, `measure_purchase_id`, `measure_sale_id`, `status`, `created_at`, `updated_at`) VALUES
(9, 'Pran Soyabean Oil 5L', 33, 12131, 12, 8, 'soyabean-oil-5ltr.jpg', 7, 7, 'active', '2023-11-02 08:10:12', '2023-11-06 10:36:43'),
(10, 'Pran Mustard Oil 2L', 33, 12112, 12, 9, '0418193_pran-mustard-oil-500ml_400.jpeg', 7, 7, 'active', '2023-11-02 08:13:30', '2023-11-06 10:36:54'),
(11, 'Addison Leather Shoe', 26, 13223, 13, 11, '748-01-300x300.jpg', 8, 8, 'active', '2023-11-02 08:16:38', NULL),
(12, 'Puma Leather Shoe', 29, 121213, 13, 11, 'images (1).jpeg', 13, 8, 'active', '2023-11-02 10:11:33', NULL),
(13, 'Pran Chanachur', 33, 321321, 14, 11, 'download.jpeg', 8, 8, 'active', '2023-11-09 11:19:19', NULL),
(14, 'pran dal', 33, 231214, 14, 11, 'download.jpeg', 8, 8, 'active', '2023-11-09 12:25:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_price`
--

CREATE TABLE `product_price` (
  `id` int(11) NOT NULL,
  `product_id` int(100) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_price`
--

INSERT INTO `product_price` (`id`, `product_id`, `product_price`, `created_at`, `updated_at`) VALUES
(1, 9, '780', '2023-11-06 10:37:27', '2023-11-06 11:33:45'),
(3, 10, '342', '2023-11-06 11:35:36', '2023-11-06 11:35:47'),
(4, 11, '3999', '2023-11-07 05:38:56', NULL),
(5, 12, '9999', '2023-11-08 11:19:38', NULL),
(6, 14, '10', '2023-11-09 12:25:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `id` int(11) NOT NULL,
  `store_name` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`id`, `store_name`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Gulshan', 'Active', '2023-11-02 08:03:28', NULL),
(4, 'Demra', 'Active', '2023-11-02 08:03:59', NULL),
(5, 'Mirpur', 'Active', '2023-11-02 08:04:08', NULL),
(6, 'Azimpur', 'Active', '2023-11-02 08:04:32', '2023-11-08 05:03:36');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `id` int(11) NOT NULL,
  `sub_category_name` varchar(250) DEFAULT NULL,
  `category_id` bigint(30) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id`, `sub_category_name`, `category_id`, `created_at`, `updated_at`) VALUES
(8, 'soybean oil', 12, '2023-11-02 07:55:37', NULL),
(9, 'mustard oil', 12, '2023-11-02 07:56:00', NULL),
(10, 'Palm Oil', 12, '2023-11-02 07:56:35', NULL),
(11, 'Boot', 13, '2023-11-02 07:57:16', NULL),
(12, 'Sneakers', 13, '2023-11-02 07:57:40', NULL),
(13, 'Sandal', 13, '2023-11-02 07:57:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `supplier_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `brand_id` bigint(30) NOT NULL,
  `status` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `supplier_name`, `phone`, `email`, `address`, `brand_id`, `status`, `created_at`, `updated_at`) VALUES
(5, 'Kamal', '01776183778', 'kamal@gmail.com', 'konapara', 26, 'Active', '2023-11-02 07:59:44', NULL),
(6, 'Jamal', '01776183778', 'jamal@gmail.com', 'Demra', 27, 'Active', '2023-11-02 08:00:33', NULL),
(7, 'Rahim', '01776183778', 'rahim@gmail.com', 'Gulshan', 31, 'Active', '2023-11-02 08:01:30', NULL),
(8, 'Korim', '01776183778', 'karim@gmail.com', 'Badda', 33, 'Active', '2023-11-02 08:03:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `phone`, `email`, `password`, `user_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Robin', '01776183778', 'smrobin136@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'Admin', 'Active', '2023-10-19 10:14:31', '2023-11-07 09:07:18'),
(3, 'Sheikh Mujib', '01776183778', 'sheikhmujib@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'Cashier', 'Active', '2023-10-19 10:32:24', '2023-11-07 09:07:25'),
(8, 'Sheikh Hasina', '01555888555', 'sheikhhasina@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'Cashier', 'Active', '2023-11-02 06:48:20', '2023-11-07 09:06:18'),
(10, 'Khaleda Zia', '01847416158', 'khaledazia@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'Cashier', 'Active', '2023-11-02 06:51:51', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `draft_invoice`
--
ALTER TABLE `draft_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `draft_invoice_details`
--
ALTER TABLE `draft_invoice_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `draft_parchase`
--
ALTER TABLE `draft_parchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `draft_parchase_details`
--
ALTER TABLE `draft_parchase_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `measurements`
--
ALTER TABLE `measurements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parchase`
--
ALTER TABLE `parchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parchase_details`
--
ALTER TABLE `parchase_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_price`
--
ALTER TABLE `product_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `draft_invoice`
--
ALTER TABLE `draft_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `draft_invoice_details`
--
ALTER TABLE `draft_invoice_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `draft_parchase`
--
ALTER TABLE `draft_parchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `draft_parchase_details`
--
ALTER TABLE `draft_parchase_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `measurements`
--
ALTER TABLE `measurements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `parchase`
--
ALTER TABLE `parchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `parchase_details`
--
ALTER TABLE `parchase_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_price`
--
ALTER TABLE `product_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
