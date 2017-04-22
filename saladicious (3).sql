-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2017 at 11:09 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saladicious`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `step` tinyint(1) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`step`, `name`) VALUES
(1, 'Lettuce'),
(1, 'Pasta'),
(1, 'Arugula'),
(2, 'Tomatoes'),
(2, 'Cucumber'),
(2, 'Red Kidney Beans'),
(2, 'Green Beans'),
(2, 'Black Olives'),
(2, 'Green Olives'),
(2, 'Chick Peas'),
(2, 'Sweet Corn'),
(2, 'Mushrooms'),
(2, 'Jalapeno'),
(2, 'Potatoes'),
(2, 'Broccoli'),
(2, 'Beetroot'),
(2, 'Onion'),
(2, 'Carrots'),
(2, 'Pepper'),
(3, 'White Cheese'),
(3, 'Roomy Cheese'),
(3, 'Cheddar'),
(3, 'Mozarella'),
(4, 'Grilled Chicken'),
(4, 'Barbeque Chicken'),
(4, 'Smoked Beef'),
(4, 'Smoked Turkey'),
(4, 'Tuna'),
(4, 'Crab'),
(4, 'Eggs'),
(5, 'Thousands Island'),
(5, 'Ranch'),
(5, 'Caesar'),
(5, 'Sweet Chili'),
(5, 'Italian Sauce'),
(5, 'Honey Mustard'),
(5, 'Olive Oil'),
(5, 'Balsamic Vinegar'),
(5, 'Lemon Sauce');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('salmaaibrahim96@gmail.com', '$2y$10$YvvbFBa16afH3.SwcOUTIeT6k9gxaHJZiXSwkeWj41O456uK5zdhe', '2017-04-19 15:52:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phonenumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `confirmationcode` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `firstname`, `lastname`, `password`, `phonenumber`, `confirmationcode`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'samar.gamal144@gmail.com', 'Samar', 'Gamal ElDin', '$2y$10$RGuOtBrCQlBbck0ayi1YU.R2ikHVI0MsyOIQ0vRG9HOn0QBYTIUjq', '01111661540', NULL, 'FBH6c8mbHMcEsrZdXDxVlPd4k111zsNJCSSDd1UnYbqfw066HDOCNLBiyrNz', '2017-04-18 10:40:28', '2017-04-21 20:48:18'),
(4, 'rana.amr.afifi@gmail.com', 'Rana', 'Afifi', '$2y$10$pJ6zhOECisSck111rUbaV.45xYjgy03aTP8bdNuIcGj6/fsjJLPGG', '01225557575', NULL, '838XWTNc6Q3iF7YMcymO2G4EpwyV9Nuw2EG55Z9oy6BfDRGHLkdxCYDG98f6', '2017-04-18 11:42:19', '2017-04-18 11:42:19'),
(5, 'ahmedhanaa@hotmail.com', 'Hanaa', 'Ahmed', '$2y$10$psTkXU5AWvVvMqPb2sfTLuG7vAx7JgPYGAim.OjLTNWrQPK93Vn5.', '01006633674', NULL, 'GbfU4p9KGuicfHmNwI7CJjPDUZWITzPQ4ldrxBxmOYJSWGM8qaKhWSEAlZpi', '2017-04-19 08:01:13', '2017-04-19 08:01:13'),
(6, 'salmaaibrahim96@gmail.com', 'Salma', 'Ibrahim', '$2y$10$SsemBzEmu3iN62zznhwDpODTWWGUxd/qw0eGjGRepgE/7KxVZHFC.', '01142774375', 'TmhLs', '5j7qYIx51PdZHppCKfO1TjHc5vd29Q0yeS2f7UNijjxXolP3mK3oPjCsDnVD', '2017-04-19 09:32:54', '2017-04-19 09:32:54'),
(7, 'ahmedyoussry1996@gmail.com', 'Ahmed', 'Youssry', '$2y$10$Ldt4S54i5WwbyeeHKC9HEeJx3CFPar.eXyhPWd698GJurG0r1d7he', '01147800900', 'rD4eG', 't0PT1Es99ybc11YdynYFxZtSsf8JEEq7pv0zdwr6IaIJHmeLc8d3hXHNH5Nv', '2017-04-19 09:47:44', '2017-04-19 09:47:44'),
(8, 'omarmah10@gmail.com', 'Omar', 'AboAdma', '$2y$10$ZzdShcHh9BA5BJ87uM/hu.GTvnHDAeLfppWrxLk2hSvC7w/O6rbKu', '01120123183', '7XmtI', 'xBh14lu6IRUsWEJrXOPmD1iNuv7DvaRfTyxiEcg74spBXqCkY2kLJ9zbAD0f', '2017-04-19 09:54:25', '2017-04-19 09:54:25'),
(9, 'ahmedsamy96@gmail.com', 'Ahmed', 'Samy', '$2y$10$d//Jsy80QOQMVdxCIPbj6uneYaawKLAfdq6OgXzx5rwGHZu3sW2mG', '01228029655', 'KI7yL', 'dJn0Vba1nXU57Y4298yq4igWpCz2Thct9J6k3SUVIxtxbA9zrGqhSZhOZsKG', '2017-04-19 10:03:41', '2017-04-19 10:03:41'),
(10, 'ahmed.gamal.92@hotmail.com', 'Ahmed', 'Gamal', '$2y$10$0hpxjxscKJfTZp/7AF9IN.dJ84dZGPj8Q4frt9WNw/qgPQ4i7IWKu', '01111396866', 'FI3vL', 'bjp4JsrQXmn2Q2VAFcSolXdWGVBY8pkjEmyH2C3ZOENrOJcc7VXuPUIfmKEz', '2017-04-19 15:23:25', '2017-04-19 15:23:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_id_unique` (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `confirmationcode` (`confirmationcode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
