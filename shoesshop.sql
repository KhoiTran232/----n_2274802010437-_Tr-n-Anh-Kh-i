-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: db:3306
-- Thời gian đã tạo: Th10 25, 2023 lúc 07:31 PM
-- Phiên bản máy phục vụ: 11.0.2-MariaDB-1:11.0.2+maria~ubu2204
-- Phiên bản PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shoesshop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `user_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `quanity` int(255) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `homedata`
--

CREATE TABLE `homedata` (
  `id` int(1) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `btn_title` varchar(255) NOT NULL,
  `btn_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `homedata`
--

INSERT INTO `homedata` (`id`, `title`, `image`, `btn_title`, `btn_link`) VALUES
(1, 'NIKE<sup>®</sup> STAR RUNNER<sup>™</sup> 2', 'images/banner-shoes.png', 'MUA SẮM NGAY', '/product.php?id=8'),
(2, 'Black Friday', 'images/sale-banner.png', 'MUA SẮM NGAY', '/products.php');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `price` bigint(255) NOT NULL,
  `out_of_stock` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `brand`, `description`, `image`, `price`, `out_of_stock`, `created_at`) VALUES
(1, 'Nike Air Force 1 \'07', 'Nike', 'The radiance lives on in the Nike Air Force 1 \'07, the b-ball icon that puts a fresh spin on what you know best: crisp leather, bold colours and the perfect amount of flash to make you shine.', 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/350e7f3a-979a-402b-9396-a8a998dd76ab/air-force-1-07-shoe-HWWX9W.png', 2929000, 0, '2023-11-25 14:43:06'),
(2, 'Nike Air Max 90', 'Nike', 'Nothing as fly, nothing as comfortable, nothing as proven.The Nike Air Max 90 stays true to its OG running roots with the iconic Waffle sole, stitched overlays and classic TPU details.Classic colours celebrate your fresh look while Max Air cushioning adds comfort to the journey.', 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/wzitsrb4oucx9jukxsmc/air-max-90-shoes-mnCmVT.png', 3519000, 0, '2023-11-25 14:43:06'),
(3, 'Air Max 90 LTR', 'Nike', 'The Nike Air Max 90 LTR stays true to its OG running roots with its iconic Waffle outsole, stitched smooth-leather overlays and classic, colour-accented TPU plates. The monochromatic upper provides versatile styling options while Max Air cushioning adds comfort to your step.', 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/f8347389-beac-4219-8a14-639926eb7ffc/air-max-90-ltr-shoes-Q2hxH4.png', 3829000, 0, '2023-11-25 14:43:06'),
(4, 'Nike Air Force 1 Shadow', 'Nike', 'Everything you love about the AF-1—but doubled! The Air Force 1 Shadow puts a playful twist on a hoops icon to highlight the best of AF-1 DNA. With 2 eyestays, 2 mudguards, 2 backtabs and 2 Swoosh logos, you get a layered look with double the branding.', 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/4562d8b5-f03d-495b-8423-75df1852cd9d/air-force-1-shadow-shoes-3d774m.png', 3829000, 0, '2023-11-25 14:43:06'),
(5, 'Nike Blazer Low \'77 Jumbo', 'Nike', 'They say, \"Don\'t fix what works\". We say, \"Perfect it\". The streetwear superstar brings home the festive season with a cosy collar that pairs perfectly with your favourite seasonal jumper. And for a bold finish, the oversized Swoosh and jumbo laces add playful cheer.', 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/0f600b39-e966-46c8-b0df-9386029466c9/blazer-low-77-jumbo-shoes-xRGRJD.png', 2779000, 0, '2023-11-25 14:43:06'),
(7, 'ADIZERO SL', 'Adidas', 'Giày Chạy Bộ Adizero SL chắt lọc mọi tinh túy từ dòng giày Adizero phá vỡ kỷ lục thế giới. Đế giữa LIGHTSTRIKE bằng chất liệu EVA siêu nhẹ mang đến khả năng đàn hồi cho kết cấu đế giữa, để bạn có thể tập trung vào bước chạy tiếp theo, cùng thân giày bằng vải lưới kỹ thuật mềm mại được bố trí ở những vùng quan trọng. Lưỡi gà và gót giày lót đệm mang đến cảm giác thoải mái tối ưu cùng miếng trang trí gót giày Adizero. Đế ngoài cao cấp tạo độ bám.', 'https://assets.adidas.com/images/h_2000,f_auto,q_auto,fl_lossy,c_fill,g_auto/877f87fbcbf34e299720aef600eff064_9366/ADIZERO_SL_DJen_HQ1349_01_standard.jpg', 1950000, 1, '2023-11-25 15:00:06'),
(8, 'NIKE STAR RUNNER 2 SNEAKER KIDS', 'Nike', 'The Nike sneaker in pink takes your style to the next level while keeping you comfortable. When you want something that is breathable so you\'ll stay dry for longer, is exceptionally comfortable to wear all day long and has cushioning for extra comfort, then this is just the product you need. The sneaker is another great product from the internationally leading manufacturer founded in 1971 with the Swoosh.', 'https://images.keepersport.net/eyJidWNrZXQiOiJrZWVwZXJzcG9ydC1wcm9kdWN0LWltYWdlcy11cy1lYXN0LTEiLCJrZXkiOiJuaWtlXC9FVFNBVDE4MDNfNjAzXC9uaWtlLXN0YXItcnVubmVyLTItc25lYWtlci1raWRzLXBpbmstZjYwMy1hdDE4MDMtbGlmZXN0eWxlLnBuZyIsImVkaXRzIjp7InJlc2l6ZSI6eyJ3aWR0aCI6ODAwfX19', 1200000, 0, '2023-11-25 18:56:44');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `homedata`
--
ALTER TABLE `homedata`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email-Unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
