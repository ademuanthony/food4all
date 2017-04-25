
--
-- Dumping data for table `sccategories`
--

INSERT INTO `sccategories` (`parent_id`, `store_id`, `name`, `description`, `image`, `meta_description`, `keywords`, `permalink`) VALUES
(NULL, <-store_id->, 'SPORTSWEAR', 'SPORTSWEAR', NULL, 'SPORTSWEAR', 'SPORTSWEAR', 'sportswear'),
(NULL, <-store_id->, 'MENS', 'MENS', NULL, 'MENS', 'MENS', 'mens'),
(NULL, <-store_id->, 'WOMEN', 'WOMEN', NULL, 'WOMEN', 'WOMEN', 'women'),
(NULL, <-store_id->, 'FASHION', 'FASHION', NULL, 'FASHION', 'FASHION', 'FASHION'),
(NULL, <-store_id->, 'KIDS', 'KIDS', NULL, 'KIDS', 'KIDS', 'KIDS'),
(NULL, <-store_id->, 'HOUSEHOLDS', 'HOUSEHOLDS', NULL, 'HOUSEHOLDS', 'HOUSEHOLDS', 'HOUSEHOLDS'),
(NULL, <-store_id->, 'INTERIORS', 'INTERIORS', NULL, 'INTERIORS', 'INTERIORS', 'INTERIORS'),
(NULL, <-store_id->, 'CLOTHING', 'CLOTHING', NULL, 'CLOTHING', 'CLOTHING', 'CLOTHING'),
(NULL, <-store_id->, 'BAGS', 'BAGS', NULL, 'BAGS', 'BAGS', 'BAGS'),
(NULL, <-store_id->, 'SHOES', 'SHOES', NULL, 'SHOES', 'SHOES', 'SHOES');

--
-- Dumping data for table `scproducts`
--

INSERT INTO `scproducts` (`category_id`, `store_id`, `name`, `description`, `main_image`, `images`, `meta_description`, `keywords`, `old_price`, `new_price`, `weight`, `is_featured`, `permalink`, `quantity`) VALUES
(5, <-store_id->, 'Easy Polo Black Edition', 'Easy Polo Black Edition is a very nice cloth', 'Easy_Polo_Black_Edition.jpg', '', 'cloth', 'cloth', '50.00', '45.00', '1.00', 1, 'easy-polo-black-edition', 10),
(4, <-store_id->, 'Easy Polo Black Edition 2', 'Easy Polo Black Edition is a very nice cloth', 'Easy_Polo_Black_Edition_2.jpg', '', 'cloth', 'cloth', '55.00', '50.00', '1.00', 1, 'easy-polo-black-edition2', 5),
(5, <-store_id->, 'Easy Polo Black Edition 3', 'Easy Polo Black Edition is a very nice cloth', 'Easy_Polo_Black_Edition_3.jpg', '', 'cloth', 'cloth', '65.00', '55.00', '1.00', 1, 'easy-polo-black-edition-3', 6);

--
-- Dumping data for table `scsliders`
--

INSERT INTO `scsliders` (`store_id`, `title`, `short_info`, `body`, `image`, `sort_order`, `landing_page`, `action_text`, `image2`) VALUES
(<-store_id->, 'E-LEGANZA', '100% Responsive Design', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'stores/laveritas/sliders/E-LEGANZA.jpg', 0, 'home', 'Get qoute', 'stores/laveritas/sliders/E-LEGANZA2.png'),
(<-store_id->, 'Urban Shop', '100% Responsive Design', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'stores/laveritas/sliders/Urban_Shop.jpg', 1, '#', 'Get qoute', 'stores/laveritas/sliders/Urban_Shop2.png'),
(<-store_id->, 'Girl Clothing', 'Clothing for girls in town', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'stores/laveritas/sliders/Girl_Clothing.jpg', 2, '#', 'Get qoute', 'stores/laveritas/sliders/Girl_Clothing2.png');

