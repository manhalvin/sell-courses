-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 12, 2023 at 03:24 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel-synthetic`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint UNSIGNED NOT NULL,
  `session_id` text,
  `course_id` bigint DEFAULT NULL,
  `user_id` text,
  `qty` text,
  `title` text,
  `price` text,
  `thumbnail` text,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `session_id`, `course_id`, `user_id`, `qty`, `title`, `price`, `thumbnail`, `updated_at`, `created_at`) VALUES
(2, '98a4c', 2, '32', '1', 'Thiết kế Web với Photoshop', '699000', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAFTUlEQVR4nO2dXU/yMBSAzwAJEgkm88IYP9HFe/f/fwIx8cKYzPARglH8CkZdyGB7L2S8Y7T7KG1X6HmuDFto6eM5p+1gM4IgAEQdKkV3gAGW/yCDey8EobqQlcFvt9u538S2bZJEJSUZiqWspc6wDH5WbNuOv6SEIFWEBABiBaQREVSomCKFLBouUkScWORIl1OEECVFxClKjGwhgcoSaMzlSJFSktEI/EXFRsoAWERyAGxT7lwIFdJutxciNlVGSOQzBPPPJQRRKWsj6gQrIuuLMCHbKCKOiNrCO2VtdK3Ii4jawlNI4Yu7Ioh8Xi5SeKUsbaIiCR4pjEeEoIw5kRTGzLpClNgIUxDmcVknZWFkJMCavlgjBGWkwJq+WIRgmspHrvFiihCMjmywjFMeIVot+niRd/GYK0JQBht5xi2TEJG7mzqRZRyzTnsxVXEgy1Q4S4SgDE5kmQrLumKIZCRNCEYHZ9KiJEkIyhBEkhRMWYpBE4LTXDmsjDM1QjBdiYU2vqp/+z03e3t7cH19TTzmeR7c3d1J7lE+SBGCxVwSpOIuJEIMw4CbmxsRb72E67pwf38vvB2ZxCMEo0My8SjBaa9ioBDFQCGKERWC9aMgonVEyCwrCAK4vb1NPe/q6goajQbx2MvLCzw9PaW2s20IWxj6vp96TtKA+r6f6T22ja1bqfPANE04Pz+nHv/4+IButyukbSzqMfb39+Hs7Ix6fDweC5MB8F8IFnQAaDQacHFxAYZBvuz98/MDnU5HSNthYccImVOv1+Hy8hJKJfKQuK4LjuMIr2soBABqtRpYlgXlcpl4fDKZgOM4MJvNhPdFeyHVahUsy4JKhTy/8TwPHMcBz/Ok9EcrIfF0U6lUwLIsqFarxPNnsxk4jgOTyURG9wBAMyHRlFMqlcCyLKjVasRzfd+Hx8dHcF1XVvf++iW1tYKZTqeLv1utFtTrdeJ5QRBAp9OB7+9vWV1boJWQMEKOjo6g2WxSz+v3+zAej2V1awnthDSbTTg8PKSeMxgM4P39XWKvltFKyM7OTuLCz/M8eHt7k9yrZbQS0mw2qWsNgD9hp6enEnu0ilZCsmCaJhwcHBTWPgohcHx8TJ0OiyYUYhDu0rnVuK5LXX2Xy2VotVrUfS0RhD/m0TJCPj8/4eHhAfr9PvWc3d3dQuqJVkKCIIDhcAidTgd834fxeAyvr6/U84uoJ1oJmU6n8Pz8vPTaYDBI3B6RXU+0EkIiCALodrvU6xyy60m0Fe0Ke4jrujAcDqnHRdeT6K9ztY+QkNFolLh/ZZommKYpvB8oJEKv10u8EHVyciK8nqCQCNPpFHq9HvX7YjLqSfydta0jIV9fXzAajajHedeT+N0dMEIIDIdD+P39pR4XWU9o9zrB72lJgHTvE4wQxaAK0b2WiIY2vjQhSjyPSQNWxhlTlmIkCdF+CiyKpBuZpUUISuFM2l3lMGUpRhYhGCWc4HXPRWi32zgNXhPbtjPdYSmTENu2cRrMgSzjmKuGYJSwkWfc8ggxAOtJbiJ1I1OWYZploZRssIwTixCsJ/nINV6s6xBMXSmwPmFn3ae0afmovCTWfS77uit1TF9kmMeFx9YJpq85PJ5jyPNZuNqmr3XTVBSem4sGgH5TYp4yAPjv9mq1eMy76MsCPk+dAZHPUxd1PcQAAGMbd4kju7ZcIyNEVITE2fiCz7tW0JB1xXCja4uIWkFDVoRE2Yj6IrJOJFGEkBAlxRQlYtGgIve+LbzGyKoRaagiJGSpMyIFEeqZEvtyqgmJs9I5FkmUyYQSAuKoLoQES4eVHHwS/wDaSzE/7jl3zgAAAABJRU5ErkJggg==', '2023-01-12 06:59:02', '2023-01-12 06:59:02'),
(3, 'a1c65', 4, '32', '1', 'title 4', '200000', 'image/course/1673357507.PNG', '2023-01-12 06:59:59', '2023-01-12 06:59:59'),
(4, 'ad6a0', 1, '32', '1', 'Học Photoshop trọn bộ trong 7 ngày', '799000', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAE60lEQVR4nO2d207qQBSG/7YYUKN4rNFwxZ3c9v0foU9gTEg0Gq0mHIII2HZfSEl36WmGNe1g13cppjPMx1prZnoywjAEow+tujsggcwvyCDvhSJ0F7I1+K7rCh/EcZw0iVpKMjRLWf91Rmbwy+I4TvJPWgjSRUgIqBVQRExQrWLqFLJpuE4RSRKRU7mcOoRoKSJJXWKqFhLqLCGLtZxKpJhVNILfqNhLGcAmkkPITbmFUCrEdd2NiH2VERH7DuH6eylBVcraizohi8r6okzIXxSRREVtoU5Ze10rRFFRWyiF1L64q4PY9yWRQpWyGhMVeVCkMIoIYRlrYilMml2FaLERpiHS47JLyuLIyEE2fclGCMsoQDZ9yQjhNCWG0HhJRQhHRzlkxklESKMWfVSILh6FIoRlyCEybqWEqNzdbBJlxrHstJdTFQFlpsJlIoRlEFFmKlzVGUOmJEVCODqIKYqSPCEsQxF5UjhlaUaWEJ7mVsPWOGdGCKcrtWSNL6cszUhbGEoX836/j/Pz89TP3t/f8fT0JHzMwWCAw8PD1M+GwyE+Pz+l+5QkDEP4vg/f97FcLjGfzzGbzTAej+H7vnDfy5BcLOp+f0ilGIaBVquFVquFdruNk5MTAEAQBBiNRnh5ecFisVDah2TK4qluCqZp4uLiAoPBADc3N6THTk6BuYYIYJomer0e7u7u1LWh7Mh/mNvbW5ydnSk5dqOFBEGwKeK+70Pkgo9er6ekT/Gi3rj68fHxsTXzsywLx8fHuL6+zo2CdruNbreL8Xi8cz9c141uTDUaHSFp+L6PyWSCx8dHPD8/5/5vt9slb5+F5PD29oavr6/Mz4+OjsjbZCEFjEajzM8ODg7I22MhBeQtBC3LIm8vEtK4gl4W08z+zQZBQNZOtEDkCCkgax8NAH5+fsjbq2wvy7Zt2LZdVXMkWJaVuzH5/f1N3iZHSAamaaLf7+cW7slkQt4u7/bGME0TnU4Hp6ensG07V0YQBCSLwiSNFnJ1dYXLy0sAv1vveQU8ied5WK1W5H1qtBARAXEWiwVeX1+Je/ML1xBBVqsVHh4elJ1BrCxCPM8r3BtK4/7+Hp1OR0GPxJlOpxgOh1gul8raqExIGIZSCykdHrA2m83geV7h+XsKGl1DksTPjUQXOEynU8zn88r60GghslfCqISLumZEQoyUp3QyFRJdn8URohksRDNYiGawEM2IC+HCXhPxC645QjSDhWgGC9GMpBCuIxWTvGGH9A4qRpykkLSUxVFSEWnPPuEaohmZQjhK1JI1vllCtHgfUwPYGmdOWZqRJ4SLuyLyHmRWFCEshZiip8pxytKMMkI4SoigeuZidJcoRZ8ai+M4pZ6wVEqI4zg8DSagzDgK1RCOEjlExk1EiAGuJ8LE6kapLCM1y2Ip5ZAZJxkhXE/EEBov2XUIp64CZN+ws+tb2hr5qrw8dn0v+64rdU5f6UiPC8XWCaevNRTvMaR8F25j09euaSoO5eaiATRvSkwpA6Df7W3U4lF00VcGfp+6BCrfp67qfIgBwPiLu8SxXVvSyIhQFSFJ9r7gU9eKLKo6Y7jXtUVFrciiqgiJsxf1RWWdyKMOIRFaiqlLxKZBHR5dAQ1qTFU1oghdhET81xmVglLqmRb7croJSbLVORlJGZMJLQQk0V1IGjId1nLw0/gHt84JHYHisiUAAAAASUVORK5CYII=', '2023-01-12 08:18:32', '2023-01-12 08:18:32');

-- --------------------------------------------------------

--
-- Table structure for table `category_courses`
--

CREATE TABLE `category_courses` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keyword` text COLLATE utf8mb4_unicode_ci,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` text COLLATE utf8mb4_unicode_ci,
  `status` int DEFAULT NULL,
  `user_created` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_deleted` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_courses`
--

INSERT INTO `category_courses` (`id`, `name`, `meta_keyword`, `slug`, `parent_id`, `thumbnail`, `status`, `user_created`, `user_updated`, `user_deleted`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Thiết kế', 'Thiết kế', 'thiet-ke', '0', 'image/category/course/1673338287.PNG', 1, NULL, NULL, 'Manh Alvin', '2023-01-08 07:43:06', '2023-01-10 02:41:45', NULL),
(2, 'Phần mềm thiết kế', 'Phần mềm thiết kế', 'phan-mem-thiet-ke', '1', 'data:image/png;base64,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', 1, NULL, NULL, 'Manh Alvin', '2023-01-08 07:43:06', '2023-01-10 02:41:45', '2023-01-10 02:41:45'),
(3, 'Phần mềm photoshop', 'Phần mềm photoshop', 'phan-mem-photoshop', '2', 'data:image/png;base64,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', 1, NULL, NULL, 'Manh Alvin', '2023-01-08 07:43:06', '2023-01-10 02:41:45', NULL),
(13, 'phát triển bản thân', NULL, 'phat-trien-ban-than', '0', 'image/category/course/1673324426.PNG', 1, NULL, NULL, 'Manh Alvin', '2023-01-09 21:20:26', '2023-01-10 02:41:45', '2023-01-10 02:41:45');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'code: mã giảm giá',
  `date_start` timestamp NULL DEFAULT NULL,
  `date_end` timestamp NULL DEFAULT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantify` int DEFAULT NULL COMMENT 'quantify: số lượng giảm giá',
  `condition` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'condition: điều kiện giảm giá',
  `status` int DEFAULT NULL,
  `user_created` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_deleted` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `title`, `content`, `code`, `date_start`, `date_end`, `time`, `quantify`, `condition`, `status`, `user_created`, `user_updated`, `user_deleted`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'TET2023', 'TET2023', 'TET2023', '2022-12-31 17:00:00', '2023-01-15 09:09:34', '10', 10, '1', 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `curriculum` text COLLATE utf8mb4_unicode_ci COMMENT 'curriculum: giáo trình',
  `course_info` text COLLATE utf8mb4_unicode_ci,
  `category_course_id` bigint DEFAULT NULL,
  `status` int DEFAULT NULL,
  `user_created` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_deleted` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `content`, `slug`, `thumbnail`, `price`, `curriculum`, `course_info`, `category_course_id`, `status`, `user_created`, `user_updated`, `user_deleted`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Học Photoshop trọn bộ trong 7 ngày', 'Học thiết kế đồ họa chuyên nghiệp với Photoshop.', 'hoc-photoshop-tron-do-trong-7-ngay', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAE60lEQVR4nO2d207qQBSG/7YYUKN4rNFwxZ3c9v0foU9gTEg0Gq0mHIII2HZfSEl36WmGNe1g13cppjPMx1prZnoywjAEow+tujsggcwvyCDvhSJ0F7I1+K7rCh/EcZw0iVpKMjRLWf91Rmbwy+I4TvJPWgjSRUgIqBVQRExQrWLqFLJpuE4RSRKRU7mcOoRoKSJJXWKqFhLqLCGLtZxKpJhVNILfqNhLGcAmkkPITbmFUCrEdd2NiH2VERH7DuH6eylBVcraizohi8r6okzIXxSRREVtoU5Ze10rRFFRWyiF1L64q4PY9yWRQpWyGhMVeVCkMIoIYRlrYilMml2FaLERpiHS47JLyuLIyEE2fclGCMsoQDZ9yQjhNCWG0HhJRQhHRzlkxklESKMWfVSILh6FIoRlyCEybqWEqNzdbBJlxrHstJdTFQFlpsJlIoRlEFFmKlzVGUOmJEVCODqIKYqSPCEsQxF5UjhlaUaWEJ7mVsPWOGdGCKcrtWSNL6cszUhbGEoX836/j/Pz89TP3t/f8fT0JHzMwWCAw8PD1M+GwyE+Pz+l+5QkDEP4vg/f97FcLjGfzzGbzTAej+H7vnDfy5BcLOp+f0ilGIaBVquFVquFdruNk5MTAEAQBBiNRnh5ecFisVDah2TK4qluCqZp4uLiAoPBADc3N6THTk6BuYYIYJomer0e7u7u1LWh7Mh/mNvbW5ydnSk5dqOFBEGwKeK+70Pkgo9er6ekT/Gi3rj68fHxsTXzsywLx8fHuL6+zo2CdruNbreL8Xi8cz9c141uTDUaHSFp+L6PyWSCx8dHPD8/5/5vt9slb5+F5PD29oavr6/Mz4+OjsjbZCEFjEajzM8ODg7I22MhBeQtBC3LIm8vEtK4gl4W08z+zQZBQNZOtEDkCCkgax8NAH5+fsjbq2wvy7Zt2LZdVXMkWJaVuzH5/f1N3iZHSAamaaLf7+cW7slkQt4u7/bGME0TnU4Hp6ensG07V0YQBCSLwiSNFnJ1dYXLy0sAv1vveQU8ied5WK1W5H1qtBARAXEWiwVeX1+Je/ML1xBBVqsVHh4elJ1BrCxCPM8r3BtK4/7+Hp1OR0GPxJlOpxgOh1gul8raqExIGIZSCykdHrA2m83geV7h+XsKGl1DksTPjUQXOEynU8zn88r60GghslfCqISLumZEQoyUp3QyFRJdn8URohksRDNYiGawEM2IC+HCXhPxC645QjSDhWgGC9GMpBCuIxWTvGGH9A4qRpykkLSUxVFSEWnPPuEaohmZQjhK1JI1vllCtHgfUwPYGmdOWZqRJ4SLuyLyHmRWFCEshZiip8pxytKMMkI4SoigeuZidJcoRZ8ai+M4pZ6wVEqI4zg8DSagzDgK1RCOEjlExk1EiAGuJ8LE6kapLCM1y2Ip5ZAZJxkhXE/EEBov2XUIp64CZN+ws+tb2hr5qrw8dn0v+64rdU5f6UiPC8XWCaevNRTvMaR8F25j09euaSoO5eaiATRvSkwpA6Df7W3U4lF00VcGfp+6BCrfp67qfIgBwPiLu8SxXVvSyIhQFSFJ9r7gU9eKLKo6Y7jXtUVFrciiqgiJsxf1RWWdyKMOIRFaiqlLxKZBHR5dAQ1qTFU1oghdhET81xmVglLqmRb7croJSbLVORlJGZMJLQQk0V1IGjId1nLw0/gHt84JHYHisiUAAAAASUVORK5CYII=', '799000', NULL, NULL, 3, 1, NULL, NULL, NULL, '2023-01-08 07:43:06', '2023-01-08 07:43:06', NULL),
(2, 'Thiết kế Web với Photoshop', 'Học thiết kế Web với Photoshop và cách kiếm tiền từ công việc Freelance.', 'thiet-ke-web-voi-photoshop', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAFTUlEQVR4nO2dXU/yMBSAzwAJEgkm88IYP9HFe/f/fwIx8cKYzPARglH8CkZdyGB7L2S8Y7T7KG1X6HmuDFto6eM5p+1gM4IgAEQdKkV3gAGW/yCDey8EobqQlcFvt9u538S2bZJEJSUZiqWspc6wDH5WbNuOv6SEIFWEBABiBaQREVSomCKFLBouUkScWORIl1OEECVFxClKjGwhgcoSaMzlSJFSktEI/EXFRsoAWERyAGxT7lwIFdJutxciNlVGSOQzBPPPJQRRKWsj6gQrIuuLMCHbKCKOiNrCO2VtdK3Ii4jawlNI4Yu7Ioh8Xi5SeKUsbaIiCR4pjEeEoIw5kRTGzLpClNgIUxDmcVknZWFkJMCavlgjBGWkwJq+WIRgmspHrvFiihCMjmywjFMeIVot+niRd/GYK0JQBht5xi2TEJG7mzqRZRyzTnsxVXEgy1Q4S4SgDE5kmQrLumKIZCRNCEYHZ9KiJEkIyhBEkhRMWYpBE4LTXDmsjDM1QjBdiYU2vqp/+z03e3t7cH19TTzmeR7c3d1J7lE+SBGCxVwSpOIuJEIMw4CbmxsRb72E67pwf38vvB2ZxCMEo0My8SjBaa9ioBDFQCGKERWC9aMgonVEyCwrCAK4vb1NPe/q6goajQbx2MvLCzw9PaW2s20IWxj6vp96TtKA+r6f6T22ja1bqfPANE04Pz+nHv/4+IButyukbSzqMfb39+Hs7Ix6fDweC5MB8F8IFnQAaDQacHFxAYZBvuz98/MDnU5HSNthYccImVOv1+Hy8hJKJfKQuK4LjuMIr2soBABqtRpYlgXlcpl4fDKZgOM4MJvNhPdFeyHVahUsy4JKhTy/8TwPHMcBz/Ok9EcrIfF0U6lUwLIsqFarxPNnsxk4jgOTyURG9wBAMyHRlFMqlcCyLKjVasRzfd+Hx8dHcF1XVvf++iW1tYKZTqeLv1utFtTrdeJ5QRBAp9OB7+9vWV1boJWQMEKOjo6g2WxSz+v3+zAej2V1awnthDSbTTg8PKSeMxgM4P39XWKvltFKyM7OTuLCz/M8eHt7k9yrZbQS0mw2qWsNgD9hp6enEnu0ilZCsmCaJhwcHBTWPgohcHx8TJ0OiyYUYhDu0rnVuK5LXX2Xy2VotVrUfS0RhD/m0TJCPj8/4eHhAfr9PvWc3d3dQuqJVkKCIIDhcAidTgd834fxeAyvr6/U84uoJ1oJmU6n8Pz8vPTaYDBI3B6RXU+0EkIiCALodrvU6xyy60m0Fe0Ke4jrujAcDqnHRdeT6K9ztY+QkNFolLh/ZZommKYpvB8oJEKv10u8EHVyciK8nqCQCNPpFHq9HvX7YjLqSfydta0jIV9fXzAajajHedeT+N0dMEIIDIdD+P39pR4XWU9o9zrB72lJgHTvE4wQxaAK0b2WiIY2vjQhSjyPSQNWxhlTlmIkCdF+CiyKpBuZpUUISuFM2l3lMGUpRhYhGCWc4HXPRWi32zgNXhPbtjPdYSmTENu2cRrMgSzjmKuGYJSwkWfc8ggxAOtJbiJ1I1OWYZploZRssIwTixCsJ/nINV6s6xBMXSmwPmFn3ae0afmovCTWfS77uit1TF9kmMeFx9YJpq85PJ5jyPNZuNqmr3XTVBSem4sGgH5TYp4yAPjv9mq1eMy76MsCPk+dAZHPUxd1PcQAAGMbd4kju7ZcIyNEVITE2fiCz7tW0JB1xXCja4uIWkFDVoRE2Yj6IrJOJFGEkBAlxRQlYtGgIve+LbzGyKoRaagiJGSpMyIFEeqZEvtyqgmJs9I5FkmUyYQSAuKoLoQES4eVHHwS/wDaSzE/7jl3zgAAAABJRU5ErkJggg==', '699000', NULL, NULL, 3, 1, NULL, NULL, NULL, '2023-01-08 07:43:06', '2023-01-08 07:43:06', NULL),
(4, 'title 4', 'content 4', 'title-4', 'image/course/1673357507.PNG', '200000', NULL, NULL, 1, 1, 'Manh Alvin', NULL, 'Manh Alvin', '2023-01-10 06:11:34', '2023-01-10 06:36:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_episodes`
--

CREATE TABLE `course_episodes` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `link_video` text COLLATE utf8mb4_unicode_ci,
  `episodes` int NOT NULL,
  `course_id` bigint DEFAULT NULL,
  `status` int DEFAULT NULL,
  `user_created` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_deleted` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_episodes`
--

INSERT INTO `course_episodes` (`id`, `title`, `content`, `link_video`, `episodes`, `course_id`, `status`, `user_created`, `user_updated`, `user_deleted`, `created_at`, `updated_at`, `deleted_at`) VALUES
(11, 'title 11', 'content 11', 'video/1673369731.mp4', 4, 1, 1, 'Manh Alvin', NULL, 'Manh Alvin', '2023-01-10 09:25:43', '2023-01-10 09:57:03', '2023-01-10 09:57:03'),
(12, 'title 2', 'content 2', 'video/1673367967.mp4', 1, 1, 1, 'Manh Alvin', NULL, NULL, '2023-01-10 09:26:07', '2023-01-10 09:26:07', NULL),
(13, 'title 3', 'content 3', 'video/1673368125.mp4', 1, 1, 1, 'Manh Alvin', NULL, NULL, '2023-01-10 09:28:45', '2023-01-10 09:28:45', NULL),
(14, 'title 4', 'content 4', 'video/1673368158.mp4', 1, 2, 1, 'Manh Alvin', NULL, NULL, '2023-01-10 09:29:18', '2023-01-10 09:29:18', NULL),
(15, 'title 5', 'content 5', 'video/1673368196.mp4', 2, 2, 1, 'Manh Alvin', NULL, NULL, '2023-01-10 09:29:56', '2023-01-10 09:29:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_01_08_120418_create_roles_table', 1),
(6, '2023_01_08_121318_create_verification_codes_table', 1),
(7, '2023_01_08_122038_create_socials_table', 1),
(8, '2023_01_08_122233_create_coupons_table', 1),
(9, '2023_01_08_124238_create_order_details_table', 1),
(10, '2023_01_08_124904_create_orders_table', 1),
(11, '2023_01_08_125732_create_category_courses_table', 1),
(12, '2023_01_08_130046_create_courses_table', 1),
(13, '2023_01_08_130609_create_course_episodes_table', 1),
(14, '2023_01_08_131044_create_posts_table', 1),
(15, '2023_01_08_131827_create_post_images_table', 1),
(16, '2023_01_10_151413_create_jobs_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci,
  `email` text COLLATE utf8mb4_unicode_ci,
  `order_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_quantify` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_destroy` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `original_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `final_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint DEFAULT NULL,
  `status` text COLLATE utf8mb4_unicode_ci,
  `user_created` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_deleted` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `order_code`, `total_quantify`, `payment_method`, `order_date`, `order_destroy`, `original_amount`, `discount_amount`, `coupon_code`, `final_amount`, `user_id`, `status`, `user_created`, `user_updated`, `user_deleted`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10, 'Quoc Manh', 'quocmanh1998s@gmail.com', 'IS-ZHG9JE6D', '3', 'home', '2023-01-12 22:18:45', NULL, '1698000', '169800', 'TET2023', '1528200', 32, 'Chưa thanh toán', 'Trần Quốc Mạnh', NULL, NULL, '2023-01-12 15:18:45', '2023-01-12 15:18:45', NULL),
(11, 'Quoc Manh', 'quocmanh1998s@gmail.com', 'IS-BDNOG8Y0', '3', 'home', '2023-01-12 22:19:19', NULL, '1698000', '0', '0', '1698000', 32, 'Chưa thanh toán', 'Trần Quốc Mạnh', NULL, NULL, '2023-01-12 15:19:19', '2023-01-12 15:19:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantify` int NOT NULL,
  `sub_total` text COLLATE utf8mb4_unicode_ci,
  `thumbnail` text COLLATE utf8mb4_unicode_ci,
  `user_created` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_deleted` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` bigint DEFAULT NULL,
  `course_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `name`, `price`, `quantify`, `sub_total`, `thumbnail`, `user_created`, `user_updated`, `user_deleted`, `order_id`, `course_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(21, 'Thiết kế Web với Photoshop', '699000', 1, '699000', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAFTUlEQVR4nO2dXU/yMBSAzwAJEgkm88IYP9HFe/f/fwIx8cKYzPARglH8CkZdyGB7L2S8Y7T7KG1X6HmuDFto6eM5p+1gM4IgAEQdKkV3gAGW/yCDey8EobqQlcFvt9u538S2bZJEJSUZiqWspc6wDH5WbNuOv6SEIFWEBABiBaQREVSomCKFLBouUkScWORIl1OEECVFxClKjGwhgcoSaMzlSJFSktEI/EXFRsoAWERyAGxT7lwIFdJutxciNlVGSOQzBPPPJQRRKWsj6gQrIuuLMCHbKCKOiNrCO2VtdK3Ii4jawlNI4Yu7Ioh8Xi5SeKUsbaIiCR4pjEeEoIw5kRTGzLpClNgIUxDmcVknZWFkJMCavlgjBGWkwJq+WIRgmspHrvFiihCMjmywjFMeIVot+niRd/GYK0JQBht5xi2TEJG7mzqRZRyzTnsxVXEgy1Q4S4SgDE5kmQrLumKIZCRNCEYHZ9KiJEkIyhBEkhRMWYpBE4LTXDmsjDM1QjBdiYU2vqp/+z03e3t7cH19TTzmeR7c3d1J7lE+SBGCxVwSpOIuJEIMw4CbmxsRb72E67pwf38vvB2ZxCMEo0My8SjBaa9ioBDFQCGKERWC9aMgonVEyCwrCAK4vb1NPe/q6goajQbx2MvLCzw9PaW2s20IWxj6vp96TtKA+r6f6T22ja1bqfPANE04Pz+nHv/4+IButyukbSzqMfb39+Hs7Ix6fDweC5MB8F8IFnQAaDQacHFxAYZBvuz98/MDnU5HSNthYccImVOv1+Hy8hJKJfKQuK4LjuMIr2soBABqtRpYlgXlcpl4fDKZgOM4MJvNhPdFeyHVahUsy4JKhTy/8TwPHMcBz/Ok9EcrIfF0U6lUwLIsqFarxPNnsxk4jgOTyURG9wBAMyHRlFMqlcCyLKjVasRzfd+Hx8dHcF1XVvf++iW1tYKZTqeLv1utFtTrdeJ5QRBAp9OB7+9vWV1boJWQMEKOjo6g2WxSz+v3+zAej2V1awnthDSbTTg8PKSeMxgM4P39XWKvltFKyM7OTuLCz/M8eHt7k9yrZbQS0mw2qWsNgD9hp6enEnu0ilZCsmCaJhwcHBTWPgohcHx8TJ0OiyYUYhDu0rnVuK5LXX2Xy2VotVrUfS0RhD/m0TJCPj8/4eHhAfr9PvWc3d3dQuqJVkKCIIDhcAidTgd834fxeAyvr6/U84uoJ1oJmU6n8Pz8vPTaYDBI3B6RXU+0EkIiCALodrvU6xyy60m0Fe0Ke4jrujAcDqnHRdeT6K9ztY+QkNFolLh/ZZommKYpvB8oJEKv10u8EHVyciK8nqCQCNPpFHq9HvX7YjLqSfydta0jIV9fXzAajajHedeT+N0dMEIIDIdD+P39pR4XWU9o9zrB72lJgHTvE4wQxaAK0b2WiIY2vjQhSjyPSQNWxhlTlmIkCdF+CiyKpBuZpUUISuFM2l3lMGUpRhYhGCWc4HXPRWi32zgNXhPbtjPdYSmTENu2cRrMgSzjmKuGYJSwkWfc8ggxAOtJbiJ1I1OWYZploZRssIwTixCsJ/nINV6s6xBMXSmwPmFn3ae0afmovCTWfS77uit1TF9kmMeFx9YJpq85PJ5jyPNZuNqmr3XTVBSem4sGgH5TYp4yAPjv9mq1eMy76MsCPk+dAZHPUxd1PcQAAGMbd4kju7ZcIyNEVITE2fiCz7tW0JB1xXCja4uIWkFDVoRE2Yj6IrJOJFGEkBAlxRQlYtGgIve+LbzGyKoRaagiJGSpMyIFEeqZEvtyqgmJs9I5FkmUyYQSAuKoLoQES4eVHHwS/wDaSzE/7jl3zgAAAABJRU5ErkJggg==', 'Trần Quốc Mạnh', NULL, NULL, 10, 2, '2023-01-12 08:18:45', '2023-01-12 08:18:45', NULL),
(22, 'title 4', '200000', 1, '200000', 'image/course/1673357507.PNG', 'Trần Quốc Mạnh', NULL, NULL, 10, 4, '2023-01-12 08:18:45', '2023-01-12 08:18:45', NULL),
(23, 'Học Photoshop trọn bộ trong 7 ngày', '799000', 1, '799000', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAE60lEQVR4nO2d207qQBSG/7YYUKN4rNFwxZ3c9v0foU9gTEg0Gq0mHIII2HZfSEl36WmGNe1g13cppjPMx1prZnoywjAEow+tujsggcwvyCDvhSJ0F7I1+K7rCh/EcZw0iVpKMjRLWf91Rmbwy+I4TvJPWgjSRUgIqBVQRExQrWLqFLJpuE4RSRKRU7mcOoRoKSJJXWKqFhLqLCGLtZxKpJhVNILfqNhLGcAmkkPITbmFUCrEdd2NiH2VERH7DuH6eylBVcraizohi8r6okzIXxSRREVtoU5Ze10rRFFRWyiF1L64q4PY9yWRQpWyGhMVeVCkMIoIYRlrYilMml2FaLERpiHS47JLyuLIyEE2fclGCMsoQDZ9yQjhNCWG0HhJRQhHRzlkxklESKMWfVSILh6FIoRlyCEybqWEqNzdbBJlxrHstJdTFQFlpsJlIoRlEFFmKlzVGUOmJEVCODqIKYqSPCEsQxF5UjhlaUaWEJ7mVsPWOGdGCKcrtWSNL6cszUhbGEoX836/j/Pz89TP3t/f8fT0JHzMwWCAw8PD1M+GwyE+Pz+l+5QkDEP4vg/f97FcLjGfzzGbzTAej+H7vnDfy5BcLOp+f0ilGIaBVquFVquFdruNk5MTAEAQBBiNRnh5ecFisVDah2TK4qluCqZp4uLiAoPBADc3N6THTk6BuYYIYJomer0e7u7u1LWh7Mh/mNvbW5ydnSk5dqOFBEGwKeK+70Pkgo9er6ekT/Gi3rj68fHxsTXzsywLx8fHuL6+zo2CdruNbreL8Xi8cz9c141uTDUaHSFp+L6PyWSCx8dHPD8/5/5vt9slb5+F5PD29oavr6/Mz4+OjsjbZCEFjEajzM8ODg7I22MhBeQtBC3LIm8vEtK4gl4W08z+zQZBQNZOtEDkCCkgax8NAH5+fsjbq2wvy7Zt2LZdVXMkWJaVuzH5/f1N3iZHSAamaaLf7+cW7slkQt4u7/bGME0TnU4Hp6ensG07V0YQBCSLwiSNFnJ1dYXLy0sAv1vveQU8ied5WK1W5H1qtBARAXEWiwVeX1+Je/ML1xBBVqsVHh4elJ1BrCxCPM8r3BtK4/7+Hp1OR0GPxJlOpxgOh1gul8raqExIGIZSCykdHrA2m83geV7h+XsKGl1DksTPjUQXOEynU8zn88r60GghslfCqISLumZEQoyUp3QyFRJdn8URohksRDNYiGawEM2IC+HCXhPxC645QjSDhWgGC9GMpBCuIxWTvGGH9A4qRpykkLSUxVFSEWnPPuEaohmZQjhK1JI1vllCtHgfUwPYGmdOWZqRJ4SLuyLyHmRWFCEshZiip8pxytKMMkI4SoigeuZidJcoRZ8ai+M4pZ6wVEqI4zg8DSagzDgK1RCOEjlExk1EiAGuJ8LE6kapLCM1y2Ip5ZAZJxkhXE/EEBov2XUIp64CZN+ws+tb2hr5qrw8dn0v+64rdU5f6UiPC8XWCaevNRTvMaR8F25j09euaSoO5eaiATRvSkwpA6Df7W3U4lF00VcGfp+6BCrfp67qfIgBwPiLu8SxXVvSyIhQFSFJ9r7gU9eKLKo6Y7jXtUVFrciiqgiJsxf1RWWdyKMOIRFaiqlLxKZBHR5dAQ1qTFU1oghdhET81xmVglLqmRb7croJSbLVORlJGZMJLQQk0V1IGjId1nLw0/gHt84JHYHisiUAAAAASUVORK5CYII=', 'Trần Quốc Mạnh', NULL, NULL, 10, 1, '2023-01-12 08:18:45', '2023-01-12 08:18:45', NULL),
(24, 'Thiết kế Web với Photoshop', '699000', 1, '699000', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAFTUlEQVR4nO2dXU/yMBSAzwAJEgkm88IYP9HFe/f/fwIx8cKYzPARglH8CkZdyGB7L2S8Y7T7KG1X6HmuDFto6eM5p+1gM4IgAEQdKkV3gAGW/yCDey8EobqQlcFvt9u538S2bZJEJSUZiqWspc6wDH5WbNuOv6SEIFWEBABiBaQREVSomCKFLBouUkScWORIl1OEECVFxClKjGwhgcoSaMzlSJFSktEI/EXFRsoAWERyAGxT7lwIFdJutxciNlVGSOQzBPPPJQRRKWsj6gQrIuuLMCHbKCKOiNrCO2VtdK3Ii4jawlNI4Yu7Ioh8Xi5SeKUsbaIiCR4pjEeEoIw5kRTGzLpClNgIUxDmcVknZWFkJMCavlgjBGWkwJq+WIRgmspHrvFiihCMjmywjFMeIVot+niRd/GYK0JQBht5xi2TEJG7mzqRZRyzTnsxVXEgy1Q4S4SgDE5kmQrLumKIZCRNCEYHZ9KiJEkIyhBEkhRMWYpBE4LTXDmsjDM1QjBdiYU2vqp/+z03e3t7cH19TTzmeR7c3d1J7lE+SBGCxVwSpOIuJEIMw4CbmxsRb72E67pwf38vvB2ZxCMEo0My8SjBaa9ioBDFQCGKERWC9aMgonVEyCwrCAK4vb1NPe/q6goajQbx2MvLCzw9PaW2s20IWxj6vp96TtKA+r6f6T22ja1bqfPANE04Pz+nHv/4+IButyukbSzqMfb39+Hs7Ix6fDweC5MB8F8IFnQAaDQacHFxAYZBvuz98/MDnU5HSNthYccImVOv1+Hy8hJKJfKQuK4LjuMIr2soBABqtRpYlgXlcpl4fDKZgOM4MJvNhPdFeyHVahUsy4JKhTy/8TwPHMcBz/Ok9EcrIfF0U6lUwLIsqFarxPNnsxk4jgOTyURG9wBAMyHRlFMqlcCyLKjVasRzfd+Hx8dHcF1XVvf++iW1tYKZTqeLv1utFtTrdeJ5QRBAp9OB7+9vWV1boJWQMEKOjo6g2WxSz+v3+zAej2V1awnthDSbTTg8PKSeMxgM4P39XWKvltFKyM7OTuLCz/M8eHt7k9yrZbQS0mw2qWsNgD9hp6enEnu0ilZCsmCaJhwcHBTWPgohcHx8TJ0OiyYUYhDu0rnVuK5LXX2Xy2VotVrUfS0RhD/m0TJCPj8/4eHhAfr9PvWc3d3dQuqJVkKCIIDhcAidTgd834fxeAyvr6/U84uoJ1oJmU6n8Pz8vPTaYDBI3B6RXU+0EkIiCALodrvU6xyy60m0Fe0Ke4jrujAcDqnHRdeT6K9ztY+QkNFolLh/ZZommKYpvB8oJEKv10u8EHVyciK8nqCQCNPpFHq9HvX7YjLqSfydta0jIV9fXzAajajHedeT+N0dMEIIDIdD+P39pR4XWU9o9zrB72lJgHTvE4wQxaAK0b2WiIY2vjQhSjyPSQNWxhlTlmIkCdF+CiyKpBuZpUUISuFM2l3lMGUpRhYhGCWc4HXPRWi32zgNXhPbtjPdYSmTENu2cRrMgSzjmKuGYJSwkWfc8ggxAOtJbiJ1I1OWYZploZRssIwTixCsJ/nINV6s6xBMXSmwPmFn3ae0afmovCTWfS77uit1TF9kmMeFx9YJpq85PJ5jyPNZuNqmr3XTVBSem4sGgH5TYp4yAPjv9mq1eMy76MsCPk+dAZHPUxd1PcQAAGMbd4kju7ZcIyNEVITE2fiCz7tW0JB1xXCja4uIWkFDVoRE2Yj6IrJOJFGEkBAlxRQlYtGgIve+LbzGyKoRaagiJGSpMyIFEeqZEvtyqgmJs9I5FkmUyYQSAuKoLoQES4eVHHwS/wDaSzE/7jl3zgAAAABJRU5ErkJggg==', 'Trần Quốc Mạnh', NULL, NULL, 11, 2, '2023-01-12 08:19:19', '2023-01-12 08:19:19', NULL),
(25, 'title 4', '200000', 1, '200000', 'image/course/1673357507.PNG', 'Trần Quốc Mạnh', NULL, NULL, 11, 4, '2023-01-12 08:19:19', '2023-01-12 08:19:19', NULL),
(26, 'Học Photoshop trọn bộ trong 7 ngày', '799000', 1, '799000', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAE60lEQVR4nO2d207qQBSG/7YYUKN4rNFwxZ3c9v0foU9gTEg0Gq0mHIII2HZfSEl36WmGNe1g13cppjPMx1prZnoywjAEow+tujsggcwvyCDvhSJ0F7I1+K7rCh/EcZw0iVpKMjRLWf91Rmbwy+I4TvJPWgjSRUgIqBVQRExQrWLqFLJpuE4RSRKRU7mcOoRoKSJJXWKqFhLqLCGLtZxKpJhVNILfqNhLGcAmkkPITbmFUCrEdd2NiH2VERH7DuH6eylBVcraizohi8r6okzIXxSRREVtoU5Ze10rRFFRWyiF1L64q4PY9yWRQpWyGhMVeVCkMIoIYRlrYilMml2FaLERpiHS47JLyuLIyEE2fclGCMsoQDZ9yQjhNCWG0HhJRQhHRzlkxklESKMWfVSILh6FIoRlyCEybqWEqNzdbBJlxrHstJdTFQFlpsJlIoRlEFFmKlzVGUOmJEVCODqIKYqSPCEsQxF5UjhlaUaWEJ7mVsPWOGdGCKcrtWSNL6cszUhbGEoX836/j/Pz89TP3t/f8fT0JHzMwWCAw8PD1M+GwyE+Pz+l+5QkDEP4vg/f97FcLjGfzzGbzTAej+H7vnDfy5BcLOp+f0ilGIaBVquFVquFdruNk5MTAEAQBBiNRnh5ecFisVDah2TK4qluCqZp4uLiAoPBADc3N6THTk6BuYYIYJomer0e7u7u1LWh7Mh/mNvbW5ydnSk5dqOFBEGwKeK+70Pkgo9er6ekT/Gi3rj68fHxsTXzsywLx8fHuL6+zo2CdruNbreL8Xi8cz9c141uTDUaHSFp+L6PyWSCx8dHPD8/5/5vt9slb5+F5PD29oavr6/Mz4+OjsjbZCEFjEajzM8ODg7I22MhBeQtBC3LIm8vEtK4gl4W08z+zQZBQNZOtEDkCCkgax8NAH5+fsjbq2wvy7Zt2LZdVXMkWJaVuzH5/f1N3iZHSAamaaLf7+cW7slkQt4u7/bGME0TnU4Hp6ensG07V0YQBCSLwiSNFnJ1dYXLy0sAv1vveQU8ied5WK1W5H1qtBARAXEWiwVeX1+Je/ML1xBBVqsVHh4elJ1BrCxCPM8r3BtK4/7+Hp1OR0GPxJlOpxgOh1gul8raqExIGIZSCykdHrA2m83geV7h+XsKGl1DksTPjUQXOEynU8zn88r60GghslfCqISLumZEQoyUp3QyFRJdn8URohksRDNYiGawEM2IC+HCXhPxC645QjSDhWgGC9GMpBCuIxWTvGGH9A4qRpykkLSUxVFSEWnPPuEaohmZQjhK1JI1vllCtHgfUwPYGmdOWZqRJ4SLuyLyHmRWFCEshZiip8pxytKMMkI4SoigeuZidJcoRZ8ai+M4pZ6wVEqI4zg8DSagzDgK1RCOEjlExk1EiAGuJ8LE6kapLCM1y2Ip5ZAZJxkhXE/EEBov2XUIp64CZN+ws+tb2hr5qrw8dn0v+64rdU5f6UiPC8XWCaevNRTvMaR8F25j09euaSoO5eaiATRvSkwpA6Df7W3U4lF00VcGfp+6BCrfp67qfIgBwPiLu8SxXVvSyIhQFSFJ9r7gU9eKLKo6Y7jXtUVFrciiqgiJsxf1RWWdyKMOIRFaiqlLxKZBHR5dAQ1qTFU1oghdhET81xmVglLqmRb7croJSbLVORlJGZMJLQQk0V1IGjId1nLw0/gHt84JHYHisiUAAAAASUVORK5CYII=', 'Trần Quốc Mạnh', NULL, NULL, 11, 1, '2023-01-12 08:19:19', '2023-01-12 08:19:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` text,
  `order_id` text,
  `payment_method` text,
  `transaction_id` text,
  `amount` text,
  `payment_status` text,
  `payment_date` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 29, 'token', '2438f1872dc62ec504ba4459b83ca656f34103afae9e671b60612ae675bd95a3', '[\"*\"]', NULL, '2023-01-09 03:03:22', '2023-01-09 03:03:22'),
(2, 'App\\Models\\User', 29, 'token', '253be6e396becd7a96736f96698e12959d1319145e2cd8ed0e1b69534936df5b', '[\"*\"]', NULL, '2023-01-09 03:03:37', '2023-01-09 03:03:37'),
(3, 'App\\Models\\User', 31, 'token', 'aaae93676a409b67b80cd080d26b344829f740745148b6833733ea07c24b063b', '[\"*\"]', '2023-01-09 07:03:24', '2023-01-09 03:10:24', '2023-01-09 07:03:24'),
(4, 'App\\Models\\User', 31, 'token', 'c0f8e7d58fff099553a3dc775aae98436937aa9892d1b1fb14cd3a315e6c3e97', '[\"*\"]', '2023-01-09 08:54:42', '2023-01-09 07:03:55', '2023-01-09 08:54:42'),
(5, 'App\\Models\\User', 32, 'token', '26ac4a0e4fd40d2c7763fbbcb3946c75cee0e6619d7563ab9be9c04ac17a93d9', '[\"*\"]', '2023-01-10 20:34:04', '2023-01-09 08:57:57', '2023-01-10 20:34:04'),
(6, 'App\\Models\\User', 32, 'token', '1f99894848541ae9e16d84bcacf4011a31ad2c26ab615442c75aa4dcb04061a2', '[\"*\"]', NULL, '2023-01-11 02:51:25', '2023-01-11 02:51:25'),
(7, 'App\\Models\\User', 32, 'token', '0305baee67533814ce6d26101416bdd4aa22fbb8f62bbb6862aa416be73504c4', '[\"*\"]', '2023-01-11 03:09:53', '2023-01-11 02:52:31', '2023-01-11 03:09:53'),
(8, 'App\\Models\\User', 32, 'token', '23992dd4cd8ae880ebb9cebb4b58bad34e1362fe8348f7048a499c7ac5f4f157', '[\"*\"]', '2023-01-11 03:35:39', '2023-01-11 03:11:31', '2023-01-11 03:35:39'),
(9, 'App\\Models\\User', 32, 'token', '505c8080a7a4aaaba5db674cf2cc4a29b51c656da7ca8b4b59ff27b742c8b078', '[\"*\"]', '2023-01-12 07:12:58', '2023-01-12 06:41:38', '2023-01-12 07:12:58'),
(10, 'App\\Models\\User', 32, 'token', '289054e89f344cb415e8fe0caa19bc3f7ae80cd246dc0c9bff6343b6ad42b7cc', '[\"*\"]', '2023-01-12 08:19:19', '2023-01-12 07:26:06', '2023-01-12 08:19:19');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keyword` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` int DEFAULT NULL,
  `course_id` bigint DEFAULT NULL,
  `user_created` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_deleted` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `slug`, `thumbnail`, `meta_keyword`, `status`, `course_id`, `user_created`, `user_updated`, `user_deleted`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1', '1', '1', 'data:image/png;base64,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', NULL, 1, 1, 'Manh Alvin', NULL, 'Manh Alvin', '2023-01-10 10:27:05', '2023-01-10 10:46:26', NULL),
(2, 'Post 17', 'Content 17', 'post-17', 'data:image/png;base64,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', NULL, 1, 1, 'Manh Alvin', NULL, NULL, '2023-01-10 20:34:04', '2023-01-10 20:34:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_images`
--

CREATE TABLE `post_images` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_created` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_deleted` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'name: tên vai trò',
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'display_name: mô tả vai trò',
  `status` int DEFAULT NULL,
  `user_created` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_deleted` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `status`, `user_created`, `user_updated`, `user_deleted`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', NULL, NULL, NULL, NULL, NULL, '2023-01-08 07:43:06', '2023-01-08 07:43:06', NULL),
(2, 'User', NULL, NULL, NULL, NULL, NULL, '2023-01-08 07:43:06', '2023-01-08 07:43:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `socials`
--

CREATE TABLE `socials` (
  `id` bigint UNSIGNED NOT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int DEFAULT NULL,
  `user_created` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_deleted` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'name: họ tên người dùng',
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'username: tên người dùng',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'gender: Giới tính',
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `thumbnail` text COLLATE utf8mb4_unicode_ci COMMENT 'thumbnail: Hình ảnh đại diện ',
  `status` tinyint(1) NOT NULL DEFAULT '2' COMMENT 'status: trạng thái tài khoản',
  `activation_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'activate_date: ngày kích hoạt',
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL COMMENT 'email_verified_at: email xác thực',
  `role_id` bigint UNSIGNED DEFAULT NULL,
  `user_created` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_deleted` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `gender`, `mobile_no`, `address`, `thumbnail`, `status`, `activation_date`, `uuid`, `email_verified_at`, `role_id`, `user_created`, `user_updated`, `user_deleted`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Quốc Mạnh', 'quocmanh', 'quocmanh1998s@gmail.com', '$2y$10$dEB42mghl2oDKHLTQhkoPu4SIaJCECmWNxFZjTlv9K3vRNOdUocze', NULL, '0961154483', NULL, 'data:image/png;base64,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', 1, NULL, NULL, '2023-01-08 07:43:06', 1, NULL, NULL, NULL, NULL, '2023-01-08 07:43:06', '2023-01-08 07:43:06', NULL),
(2, 'Quốc Việt', 'quocviet', 'quocviet2001s@gmail.com', '$2y$10$r/p881QS/vrI9G4utLmiF.iR387oh55sy5F7yXL3hmnuUGskKYTje', NULL, '0914018077', NULL, 'data:image/png;base64,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', 1, NULL, NULL, '2023-01-08 07:43:06', 2, NULL, NULL, NULL, NULL, '2023-01-08 07:43:06', '2023-01-08 07:43:06', NULL),
(32, 'Trần Quốc Mạnh', 'manhalvin', 'manhquoc1998s@gmail.com', '$2y$10$YIceysR77JBkqZwx./9qQ.Xb6EgPkIq/oW.tHuOwg2N2Fwu4NqdZC', NULL, '0961154483', NULL, 'image/users/1673433339.PNG', 1, '2023-01-09 22:57:16', 'ca2bf8c83ac94815f8785f1267cd212b', NULL, 1, NULL, 'Trần Quốc Mạnh', NULL, NULL, '2023-01-09 08:57:17', '2023-01-11 03:35:39', NULL),
(33, 'manh', 'manh', 'manhquoc1999s@gmail.com', '$2y$10$GEwq8Dz7WQ3oHzuyJEoCZudfTzOkKSSD1ZiXraKc37H9U7WSQjeAa', NULL, NULL, NULL, 'data:image/png;base64,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', 1, NULL, NULL, NULL, 1, 'Manh Alvin', 'Manh Alvin', NULL, NULL, '2023-01-09 08:58:51', '2023-01-09 10:05:30', '2023-01-02 02:40:17');

-- --------------------------------------------------------

--
-- Table structure for table `verification_codes`
--

CREATE TABLE `verification_codes` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint NOT NULL,
  `otp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int DEFAULT NULL,
  `user_created` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_updated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_deleted` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expire_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `verification_codes`
--

INSERT INTO `verification_codes` (`id`, `user_id`, `otp`, `email`, `status`, `user_created`, `user_updated`, `user_deleted`, `expire_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 31, '277365', 'manhquoc1998s@gmail.com', NULL, NULL, NULL, NULL, '2023-01-09 10:19:57', '2023-01-09 03:09:57', '2023-01-09 03:09:57', NULL),
(9, 31, '756323', 'manhquoc1998s@gmail.com', NULL, NULL, NULL, NULL, '2023-01-09 14:47:48', '2023-01-09 07:37:48', '2023-01-09 07:37:48', NULL),
(10, 31, '550167', 'manhquoc1998s@gmail.com', NULL, NULL, NULL, NULL, '2023-01-09 15:03:26', '2023-01-09 07:53:26', '2023-01-09 07:53:26', NULL),
(11, 32, '959453', 'manhquoc1998s@gmail.com', NULL, NULL, NULL, NULL, '2023-01-09 16:07:17', '2023-01-09 08:57:17', '2023-01-09 08:57:17', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_courses`
--
ALTER TABLE `category_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_episodes`
--
ALTER TABLE `course_episodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_images`
--
ALTER TABLE `post_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verification_codes`
--
ALTER TABLE `verification_codes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category_courses`
--
ALTER TABLE `category_courses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `course_episodes`
--
ALTER TABLE `course_episodes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post_images`
--
ALTER TABLE `post_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `socials`
--
ALTER TABLE `socials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `verification_codes`
--
ALTER TABLE `verification_codes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
