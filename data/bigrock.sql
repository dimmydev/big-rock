-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2021 at 08:04 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bigrock`
--

-- --------------------------------------------------------

--
-- Table structure for table `autor`
--

CREATE TABLE `autor` (
  `id_autor` int(1) NOT NULL,
  `ime` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `indeks` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `opis` text COLLATE utf8_unicode_ci NOT NULL,
  `slika` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `autor`
--

INSERT INTO `autor` (`id_autor`, `ime`, `prezime`, `indeks`, `opis`, `slika`) VALUES
(1, 'Stefan', 'Dimitrijević', '57/16', 'Hi! My name is Stefan Dimitrijević. I\'m 28 years old student of ICT College of Vocational Studies.\r\nI\'m guitar player in alternative band \"Strah od Džeki Čena\" and professional pool player. As a beer lover, this is my PHP school project about \"Big Rock\" beers.', 'assets/images/oMeni.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kategorija`
--

CREATE TABLE `kategorija` (
  `id_kategorija` int(10) NOT NULL,
  `naziv_kategorije` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kategorija`
--

INSERT INTO `kategorija` (`id_kategorija`, `naziv_kategorije`) VALUES
(1, 'Signature'),
(2, 'Seasonal'),
(3, 'Lambic Style'),
(4, 'Cider'),
(5, 'AGD');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id_korisnik` int(10) NOT NULL,
  `ime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `datum_registracije` int(10) NOT NULL,
  `id_uloga` int(10) NOT NULL,
  `ulogovan` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id_korisnik`, `ime`, `prezime`, `username`, `password`, `email`, `datum_registracije`, `id_uloga`, `ulogovan`) VALUES
(14, 'Stefan', 'Dimitrijevic', 'admin123', '0192023a7bbd73250516f069df18b500', 'stefan@gmail.com', 1612118454, 1, 0),
(15, 'Petar', 'Petrovic', 'pera123', 'bf676ed1364b5857fba69b5623c81b64', 'pera@gmail.com', 1612118731, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik_proizvod`
--

CREATE TABLE `korisnik_proizvod` (
  `id_korisnik_proizvod` int(10) NOT NULL,
  `id_korisnik` int(10) NOT NULL,
  `id_proizvod` int(10) NOT NULL,
  `ocena` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnik_proizvod`
--

INSERT INTO `korisnik_proizvod` (`id_korisnik_proizvod`, `id_korisnik`, `id_proizvod`, `ocena`) VALUES
(15, 14, 1, 4),
(16, 15, 1, 3),
(17, 15, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `meni`
--

CREATE TABLE `meni` (
  `id_meni` int(10) NOT NULL,
  `putanja` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `naziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `redosled` int(10) NOT NULL,
  `id_pozicija_meni` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `meni`
--

INSERT INTO `meni` (`id_meni`, `putanja`, `naziv`, `redosled`, `id_pozicija_meni`) VALUES
(1, 'index.php?page=home', 'Home', 0, 1),
(2, 'index.php?page=allbeers', 'Our beers', 1, 1),
(3, 'index.php?page=register', 'Register', 2, 1),
(4, 'index.php?page=login', 'Login', 3, 1),
(5, 'models/login/logout.php', 'Logout', 4, 1),
(6, 'admin.php', 'Admin panel', 5, 1),
(7, 'assets\\pdf\\dokumentacijaBigRock.pdf', 'Documentation', 6, 2),
(8, 'index.php?page=aboutme', 'About me', 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `meni_uloga`
--

CREATE TABLE `meni_uloga` (
  `id_meni_uloga` int(10) NOT NULL,
  `id_meni` int(10) NOT NULL,
  `id_uloga` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `meni_uloga`
--

INSERT INTO `meni_uloga` (`id_meni_uloga`, `id_meni`, `id_uloga`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 1),
(5, 2, 2),
(6, 2, 3),
(7, 3, 3),
(8, 4, 3),
(9, 5, 1),
(10, 5, 2),
(11, 6, 1),
(12, 7, 1),
(13, 7, 2),
(14, 7, 3),
(15, 8, 1),
(16, 8, 2),
(17, 8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `pozicija_meni`
--

CREATE TABLE `pozicija_meni` (
  `id_pozicija_meni` int(10) NOT NULL,
  `pozicija` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pozicija_meni`
--

INSERT INTO `pozicija_meni` (`id_pozicija_meni`, `pozicija`) VALUES
(1, 'header'),
(2, 'footer');

-- --------------------------------------------------------

--
-- Table structure for table `proizvod`
--

CREATE TABLE `proizvod` (
  `id_proizvod` int(10) NOT NULL,
  `naziv_proizvoda` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `opis` text COLLATE utf8_unicode_ci NOT NULL,
  `beer_story` text COLLATE utf8_unicode_ci NOT NULL,
  `slika` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mala_slika` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alkohol` decimal(10,1) NOT NULL,
  `id_kategorija` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `proizvod`
--

INSERT INTO `proizvod` (`id_proizvod`, `naziv_proizvoda`, `opis`, `beer_story`, `slika`, `mala_slika`, `alkohol`, `id_kategorija`) VALUES
(1, 'Grasshopper', 'A light touch of hops gives the brew a crisp finish, balancing its soft sweetness and texture with fruity or citrusy notes.', 'Fresh from the prairie hoppers, our Grasshopper wheat ale has a crisp finish, balancing its soft sweetness with fruity and bready notes.</br><br/>\r\n\r\n2017 Canadian Brewing Awards: Silver, North American Style Wheat Beer', '1561852295Grasshopper.png', 'mala_1561852295Grasshopper.png', '5.0', 1),
(2, 'Traditional Ale', 'Toasty malt and sweet caramel up front finishing with a nutty flavour, medium creamy carbonation, and mild hop bitterness.', 'A recipe gone untouched since Big Rock’s founding. Toasty malt and sweet caramel up front, Big Rock Traditional Ale finishes with a nutty flavour, medium creamy carbonation and mild hop bitterness.\r\n\r\n', '1561852424Traditional_Ale.png', 'mala_1561852424Traditional_Ale.png', '5.0', 1),
(3, 'Craft Lager', 'If you love great tasting, high quality lagers, you’re going to love this beer.', 'Craft Lager is our brewmaster’s clean, crisp, crushable interpretation of the most popular beer style in the world. No hop bomb here: just a great tasting, premium quality, well made beer. This recipe is three years in the making and includes a lager yeast new and unique to our brewhouse and a base of craft two-row malt. This beer succeeds on our commitment to process. It’s all about lagering time and no one has more patience than we do. The premium flavour comes from quality ingredients and the time it spends in tank.', '1561852437Craft_Lager.png', 'mala_1561852437Craft_Lager.png', '4.8', 1),
(4, 'Rhine Stone Cowboy', 'Light and delicate with subtle fruity notes.', 'A Kolsh style ale born from the banks of the Rhine. Light in body and appearance, our Rhine Stone Cowboy ale contains aromas of clean malt, fruit, and a touch of noble hops. 2017 Ontario Brewing Awards – Bronze: Lagered Ale', '1561852456Rhine_Stone_Cowboy.png', 'mala_1561852456Rhine_Stone_Cowboy.png', '4.6', 1),
(5, 'Pilsner', 'Soft malty flavour balanced with a mild bitterness and a fragrant hop nose.', 'Here’s a classic Pilsner born from the original Czech style, as reliable as Prague’s landmark time piece. The mild bitterness and fragrant hop nose of Czech’s Saaz hops are balanced with Pale malt. A thirst quenching experience… anytime.<br/><br/>\r\n\r\n2017 Canadian Brewing Awards: Gold: Euro Style Lager (Pilsner)\r\n2017 Canadian International Beer Awards: Bronze: Pilsner\r\n2017 Alberta Beverage Awards, Category: Pilsner, Judges Selection\r\n2018 Alberta Beverage Awards, Category: Pilsner, Judges Selection\r\n2019 Alberta Beer Awards, Category: German/Czech Style Pilsner, Gold', '1561852473Pilsner.png', 'mala_1561852473Pilsner.png', '4.9', 1),
(6, 'Session IPA', 'A classic, sessionable IPA, dry hopped to lend a distinctive citrusy Cascade hop flavour and aroma.', 'The original IPAs were born in England where hops worked as natural preservatives for voyages to India. Today, the hops remain, but most importantly for the flavours they impart. Here’s a golden amber with a citrusy bouquet and a mild hop bite.', '1561852489Session_IPA.png', 'mala_1561852489Session_IPA.png', '5.5', 1),
(7, 'Citradelic IPA', 'Repeated heavy dosing and dry hopping brings out the smooth citrus and tropical tones of the Citra hop.', 'Repeated heavy dosing and dry hopping brings out the smooth citrus and tropical tones of the Citra hop, creating the unique flavour experience of our Citradelic IPA.', '1561852505Citradelic_IPA.png', 'mala_1561852505Citradelic_IPA.png', '6.0', 1),
(8, 'Warthog Ale', 'Malty with a hint of toffee balanced with a mild hop bite and a clean finish.', 'True to style, Warthog Ale is a mild brown brew with a hint of toffee, balanced with a mild hop bite and a clean finish.', '1561852554Warthog_Ale.png', 'mala_1561852554Warthog_Ale.png', '4.5', 1),
(9, 'Scottish Heavy Ale', 'A beautiful malt flavour warms the palate with a complex mix of toffee, caramel, vanilla and a hint of peat.', 'A style born in the rugged highlands, this unique Scottish Heavy Ale is strong and full bodied with a complex mix of toffee, caramel, vanilla and a hint of peat.', '1561852571Scottish_Heavy_Ale.png', 'mala_1561852570Scottish_Heavy_Ale.png', '7.0', 1),
(10, 'Honey Brown Lager', 'Sweet, honey-molasses flavour, slightly hopped.', 'Honey from our local bees and world-renowned prairie malt are the backbone to our award-winning Honey Brown Lager. Together with Nugget and Fuggles hops, the result is a nutty caramel flavour, a mild hop bitterness, and a lingering sweetness.<br/><br/>\r\n\r\nWinner: 2017 Alberta Beer Awards, <b>Category:</b> Lager, <b>Judges Selection</b>', '1561852591Honey_Brown_Lager.png', 'mala_1561852591Honey_Brown_Lager.png', '5.0', 1),
(11, 'The Darcys Poolside', 'Our light lager is bright, clean, and with zesty notes of grapefruit it splashes down in a cannonball of refreshment. Poolside pairs perfectly with sunblock, pool toys and great tunes.', 'The sun is hot but your beer is cold and sings with grapefruit. Kick back poolside with Toronto music duo <b>The Darcys</b> and enjoy our collaborative award-winning summer lager.<br/>\r\nVoted Best Beer Session Toronto 2018!', '1561852633The_Darcys_Poolside.png', 'mala_1561852633The_Darcys_Poolside.png', '4.0', 2),
(12, 'Grasshopper with Lemon', 'Refreshing wheat beer with a lemon twist.', 'All the Grasshopper flavour you know and love with a twist of lemon. A classic filtered wheat ale, just as light and refreshing as ever… perked up with the tangy juiciness of lemons.', '1562519301grasshopper_lemon_detail-355.png', 'mala_1562519301grasshopper_lemon_detail-355.png', '5.0', 2),
(13, 'Jackrabbit', 'A pure light lager, flavourful and satisfying, without any excess.', 'A light lager for your active lifestyle.  No additives, no preservatives.  100 calories per 355 ml can. 90 calories per 330ml bottle.', '1562519523jackrabbit_bottle_detail.png', 'mala_1562519523jackrabbit_bottle_detail.png', '3.8', 2),
(14, 'Winter Spice', 'Malty sweetness, notes of cinnamon, nutmeg and ginger, are balanced with a crisp Fuggle hop finish.', 'Something special to get you through those short days and cold temperatures. Aromas of cloves and caramel evoke the sensation of home baking, and the rich malty flavour is enhanced with cinnamon, nutmeg and ginger.', '1562519584winter_spice_detail.png', 'mala_1562519584winter_spice_detail.png', '6.0', 2),
(15, 'Midnight Rhapsody Dark Ale', 'Roasted malts with hints of raspberry jam.', 'The dark is nothing to fear with a beer this smooth and approachable. Roasted malt counterpoints a chord struck with black currant, cherry and raspberry. It has subtle sweetness and soft bitterness that echo in the aftertaste. It’s hard not to dance to the tune of Midnight Rhapsody.', '1562519687midnight_details-1.png', 'mala_1562519687midnight_details-1.png', '5.5', 2),
(16, 'Framboise', 'Once you experience the gigantic tart raspberry flavour, you\'ll have trouble keeping this one under the table.', 'Belgian inspiration and spontaneous fermentation define Under the Table limited small batch beers. Framboise is a lambic style specialty that blends raspberries with a remarkable base beer born of our custom built Koelschip and aged in wine barrels. This arduous process takes time but creates complexity you can curl up under: sour and sweet; fresh and fermented; tangy and pleasing. We didn’t make much, so between us, let’s keep it Under the Table.<br/>\r\n<b>Only available at our Calgary brewery.</b>', '1562519774Framboise-detail-1.png', 'mala_1562519774Framboise-detail-1.png', '9.0', 3),
(17, 'Rock Creek Dry Apple Cider', 'Apple with notes of vanilla and cinnamon, mouth feel is crisp and dry.', 'One day back in 1993, Chris Turton drove 590 kilometers from Kelowna to Calgary, to show Ed McNally some apples. As soon as he surveyed the apples, Ed saw the possibilities. Chris grows apples you don’t see in the supermarket. The fragrant, sweet and succulent European varieties grown in Chris Turton’s orchards are fine examples of classic English-style cider apples. At the end of that meeting Ed and Chris shook hands. A year later, Big Rock’s first cider was in the keg.\r\n', '1562519966apple_473.png', 'mala_1562519966apple_473.png', '5.5', 4),
(18, 'Rock Creek Pear Cider', 'Sweet Bartlett pear.', 'For some reason the French chose to make Champagne out of grapes. But in a parallel universe somewhere, it’s made out of pears. To open this award-winning pear cider is to step into that universe. While we use all our knowledge and experience to make it a light, bubbly, clear oasis of refreshment in your day, the Okanagan’s best Bartlett pears effortlessly turn that hard work into pure deliciousness. Although we think you’ll agree that this flavour needs a much longer word to adequately describe what it does to your tastebuds.', '1562520185pear_473.png', 'mala_1562520185pear_473.png', '5.8', 4),
(19, 'Rock Creek Peach Cider', 'Fresh, fleshy and juicy peach.', 'Brewmaster Paul blends ripened peaches with crisp apples for our newest offering from the Rock Creek family. Briskly carbonated, the classic peach cider pours a golden colour with a refreshing finish. Outside of slicing open a fresh peach in the peak of its harvest season, we think this one’s hard to beat.', '1562520238peach_473.png', 'mala_1562520237peach_473.png', '5.5', 4),
(20, 'Rock Creek Strawberry Rhubarb Cider', 'A delicious balance of sweet strawberries and tart rhubarb.', 'The bright sweetness of ripe strawberry chases the crisp counterpoint of rhubarb around a classic crust of Okanagan apples. Briskly carbonated and based on a traditional European recipe, this classic strawberry rhubarb cider calls to you like fresh baked temptation cooling on the windowsill.', '1562520295sr_473.png', 'mala_1562520295sr_473.png', '5.5', 4),
(21, 'Rock Creek Rosé Cider', 'Rosé is both fruity and floral. An effervescent blend of 100% Okanagan grown apples and natural rosé wine flavours.', 'Rosé cider is crafted with fresh pressed apples sourced entirely from the Okanagan, a rare combination of European varietals including Bulmer’s Norman, Belle de Boskoop and Bramley.', '1562520383rose_main.png', 'mala_1562520383rose_main.png', '5.4', 4),
(22, 'Alberta Genuine Draft', 'Crisp and refreshing.', 'All natural, and batch brewed. That’s the Big Rock difference inside every can of Alberta Genuine Draft. As always, our Brewmaster doesn’t cut any corners and in this beer you’ll find a pale lager, brewed with the highest quality of ingredients including selected Willamette hops. No additives, unpasteurized…this is a pure malt beer.  A great beer, great value…by Big Rock Brewery.', '1562520443agd_reg_short_can.png', 'mala_1562520443agd_reg_short_can.png', '5.0', 5),
(23, 'Alberta Genuine Draft Light Beer', 'Crisp, refreshing and light.', 'All natural and batch brewed. That’s the Big Rock difference inside every can of Alberta Genuine Draft light beer. As always, our Brewmaster doesn’t cut any corners and in this beer you’ll find a light pale lager, brewed with the highest quality of ingredients including selected Willamette hops. No additives, unpasteurized…this is a pure malt beer. A great beer, great value…by Big Rock Brewery.', '1562520502agd_light_short_can.png', 'mala_1562520502agd_light_short_can.png', '4.0', 5);

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE `uloga` (
  `id_uloga` int(10) NOT NULL,
  `naziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` (`id_uloga`, `naziv`) VALUES
(1, 'Administrator'),
(2, 'Autorizovan'),
(3, 'Neautorizovan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autor`
--
ALTER TABLE `autor`
  ADD UNIQUE KEY `id_autor` (`id_autor`);

--
-- Indexes for table `kategorija`
--
ALTER TABLE `kategorija`
  ADD PRIMARY KEY (`id_kategorija`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id_korisnik`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_uloga` (`id_uloga`);

--
-- Indexes for table `korisnik_proizvod`
--
ALTER TABLE `korisnik_proizvod`
  ADD PRIMARY KEY (`id_korisnik_proizvod`),
  ADD KEY `id_korisnik` (`id_korisnik`),
  ADD KEY `id_proizvod` (`id_proizvod`);

--
-- Indexes for table `meni`
--
ALTER TABLE `meni`
  ADD PRIMARY KEY (`id_meni`),
  ADD KEY `id_pozicija_meni` (`id_pozicija_meni`);

--
-- Indexes for table `meni_uloga`
--
ALTER TABLE `meni_uloga`
  ADD PRIMARY KEY (`id_meni_uloga`),
  ADD KEY `id_meni` (`id_meni`),
  ADD KEY `id_uloga` (`id_uloga`);

--
-- Indexes for table `pozicija_meni`
--
ALTER TABLE `pozicija_meni`
  ADD PRIMARY KEY (`id_pozicija_meni`);

--
-- Indexes for table `proizvod`
--
ALTER TABLE `proizvod`
  ADD PRIMARY KEY (`id_proizvod`),
  ADD KEY `id_kategorija` (`id_kategorija`);

--
-- Indexes for table `uloga`
--
ALTER TABLE `uloga`
  ADD PRIMARY KEY (`id_uloga`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategorija`
--
ALTER TABLE `kategorija`
  MODIFY `id_kategorija` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id_korisnik` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `korisnik_proizvod`
--
ALTER TABLE `korisnik_proizvod`
  MODIFY `id_korisnik_proizvod` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `meni`
--
ALTER TABLE `meni`
  MODIFY `id_meni` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `meni_uloga`
--
ALTER TABLE `meni_uloga`
  MODIFY `id_meni_uloga` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pozicija_meni`
--
ALTER TABLE `pozicija_meni`
  MODIFY `id_pozicija_meni` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `proizvod`
--
ALTER TABLE `proizvod`
  MODIFY `id_proizvod` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `uloga`
--
ALTER TABLE `uloga`
  MODIFY `id_uloga` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `korisnik_ibfk_1` FOREIGN KEY (`id_uloga`) REFERENCES `uloga` (`id_uloga`);

--
-- Constraints for table `korisnik_proizvod`
--
ALTER TABLE `korisnik_proizvod`
  ADD CONSTRAINT `korisnik_proizvod_ibfk_1` FOREIGN KEY (`id_korisnik`) REFERENCES `korisnik` (`id_korisnik`) ON DELETE CASCADE,
  ADD CONSTRAINT `korisnik_proizvod_ibfk_2` FOREIGN KEY (`id_proizvod`) REFERENCES `proizvod` (`id_proizvod`) ON DELETE CASCADE;

--
-- Constraints for table `meni`
--
ALTER TABLE `meni`
  ADD CONSTRAINT `meni_ibfk_1` FOREIGN KEY (`id_pozicija_meni`) REFERENCES `pozicija_meni` (`id_pozicija_meni`);

--
-- Constraints for table `meni_uloga`
--
ALTER TABLE `meni_uloga`
  ADD CONSTRAINT `meni_uloga_ibfk_1` FOREIGN KEY (`id_meni`) REFERENCES `meni` (`id_meni`),
  ADD CONSTRAINT `meni_uloga_ibfk_2` FOREIGN KEY (`id_uloga`) REFERENCES `uloga` (`id_uloga`);

--
-- Constraints for table `proizvod`
--
ALTER TABLE `proizvod`
  ADD CONSTRAINT `proizvod_ibfk_1` FOREIGN KEY (`id_kategorija`) REFERENCES `kategorija` (`id_kategorija`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
