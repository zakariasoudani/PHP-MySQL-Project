-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 09, 2026 at 02:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `market`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `ville` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `email`, `telephone`, `ville`) VALUES
(2, 'ahmed', 'ahmednakis123@gmail.com', '0643123245', 'Nador'),
(3, 'Nasir', 'nasir122@gmail.com', '0623659811', 'Casablanca'),
(5, 'jamil', 'jamil@gmail.com', '0394894394', 'Casablanca');

-- --------------------------------------------------------

--
-- Table structure for table `commandes`
--

CREATE TABLE `commandes` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `statut` enum('Livré','En cours','Annulé') DEFAULT 'En cours',
  `date_commande` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `commandes`
--

INSERT INTO `commandes` (`id`, `client_id`, `total`, `statut`, `date_commande`) VALUES
(1, 2, 24.00, 'En cours', '2024-11-12 00:00:00'),
(2, 2, 111.00, 'Livré', '2200-12-11 00:00:00'),
(5, 3, 11.00, 'Livré', '2026-05-05 00:00:00'),
(9, 2, 20.00, 'Livré', '2034-11-02 00:00:00'),
(10, 2, 12.00, 'En cours', '2026-05-28 00:00:00'),
(14, 2, 11.00, 'En cours', '2026-05-09 00:00:00'),
(15, 3, 11.00, 'En cours', '2026-05-09 00:00:00'),
(16, 2, 11.00, 'En cours', '2026-05-09 00:00:00'),
(17, 3, 11.00, 'En cours', '2026-05-09 00:00:00'),
(18, 3, 22.00, 'En cours', '2026-05-09 00:00:00'),
(19, 3, 1.00, 'En cours', '2026-05-09 00:00:00'),
(20, 3, 1.00, 'En cours', '2026-05-09 00:00:00'),
(21, 5, 1.00, 'En cours', '2026-05-09 00:00:00'),
(22, 3, 1.00, 'En cours', '2026-05-09 00:00:00'),
(23, 5, 1.00, 'En cours', '2026-05-09 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `commandes_details`
--

CREATE TABLE `commandes_details` (
  `id` int(11) NOT NULL,
  `commande_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `prix_unitaire` decimal(10,2) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `commandes_details`
--

INSERT INTO `commandes_details` (`id`, `commande_id`, `produit_id`, `prix_unitaire`, `quantite`) VALUES
(1, 2, 4, 12.00, 20),
(2, 2, 4, 22.00, 11),
(10, 2, 4, 12.00, 1),
(16, 23, 4, 11.00, 121);

-- --------------------------------------------------------

--
-- Table structure for table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `stock` int(11) DEFAULT NULL,
  `categorie` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `prix`, `stock`, `categorie`) VALUES
(4, 'informatique HP 20012', 122.00, 110, 'PC ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `commandes_details`
--
ALTER TABLE `commandes_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commande_id` (`commande_id`),
  ADD KEY `produit_id` (`produit_id`);

--
-- Indexes for table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `commandes_details`
--
ALTER TABLE `commandes_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);

--
-- Constraints for table `commandes_details`
--
ALTER TABLE `commandes_details`
  ADD CONSTRAINT `commandes_details_ibfk_1` FOREIGN KEY (`commande_id`) REFERENCES `commandes` (`id`),
  ADD CONSTRAINT `commandes_details_ibfk_2` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
