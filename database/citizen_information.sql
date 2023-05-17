-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2023 at 06:07 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sechshebatetulia_laravel_update`
--

-- --------------------------------------------------------

--
-- Table structure for table `citizen_information`
--

CREATE TABLE `citizen_information` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullNameEN` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathersNameEN` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothersNameEN` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spouseNameEN` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `presentAddressEN` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permenantAddressEN` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fullNameBN` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathersNameBN` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothersNameBN` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spouseNameBN` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `presentAddressBN` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `presentHolding` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `presentVillage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `presentUnion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `presentPost` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `presentPostCode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `presentThana` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `presentDistrict` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanentAddressBN` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanentHolding` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanentVillage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanentUnion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanentPost` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanentPostCode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanentThana` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanentDistrict` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profession` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dateOfBirth` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthPlaceBN` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothersNationalityBN` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothersNationalityEN` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathersNationalityBN` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathersNationalityEN` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthRegistrationNumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationalIdNumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `oldNationalIdNumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photoUrl` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `citizen_information`
--

INSERT INTO `citizen_information` (`id`, `fullNameEN`, `fathersNameEN`, `mothersNameEN`, `spouseNameEN`, `presentAddressEN`, `permenantAddressEN`, `fullNameBN`, `fathersNameBN`, `mothersNameBN`, `spouseNameBN`, `presentAddressBN`, `presentHolding`, `presentVillage`, `presentUnion`, `presentPost`, `presentPostCode`, `presentThana`, `presentDistrict`, `permanentAddressBN`, `permanentHolding`, `permanentVillage`, `permanentUnion`, `permanentPost`, `permanentPostCode`, `permanentThana`, `permanentDistrict`, `gender`, `profession`, `dateOfBirth`, `birthPlaceBN`, `mothersNationalityBN`, `mothersNationalityEN`, `fathersNationalityBN`, `fathersNationalityEN`, `birthRegistrationNumber`, `nationalIdNumber`, `oldNationalIdNumber`, `photoUrl`, `created_at`, `updated_at`) VALUES
(2, 'Abdur Rahim', 'Abdul Karim', 'Rahima Begum', 'Fatema Begum', '', '', 'আব্দুর রহিম', 'আব্দুল করিম', 'রহিমা বেগম', 'ফাতেমা বেগম', 'মুন্সিগঞ্জ লৌহজং শিমুলিয়া যাত্রাবাড়ি তেজগাঁও, গুলশান লিঙ্ক রোড, ঢাকা-১২০৮', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'মুন্সিগঞ্জ লৌহজং শিমুলিয়া যাত্রাবাড়ি তেজগাঁও, গুলশান লিঙ্ক রোড, ঢাকা-১২০৮', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Male', 'Student', '2000-11-30', NULL, NULL, NULL, NULL, NULL, NULL, '1234567890', '1234567890', 'https://picsum.photos/200', '2023-03-30 06:47:39', '2023-03-30 06:47:39'),
(3, 'Md Joynal Abedin', 'Nurul Islam', 'Mst Hajera Khatun', 'Mst Banesha Khatun', 'Home / Holding: , Village / Road: Baneshwar Para, Tepriganj, Post Office: Tepriganj-5020, Debiganj, Panchagarh', 'Home / Holding: , Village / Road: Baneshwar Para,, Post Office: Tepriganj-5020, Debiganj, Panchagarh', 'মোঃ জয়নাল আবেদীন', 'নুরুল ইসলাম', 'মোছাঃ হাজেরা খাতুন', 'মোছাঃ বানেছা খাতুন', 'বাসা/হোল্ডিং: , গ্রাম/রাস্তা: বানেশ্বর পাড়া, টেপ্রীগঞ্জ, ডাকঘর: টেপ্রীগঞ্জ-5020, দেবীগঞ্জ, পঞ্চগড়', ' ', ' বানেশ্বর পাড়া', 'টেপ্রীগঞ্জ', 'টেপ্রীগঞ্জ', '5020', 'দেবীগঞ্জ', 'পঞ্চগড়', 'বাসা/হোল্ডিং: , গ্রাম/রাস্তা: বানেশ্বর পাড়া, , ডাকঘর: টেপ্রীগঞ্জ-5020, দেবীগঞ্জ, পঞ্চগড়', ' ', ' বানেশ্বর পাড়া', '', 'টেপ্রীগঞ্জ', '5020', 'দেবীগঞ্জ', 'পঞ্চগড়', 'male', 'কৃষক', '1975-11-10', NULL, NULL, NULL, NULL, NULL, NULL, '2385830951', '19757713495546036', 'https://prportal.nidw.gov.bd/file-60/4/a/5/a404e40b-4740-4ee2-9f36-e8a2fba4665b/Photo-a404e40b-4740-4ee2-9f36-e8a2fba4665b.jpg?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=fileobj%2F20230330%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20230330T071548Z&X-Amz-Expires=120&X-Amz-SignedHeaders=host&X-Amz-Signature=fe8ebc7dd687724de2624f8101b7ac0ec5f9f65b65e79fe7dc5145664e4c2702', '2023-03-30 07:15:48', '2023-03-30 09:14:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `citizen_information`
--
ALTER TABLE `citizen_information`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `citizen_information`
--
ALTER TABLE `citizen_information`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
