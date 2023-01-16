-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 16, 2023 at 09:50 AM
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
(15, '88fda', 1, '42', '1', 'Học Photoshop trọn bộ trong 7 ngày', '799000', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAE60lEQVR4nO2d207qQBSG/7YYUKN4rNFwxZ3c9v0foU9gTEg0Gq0mHIII2HZfSEl36WmGNe1g13cppjPMx1prZnoywjAEow+tujsggcwvyCDvhSJ0F7I1+K7rCh/EcZw0iVpKMjRLWf91Rmbwy+I4TvJPWgjSRUgIqBVQRExQrWLqFLJpuE4RSRKRU7mcOoRoKSJJXWKqFhLqLCGLtZxKpJhVNILfqNhLGcAmkkPITbmFUCrEdd2NiH2VERH7DuH6eylBVcraizohi8r6okzIXxSRREVtoU5Ze10rRFFRWyiF1L64q4PY9yWRQpWyGhMVeVCkMIoIYRlrYilMml2FaLERpiHS47JLyuLIyEE2fclGCMsoQDZ9yQjhNCWG0HhJRQhHRzlkxklESKMWfVSILh6FIoRlyCEybqWEqNzdbBJlxrHstJdTFQFlpsJlIoRlEFFmKlzVGUOmJEVCODqIKYqSPCEsQxF5UjhlaUaWEJ7mVsPWOGdGCKcrtWSNL6cszUhbGEoX836/j/Pz89TP3t/f8fT0JHzMwWCAw8PD1M+GwyE+Pz+l+5QkDEP4vg/f97FcLjGfzzGbzTAej+H7vnDfy5BcLOp+f0ilGIaBVquFVquFdruNk5MTAEAQBBiNRnh5ecFisVDah2TK4qluCqZp4uLiAoPBADc3N6THTk6BuYYIYJomer0e7u7u1LWh7Mh/mNvbW5ydnSk5dqOFBEGwKeK+70Pkgo9er6ekT/Gi3rj68fHxsTXzsywLx8fHuL6+zo2CdruNbreL8Xi8cz9c141uTDUaHSFp+L6PyWSCx8dHPD8/5/5vt9slb5+F5PD29oavr6/Mz4+OjsjbZCEFjEajzM8ODg7I22MhBeQtBC3LIm8vEtK4gl4W08z+zQZBQNZOtEDkCCkgax8NAH5+fsjbq2wvy7Zt2LZdVXMkWJaVuzH5/f1N3iZHSAamaaLf7+cW7slkQt4u7/bGME0TnU4Hp6ensG07V0YQBCSLwiSNFnJ1dYXLy0sAv1vveQU8ied5WK1W5H1qtBARAXEWiwVeX1+Je/ML1xBBVqsVHh4elJ1BrCxCPM8r3BtK4/7+Hp1OR0GPxJlOpxgOh1gul8raqExIGIZSCykdHrA2m83geV7h+XsKGl1DksTPjUQXOEynU8zn88r60GghslfCqISLumZEQoyUp3QyFRJdn8URohksRDNYiGawEM2IC+HCXhPxC645QjSDhWgGC9GMpBCuIxWTvGGH9A4qRpykkLSUxVFSEWnPPuEaohmZQjhK1JI1vllCtHgfUwPYGmdOWZqRJ4SLuyLyHmRWFCEshZiip8pxytKMMkI4SoigeuZidJcoRZ8ai+M4pZ6wVEqI4zg8DSagzDgK1RCOEjlExk1EiAGuJ8LE6kapLCM1y2Ip5ZAZJxkhXE/EEBov2XUIp64CZN+ws+tb2hr5qrw8dn0v+64rdU5f6UiPC8XWCaevNRTvMaR8F25j09euaSoO5eaiATRvSkwpA6Df7W3U4lF00VcGfp+6BCrfp67qfIgBwPiLu8SxXVvSyIhQFSFJ9r7gU9eKLKo6Y7jXtUVFrciiqgiJsxf1RWWdyKMOIRFaiqlLxKZBHR5dAQ1qTFU1oghdhET81xmVglLqmRb7croJSbLVORlJGZMJLQQk0V1IGjId1nLw0/gHt84JHYHisiUAAAAASUVORK5CYII=', '2023-01-15 21:27:03', '2023-01-15 21:27:03'),
(16, '88fda', 2, '42', '1', 'Thiết kế Web với Photoshop', '699000', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAFTUlEQVR4nO2dXU/yMBSAzwAJEgkm88IYP9HFe/f/fwIx8cKYzPARglH8CkZdyGB7L2S8Y7T7KG1X6HmuDFto6eM5p+1gM4IgAEQdKkV3gAGW/yCDey8EobqQlcFvt9u538S2bZJEJSUZiqWspc6wDH5WbNuOv6SEIFWEBABiBaQREVSomCKFLBouUkScWORIl1OEECVFxClKjGwhgcoSaMzlSJFSktEI/EXFRsoAWERyAGxT7lwIFdJutxciNlVGSOQzBPPPJQRRKWsj6gQrIuuLMCHbKCKOiNrCO2VtdK3Ii4jawlNI4Yu7Ioh8Xi5SeKUsbaIiCR4pjEeEoIw5kRTGzLpClNgIUxDmcVknZWFkJMCavlgjBGWkwJq+WIRgmspHrvFiihCMjmywjFMeIVot+niRd/GYK0JQBht5xi2TEJG7mzqRZRyzTnsxVXEgy1Q4S4SgDE5kmQrLumKIZCRNCEYHZ9KiJEkIyhBEkhRMWYpBE4LTXDmsjDM1QjBdiYU2vqp/+z03e3t7cH19TTzmeR7c3d1J7lE+SBGCxVwSpOIuJEIMw4CbmxsRb72E67pwf38vvB2ZxCMEo0My8SjBaa9ioBDFQCGKERWC9aMgonVEyCwrCAK4vb1NPe/q6goajQbx2MvLCzw9PaW2s20IWxj6vp96TtKA+r6f6T22ja1bqfPANE04Pz+nHv/4+IButyukbSzqMfb39+Hs7Ix6fDweC5MB8F8IFnQAaDQacHFxAYZBvuz98/MDnU5HSNthYccImVOv1+Hy8hJKJfKQuK4LjuMIr2soBABqtRpYlgXlcpl4fDKZgOM4MJvNhPdFeyHVahUsy4JKhTy/8TwPHMcBz/Ok9EcrIfF0U6lUwLIsqFarxPNnsxk4jgOTyURG9wBAMyHRlFMqlcCyLKjVasRzfd+Hx8dHcF1XVvf++iW1tYKZTqeLv1utFtTrdeJ5QRBAp9OB7+9vWV1boJWQMEKOjo6g2WxSz+v3+zAej2V1awnthDSbTTg8PKSeMxgM4P39XWKvltFKyM7OTuLCz/M8eHt7k9yrZbQS0mw2qWsNgD9hp6enEnu0ilZCsmCaJhwcHBTWPgohcHx8TJ0OiyYUYhDu0rnVuK5LXX2Xy2VotVrUfS0RhD/m0TJCPj8/4eHhAfr9PvWc3d3dQuqJVkKCIIDhcAidTgd834fxeAyvr6/U84uoJ1oJmU6n8Pz8vPTaYDBI3B6RXU+0EkIiCALodrvU6xyy60m0Fe0Ke4jrujAcDqnHRdeT6K9ztY+QkNFolLh/ZZommKYpvB8oJEKv10u8EHVyciK8nqCQCNPpFHq9HvX7YjLqSfydta0jIV9fXzAajajHedeT+N0dMEIIDIdD+P39pR4XWU9o9zrB72lJgHTvE4wQxaAK0b2WiIY2vjQhSjyPSQNWxhlTlmIkCdF+CiyKpBuZpUUISuFM2l3lMGUpRhYhGCWc4HXPRWi32zgNXhPbtjPdYSmTENu2cRrMgSzjmKuGYJSwkWfc8ggxAOtJbiJ1I1OWYZploZRssIwTixCsJ/nINV6s6xBMXSmwPmFn3ae0afmovCTWfS77uit1TF9kmMeFx9YJpq85PJ5jyPNZuNqmr3XTVBSem4sGgH5TYp4yAPjv9mq1eMy76MsCPk+dAZHPUxd1PcQAAGMbd4kju7ZcIyNEVITE2fiCz7tW0JB1xXCja4uIWkFDVoRE2Yj6IrJOJFGEkBAlxRQlYtGgIve+LbzGyKoRaagiJGSpMyIFEeqZEvtyqgmJs9I5FkmUyYQSAuKoLoQES4eVHHwS/wDaSzE/7jl3zgAAAABJRU5ErkJggg==', '2023-01-15 21:27:03', '2023-01-15 21:27:03'),
(17, 'c518f', 1, '73', '1', 'Học Photoshop trọn bộ trong 7 ngày', '799000', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAE60lEQVR4nO2d207qQBSG/7YYUKN4rNFwxZ3c9v0foU9gTEg0Gq0mHIII2HZfSEl36WmGNe1g13cppjPMx1prZnoywjAEow+tujsggcwvyCDvhSJ0F7I1+K7rCh/EcZw0iVpKMjRLWf91Rmbwy+I4TvJPWgjSRUgIqBVQRExQrWLqFLJpuE4RSRKRU7mcOoRoKSJJXWKqFhLqLCGLtZxKpJhVNILfqNhLGcAmkkPITbmFUCrEdd2NiH2VERH7DuH6eylBVcraizohi8r6okzIXxSRREVtoU5Ze10rRFFRWyiF1L64q4PY9yWRQpWyGhMVeVCkMIoIYRlrYilMml2FaLERpiHS47JLyuLIyEE2fclGCMsoQDZ9yQjhNCWG0HhJRQhHRzlkxklESKMWfVSILh6FIoRlyCEybqWEqNzdbBJlxrHstJdTFQFlpsJlIoRlEFFmKlzVGUOmJEVCODqIKYqSPCEsQxF5UjhlaUaWEJ7mVsPWOGdGCKcrtWSNL6cszUhbGEoX836/j/Pz89TP3t/f8fT0JHzMwWCAw8PD1M+GwyE+Pz+l+5QkDEP4vg/f97FcLjGfzzGbzTAej+H7vnDfy5BcLOp+f0ilGIaBVquFVquFdruNk5MTAEAQBBiNRnh5ecFisVDah2TK4qluCqZp4uLiAoPBADc3N6THTk6BuYYIYJomer0e7u7u1LWh7Mh/mNvbW5ydnSk5dqOFBEGwKeK+70Pkgo9er6ekT/Gi3rj68fHxsTXzsywLx8fHuL6+zo2CdruNbreL8Xi8cz9c141uTDUaHSFp+L6PyWSCx8dHPD8/5/5vt9slb5+F5PD29oavr6/Mz4+OjsjbZCEFjEajzM8ODg7I22MhBeQtBC3LIm8vEtK4gl4W08z+zQZBQNZOtEDkCCkgax8NAH5+fsjbq2wvy7Zt2LZdVXMkWJaVuzH5/f1N3iZHSAamaaLf7+cW7slkQt4u7/bGME0TnU4Hp6ensG07V0YQBCSLwiSNFnJ1dYXLy0sAv1vveQU8ied5WK1W5H1qtBARAXEWiwVeX1+Je/ML1xBBVqsVHh4elJ1BrCxCPM8r3BtK4/7+Hp1OR0GPxJlOpxgOh1gul8raqExIGIZSCykdHrA2m83geV7h+XsKGl1DksTPjUQXOEynU8zn88r60GghslfCqISLumZEQoyUp3QyFRJdn8URohksRDNYiGawEM2IC+HCXhPxC645QjSDhWgGC9GMpBCuIxWTvGGH9A4qRpykkLSUxVFSEWnPPuEaohmZQjhK1JI1vllCtHgfUwPYGmdOWZqRJ4SLuyLyHmRWFCEshZiip8pxytKMMkI4SoigeuZidJcoRZ8ai+M4pZ6wVEqI4zg8DSagzDgK1RCOEjlExk1EiAGuJ8LE6kapLCM1y2Ip5ZAZJxkhXE/EEBov2XUIp64CZN+ws+tb2hr5qrw8dn0v+64rdU5f6UiPC8XWCaevNRTvMaR8F25j09euaSoO5eaiATRvSkwpA6Df7W3U4lF00VcGfp+6BCrfp67qfIgBwPiLu8SxXVvSyIhQFSFJ9r7gU9eKLKo6Y7jXtUVFrciiqgiJsxf1RWWdyKMOIRFaiqlLxKZBHR5dAQ1qTFU1oghdhET81xmVglLqmRb7croJSbLVORlJGZMJLQQk0V1IGjId1nLw0/gHt84JHYHisiUAAAAASUVORK5CYII=', '2023-01-16 00:09:10', '2023-01-16 00:09:10'),
(18, '8d404', 2, '73', '1', 'Thiết kế Web với Photoshop', '699000', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAFTUlEQVR4nO2dXU/yMBSAzwAJEgkm88IYP9HFe/f/fwIx8cKYzPARglH8CkZdyGB7L2S8Y7T7KG1X6HmuDFto6eM5p+1gM4IgAEQdKkV3gAGW/yCDey8EobqQlcFvt9u538S2bZJEJSUZiqWspc6wDH5WbNuOv6SEIFWEBABiBaQREVSomCKFLBouUkScWORIl1OEECVFxClKjGwhgcoSaMzlSJFSktEI/EXFRsoAWERyAGxT7lwIFdJutxciNlVGSOQzBPPPJQRRKWsj6gQrIuuLMCHbKCKOiNrCO2VtdK3Ii4jawlNI4Yu7Ioh8Xi5SeKUsbaIiCR4pjEeEoIw5kRTGzLpClNgIUxDmcVknZWFkJMCavlgjBGWkwJq+WIRgmspHrvFiihCMjmywjFMeIVot+niRd/GYK0JQBht5xi2TEJG7mzqRZRyzTnsxVXEgy1Q4S4SgDE5kmQrLumKIZCRNCEYHZ9KiJEkIyhBEkhRMWYpBE4LTXDmsjDM1QjBdiYU2vqp/+z03e3t7cH19TTzmeR7c3d1J7lE+SBGCxVwSpOIuJEIMw4CbmxsRb72E67pwf38vvB2ZxCMEo0My8SjBaa9ioBDFQCGKERWC9aMgonVEyCwrCAK4vb1NPe/q6goajQbx2MvLCzw9PaW2s20IWxj6vp96TtKA+r6f6T22ja1bqfPANE04Pz+nHv/4+IButyukbSzqMfb39+Hs7Ix6fDweC5MB8F8IFnQAaDQacHFxAYZBvuz98/MDnU5HSNthYccImVOv1+Hy8hJKJfKQuK4LjuMIr2soBABqtRpYlgXlcpl4fDKZgOM4MJvNhPdFeyHVahUsy4JKhTy/8TwPHMcBz/Ok9EcrIfF0U6lUwLIsqFarxPNnsxk4jgOTyURG9wBAMyHRlFMqlcCyLKjVasRzfd+Hx8dHcF1XVvf++iW1tYKZTqeLv1utFtTrdeJ5QRBAp9OB7+9vWV1boJWQMEKOjo6g2WxSz+v3+zAej2V1awnthDSbTTg8PKSeMxgM4P39XWKvltFKyM7OTuLCz/M8eHt7k9yrZbQS0mw2qWsNgD9hp6enEnu0ilZCsmCaJhwcHBTWPgohcHx8TJ0OiyYUYhDu0rnVuK5LXX2Xy2VotVrUfS0RhD/m0TJCPj8/4eHhAfr9PvWc3d3dQuqJVkKCIIDhcAidTgd834fxeAyvr6/U84uoJ1oJmU6n8Pz8vPTaYDBI3B6RXU+0EkIiCALodrvU6xyy60m0Fe0Ke4jrujAcDqnHRdeT6K9ztY+QkNFolLh/ZZommKYpvB8oJEKv10u8EHVyciK8nqCQCNPpFHq9HvX7YjLqSfydta0jIV9fXzAajajHedeT+N0dMEIIDIdD+P39pR4XWU9o9zrB72lJgHTvE4wQxaAK0b2WiIY2vjQhSjyPSQNWxhlTlmIkCdF+CiyKpBuZpUUISuFM2l3lMGUpRhYhGCWc4HXPRWi32zgNXhPbtjPdYSmTENu2cRrMgSzjmKuGYJSwkWfc8ggxAOtJbiJ1I1OWYZploZRssIwTixCsJ/nINV6s6xBMXSmwPmFn3ae0afmovCTWfS77uit1TF9kmMeFx9YJpq85PJ5jyPNZuNqmr3XTVBSem4sGgH5TYp4yAPjv9mq1eMy76MsCPk+dAZHPUxd1PcQAAGMbd4kju7ZcIyNEVITE2fiCz7tW0JB1xXCja4uIWkFDVoRE2Yj6IrJOJFGEkBAlxRQlYtGgIve+LbzGyKoRaagiJGSpMyIFEeqZEvtyqgmJs9I5FkmUyYQSAuKoLoQES4eVHHwS/wDaSzE/7jl3zgAAAABJRU5ErkJggg==', '2023-01-16 00:09:21', '2023-01-16 00:09:21');

-- --------------------------------------------------------

--
-- Table structure for table `category_courses`
--

CREATE TABLE `category_courses` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keyword` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` int DEFAULT NULL,
  `user_created` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_updated` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_deleted` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(13, 'phát triển bản thân', NULL, 'phat-trien-ban-than', '0', 'image/category/course/1673324426.PNG', 1, NULL, NULL, 'Manh Alvin', '2023-01-09 21:20:26', '2023-01-10 02:41:45', '2023-01-10 02:41:45'),
(17, 'Thiết kế pts', NULL, 'thiet-ke-pts', '0', 'data:image/png;base64,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', 1, NULL, NULL, 'Quốc Mạnh', '2023-01-15 01:31:27', '2023-01-15 01:34:21', '2023-01-15 01:34:21');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'code: mã giảm giá',
  `date_start` timestamp NULL DEFAULT NULL,
  `date_end` timestamp NULL DEFAULT NULL,
  `time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantify` int DEFAULT NULL COMMENT 'quantify: số lượng giảm giá',
  `condition` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'condition: điều kiện giảm giá',
  `status` int DEFAULT NULL,
  `coupon_user` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_created` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_updated` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_deleted` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `title`, `content`, `code`, `date_start`, `date_end`, `time`, `quantify`, `condition`, `status`, `coupon_user`, `user_created`, `user_updated`, `user_deleted`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'TET2023', 'TET2023', 'TET2023', '2022-12-31 17:00:00', '2023-01-27 09:09:34', '35', 2922, '1', 1, 'TET2023,73', NULL, NULL, NULL, NULL, '2023-01-16 02:22:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `curriculum` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'curriculum: giáo trình',
  `course_info` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `category_course_id` bigint DEFAULT NULL,
  `status` int DEFAULT NULL,
  `user_created` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_updated` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_deleted` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(4, 'title 4', 'content 4', 'title-4', 'image/course/1673357507.PNG', '200000', NULL, NULL, 1, 1, 'Manh Alvin', NULL, 'Manh Alvin', '2023-01-10 06:11:34', '2023-01-15 01:42:49', NULL),
(6, 'title 12', 'content 12', 'title-12', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAFbklEQVR4nO2d2W7qOhSG/5CGQQwNCLV0VFuk8gB5/0fgtlIHxAWqVCE6qilTIediN5wQkpAYO16Av6st0p0Yf6y1bGfSHMeBgg4HshvAAMsvSOPeCkFQF7LS+e12O/FOLMsKkkhSkkYsZS01hqXz42JZlv8jEoKoCHEAsQLW4REkVYxMIYsDyxThxxc5qcuRIYSkCD+yxKQtxKEsIYw/OalIyaRxEPyLiq2UASwi2QHbkDsRQoW02+2FiG2V4eL5Ds7f9xKCqJS1FXWCFZH1RZiQXRThR0Rt4Z2ytrpWJEVEbeEpRPrkTgae78tFCq+UtTdREQWPFMYjQpSMPzwpjJlNhZBYCCMIc79skrJUZETAmr5YI0TJWANr+mIRotJUMhL1F1OEqOiIB0s/JRGyV5M+XiSdPCaKECWDjST9FkuIyNXNfSJOP8Yd9qpUxYE4Q+E4EaJkcCLOUDitM4aKmKwToqKDM+uiJEqIkiGIKCkqZREjTIga5qbDSj+HRohKV2IJ61+VsogRNDHci2KeyWRwfX0N0zRXtg2HQ9zd3aXSDv9kkfr9IULI5/NoNpvI5/Oym7KCX4j06Dg/P4em/b+68PPzg9fXV277N00TV1dX0HWd2z43od1uuzcUaQCxCKlUKjg+Pl767P39nZuQs7MzNBoNLvsSBSkh9XpdyH51XcfNzQ0qlYqQ/fOEjBBd13F4eMh9v4VCAc1mE7lcjvu+ReAd9kqtH9VqFZkM31F4rVZDq9UiL8O7lEImQninq4uLCxwdHYVun06nMAyD6zF5IF1INpvF5eUlisVi4PZqtRp0x+yCoKi+vb1FuVwO/T+2bePl5QXNZjN5gwUjTYimaWg0Gmg0GtxTlW3boUK+vr7Q6XRQKpW4HpMX0oS0Wq3QqNiU5+dnFAqFlUFCv99Hr9cDgKW5DiXcn2bqBV10/u52uxiPxwCA+XyObre7kAHQE+IW9p1dXJzNZnh6esJwOMT9/T3e3t6WtvNOk7yQlrJ6vd6iU0zTRLVaDfw727bR7/eZjjEajUIXCalFiIs0IR8fH4t/G4YRKmQymaz8unlAVQjNuN1jlBBiKCHEUEKIoYQQQwkhhhJCDCWEGEoIMVwhWtQ5B4V43OuzyEcI1SUOUZAQMpvNQrcVCoUUWyIfEkJ+f39Dt+VyOZyenq58rus6TNNENpsV2bTUkX5OHfh3LW0UJycnqNfrGI1G0DQNhmEgm81C0zQ8Pj5iMpmk1FLxeCNEWmEfj8eLs3thGIaBcrmMUqmEXC63U7XFe8E1iZQFgPkk1K5BSoht27KbIR0yQgDg4eFh6UziOhzHwXw+F9ii9PEXdc2yLGmXlM7nc3Q6HRSLRdRqNZRKJRiGgYODAziOg9lshul0iuFwiO/vb3x+fmI6nUppKy+24oYd27aFp6/BYIDBYCD0GCwEpSy1jJISQc8+IVVDFBFCVJSIJax/w4TszqyLNiv9rFIWMaKEqOIuiKgHma2LECWFM+ueKqdSFjHiCFFRwglez1x0nzbAo017i2VZsZ6wFEuIZVlqGMyBOP2YqIaoKGEjSb8lEaJB1ZPEeOpGrCzDNMpSUuLB0k8sQlQ9SUai/mKdh6jUtQbWN+xs+pa2vXxVXhSbvpd905m6Sl/BMPcLj6UTlb7+4PEeQ57vwt3b9LVpmvLCc3FRA/ZvSMxTBsB/tXevJo9JJ31xUO9TZ0Dk+9RFnQ/RAGi7uErsWbXlGhkuoiLEz9YXfN61Ioy0zhhudW0RUSvCSCtCvGxFfRFZJ6KQIcSFpBhZIhYHlCjEi/Qak1aNWAcVIS5LjREpKKCekViXoybEz0rjWCSFDCZICPBDXUgQLA0m2flB/AcOdf8LLnR8eQAAAABJRU5ErkJggg==', '200000', NULL, NULL, 1, 1, 'Quốc Mạnh', NULL, 'Quốc Mạnh', '2023-01-15 01:39:43', '2023-01-15 01:43:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_episodes`
--

CREATE TABLE `course_episodes` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `link_video` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `episodes` int NOT NULL,
  `course_id` bigint DEFAULT NULL,
  `status` int DEFAULT NULL,
  `user_created` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_updated` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_deleted` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(15, 'title 5', 'content 5', 'video/1673368196.mp4', 2, 2, 1, 'Manh Alvin', NULL, NULL, '2023-01-10 09:29:56', '2023-01-10 09:29:56', NULL),
(19, 'title 12', 'content 12', 'video/1673773556.mp4', 4, 6, 1, 'Quốc Mạnh', NULL, 'Quốc Mạnh', '2023-01-15 02:02:56', '2023-01-15 02:06:28', '2023-01-15 02:06:28'),
(20, 'title 123', 'content 123', 'video/1673790780.mp4', 4, 6, 1, 'Trần Quốc Mạnh', NULL, NULL, '2023-01-15 06:18:59', '2023-01-15 06:53:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `failed_jobs`
--

INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(1, 'aee2fd89-d62e-4c4c-911c-b10e67d98620', 'database', 'default', '{\"uuid\":\"aee2fd89-d62e-4c4c-911c-b10e67d98620\",\"displayName\":\"App\\\\Listeners\\\\CreateUserListener\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":19:{s:5:\\\"class\\\";s:32:\\\"App\\\\Listeners\\\\CreateUserListener\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:26:\\\"App\\\\Events\\\\CreateUserEvent\\\":3:{s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";N;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";N;}s:4:\\\"data\\\";a:4:{s:4:\\\"name\\\";s:8:\\\"quocmanh\\\";s:5:\\\"email\\\";s:26:\\\"quocmanh.tran@gumiviet.com\\\";s:4:\\\"uuid\\\";s:32:\\\"ecebcb12e4c96ba487fd76bbdc8d8636\\\";s:7:\\\"message\\\";s:20:\\\"Your OTP is - 876132\\\";}s:6:\\\"socket\\\";N;}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Illuminate\\Database\\Eloquent\\ModelNotFoundException: No query results for model [App\\Models\\User]. in C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Database\\Eloquent\\Builder.php:527\nStack trace:\n#0 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesAndRestoresModelIdentifiers.php(102): Illuminate\\Database\\Eloquent\\Builder->firstOrFail()\n#1 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesAndRestoresModelIdentifiers.php(57): App\\Events\\CreateUserEvent->restoreModel(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#2 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesModels.php(122): App\\Events\\CreateUserEvent->getRestoredPropertyValue(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#3 [internal function]: App\\Events\\CreateUserEvent->__unserialize(Array)\n#4 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(97): unserialize(\'O:36:\"Illuminat...\')\n#5 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(60): Illuminate\\Queue\\CallQueuedHandler->getCommand(Array)\n#6 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#7 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(428): Illuminate\\Queue\\Jobs\\Job->fire()\n#8 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(378): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#9 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(172): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#10 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(117): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#11 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(101): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#12 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#13 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#14 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#15 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#16 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(653): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#17 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(136): Illuminate\\Container\\Container->call(Array)\n#18 C:\\laragon\\www\\Laravel\\vendor\\symfony\\console\\Command\\Command.php(298): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#19 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#20 C:\\laragon\\www\\Laravel\\vendor\\symfony\\console\\Application.php(1040): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#21 C:\\laragon\\www\\Laravel\\vendor\\symfony\\console\\Application.php(301): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#22 C:\\laragon\\www\\Laravel\\vendor\\symfony\\console\\Application.php(171): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#23 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Application.php(94): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#24 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#25 C:\\laragon\\www\\Laravel\\artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#26 {main}', '2023-01-15 08:56:04'),
(2, '8e986ce7-a49e-4fe7-892c-3746de4da829', 'database', 'default', '{\"uuid\":\"8e986ce7-a49e-4fe7-892c-3746de4da829\",\"displayName\":\"App\\\\Jobs\\\\SigninEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SigninEmail\",\"command\":\"O:20:\\\"App\\\\Jobs\\\\SigninEmail\\\":12:{s:17:\\\"\\u0000*\\u0000userRepository\\\";O:44:\\\"App\\\\Repositories\\\\Eloquent\\\\API\\\\UserRepository\\\":1:{s:7:\\\"\\u0000*\\u0000user\\\";O:15:\\\"App\\\\Models\\\\User\\\":33:{s:13:\\\"\\u0000*\\u0000connection\\\";N;s:8:\\\"\\u0000*\\u0000table\\\";N;s:13:\\\"\\u0000*\\u0000primaryKey\\\";s:2:\\\"id\\\";s:10:\\\"\\u0000*\\u0000keyType\\\";s:3:\\\"int\\\";s:12:\\\"incrementing\\\";b:1;s:7:\\\"\\u0000*\\u0000with\\\";a:0:{}s:12:\\\"\\u0000*\\u0000withCount\\\";a:0:{}s:19:\\\"preventsLazyLoading\\\";b:0;s:10:\\\"\\u0000*\\u0000perPage\\\";i:15;s:6:\\\"exists\\\";b:0;s:18:\\\"wasRecentlyCreated\\\";b:0;s:28:\\\"\\u0000*\\u0000escapeWhenCastingToString\\\";b:0;s:13:\\\"\\u0000*\\u0000attributes\\\";a:0:{}s:11:\\\"\\u0000*\\u0000original\\\";a:0:{}s:10:\\\"\\u0000*\\u0000changes\\\";a:0:{}s:8:\\\"\\u0000*\\u0000casts\\\";a:2:{s:17:\\\"email_verified_at\\\";s:8:\\\"datetime\\\";s:10:\\\"deleted_at\\\";s:8:\\\"datetime\\\";}s:17:\\\"\\u0000*\\u0000classCastCache\\\";a:0:{}s:21:\\\"\\u0000*\\u0000attributeCastCache\\\";a:0:{}s:8:\\\"\\u0000*\\u0000dates\\\";a:0:{}s:13:\\\"\\u0000*\\u0000dateFormat\\\";N;s:10:\\\"\\u0000*\\u0000appends\\\";a:0:{}s:19:\\\"\\u0000*\\u0000dispatchesEvents\\\";a:0:{}s:14:\\\"\\u0000*\\u0000observables\\\";a:0:{}s:12:\\\"\\u0000*\\u0000relations\\\";a:0:{}s:10:\\\"\\u0000*\\u0000touches\\\";a:0:{}s:10:\\\"timestamps\\\";b:1;s:9:\\\"\\u0000*\\u0000hidden\\\";a:2:{i:0;s:8:\\\"password\\\";i:1;s:14:\\\"remember_token\\\";}s:10:\\\"\\u0000*\\u0000visible\\\";a:0:{}s:11:\\\"\\u0000*\\u0000fillable\\\";a:0:{}s:10:\\\"\\u0000*\\u0000guarded\\\";a:1:{i:0;s:16:\\\"confirm_password\\\";}s:20:\\\"\\u0000*\\u0000rememberTokenName\\\";s:14:\\\"remember_token\\\";s:14:\\\"\\u0000*\\u0000accessToken\\\";N;s:16:\\\"\\u0000*\\u0000forceDeleting\\\";b:0;}}s:7:\\\"\\u0000*\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";N;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";N;}s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";O:13:\\\"Carbon\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2023-01-15 15:56:05.184717\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Illuminate\\Database\\Eloquent\\ModelNotFoundException: No query results for model [App\\Models\\User]. in C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Database\\Eloquent\\Builder.php:527\nStack trace:\n#0 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesAndRestoresModelIdentifiers.php(102): Illuminate\\Database\\Eloquent\\Builder->firstOrFail()\n#1 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesAndRestoresModelIdentifiers.php(57): App\\Jobs\\SigninEmail->restoreModel(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#2 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesModels.php(122): App\\Jobs\\SigninEmail->getRestoredPropertyValue(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#3 [internal function]: App\\Jobs\\SigninEmail->__unserialize(Array)\n#4 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(97): unserialize(\'O:20:\"App\\\\Jobs\\\\...\')\n#5 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(60): Illuminate\\Queue\\CallQueuedHandler->getCommand(Array)\n#6 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#7 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(428): Illuminate\\Queue\\Jobs\\Job->fire()\n#8 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(378): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#9 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(172): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#10 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(117): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#11 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(101): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#12 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#13 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#14 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#15 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#16 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(653): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#17 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(136): Illuminate\\Container\\Container->call(Array)\n#18 C:\\laragon\\www\\Laravel\\vendor\\symfony\\console\\Command\\Command.php(298): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#19 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#20 C:\\laragon\\www\\Laravel\\vendor\\symfony\\console\\Application.php(1040): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#21 C:\\laragon\\www\\Laravel\\vendor\\symfony\\console\\Application.php(301): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#22 C:\\laragon\\www\\Laravel\\vendor\\symfony\\console\\Application.php(171): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#23 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Application.php(94): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#24 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#25 C:\\laragon\\www\\Laravel\\artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#26 {main}', '2023-01-15 08:56:05'),
(3, '76359e4e-8c10-44ce-9423-9ec149de3077', 'database', 'default', '{\"uuid\":\"76359e4e-8c10-44ce-9423-9ec149de3077\",\"displayName\":\"App\\\\Jobs\\\\SigninEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SigninEmail\",\"command\":\"O:20:\\\"App\\\\Jobs\\\\SigninEmail\\\":12:{s:17:\\\"\\u0000*\\u0000userRepository\\\";O:44:\\\"App\\\\Repositories\\\\Eloquent\\\\API\\\\UserRepository\\\":1:{s:7:\\\"\\u0000*\\u0000user\\\";O:15:\\\"App\\\\Models\\\\User\\\":33:{s:13:\\\"\\u0000*\\u0000connection\\\";N;s:8:\\\"\\u0000*\\u0000table\\\";N;s:13:\\\"\\u0000*\\u0000primaryKey\\\";s:2:\\\"id\\\";s:10:\\\"\\u0000*\\u0000keyType\\\";s:3:\\\"int\\\";s:12:\\\"incrementing\\\";b:1;s:7:\\\"\\u0000*\\u0000with\\\";a:0:{}s:12:\\\"\\u0000*\\u0000withCount\\\";a:0:{}s:19:\\\"preventsLazyLoading\\\";b:0;s:10:\\\"\\u0000*\\u0000perPage\\\";i:15;s:6:\\\"exists\\\";b:0;s:18:\\\"wasRecentlyCreated\\\";b:0;s:28:\\\"\\u0000*\\u0000escapeWhenCastingToString\\\";b:0;s:13:\\\"\\u0000*\\u0000attributes\\\";a:0:{}s:11:\\\"\\u0000*\\u0000original\\\";a:0:{}s:10:\\\"\\u0000*\\u0000changes\\\";a:0:{}s:8:\\\"\\u0000*\\u0000casts\\\";a:2:{s:17:\\\"email_verified_at\\\";s:8:\\\"datetime\\\";s:10:\\\"deleted_at\\\";s:8:\\\"datetime\\\";}s:17:\\\"\\u0000*\\u0000classCastCache\\\";a:0:{}s:21:\\\"\\u0000*\\u0000attributeCastCache\\\";a:0:{}s:8:\\\"\\u0000*\\u0000dates\\\";a:0:{}s:13:\\\"\\u0000*\\u0000dateFormat\\\";N;s:10:\\\"\\u0000*\\u0000appends\\\";a:0:{}s:19:\\\"\\u0000*\\u0000dispatchesEvents\\\";a:0:{}s:14:\\\"\\u0000*\\u0000observables\\\";a:0:{}s:12:\\\"\\u0000*\\u0000relations\\\";a:0:{}s:10:\\\"\\u0000*\\u0000touches\\\";a:0:{}s:10:\\\"timestamps\\\";b:1;s:9:\\\"\\u0000*\\u0000hidden\\\";a:2:{i:0;s:8:\\\"password\\\";i:1;s:14:\\\"remember_token\\\";}s:10:\\\"\\u0000*\\u0000visible\\\";a:0:{}s:11:\\\"\\u0000*\\u0000fillable\\\";a:0:{}s:10:\\\"\\u0000*\\u0000guarded\\\";a:1:{i:0;s:16:\\\"confirm_password\\\";}s:20:\\\"\\u0000*\\u0000rememberTokenName\\\";s:14:\\\"remember_token\\\";s:14:\\\"\\u0000*\\u0000accessToken\\\";N;s:16:\\\"\\u0000*\\u0000forceDeleting\\\";b:0;}}s:7:\\\"\\u0000*\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";N;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";N;}s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";O:13:\\\"Carbon\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2023-01-15 15:57:15.903155\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Illuminate\\Database\\Eloquent\\ModelNotFoundException: No query results for model [App\\Models\\User]. in C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Database\\Eloquent\\Builder.php:527\nStack trace:\n#0 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesAndRestoresModelIdentifiers.php(102): Illuminate\\Database\\Eloquent\\Builder->firstOrFail()\n#1 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesAndRestoresModelIdentifiers.php(57): App\\Jobs\\SigninEmail->restoreModel(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#2 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesModels.php(122): App\\Jobs\\SigninEmail->getRestoredPropertyValue(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#3 [internal function]: App\\Jobs\\SigninEmail->__unserialize(Array)\n#4 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(97): unserialize(\'O:20:\"App\\\\Jobs\\\\...\')\n#5 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(60): Illuminate\\Queue\\CallQueuedHandler->getCommand(Array)\n#6 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#7 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(428): Illuminate\\Queue\\Jobs\\Job->fire()\n#8 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(378): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#9 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(172): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#10 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(117): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#11 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(101): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#12 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#13 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#14 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#15 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#16 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(653): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#17 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(136): Illuminate\\Container\\Container->call(Array)\n#18 C:\\laragon\\www\\Laravel\\vendor\\symfony\\console\\Command\\Command.php(298): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#19 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#20 C:\\laragon\\www\\Laravel\\vendor\\symfony\\console\\Application.php(1040): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#21 C:\\laragon\\www\\Laravel\\vendor\\symfony\\console\\Application.php(301): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#22 C:\\laragon\\www\\Laravel\\vendor\\symfony\\console\\Application.php(171): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#23 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Application.php(94): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#24 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#25 C:\\laragon\\www\\Laravel\\artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#26 {main}', '2023-01-15 08:57:16'),
(4, 'd9c03c32-2810-46fe-9dbb-4dab2ba80d85', 'database', 'default', '{\"uuid\":\"d9c03c32-2810-46fe-9dbb-4dab2ba80d85\",\"displayName\":\"App\\\\Listeners\\\\CreateUserListener\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":19:{s:5:\\\"class\\\";s:32:\\\"App\\\\Listeners\\\\CreateUserListener\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:26:\\\"App\\\\Events\\\\CreateUserEvent\\\":3:{s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";N;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";N;}s:4:\\\"data\\\";a:4:{s:4:\\\"name\\\";s:8:\\\"quocmanh\\\";s:5:\\\"email\\\";s:26:\\\"quocmanh.tran@gumiviet.com\\\";s:4:\\\"uuid\\\";s:32:\\\"e57adaf9f0c2ad401f68fe5b2bbdbf38\\\";s:7:\\\"message\\\";s:20:\\\"Your OTP is - 775491\\\";}s:6:\\\"socket\\\";N;}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Illuminate\\Database\\Eloquent\\ModelNotFoundException: No query results for model [App\\Models\\User]. in C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Database\\Eloquent\\Builder.php:527\nStack trace:\n#0 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesAndRestoresModelIdentifiers.php(102): Illuminate\\Database\\Eloquent\\Builder->firstOrFail()\n#1 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesAndRestoresModelIdentifiers.php(57): App\\Events\\CreateUserEvent->restoreModel(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#2 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesModels.php(122): App\\Events\\CreateUserEvent->getRestoredPropertyValue(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#3 [internal function]: App\\Events\\CreateUserEvent->__unserialize(Array)\n#4 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(97): unserialize(\'O:36:\"Illuminat...\')\n#5 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(60): Illuminate\\Queue\\CallQueuedHandler->getCommand(Array)\n#6 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#7 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(428): Illuminate\\Queue\\Jobs\\Job->fire()\n#8 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(378): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#9 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(172): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#10 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(117): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#11 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(101): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#12 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#13 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#14 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#15 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#16 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(653): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#17 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(136): Illuminate\\Container\\Container->call(Array)\n#18 C:\\laragon\\www\\Laravel\\vendor\\symfony\\console\\Command\\Command.php(298): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#19 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#20 C:\\laragon\\www\\Laravel\\vendor\\symfony\\console\\Application.php(1040): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#21 C:\\laragon\\www\\Laravel\\vendor\\symfony\\console\\Application.php(301): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#22 C:\\laragon\\www\\Laravel\\vendor\\symfony\\console\\Application.php(171): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#23 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Application.php(94): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#24 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#25 C:\\laragon\\www\\Laravel\\artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#26 {main}', '2023-01-15 08:57:16'),
(5, '922a864a-f564-4d89-b03c-f0399616ffb7', 'database', 'default', '{\"uuid\":\"922a864a-f564-4d89-b03c-f0399616ffb7\",\"displayName\":\"App\\\\Listeners\\\\CreateUserListener\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":19:{s:5:\\\"class\\\";s:32:\\\"App\\\\Listeners\\\\CreateUserListener\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:26:\\\"App\\\\Events\\\\CreateUserEvent\\\":3:{s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";N;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";N;}s:4:\\\"data\\\";a:4:{s:4:\\\"name\\\";s:8:\\\"quocmanh\\\";s:5:\\\"email\\\";s:26:\\\"quocmanh.tran@gumiviet.com\\\";s:4:\\\"uuid\\\";s:32:\\\"9a4cda539496f7e477659fb68908fa4c\\\";s:7:\\\"message\\\";s:20:\\\"Your OTP is - 291352\\\";}s:6:\\\"socket\\\";N;}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Illuminate\\Database\\Eloquent\\ModelNotFoundException: No query results for model [App\\Models\\User]. in C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Database\\Eloquent\\Builder.php:527\nStack trace:\n#0 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesAndRestoresModelIdentifiers.php(102): Illuminate\\Database\\Eloquent\\Builder->firstOrFail()\n#1 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesAndRestoresModelIdentifiers.php(57): App\\Events\\CreateUserEvent->restoreModel(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#2 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesModels.php(122): App\\Events\\CreateUserEvent->getRestoredPropertyValue(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#3 [internal function]: App\\Events\\CreateUserEvent->__unserialize(Array)\n#4 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(97): unserialize(\'O:36:\"Illuminat...\')\n#5 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(60): Illuminate\\Queue\\CallQueuedHandler->getCommand(Array)\n#6 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#7 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(428): Illuminate\\Queue\\Jobs\\Job->fire()\n#8 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(378): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#9 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(172): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#10 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(117): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#11 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(101): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#12 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#13 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#14 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#15 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#16 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(653): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#17 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(136): Illuminate\\Container\\Container->call(Array)\n#18 C:\\laragon\\www\\Laravel\\vendor\\symfony\\console\\Command\\Command.php(298): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#19 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#20 C:\\laragon\\www\\Laravel\\vendor\\symfony\\console\\Application.php(1040): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#21 C:\\laragon\\www\\Laravel\\vendor\\symfony\\console\\Application.php(301): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#22 C:\\laragon\\www\\Laravel\\vendor\\symfony\\console\\Application.php(171): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#23 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Application.php(94): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#24 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#25 C:\\laragon\\www\\Laravel\\artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#26 {main}', '2023-01-15 08:57:56'),
(6, '3bd56d75-c938-48ff-a7c1-8923b6ea8e14', 'database', 'default', '{\"uuid\":\"3bd56d75-c938-48ff-a7c1-8923b6ea8e14\",\"displayName\":\"App\\\\Listeners\\\\CreateUserListener\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Events\\\\CallQueuedListener\",\"command\":\"O:36:\\\"Illuminate\\\\Events\\\\CallQueuedListener\\\":19:{s:5:\\\"class\\\";s:32:\\\"App\\\\Listeners\\\\CreateUserListener\\\";s:6:\\\"method\\\";s:6:\\\"handle\\\";s:4:\\\"data\\\";a:1:{i:0;O:26:\\\"App\\\\Events\\\\CreateUserEvent\\\":3:{s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";N;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";N;}s:4:\\\"data\\\";a:4:{s:4:\\\"name\\\";s:8:\\\"quocmanh\\\";s:5:\\\"email\\\";s:26:\\\"quocmanh.tran@gumiviet.com\\\";s:4:\\\"uuid\\\";s:32:\\\"2d0b7af26548ce9eb82b66f2444c9b51\\\";s:7:\\\"message\\\";s:20:\\\"Your OTP is - 495636\\\";}s:6:\\\"socket\\\";N;}}s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"retryUntil\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Illuminate\\Database\\Eloquent\\ModelNotFoundException: No query results for model [App\\Models\\User]. in C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Database\\Eloquent\\Builder.php:527\nStack trace:\n#0 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesAndRestoresModelIdentifiers.php(102): Illuminate\\Database\\Eloquent\\Builder->firstOrFail()\n#1 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesAndRestoresModelIdentifiers.php(57): App\\Events\\CreateUserEvent->restoreModel(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#2 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesModels.php(122): App\\Events\\CreateUserEvent->getRestoredPropertyValue(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#3 [internal function]: App\\Events\\CreateUserEvent->__unserialize(Array)\n#4 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(97): unserialize(\'O:36:\"Illuminat...\')\n#5 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(60): Illuminate\\Queue\\CallQueuedHandler->getCommand(Array)\n#6 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#7 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(428): Illuminate\\Queue\\Jobs\\Job->fire()\n#8 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(378): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#9 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(172): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#10 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(117): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#11 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(101): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#12 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#13 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#14 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#15 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#16 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(653): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#17 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(136): Illuminate\\Container\\Container->call(Array)\n#18 C:\\laragon\\www\\Laravel\\vendor\\symfony\\console\\Command\\Command.php(298): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#19 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#20 C:\\laragon\\www\\Laravel\\vendor\\symfony\\console\\Application.php(1040): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#21 C:\\laragon\\www\\Laravel\\vendor\\symfony\\console\\Application.php(301): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#22 C:\\laragon\\www\\Laravel\\vendor\\symfony\\console\\Application.php(171): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#23 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Application.php(94): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#24 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#25 C:\\laragon\\www\\Laravel\\artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#26 {main}', '2023-01-15 08:59:15');
INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(7, 'ad04531b-295c-4531-bfaf-405e38eef327', 'database', 'default', '{\"uuid\":\"ad04531b-295c-4531-bfaf-405e38eef327\",\"displayName\":\"App\\\\Jobs\\\\SigninEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SigninEmail\",\"command\":\"O:20:\\\"App\\\\Jobs\\\\SigninEmail\\\":12:{s:17:\\\"\\u0000*\\u0000userRepository\\\";O:44:\\\"App\\\\Repositories\\\\Eloquent\\\\API\\\\UserRepository\\\":1:{s:7:\\\"\\u0000*\\u0000user\\\";O:15:\\\"App\\\\Models\\\\User\\\":33:{s:13:\\\"\\u0000*\\u0000connection\\\";N;s:8:\\\"\\u0000*\\u0000table\\\";N;s:13:\\\"\\u0000*\\u0000primaryKey\\\";s:2:\\\"id\\\";s:10:\\\"\\u0000*\\u0000keyType\\\";s:3:\\\"int\\\";s:12:\\\"incrementing\\\";b:1;s:7:\\\"\\u0000*\\u0000with\\\";a:0:{}s:12:\\\"\\u0000*\\u0000withCount\\\";a:0:{}s:19:\\\"preventsLazyLoading\\\";b:0;s:10:\\\"\\u0000*\\u0000perPage\\\";i:15;s:6:\\\"exists\\\";b:0;s:18:\\\"wasRecentlyCreated\\\";b:0;s:28:\\\"\\u0000*\\u0000escapeWhenCastingToString\\\";b:0;s:13:\\\"\\u0000*\\u0000attributes\\\";a:0:{}s:11:\\\"\\u0000*\\u0000original\\\";a:0:{}s:10:\\\"\\u0000*\\u0000changes\\\";a:0:{}s:8:\\\"\\u0000*\\u0000casts\\\";a:2:{s:17:\\\"email_verified_at\\\";s:8:\\\"datetime\\\";s:10:\\\"deleted_at\\\";s:8:\\\"datetime\\\";}s:17:\\\"\\u0000*\\u0000classCastCache\\\";a:0:{}s:21:\\\"\\u0000*\\u0000attributeCastCache\\\";a:0:{}s:8:\\\"\\u0000*\\u0000dates\\\";a:0:{}s:13:\\\"\\u0000*\\u0000dateFormat\\\";N;s:10:\\\"\\u0000*\\u0000appends\\\";a:0:{}s:19:\\\"\\u0000*\\u0000dispatchesEvents\\\";a:0:{}s:14:\\\"\\u0000*\\u0000observables\\\";a:0:{}s:12:\\\"\\u0000*\\u0000relations\\\";a:0:{}s:10:\\\"\\u0000*\\u0000touches\\\";a:0:{}s:10:\\\"timestamps\\\";b:1;s:9:\\\"\\u0000*\\u0000hidden\\\";a:2:{i:0;s:8:\\\"password\\\";i:1;s:14:\\\"remember_token\\\";}s:10:\\\"\\u0000*\\u0000visible\\\";a:0:{}s:11:\\\"\\u0000*\\u0000fillable\\\";a:0:{}s:10:\\\"\\u0000*\\u0000guarded\\\";a:1:{i:0;s:16:\\\"confirm_password\\\";}s:20:\\\"\\u0000*\\u0000rememberTokenName\\\";s:14:\\\"remember_token\\\";s:14:\\\"\\u0000*\\u0000accessToken\\\";N;s:16:\\\"\\u0000*\\u0000forceDeleting\\\";b:0;}}s:7:\\\"\\u0000*\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";N;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";N;}s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";O:13:\\\"Carbon\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2023-01-15 15:59:16.679629\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Illuminate\\Database\\Eloquent\\ModelNotFoundException: No query results for model [App\\Models\\User]. in C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Database\\Eloquent\\Builder.php:527\nStack trace:\n#0 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesAndRestoresModelIdentifiers.php(102): Illuminate\\Database\\Eloquent\\Builder->firstOrFail()\n#1 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesAndRestoresModelIdentifiers.php(57): App\\Jobs\\SigninEmail->restoreModel(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#2 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesModels.php(122): App\\Jobs\\SigninEmail->getRestoredPropertyValue(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#3 [internal function]: App\\Jobs\\SigninEmail->__unserialize(Array)\n#4 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(97): unserialize(\'O:20:\"App\\\\Jobs\\\\...\')\n#5 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(60): Illuminate\\Queue\\CallQueuedHandler->getCommand(Array)\n#6 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#7 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(428): Illuminate\\Queue\\Jobs\\Job->fire()\n#8 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(378): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#9 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(172): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#10 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(117): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#11 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(101): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#12 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#13 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#14 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#15 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#16 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(653): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#17 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(136): Illuminate\\Container\\Container->call(Array)\n#18 C:\\laragon\\www\\Laravel\\vendor\\symfony\\console\\Command\\Command.php(298): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#19 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#20 C:\\laragon\\www\\Laravel\\vendor\\symfony\\console\\Application.php(1040): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#21 C:\\laragon\\www\\Laravel\\vendor\\symfony\\console\\Application.php(301): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#22 C:\\laragon\\www\\Laravel\\vendor\\symfony\\console\\Application.php(171): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#23 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Application.php(94): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#24 C:\\laragon\\www\\Laravel\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#25 C:\\laragon\\www\\Laravel\\artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#26 {main}', '2023-01-15 08:59:18');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(33, 'default', '{\"uuid\":\"236ef001-6642-4b6d-beee-fe7be328479e\",\"displayName\":\"App\\\\Jobs\\\\CreateUserJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\CreateUserJob\",\"command\":\"O:22:\\\"App\\\\Jobs\\\\CreateUserJob\\\":12:{s:12:\\\"\\u0000*\\u0000inputData\\\";a:7:{s:8:\\\"username\\\";s:8:\\\"quocmanh\\\";s:5:\\\"email\\\";s:26:\\\"quocmanh.tran@gumiviet.com\\\";s:8:\\\"password\\\";s:9:\\\"123456789\\\";s:16:\\\"confirm_password\\\";s:9:\\\"123456789\\\";s:5:\\\"phone\\\";s:10:\\\"0961154483\\\";s:4:\\\"name\\\";s:13:\\\"Quốc Mạnh\\\";s:4:\\\"uuid\\\";s:32:\\\"83a224caa84f7edd979ebbca858b8b9c\\\";}s:11:\\\"\\u0000*\\u0000userData\\\";a:4:{s:4:\\\"name\\\";s:8:\\\"quocmanh\\\";s:5:\\\"email\\\";s:26:\\\"quocmanh.tran@gumiviet.com\\\";s:4:\\\"uuid\\\";s:32:\\\"83a224caa84f7edd979ebbca858b8b9c\\\";s:7:\\\"message\\\";s:20:\\\"Your OTP is - 776323\\\";}s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";O:13:\\\"Carbon\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2023-01-16 04:41:12.248296\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1673844072, 1673844071),
(34, 'default', '{\"uuid\":\"8595e9da-eb8e-432d-96eb-87890090b829\",\"displayName\":\"App\\\\Jobs\\\\CreateUserJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\CreateUserJob\",\"command\":\"O:22:\\\"App\\\\Jobs\\\\CreateUserJob\\\":12:{s:12:\\\"\\u0000*\\u0000inputData\\\";a:7:{s:8:\\\"username\\\";s:8:\\\"quocmanh\\\";s:5:\\\"email\\\";s:26:\\\"quocmanh.tran@gumiviet.com\\\";s:8:\\\"password\\\";s:9:\\\"123456789\\\";s:16:\\\"confirm_password\\\";s:9:\\\"123456789\\\";s:5:\\\"phone\\\";s:10:\\\"0961154483\\\";s:4:\\\"name\\\";s:13:\\\"Quốc Mạnh\\\";s:4:\\\"uuid\\\";s:32:\\\"33a9bdb0aeb604b5bf6990849278078b\\\";}s:11:\\\"\\u0000*\\u0000userData\\\";a:4:{s:4:\\\"name\\\";s:8:\\\"quocmanh\\\";s:5:\\\"email\\\";s:26:\\\"quocmanh.tran@gumiviet.com\\\";s:4:\\\"uuid\\\";s:32:\\\"33a9bdb0aeb604b5bf6990849278078b\\\";s:7:\\\"message\\\";s:20:\\\"Your OTP is - 685922\\\";}s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";O:13:\\\"Carbon\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2023-01-16 04:41:43.039065\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1673844103, 1673844102),
(35, 'default', '{\"uuid\":\"50f88b77-d389-4285-86ae-20c029e1ba5d\",\"displayName\":\"App\\\\Jobs\\\\CreateUserJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\CreateUserJob\",\"command\":\"O:22:\\\"App\\\\Jobs\\\\CreateUserJob\\\":12:{s:12:\\\"\\u0000*\\u0000inputData\\\";a:7:{s:8:\\\"username\\\";s:8:\\\"quocmanh\\\";s:5:\\\"email\\\";s:26:\\\"quocmanh.tran@gumiviet.com\\\";s:8:\\\"password\\\";s:9:\\\"123456789\\\";s:16:\\\"confirm_password\\\";s:9:\\\"123456789\\\";s:5:\\\"phone\\\";s:10:\\\"0961154483\\\";s:4:\\\"name\\\";s:13:\\\"Quốc Mạnh\\\";s:4:\\\"uuid\\\";s:32:\\\"823447415b328c0a6e9388e19d08d431\\\";}s:11:\\\"\\u0000*\\u0000userData\\\";a:4:{s:4:\\\"name\\\";s:8:\\\"quocmanh\\\";s:5:\\\"email\\\";s:26:\\\"quocmanh.tran@gumiviet.com\\\";s:4:\\\"uuid\\\";s:32:\\\"823447415b328c0a6e9388e19d08d431\\\";s:7:\\\"message\\\";s:20:\\\"Your OTP is - 170543\\\";}s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";O:13:\\\"Carbon\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2023-01-16 04:43:24.395875\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1673844204, 1673844203);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `order_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_quantify` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_destroy` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `original_amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `final_amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint DEFAULT NULL,
  `status` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_created` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_updated` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_deleted` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `order_code`, `total_quantify`, `payment_method`, `order_date`, `order_destroy`, `original_amount`, `discount_amount`, `coupon_code`, `final_amount`, `user_id`, `status`, `user_created`, `user_updated`, `user_deleted`, `created_at`, `updated_at`, `deleted_at`) VALUES
(61, 'Trần Quốc Mạnh', 'manhquoc1998s@gmail.com', 'IS-D1VAMYCN', '2', 'home', '2023-01-16 16:22:25', NULL, '1498000', '524300', 'TET2023', '973700', 73, 'completed', 'Quốc Mạnh', NULL, NULL, '2023-01-16 09:22:25', '2023-01-16 02:23:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantify` int NOT NULL,
  `sub_total` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `thumbnail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_created` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_updated` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_deleted` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(129, 'Học Photoshop trọn bộ trong 7 ngày', '799000', 1, '799000', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAE60lEQVR4nO2d207qQBSG/7YYUKN4rNFwxZ3c9v0foU9gTEg0Gq0mHIII2HZfSEl36WmGNe1g13cppjPMx1prZnoywjAEow+tujsggcwvyCDvhSJ0F7I1+K7rCh/EcZw0iVpKMjRLWf91Rmbwy+I4TvJPWgjSRUgIqBVQRExQrWLqFLJpuE4RSRKRU7mcOoRoKSJJXWKqFhLqLCGLtZxKpJhVNILfqNhLGcAmkkPITbmFUCrEdd2NiH2VERH7DuH6eylBVcraizohi8r6okzIXxSRREVtoU5Ze10rRFFRWyiF1L64q4PY9yWRQpWyGhMVeVCkMIoIYRlrYilMml2FaLERpiHS47JLyuLIyEE2fclGCMsoQDZ9yQjhNCWG0HhJRQhHRzlkxklESKMWfVSILh6FIoRlyCEybqWEqNzdbBJlxrHstJdTFQFlpsJlIoRlEFFmKlzVGUOmJEVCODqIKYqSPCEsQxF5UjhlaUaWEJ7mVsPWOGdGCKcrtWSNL6cszUhbGEoX836/j/Pz89TP3t/f8fT0JHzMwWCAw8PD1M+GwyE+Pz+l+5QkDEP4vg/f97FcLjGfzzGbzTAej+H7vnDfy5BcLOp+f0ilGIaBVquFVquFdruNk5MTAEAQBBiNRnh5ecFisVDah2TK4qluCqZp4uLiAoPBADc3N6THTk6BuYYIYJomer0e7u7u1LWh7Mh/mNvbW5ydnSk5dqOFBEGwKeK+70Pkgo9er6ekT/Gi3rj68fHxsTXzsywLx8fHuL6+zo2CdruNbreL8Xi8cz9c141uTDUaHSFp+L6PyWSCx8dHPD8/5/5vt9slb5+F5PD29oavr6/Mz4+OjsjbZCEFjEajzM8ODg7I22MhBeQtBC3LIm8vEtK4gl4W08z+zQZBQNZOtEDkCCkgax8NAH5+fsjbq2wvy7Zt2LZdVXMkWJaVuzH5/f1N3iZHSAamaaLf7+cW7slkQt4u7/bGME0TnU4Hp6ensG07V0YQBCSLwiSNFnJ1dYXLy0sAv1vveQU8ied5WK1W5H1qtBARAXEWiwVeX1+Je/ML1xBBVqsVHh4elJ1BrCxCPM8r3BtK4/7+Hp1OR0GPxJlOpxgOh1gul8raqExIGIZSCykdHrA2m83geV7h+XsKGl1DksTPjUQXOEynU8zn88r60GghslfCqISLumZEQoyUp3QyFRJdn8URohksRDNYiGawEM2IC+HCXhPxC645QjSDhWgGC9GMpBCuIxWTvGGH9A4qRpykkLSUxVFSEWnPPuEaohmZQjhK1JI1vllCtHgfUwPYGmdOWZqRJ4SLuyLyHmRWFCEshZiip8pxytKMMkI4SoigeuZidJcoRZ8ai+M4pZ6wVEqI4zg8DSagzDgK1RCOEjlExk1EiAGuJ8LE6kapLCM1y2Ip5ZAZJxkhXE/EEBov2XUIp64CZN+ws+tb2hr5qrw8dn0v+64rdU5f6UiPC8XWCaevNRTvMaR8F25j09euaSoO5eaiATRvSkwpA6Df7W3U4lF00VcGfp+6BCrfp67qfIgBwPiLu8SxXVvSyIhQFSFJ9r7gU9eKLKo6Y7jXtUVFrciiqgiJsxf1RWWdyKMOIRFaiqlLxKZBHR5dAQ1qTFU1oghdhET81xmVglLqmRb7croJSbLVORlJGZMJLQQk0V1IGjId1nLw0/gHt84JHYHisiUAAAAASUVORK5CYII=', 'Quốc Mạnh', NULL, NULL, 61, 1, '2023-01-16 02:22:25', '2023-01-16 02:22:25', NULL),
(130, 'Thiết kế Web với Photoshop', '699000', 1, '699000', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAFTUlEQVR4nO2dXU/yMBSAzwAJEgkm88IYP9HFe/f/fwIx8cKYzPARglH8CkZdyGB7L2S8Y7T7KG1X6HmuDFto6eM5p+1gM4IgAEQdKkV3gAGW/yCDey8EobqQlcFvt9u538S2bZJEJSUZiqWspc6wDH5WbNuOv6SEIFWEBABiBaQREVSomCKFLBouUkScWORIl1OEECVFxClKjGwhgcoSaMzlSJFSktEI/EXFRsoAWERyAGxT7lwIFdJutxciNlVGSOQzBPPPJQRRKWsj6gQrIuuLMCHbKCKOiNrCO2VtdK3Ii4jawlNI4Yu7Ioh8Xi5SeKUsbaIiCR4pjEeEoIw5kRTGzLpClNgIUxDmcVknZWFkJMCavlgjBGWkwJq+WIRgmspHrvFiihCMjmywjFMeIVot+niRd/GYK0JQBht5xi2TEJG7mzqRZRyzTnsxVXEgy1Q4S4SgDE5kmQrLumKIZCRNCEYHZ9KiJEkIyhBEkhRMWYpBE4LTXDmsjDM1QjBdiYU2vqp/+z03e3t7cH19TTzmeR7c3d1J7lE+SBGCxVwSpOIuJEIMw4CbmxsRb72E67pwf38vvB2ZxCMEo0My8SjBaa9ioBDFQCGKERWC9aMgonVEyCwrCAK4vb1NPe/q6goajQbx2MvLCzw9PaW2s20IWxj6vp96TtKA+r6f6T22ja1bqfPANE04Pz+nHv/4+IButyukbSzqMfb39+Hs7Ix6fDweC5MB8F8IFnQAaDQacHFxAYZBvuz98/MDnU5HSNthYccImVOv1+Hy8hJKJfKQuK4LjuMIr2soBABqtRpYlgXlcpl4fDKZgOM4MJvNhPdFeyHVahUsy4JKhTy/8TwPHMcBz/Ok9EcrIfF0U6lUwLIsqFarxPNnsxk4jgOTyURG9wBAMyHRlFMqlcCyLKjVasRzfd+Hx8dHcF1XVvf++iW1tYKZTqeLv1utFtTrdeJ5QRBAp9OB7+9vWV1boJWQMEKOjo6g2WxSz+v3+zAej2V1awnthDSbTTg8PKSeMxgM4P39XWKvltFKyM7OTuLCz/M8eHt7k9yrZbQS0mw2qWsNgD9hp6enEnu0ilZCsmCaJhwcHBTWPgohcHx8TJ0OiyYUYhDu0rnVuK5LXX2Xy2VotVrUfS0RhD/m0TJCPj8/4eHhAfr9PvWc3d3dQuqJVkKCIIDhcAidTgd834fxeAyvr6/U84uoJ1oJmU6n8Pz8vPTaYDBI3B6RXU+0EkIiCALodrvU6xyy60m0Fe0Ke4jrujAcDqnHRdeT6K9ztY+QkNFolLh/ZZommKYpvB8oJEKv10u8EHVyciK8nqCQCNPpFHq9HvX7YjLqSfydta0jIV9fXzAajajHedeT+N0dMEIIDIdD+P39pR4XWU9o9zrB72lJgHTvE4wQxaAK0b2WiIY2vjQhSjyPSQNWxhlTlmIkCdF+CiyKpBuZpUUISuFM2l3lMGUpRhYhGCWc4HXPRWi32zgNXhPbtjPdYSmTENu2cRrMgSzjmKuGYJSwkWfc8ggxAOtJbiJ1I1OWYZploZRssIwTixCsJ/nINV6s6xBMXSmwPmFn3ae0afmovCTWfS77uit1TF9kmMeFx9YJpq85PJ5jyPNZuNqmr3XTVBSem4sGgH5TYp4yAPjv9mq1eMy76MsCPk+dAZHPUxd1PcQAAGMbd4kju7ZcIyNEVITE2fiCz7tW0JB1xXCja4uIWkFDVoRE2Yj6IrJOJFGEkBAlxRQlYtGgIve+LbzGyKoRaagiJGSpMyIFEeqZEvtyqgmJs9I5FkmUyYQSAuKoLoQES4eVHHwS/wDaSzE/7jl3zgAAAABJRU5ErkJggg==', 'Quốc Mạnh', NULL, NULL, 61, 2, '2023-01-16 02:22:25', '2023-01-16 02:22:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint NOT NULL,
  `vnp_Amount` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `order_id` int DEFAULT NULL,
  `vnp_BankCode` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `vnp_BankTranNo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `vnp_CardType` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `vnp_OrderInfo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `vnp_PayDate` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `vnp_ResponseCode` text NOT NULL,
  `vnp_TmnCode` text NOT NULL,
  `vnp_TransactionNo` text NOT NULL,
  `vnp_TransactionStatus` text NOT NULL,
  `vnp_TxnRef` text NOT NULL,
  `vnp_SecureHash` text NOT NULL,
  `vnp_Status` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `vnp_Amount`, `order_id`, `vnp_BankCode`, `vnp_BankTranNo`, `vnp_CardType`, `vnp_OrderInfo`, `vnp_PayDate`, `vnp_ResponseCode`, `vnp_TmnCode`, `vnp_TransactionNo`, `vnp_TransactionStatus`, `vnp_TxnRef`, `vnp_SecureHash`, `vnp_Status`, `created_at`, `updated_at`) VALUES
(8, '97370000', 61, 'NCB', 'VNP13927060', 'ATM', '61', '20230116162311', '00', 'UD2KZW06', '13927060', '00', 'IS-D1VAMYCN', '2f9e4c9e772b8a89947ac540a1750540dc68bc9c52e823fe5bf78bd0e8f958386f8ad7250c26da8f3f33b251d26391fe2c5d433b8ad614cfca8c68342fabb2e7', NULL, '2023-01-16 02:23:19', '2023-01-16 02:23:19');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
(10, 'App\\Models\\User', 32, 'token', '289054e89f344cb415e8fe0caa19bc3f7ae80cd246dc0c9bff6343b6ad42b7cc', '[\"*\"]', '2023-01-12 19:57:16', '2023-01-12 07:26:06', '2023-01-12 19:57:16'),
(11, 'App\\Models\\User', 32, 'token', 'c9e524dd1a0b19a251620eb19aa44b7bc02da541f215492bec9f8416b511ac66', '[\"*\"]', '2023-01-13 02:25:40', '2023-01-12 19:57:48', '2023-01-13 02:25:40'),
(12, 'App\\Models\\User', 35, 'token', '4c864220c8bab9dbc4e8ebae0926e58e699a5cfea67d14adbb7b543c313fc820', '[\"*\"]', NULL, '2023-01-14 22:46:25', '2023-01-14 22:46:25'),
(13, 'App\\Models\\User', 36, 'token', 'e75cc611176e9b4cd07454a404bc3abd28d4308db9d29b34eab54694c39e148c', '[\"*\"]', NULL, '2023-01-14 22:47:12', '2023-01-14 22:47:12'),
(14, 'App\\Models\\User', 37, 'token', 'e480184632b9f90b04eabebe055bff8eefdc74f45b79614fd871dd3c6e0ccf66', '[\"*\"]', NULL, '2023-01-14 22:48:02', '2023-01-14 22:48:02'),
(15, 'App\\Models\\User', 39, 'token', 'f1574ff7bc04e2caf2c96b133cac0fbe9366cb05e1e0b1869f65274f20b0aaa6', '[\"*\"]', '2023-01-14 22:52:56', '2023-01-14 22:50:23', '2023-01-14 22:52:56'),
(16, 'App\\Models\\User', 40, 'token', '1d2ba99cd3bb1f86e9bd675acab159b21e72b653e519a88c2c2272c5282d07c8', '[\"*\"]', NULL, '2023-01-15 00:24:40', '2023-01-15 00:24:40'),
(17, 'App\\Models\\User', 42, 'token', '800ba7d1cc035a41816fa4979070441bbd6904bbc9bf819fe841f8cc7bdeb614', '[\"*\"]', '2023-01-15 21:28:46', '2023-01-15 00:26:07', '2023-01-15 21:28:46'),
(18, 'App\\Models\\User', 73, 'token', 'e621c1d8697cc155d68ebeedfd1c10f3602ad6fd4b0fd8edf1b56120bea4fa7e', '[\"*\"]', '2023-01-16 02:48:45', '2023-01-15 21:44:07', '2023-01-16 02:48:45');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keyword` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` int DEFAULT NULL,
  `course_id` bigint DEFAULT NULL,
  `user_created` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_updated` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_deleted` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `slug`, `thumbnail`, `meta_keyword`, `status`, `course_id`, `user_created`, `user_updated`, `user_deleted`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1', '1', '1', 'data:image/png;base64,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', NULL, 1, 1, 'Manh Alvin', NULL, 'Manh Alvin', '2023-01-10 10:27:05', '2023-01-10 10:46:26', NULL),
(2, 'Post 17', 'Content 17', 'post-17', 'data:image/png;base64,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', NULL, 1, 1, 'Manh Alvin', NULL, NULL, '2023-01-10 20:34:04', '2023-01-10 20:34:04', NULL),
(3, 'Test', 'Test', 'Test', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAGB0lEQVR4nO2dWU/yQBSG3y5+iha0LmhcE0L03v7/n8ClJuqF0RgQl2gKCgi034VCau2Udphpp8M8l4xMD+f1LDPdNN/3oRAHM28DKKD5D9KYW8EJ0QX54/xGo5F6EsdxokQUUiRNsJT1yxga5yfFcZzwR0IIJIogPsBXgFkEBMpVmDwFmR44TyHChCInc3HyEERIIcLkJUzWgvgii0DiR5xMRNGzOAi+o6KQYgDTSPZB13KngqsgjUZjKkRRxZgQ+A3+z+/iAq+UVYg6QQvP+sJNEBmFCMOjtrBOWYWuFWnhUVtYCpL74i4PAr+XiSisUtbCREUcLFIYiwhRYvwQSGHUzCuIEBthAkLtl3lSloqMGGjTF22EKDFmQJu+aARRaSodqfxFFSEqOpJB46c0gizUoo8VaRePqSJEiUFHGr8lEoTn7uYikcSPSdtelaoYkKQVThIhSgxGJGmFszpjqEjILEFUdDBmVpTECaLE4EScKCplCQZJENXmZsMfPxMjRKUrvpD8q1KWYEQtDJkWc03TcH5+zmw+Er1eD5eXl9yPw5rwYlFFiGCEBVGtbsaEW2AVIYKhBBEMJYhgBLssbvVD12frXq/XUS6XI8fa7TaazWbs933fhyC351Ex6bYyuQvX87yZfxPnTM/zEs0hA6LfFs2M5eVlVCoVVCoVLC8vwzRNGIYBz/MwGo0wGAzQ7Xbhui4+Pz9zs1N6QVZWVrC/vw/btiPHdV2HaZpYWVnB+vo6Dg4O0Ol00Gw20e12M7ZWckF2dnZwdHQETUt3AWG5XMbp6SlarRZarRYn66KZVFvpFoQHBwc4Pj5OLcYETdOwv7+Pw8NDxpZFM1kgStn22raNvb09JnPt7u5ic3OTyVxJkC5lmaaJk5MT4vhwOES73Uan08FwOIRhGLAsC9VqFaVSKfI7h4eHeHt7y6Stlk6QarUKwzAix/r9Pq6urjAajaafDYdD9Pt9vL6+olarYWNj48/3lpaWsL29jefnZ252T5AqZWmahp2dHeL43d3dLzGC+L6P29tb4niUUDyQSpDV1VWYZnTQ93q9mW2s53l4f3+PHLMsi7pBSINUgliWRRxLutjr9XqRn+u6jn///lHZlQapasjq6ipxbGtrC1tbW3PNb5omBoPBXHPMQqoIIaUrVpCaBZZIJUgWDuONVIJkUXR5I1UNIbWsADAYDPD19TXX/OPxeK7vJ0EqQeIc9vLygsfHxwytoWOSsrSIp3QWDlLLCgBra2sZWpKeyRlDqWpIp9MhjlUqFe5dGAukEqTb7RLriK7rOD4+ppo3yTUBrJBKEAB4enoijtm2jVqtlihSDMOAbduo1+s4OztjaWIs4sdwStrtNqrVKtHptm1jfX0d7+/v+Pj4wGg0gu/7MAxjeiq3VCqhVCpN2+i42sSaoNWa4ziFP3PoeR5ub29Rr9eJ6xJd17G5uZnpiac4ghdcS5eyAMB1Xdzf3xfyOi0pBQG+1x3X19cYDod5m5IKaQUBvruui4sLNJtNamFc18XDwwNjy8iEK58UdSTIeDxGq9XC4+MjyuUyLMuCZVlYWlqaXizn+z48z8N4PMbX1xf6/f70orm47RgWhG/YEabLurm54Tq/7/twXReu63I9zrxEpSwptlGKQNSzT6SuIUWEKIiKEr6Q/EsSpPhneorBHz+rlCUYcYKo4s6JuAeZzYoQJQpjZj1VTqUswUgiiIoSRrB65iIajYZqg+fEcZxET1hKJIjjOKoNZkASP6aqISpK6EjjtzSCaFD1JDWBupEoy1B1WUqUZND4iUYQVU/SkcpftOsQlbpmQPuGnXnf0raQr8qLY973ss+7UlfpKxpqv7DYOlHp6wcW7zFk+S7chU1f86apICw3FzVg8VpilmIA7Hd7F2rxmHbRlwT1PnUKeL5Pndf5EA2AJuMucWDXlmlkTOAVIWEKX/BZ1woSWZ0xLHRt4VErSGQVIUEKUV941ok48hBkgpDC5CXE9ICC3NSSe43JqkbMQhRBJvwyhqdAEfVMiH050QQJ88c4GpEIzYQQAoQRXZAoaAwW0vlR/Ae70F7849QW5AAAAABJRU5ErkJggg==', NULL, 1, 1, 'Trần Quốc Mạnh', NULL, NULL, '2023-01-12 19:38:14', '2023-01-12 19:38:14', NULL),
(10, '2', '2', '2', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAA7EAAAOxAGVKw4bAAADDUlEQVR4nO2dQZKDIBBFcWpuxP2PwJmcxahFEBTabviG/5azmJh++d1IKrKs6+oIDr+jL0CA5BO0qF+FEehCTsUPITT/E+99TiKkpAWsZX1cjKT4tXjv0z9BCEIRsjpnK+COSNBQMSOFHC88UkRKkpzuckYIgRSRMkpMbyErsoQSm5wuUn56vIj7T8UrZTh3JHl1siV3E6ZCQgiHiLfK2Inew7q9LxOsWtYr5oQUy/liJuQbRaRYzBbtlvXqWdGKxWzRFDL85m4E0ftVkaLVsqZJxRUaLUwjIZSxEbUwMU+FQGyEASKuy5OWxWRcIG1f0oRQxg3S9iURwjbVRlO9RAlhOuqQ1KlFyFQ3fVq03jw2JYQyZLTUrUqI5e7mTNTUsXbZy1alQM1SuCYhlKFEzVK41zeGpJI7IUyHMncpuRJCGUZcSWHLAqMkhMvcPpzqXEwI25UtpfqyZYGRE8Jh3onccGdCwEiFMB2dSVPChIBBIWBQCBixEM6PQcRzhAkBg0LAoBAwKASMXQgH+mD2wc6EgEEhYFAIGBQCBoWAQSFgUAgYFAIGhYBBIWBQCBgUAsYuZMk8pZN0ZP8xDxMCBoWAQSFgUAgYsRAO9kHEv85lQsCgEDAoBIxUCOdIZ9KnOzAhYOSEMCWdyD37hAkBoyiEKbGlVN+SEIjzmCbgVGe2LDCuhHC4G3H1ILO7hFCKMndPlWPLAqNGCFOihNYzF10Igcvgh3jvq56wVCXEe89lsAI1dWyaIUyJjJa6tQhZHOdJM9HcqOoyolUWpdQhqZNECOdJG031kt6HsHXdID1h5+kpbVMelXfF03PZn96ps33lEddFY+uE7WtD4xxDzbNwp21fT9tUjObm4uLcfEtiTRnO6e/2TnXz2HrTVwPPUxdgeZ661fchi3Nu+cZd4mjXVjUZO1YJSXn9wNeeFSV6fWP46tliMStK9EpIzCvmi+WcuGKEkB1IMaNEHC84UEjM8BnTa0bcgSJk5+NiLAVl5hnEvhyakJTTxUkkFRYTEAJS0IXkkFwwZPFz/AGvLT7xLsp70AAAAABJRU5ErkJggg==', NULL, 1, 1, 'Quốc Mạnh', NULL, 'Quốc Mạnh', '2023-01-15 01:25:10', '2023-01-15 01:25:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_images`
--

CREATE TABLE `post_images` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_created` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_updated` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_deleted` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'name: tên vai trò',
  `display_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'display_name: mô tả vai trò',
  `status` int DEFAULT NULL,
  `user_created` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_updated` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_deleted` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `provider` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int DEFAULT NULL,
  `user_created` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_updated` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_deleted` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'name: họ tên người dùng',
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'username: tên người dùng',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'gender: Giới tính',
  `mobile_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `thumbnail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'thumbnail: Hình ảnh đại diện ',
  `status` tinyint(1) NOT NULL DEFAULT '2' COMMENT 'status: trạng thái tài khoản',
  `activation_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'activate_date: ngày kích hoạt',
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL COMMENT 'email_verified_at: email xác thực',
  `role_id` bigint UNSIGNED DEFAULT NULL,
  `user_created` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_updated` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_deleted` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `gender`, `mobile_no`, `address`, `thumbnail`, `status`, `activation_date`, `uuid`, `email_verified_at`, `role_id`, `user_created`, `user_updated`, `user_deleted`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(73, 'Quốc Mạnh', 'quocmanh', 'quocmanh.tran@gumiviet.com', '$2y$10$Dv3Qc.DuCosBBlzPIhHjYeLfMUKnge8tOF2AoVcTnaDFE.ao8Nq.G', NULL, '0961154483', NULL, 'data:image/png;base64,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', 1, '2023-01-16 11:43:23', '823447415b328c0a6e9388e19d08d431', NULL, 1, NULL, NULL, NULL, NULL, '2023-01-15 21:43:23', '2023-01-15 21:44:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `verification_codes`
--

CREATE TABLE `verification_codes` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint NOT NULL,
  `otp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int DEFAULT NULL,
  `user_created` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_updated` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_deleted` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expire_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `verification_codes`
--

INSERT INTO `verification_codes` (`id`, `user_id`, `otp`, `email`, `status`, `user_created`, `user_updated`, `user_deleted`, `expire_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(21, 47, '754977', 'quocmanh.tran@gumiviet.com', NULL, NULL, NULL, NULL, '2023-01-15 14:57:32', '2023-01-15 07:47:32', '2023-01-15 07:47:32', NULL),
(22, 48, '446715', 'quocmanh.tran@gumiviet.com', NULL, NULL, NULL, NULL, '2023-01-15 15:00:19', '2023-01-15 07:50:19', '2023-01-15 07:50:19', NULL),
(23, 49, '528775', 'quocmanh.tran@gumiviet.com', NULL, NULL, NULL, NULL, '2023-01-15 15:01:51', '2023-01-15 07:51:51', '2023-01-15 07:51:51', NULL),
(24, 50, '895162', 'quocmanh.tran@gumiviet.com', NULL, NULL, NULL, NULL, '2023-01-15 15:05:09', '2023-01-15 07:55:09', '2023-01-15 07:55:09', NULL),
(25, 51, '510394', 'quocmanh.tran@gumiviet.com', NULL, NULL, NULL, NULL, '2023-01-15 15:07:59', '2023-01-15 07:57:59', '2023-01-15 07:57:59', NULL),
(26, 52, '918986', 'quocmanh.tran@gumiviet.com', NULL, NULL, NULL, NULL, '2023-01-15 15:08:21', '2023-01-15 07:58:21', '2023-01-15 07:58:21', NULL),
(27, 53, '954278', 'quocmanh.tran@gumiviet.com', NULL, NULL, NULL, NULL, '2023-01-15 15:27:07', '2023-01-15 08:17:07', '2023-01-15 08:17:07', NULL),
(28, 54, '143949', 'quocmanh.tran@gumiviet.com', NULL, NULL, NULL, NULL, '2023-01-15 15:46:30', '2023-01-15 08:36:30', '2023-01-15 08:36:30', NULL),
(29, 55, '707286', 'quocmanh.tran@gumiviet.com', NULL, NULL, NULL, NULL, '2023-01-15 15:47:19', '2023-01-15 08:37:19', '2023-01-15 08:37:19', NULL),
(30, 56, '364030', 'quocmanh.tran@gumiviet.com', NULL, NULL, NULL, NULL, '2023-01-15 15:48:08', '2023-01-15 08:38:08', '2023-01-15 08:38:08', NULL),
(31, 57, '959741', 'quocmanh.tran@gumiviet.com', NULL, NULL, NULL, NULL, '2023-01-15 15:48:32', '2023-01-15 08:38:32', '2023-01-15 08:38:32', NULL),
(32, 58, '436832', 'quocmanh.tran@gumiviet.com', NULL, NULL, NULL, NULL, '2023-01-15 15:49:19', '2023-01-15 08:39:19', '2023-01-15 08:39:19', NULL),
(33, 59, '812668', 'quocmanh.tran@gumiviet.com', NULL, NULL, NULL, NULL, '2023-01-15 15:56:34', '2023-01-15 08:46:34', '2023-01-15 08:46:34', NULL),
(34, 60, '773310', 'quocmanh.tran@gumiviet.com', NULL, NULL, NULL, NULL, '2023-01-15 15:57:03', '2023-01-15 08:47:03', '2023-01-15 08:47:03', NULL),
(35, 61, '803332', 'quocmanh.tran@gumiviet.com', NULL, NULL, NULL, NULL, '2023-01-15 15:58:04', '2023-01-15 08:48:04', '2023-01-15 08:48:04', NULL),
(36, 62, '664381', 'quocmanh.tran@gumiviet.com', NULL, NULL, NULL, NULL, '2023-01-15 15:58:32', '2023-01-15 08:48:32', '2023-01-15 08:48:32', NULL),
(37, 63, '790886', 'quocmanh.tran@gumiviet.com', NULL, NULL, NULL, NULL, '2023-01-15 15:59:12', '2023-01-15 08:49:12', '2023-01-15 08:49:12', NULL),
(38, 64, '389432', 'quocmanh.tran@gumiviet.com', NULL, NULL, NULL, NULL, '2023-01-15 15:59:50', '2023-01-15 08:49:50', '2023-01-15 08:49:50', NULL),
(39, 65, '909936', 'quocmanh.tran@gumiviet.com', NULL, NULL, NULL, NULL, '2023-01-15 16:00:56', '2023-01-15 08:50:56', '2023-01-15 08:50:56', NULL),
(40, 66, '308954', 'quocmanh.tran@gumiviet.com', NULL, NULL, NULL, NULL, '2023-01-15 16:01:14', '2023-01-15 08:51:14', '2023-01-15 08:51:14', NULL),
(41, 67, '876132', 'quocmanh.tran@gumiviet.com', NULL, NULL, NULL, NULL, '2023-01-15 16:06:04', '2023-01-15 08:56:04', '2023-01-15 08:56:04', NULL),
(42, 68, '775491', 'quocmanh.tran@gumiviet.com', NULL, NULL, NULL, NULL, '2023-01-15 16:07:14', '2023-01-15 08:57:14', '2023-01-15 08:57:14', NULL),
(43, 69, '291352', 'quocmanh.tran@gumiviet.com', NULL, NULL, NULL, NULL, '2023-01-15 16:07:54', '2023-01-15 08:57:54', '2023-01-15 08:57:54', NULL),
(44, 70, '495636', 'quocmanh.tran@gumiviet.com', NULL, NULL, NULL, NULL, '2023-01-15 16:09:15', '2023-01-15 08:59:15', '2023-01-15 08:59:15', NULL),
(45, 71, '776323', 'quocmanh.tran@gumiviet.com', NULL, NULL, NULL, NULL, '2023-01-16 04:51:11', '2023-01-15 21:41:11', '2023-01-15 21:41:11', NULL),
(46, 72, '685922', 'quocmanh.tran@gumiviet.com', NULL, NULL, NULL, NULL, '2023-01-16 04:51:42', '2023-01-15 21:41:42', '2023-01-15 21:41:42', NULL),
(47, 73, '170543', 'quocmanh.tran@gumiviet.com', NULL, NULL, NULL, NULL, '2023-01-16 04:53:23', '2023-01-15 21:43:23', '2023-01-15 21:43:23', NULL);

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
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `category_courses`
--
ALTER TABLE `category_courses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `course_episodes`
--
ALTER TABLE `course_episodes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `post_images`
--
ALTER TABLE `post_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `verification_codes`
--
ALTER TABLE `verification_codes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
