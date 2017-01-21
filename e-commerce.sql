-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 01 Février 2016 à 02:29
-- Version du serveur :  10.1.9-MariaDB
-- Version de PHP :  5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `e-commerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `Num_admin` int(11) NOT NULL,
  `Shift` int(1) NOT NULL,
  `Login` varchar(25) NOT NULL,
  `pass` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`Num_admin`, `Shift`, `Login`, `pass`) VALUES
(1, 1, 'amd', 'brigade');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `ID_Commande` int(11) NOT NULL,
  `Reference` int(10) NOT NULL,
  `Nom` varchar(500) NOT NULL,
  `Quantite` int(15) NOT NULL,
  `Prix` float NOT NULL,
  `Couleur` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`ID_Commande`, `Reference`, `Nom`, `Quantite`, `Prix`, `Couleur`) VALUES
(1, 114300, 'ROLEX Oyster Perpetual 39', 1, 4883, 'ACIER'),
(1, 279178, 'ROLEX Lady-Datejust 28', 3, 20, 'OR EVEROSE ET DIAMANTS');

-- --------------------------------------------------------

--
-- Structure de la table `destination`
--

CREATE TABLE `destination` (
  `Num_Commande` int(50) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Pays` varchar(50) NOT NULL,
  `Ville` varchar(75) NOT NULL,
  `Adresse` varchar(300) NOT NULL,
  `CodePostale` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `destination`
--

INSERT INTO `destination` (`Num_Commande`, `Nom`, `Prenom`, `Pays`, `Ville`, `Adresse`, `CodePostale`) VALUES
(1, 'ali', 'besbes', 'tunis', 'sfax', 'sokra km 4.5', '3364');

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `Nom_societe` varchar(150) NOT NULL,
  `Adresse` varchar(85) NOT NULL,
  `Siege` varchar(20) NOT NULL,
  `Login` varchar(25) NOT NULL,
  `Password` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `fournisseur`
--

INSERT INTO `fournisseur` (`Nom_societe`, `Adresse`, `Siege`, `Login`, `Password`) VALUES
('ROLEX ', 'Suisse,New chatel  ', 'New chatel  ', 'Rolex', 's1'),
('Festina', 'Italie,Florence', 'Florence', 'Festina', 's3'),
('Swatch', 'Sisse,Bienne    ', 'Bienne   ', 'Swatch', 's2'),
('Cartier', 'France,Paris', 'Paris', 'Cartier', 's4'),
('Omega', 'Suisse,Bienne', 'Bienne', 'Omega', 's5'),
('IWC', 'Suisse,Schaffhouse', 'Schaffhouse', 'IWC', 's6'),
('Breitling', 'Suisse,Granges', 'Granges', 'Breitling', 's7'),
('Zenith', 'France,Paris', 'Paris', 'Zenith', 's8');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `Reference` int(10) NOT NULL,
  `Marque` varchar(75) NOT NULL,
  `Modele` varchar(350) NOT NULL,
  `Echantillon` varchar(300) NOT NULL,
  `Couleur` varchar(500) NOT NULL,
  `Prix` float NOT NULL,
  `Quantite` int(15) NOT NULL,
  `Fournisseur` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`Reference`, `Marque`, `Modele`, `Echantillon`, `Couleur`, `Prix`, `Quantite`, `Fournisseur`) VALUES
(336123, 'Swatch Skin', 'BLAUMANN ', '../Upload/Swatch_45-39-10-01-16.jpg', 'noir,blanc,bleue,silver', 119, 7, 'Swatch'),
(451397, 'Swatch Skin', 'SUMMER BREEZE', '../Upload/Swatch_48-37-10-01-16.jpg', 'bleue', 121, 7, 'Swatch'),
(114300, 'Oyster', 'Perpetual 39', '../Upload/ROLEX _03-55-04-01-16.jpg', 'acier', 4650, 14, 'ROLEX'),
(228239, 'Oyster      ', 'Perpetual Day-Date 40     ', '../Upload/ROLEX_44-54-09-01-16.jpg', 'platine     ', 5500, 9, 'ROLEX'),
(80319, 'Oyster   ', 'Pearlmaster 29   ', '../Upload/ROLEX_23-55-09-01-16.jpg', 'or,gris,diamants   ', 23725, 14, 'ROLEX '),
(116713, 'Oyster', 'GMT-Master II', '../Upload/ROLEX _13-21-04-01-16.jpg', 'acier', 11300, 15, 'ROLEX '),
(214270, 'Oyster           ', 'Explorer           ', '../Upload/ROLEX_38-55-09-01-16.jpg', 'acier,marron          ', 5000, 15, 'ROLEX '),
(279136, 'Lady-Datejust', '28', '../Upload/ROLEX_33-05-10-01-16.jpg', 'platine', 44, 2, 'ROLEX'),
(179138, 'Lady-Datejust', 'President', '../Upload/ROLEX_26-14-10-01-16.jpg', 'Silver,Yellow Gold', 26, 4, 'ROLEX'),
(424319, 'Cellini ', 'Danaos', '../Upload/ROLEX_01-30-10-01-16.jpg', 'White Gold ', 8, 22, 'ROLEX'),
(50509, 'Cellini', 'Time', '../Upload/ROLEX_15-33-10-01-16.jpg', 'white gold,rose,black', 13, 13, 'ROLEX'),
(50515, 'Cellini', 'Date', '../Upload/ROLEX_41-35-10-01-16.jpg', 'gold,black', 15, 11, 'ROLEX'),
(895141, 'Swatch Irony', 'TRESOR BLANC', '../Upload/Swatch_25-24-10-01-16.jpg', 'blanc', 140, 3, 'Swatch'),
(159710, 'Swatch Irony', 'MOROCCAN NIGHT', '../Upload/Swatch_57-25-10-01-16.jpg', 'black', 136, 10, 'Swatch'),
(252713, 'Swatch Irony', 'GRANDE DAME', '../Upload/Swatch_06-28-10-01-16.jpg', 'bleue', 93, 10, 'Swatch'),
(624019, 'Swatch Irony', 'BLACK COAT', '../Upload/Swatch_55-29-10-01-16.jpg', 'noir', 167, 5, 'Swatch'),
(117485, 'Swatch Irony', 'DREAMNIGHT ', '../Upload/Swatch_27-31-10-01-16.jpg', 'blanc,noir,acier', 213, 5, 'Swatch'),
(145115, 'Swatch Skin', 'HELLO DARLING', '../Upload/Swatch_37-33-10-01-16.jpg', 'rose', 136, 13, 'Swatch'),
(322300, 'Swatch Skin  ', 'CLIMBER FLOWERY  ', '../Upload/Swatch_59-35-10-01-16.jpg', 'Silver,Yellow Gold  ', 116, 12, 'Swatch'),
(279178, 'Lady-Datejust', '28', '../Upload/ROLEX_23-59-09-01-16.jpg', 'or Everose et diamants', 19, 5, 'ROLEX'),
(178341, 'Lady-Datejust	', '31', '../Upload/ROLEX_52-01-10-01-16.jpg', 'acier, or Everose et diamants', 8, 5, 'ROLEX'),
(214006, 'Irony XLite', 'DARKONY ', '../Upload/Swatch_41-42-10-01-16.jpg', 'bleue,jaune', 150, 8, 'Swatch'),
(214001, 'Irony XLite ', 'ENDLESS ENERGY ', '../Upload/Swatch_33-44-10-01-16.jpg', 'bleue ', 153, 11, 'Swatch'),
(214004, 'Irony XLite', 'RED WHEEL', '../Upload/Swatch_23-46-10-01-16.jpg', 'noir', 123, 8, 'Swatch'),
(168828, 'Chrono Bike ', 'F16882/8', '../Upload/Festina_09-51-10-01-16.jpg', 'black', 210, 27, 'Festina'),
(168827, 'Chrono Bike ', ' F16882_7', '../Upload/Festina_40-52-10-01-16.jpg', 'noir', 210, 18, 'Festina'),
(168821, 'Chrono Bike', 'F16882/1', '../Upload/Festina_20-54-10-01-16.jpg', 'noir', 213, 8, 'Festina'),
(168813, 'Chrono Bike ', ' F16881_3', '../Upload/Festina_16-56-10-01-16.jpg', 'bleue', 255, 3, 'Festina'),
(168812, 'Chrono Bike ', 'F16881_2', '../Upload/Festina_24-57-10-01-16.jpg', 'bleue', 249, 9, 'Festina'),
(168591, 'Chronograph', 'F16859/1', '../Upload/Festina_04-00-10-01-16.jpg', 'marron', 253, 9, 'Festina'),
(168561, 'Chronograph', 'F16856/1', '../Upload/Festina_35-27-10-01-16.jpg', 'marron', 246, 6, 'Festina'),
(168551, 'Chronograph', ' F16855/1', '../Upload/Festina_55-28-10-01-16.jpg', 'marron', 208, 2, 'Festina'),
(1580048, 'quantiÃ¨me perpÃ©tuel', 'Tortue', '../Upload/Cartier_38-32-10-01-16.jpg', 'noir,or gris', 65, 6, 'Cartier'),
(1556225, 'quantiÃ¨me perpÃ©tuel', 'Rotonde de Cartier', '../Upload/Cartier_43-35-10-01-16.jpg', 'marron,rose', 71, 12, 'Cartier'),
(1556217, 'quantiÃ¨me perpÃ©tuel', 'Rotonde de Cartier', '../Upload/Cartier_59-36-10-01-16.jpg', 'marron', 54, 19, 'Cartier'),
(1556242, 'quantiÃ¨me perpÃ©tuel', 'Rotonde de Cartier', '../Upload/Cartier_27-38-10-01-16.jpg', 'marron,noir', 208, 20, 'Cartier'),
(1555951, 'Chronographe', 'Centrale', '../Upload/Cartier_38-42-10-01-16.jpg', 'noir', 39, 19, 'Cartier'),
(1580017, 'Squelette', 'complication', '../Upload/Cartier_33-45-10-01-16.jpg', 'Silver,noir', 133, 5, 'Cartier'),
(2020057, 'Squelette', 'Santos-Dumont', '../Upload/Cartier_27-47-10-01-16.jpg', 'marron', 48, 4, 'Cartier'),
(3030021, 'Squelette', 'tourbillon volant ', '../Upload/Cartier_48-48-10-01-16.jpg', 'noir', 142, 17, 'Cartier'),
(1560017, 'Squelette', 'Cartier Tank Louis', '../Upload/Cartier_04-52-10-01-16.jpg', 'marron sombre, marron claire', 15, 14, 'Cartier'),
(166281, 'Ceramic', 'F16628/1', '../Upload/Festina_14-55-10-01-16.jpg', 'blanc', 289, 11, 'Festina'),
(166382, 'Ceramic', 'F16638/2', '../Upload/Festina_42-57-10-01-16.jpg', 'noir', 297, 3, 'Festina'),
(165761, 'Ceramic ', ' f16576/1 ', '../Upload/Festina_32-59-10-01-16.jpg', 'blanc ', 171, 6, 'Festina'),
(1235038, 'Constellation ', 'Co-Axial Jour-Date 38 ', '../Upload/Omega_02-59-17-01-16.jpg', 'Or jaune,Or rouge,acier ', 14, 22, 'Omega'),
(1232038, 'Constellation', 'Co-Axial 38', '../Upload/Omega_17-01-17-01-16.jpg', 'Acier,or rouge', 11490, 11, 'Omega'),
(1232024, 'Constellation', 'Quartz 24', '../Upload/Omega_18-04-17-01-16.jpg', 'Acier,or rouge', 1300, 18, 'Omega'),
(1501510, 'Constellation', 'Double Eagle', '../Upload/Omega_15-07-17-01-16.jpg', 'acier', 2700, 14, 'Omega'),
(2329046, 'Seamaster planet ocean', 'New ', '../Upload/Omega_15-17-17-01-16.jpg', 'Acier', 4900, 16, 'Omega'),
(2329042, 'Seamaster planet ocean', 'Liquidmetal', '../Upload/Omega_16-19-17-01-16.jpg', 'Bleue', 5450, 17, 'Omega'),
(2323044, 'Seamaster planet ocean', 'GMT', '../Upload/Omega_11-23-17-01-16.jpg', 'acier', 5300, 18, 'Omega'),
(1469238, 'Seamaster planet ocean ', 'Titane COSC Full set ', '../Upload/Omega_17-29-17-01-16.jpg', 'bleue,black ', 4750, 13, 'Omega'),
(3559320, 'Speedmaster', 'Chronographe Michael Schumacher', '../Upload/Omega_57-31-17-01-16.jpg', 'noir', 3, 44, 'Omega'),
(3477379, 'Speedmaster', 'New ', '../Upload/Omega_40-34-17-01-16.jpg', 'blanc', 1750, 24, 'Omega'),
(1397811, 'Speedmaster', 'professional mark II ', '../Upload/Omega_40-36-17-01-16.jpg', 'acier,noir', 2750, 19, 'Omega'),
(5041, 'Portugieser', 'SidÃ©rale Scafusia', '../Upload/IWC_37-51-17-01-16.jpg', 'noir', 74500, 9, 'IWC'),
(5035, 'Portugieser', 'Calendrier Annuel', '../Upload/IWC_56-53-17-01-16.jpg', 'argent', 75500, 8, 'IWC'),
(5034, 'Portugieser', 'Calendrier PerpÃ©tuel', '../Upload/IWC_14-56-17-01-16.jpg', 'noir,bleue', 78450, 8, 'IWC'),
(5102, 'Portugieser', 'Huit Jours Edition', '../Upload/IWC_41-57-17-01-16.jpg', 'marron', 77900, 7, 'IWC'),
(3768, 'Aquatimer', 'CHRONOGRAPHE', '../Upload/IWC_48-59-17-01-16.jpg', 'bleuennoir', 5350, 8, 'IWC'),
(3795, 'Aquatimer ', 'Science for Galapagos ', '../Upload/IWC_22-04-17-01-16.jpg', 'noir ', 5750, 9, 'IWC'),
(3580, 'Aquatimer', 'Automatic 2000', '../Upload/IWC_31-05-17-01-16.jpg', 'noir', 6320, 12, 'IWC'),
(3759, 'Aquatimer', 'GALAPAGOS ISLANDS', '../Upload/IWC_41-09-17-01-16.jpg', 'noir', 5875, 18, 'IWC'),
(3239, ' Ingenieur', 'Automatic ', '../Upload/IWC_09-11-17-01-16.jpg', 'gris,argent', 6550, 14, 'IWC'),
(3796, 'Ingenieur', 'Chronographe Edition', '../Upload/IWC_27-12-17-01-16.jpg', 'gris', 5478, 16, 'IWC'),
(3246, 'Ingenieur ', 'Automatic Edition ', '../Upload/IWC_05-14-17-01-16.jpg', 'noir ', 5635, 16, 'IWC'),
(12721, 'Navitimer', '01 ', '../Upload/Breitling_38-45-17-01-16.jpg', 'noir,gris', 7420, 21, 'Breitling'),
(24322, 'Navitimer', '1461', '../Upload/Breitling_15-49-17-01-16.jpg', 'gris,marron', 5950, 15, 'Breitling'),
(12722, 'Navitimer', 'AOPA', '../Upload/Breitling_32-52-17-01-16.jpg', 'noir,gris,bleue', 5800, 18, 'Breitling'),
(12012, 'Navitimer', 'Cosmonaute', '../Upload/Breitling_45-54-17-01-16.jpg', 'noir,gris', 4760, 8, 'Breitling'),
(14053, 'Chronomat', '41', '../Upload/Breitling_00-58-17-01-16.jpg', 'or,argent,noir', 7345, 20, 'Breitling'),
(11079, 'Chronomat', '44', '../Upload/Breitling_35-00-17-01-16.jpg', 'bleue,noir;gris', 7910, 12, 'Breitling'),
(11381, 'Chronomat', '38', '../Upload/Breitling_10-03-17-01-16.jpg', 'bleue,gris', 1970, 19, 'Breitling'),
(42011, 'Chronomat ', 'GMT ', '../Upload/Breitling_01-06-17-01-16.jpg', 'gris,noir,argent ', 6395, 15, 'Breitling'),
(45320, 'Galactic', '44', '../Upload/Breitling_41-07-17-01-16.jpg', 'gris', 4520, 24, 'Breitling'),
(49350, 'Galactic', '41', '../Upload/Breitling_12-10-17-01-16.jpg', 'gris,bleue', 4375, 28, 'Breitling'),
(35100, 'Galactic', 'Unitime SleekT', '../Upload/Breitling_50-11-17-01-16.jpg', 'noir', 5835, 27, 'Breitling'),
(71356, 'Galactic', '32', '../Upload/Breitling_25-13-17-01-16.jpg', 'noir', 3078, 25, 'Breitling'),
(182040, 'El Primero', 'Chronomaster ', '../Upload/Zenith_51-18-17-01-16.jpg', 'noir', 16345, 33, 'Zenith'),
(182091, 'El Primero', '410', '../Upload/Zenith_49-20-17-01-16.jpg', 'noir,marron', 16405, 23, 'Zenith'),
(302040, 'El Primero ', '36000 VPH ', '../Upload/Zenith_39-22-17-01-16.jpg', 'gris,noir ', 7100, 22, 'Zenith'),
(452050, 'El Primero', 'Tourbillon', '../Upload/Zenith_13-24-17-01-16.jpg', 'marron,noir', 43648, 13, 'Zenith'),
(227061, 'Elite', '6150', '../Upload/Zenith_50-27-17-01-16.jpg', 'noir', 6415, 23, 'Zenith'),
(201068, 'Elite ', 'Ultra Thin ', '../Upload/Zenith_42-29-17-01-16.jpg', 'noir,argent ', 4165, 25, 'Zenith'),
(202067, 'Elite', 'Captain Central', '../Upload/Zenith_41-31-17-01-16.jpg', 'noir', 4712, 21, 'Zenith'),
(222310, 'Elite', 'Lady Moonphase', '../Upload/Zenith_55-33-17-01-16.jpg', 'gris,bleue,noir,argent', 4578, 21, 'Zenith'),
(192569, 'Star', 'Moonphase', '../Upload/Zenith_43-35-17-01-16.jpg', 'noir', 4935, 26, 'Zenith'),
(192540, 'Star', 'Open', '../Upload/Zenith_51-36-17-01-16.jpg', 'marron', 6623, 18, 'Zenith'),
(197068, 'Star', '33', '../Upload/Zenith_23-38-17-01-16.jpg', 'noir,gris', 4069, 21, 'Zenith');

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

CREATE TABLE `stock` (
  `Reference` int(10) NOT NULL,
  `Marque` varchar(75) NOT NULL,
  `Modele` varchar(100) NOT NULL,
  `Echantillon` varchar(300) NOT NULL,
  `Couleur` varchar(500) NOT NULL,
  `Prix` decimal(10,0) NOT NULL,
  `Quantite` int(50) NOT NULL,
  `Fournisseur` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `stock`
--

INSERT INTO `stock` (`Reference`, `Marque`, `Modele`, `Echantillon`, `Couleur`, `Prix`, `Quantite`, `Fournisseur`) VALUES
(114300, 'Oyster', 'Perpetual 39', '../Upload/ROLEX _03-55-04-01-16.jpg', 'acier', '4883', 22, 'ROLEX'),
(424319, 'Cellini ', 'Danaos', '../Upload/ROLEX_01-30-10-01-16.jpg', 'White Gold ', '8', 15, 'ROLEX'),
(279178, 'Lady-Datejust', '28', '../Upload/ROLEX_23-59-09-01-16.jpg', 'or Everose et diamants', '20', 28, 'ROLEX'),
(279136, 'Lady-Datejust', '28', '../Upload/ROLEX_33-05-10-01-16.jpg', 'platine', '46', 6, 'ROLEX'),
(168813, 'Chrono Bike ', ' F16881_3', '../Upload/Festina_16-56-10-01-16.jpg', 'bleue', '268', 28, 'Festina'),
(228239, 'Oyster      ', 'Perpetual Day-Date 40     ', '../Upload/ROLEX_44-54-09-01-16.jpg', 'platine     ', '5775', 16, 'ROLEX'),
(168827, 'Chrono Bike ', ' F16882_7', '../Upload/Festina_40-52-10-01-16.jpg', 'noir', '221', 15, 'Festina'),
(168828, 'Chrono Bike ', 'F16882/8', '../Upload/Festina_09-51-10-01-16.jpg', 'black', '221', 18, 'Festina'),
(168812, 'Chrono Bike ', 'F16881_2', '../Upload/Festina_24-57-10-01-16.jpg', 'bleue', '261', 19, 'Festina'),
(166382, 'Ceramic', 'F16638/2', '../Upload/Festina_42-57-10-01-16.jpg', 'noir', '312', 29, 'Festina'),
(165761, 'Ceramic ', ' f16576/1 ', '../Upload/Festina_32-59-10-01-16.jpg', 'blanc ', '180', 28, 'Festina'),
(214270, 'Oyster           ', 'Explorer           ', '../Upload/ROLEX_38-55-09-01-16.jpg', 'acier,marron          ', '5250', 16, 'ROLEX '),
(179138, 'Lady-Datejust', 'President', '../Upload/ROLEX_26-14-10-01-16.jpg', 'Silver,Yellow Gold', '27', 2, 'ROLEX'),
(178341, 'Lady-Datejust	', '31', '../Upload/ROLEX_52-01-10-01-16.jpg', 'acier, or Everose et diamants', '8', 17, 'ROLEX'),
(116713, 'Oyster', 'GMT-Master II', '../Upload/ROLEX _13-21-04-01-16.jpg', 'acier', '11865', 19, 'ROLEX '),
(80319, 'Oyster   ', 'Pearlmaster 29   ', '../Upload/ROLEX_23-55-09-01-16.jpg', 'or,gris,diamants   ', '24911', 13, 'ROLEX '),
(50515, 'Cellini', 'Date', '../Upload/ROLEX_41-35-10-01-16.jpg', 'gold,black', '16', 8, 'ROLEX'),
(50509, 'Cellini', 'Time', '../Upload/ROLEX_15-33-10-01-16.jpg', 'white gold,rose,black', '14', 13, 'ROLEX'),
(168591, 'Chronograph', 'F16859/1', '../Upload/Festina_04-00-10-01-16.jpg', 'marron', '266', 24, 'Festina'),
(168561, 'Chronograph', 'F16856/1', '../Upload/Festina_35-27-10-01-16.jpg', 'marron', '258', 27, 'Festina'),
(168551, 'Chronograph', ' F16855/1', '../Upload/Festina_55-28-10-01-16.jpg', 'marron', '218', 30, 'Festina'),
(166281, 'Ceramic', 'F16628/1', '../Upload/Festina_14-55-10-01-16.jpg', 'blanc', '303', 34, 'Festina'),
(895141, 'Swatch Irony', 'TRESOR BLANC', '../Upload/Swatch_25-24-10-01-16.jpg', 'blanc', '147', 5, 'Swatch'),
(624019, 'Swatch Irony', 'BLACK COAT', '../Upload/Swatch_55-29-10-01-16.jpg', 'noir', '175', 8, 'Swatch'),
(451397, 'Swatch Skin', 'SUMMER BREEZE', '../Upload/Swatch_48-37-10-01-16.jpg', 'bleue', '127', 12, 'Swatch'),
(336123, 'Swatch Skin', 'BLAUMANN ', '../Upload/Swatch_45-39-10-01-16.jpg', 'noir,blanc,bleue,silver', '125', 15, 'Swatch'),
(322300, 'Swatch Skin  ', 'CLIMBER FLOWERY  ', '../Upload/Swatch_59-35-10-01-16.jpg', 'Silver,Yellow Gold  ', '122', 7, 'Swatch'),
(252713, 'Swatch Irony', 'GRANDE DAME', '../Upload/Swatch_06-28-10-01-16.jpg', 'bleue', '98', 11, 'Swatch'),
(214006, 'Irony XLite', 'DARKONY ', '../Upload/Swatch_41-42-10-01-16.jpg', 'bleue,jaune', '158', 13, 'Swatch'),
(214004, 'Irony XLite', 'RED WHEEL', '../Upload/Swatch_23-46-10-01-16.jpg', 'noir', '129', 9, 'Swatch'),
(214001, 'Irony XLite ', 'ENDLESS ENERGY ', '../Upload/Swatch_33-44-10-01-16.jpg', 'bleue ', '161', 14, 'Swatch'),
(159710, 'Swatch Irony', 'MOROCCAN NIGHT', '../Upload/Swatch_57-25-10-01-16.jpg', 'black', '143', 7, 'Swatch'),
(145115, 'Swatch Skin', 'HELLO DARLING', '../Upload/Swatch_37-33-10-01-16.jpg', 'rose', '143', 18, 'Swatch'),
(117485, 'Swatch Irony', 'DREAMNIGHT ', '../Upload/Swatch_27-31-10-01-16.jpg', 'blanc,noir,acier', '224', 13, 'Swatch'),
(3030021, 'Squelette', 'tourbillon volant ', '../Upload/Cartier_48-48-10-01-16.jpg', 'noir', '149', 8, 'Cartier'),
(2020057, 'Squelette', 'Santos-Dumont', '../Upload/Cartier_27-47-10-01-16.jpg', 'marron', '50', 18, 'Cartier'),
(1580048, 'quantiÃ¨me perpÃ©tuel', 'Tortue', '../Upload/Cartier_38-32-10-01-16.jpg', 'noir,or gris', '68', 16, 'Cartier'),
(1580017, 'Squelette', 'complication', '../Upload/Cartier_33-45-10-01-16.jpg', 'Silver,noir', '140', 17, 'Cartier'),
(1560017, 'Squelette', 'Cartier Tank Louis', '../Upload/Cartier_04-52-10-01-16.jpg', 'marron sombre', '16', 13, 'Cartier'),
(1556242, 'quantiÃ¨me perpÃ©tuel', 'Rotonde de Cartier', '../Upload/Cartier_27-38-10-01-16.jpg', 'marron,noir', '218', 26, 'Cartier'),
(1556225, 'quantiÃ¨me perpÃ©tuel', 'Rotonde de Cartier', '../Upload/Cartier_43-35-10-01-16.jpg', 'marron,rose', '75', 8, 'Cartier'),
(1556217, 'quantiÃ¨me perpÃ©tuel', 'Rotonde de Cartier', '../Upload/Cartier_59-36-10-01-16.jpg', 'marron', '57', 17, 'Cartier'),
(1555951, 'Chronographe', 'Centrale', '../Upload/Cartier_38-42-10-01-16.jpg', 'noir', '41', 22, 'Cartier'),
(3559320, 'Speedmaster', 'Chronographe Michael Schumacher', '../Upload/Omega_57-31-17-01-16.jpg', 'noir', '3', 25, 'Omega'),
(3477379, 'Speedmaster', 'New ', '../Upload/Omega_40-34-17-01-16.jpg', 'blanc', '1838', 18, 'Omega'),
(2329046, 'Seamaster planet ocean', 'New ', '../Upload/Omega_15-17-17-01-16.jpg', 'Acier', '5145', 16, 'Omega'),
(2329042, 'Seamaster planet ocean', 'Liquidmetal', '../Upload/Omega_16-19-17-01-16.jpg', 'Bleue', '5723', 19, 'Omega'),
(2323044, 'Seamaster planet ocean', 'GMT', '../Upload/Omega_11-23-17-01-16.jpg', 'acier', '5565', 27, 'Omega'),
(1501510, 'Constellation', 'Double Eagle', '../Upload/Omega_15-07-17-01-16.jpg', 'acier', '2835', 13, 'Omega'),
(1469238, 'Seamaster planet ocean ', 'Titane COSC Full set ', '../Upload/Omega_17-29-17-01-16.jpg', 'bleue,black ', '4988', 36, 'Omega'),
(1397811, 'Speedmaster', 'professional mark II ', '../Upload/Omega_40-36-17-01-16.jpg', 'acier,noir', '2888', 19, 'Omega'),
(1235038, 'Constellation ', 'Co-Axial Jour-Date 38 ', '../Upload/Omega_02-59-17-01-16.jpg', 'Or jaune,Or rouge,acier ', '15', 22, 'Omega'),
(1232038, 'Constellation', 'Co-Axial 38', '../Upload/Omega_17-01-17-01-16.jpg', 'Acier,or rouge', '12065', 12, 'Omega'),
(1232024, 'Constellation', 'Quartz 24', '../Upload/Omega_18-04-17-01-16.jpg', 'Acier,or rouge', '1365', 18, 'Omega'),
(5102, 'Portugieser', 'Huit Jours Edition', '../Upload/IWC_41-57-17-01-16.jpg', 'marron', '81795', 16, 'IWC'),
(5041, 'Portugieser', 'SidÃ©rale Scafusia', '../Upload/IWC_37-51-17-01-16.jpg', 'noir', '78225', 8, 'IWC'),
(5035, 'Portugieser', 'Calendrier Annuel', '../Upload/IWC_56-53-17-01-16.jpg', 'argent', '79275', 13, 'IWC'),
(5034, 'Portugieser', 'Calendrier PerpÃ©tuel', '../Upload/IWC_14-56-17-01-16.jpg', 'noir,bleue', '82373', 11, 'IWC'),
(3796, 'Ingenieur', 'Chronographe Edition', '../Upload/IWC_27-12-17-01-16.jpg', 'gris', '5752', 17, 'IWC'),
(3795, 'Aquatimer ', 'Science for Galapagos ', '../Upload/IWC_22-04-17-01-16.jpg', 'noir ', '6038', 14, 'IWC'),
(3768, 'Aquatimer', 'CHRONOGRAPHE', '../Upload/IWC_48-59-17-01-16.jpg', 'bleuennoir', '5618', 18, 'IWC'),
(3759, 'Aquatimer', 'GALAPAGOS ISLANDS', '../Upload/IWC_41-09-17-01-16.jpg', 'noir', '6169', 19, 'IWC'),
(3580, 'Aquatimer', 'Automatic 2000', '../Upload/IWC_31-05-17-01-16.jpg', 'noir', '6636', 20, 'IWC'),
(3246, 'Ingenieur ', 'Automatic Edition ', '../Upload/IWC_05-14-17-01-16.jpg', 'noir ', '5917', 22, 'IWC'),
(3239, ' Ingenieur', 'Automatic ', '../Upload/IWC_09-11-17-01-16.jpg', 'gris,argent', '6878', 19, 'IWC'),
(71356, 'Galactic', '32', '../Upload/Breitling_25-13-17-01-16.jpg', 'noir', '3232', 16, 'Breitling'),
(49350, 'Galactic', '41', '../Upload/Breitling_12-10-17-01-16.jpg', 'gris,bleue', '4594', 7, 'Breitling'),
(45320, 'Galactic', '44', '../Upload/Breitling_41-07-17-01-16.jpg', 'gris', '4746', 10, 'Breitling'),
(42011, 'Chronomat ', 'GMT ', '../Upload/Breitling_01-06-17-01-16.jpg', 'gris,noir,argent ', '6715', 24, 'Breitling'),
(35100, 'Galactic', 'Unitime SleekT', '../Upload/Breitling_50-11-17-01-16.jpg', 'noir', '6127', 18, 'Breitling'),
(24322, 'Navitimer', '1461', '../Upload/Breitling_15-49-17-01-16.jpg', 'gris,marron', '6248', 8, 'Breitling'),
(14053, 'Chronomat', '41', '../Upload/Breitling_00-58-17-01-16.jpg', 'or,argent,noir', '7712', 21, 'Breitling'),
(12722, 'Navitimer', 'AOPA', '../Upload/Breitling_32-52-17-01-16.jpg', 'noir,gris,bleue', '6090', 17, 'Breitling'),
(12721, 'Navitimer', '01 ', '../Upload/Breitling_38-45-17-01-16.jpg', 'noir,gris', '7791', 22, 'Breitling'),
(12012, 'Navitimer', 'Cosmonaute', '../Upload/Breitling_45-54-17-01-16.jpg', 'noir,gris', '4998', 17, 'Breitling'),
(11381, 'Chronomat', '38', '../Upload/Breitling_10-03-17-01-16.jpg', 'bleue,gris', '2069', 14, 'Breitling'),
(11079, 'Chronomat', '44', '../Upload/Breitling_35-00-17-01-16.jpg', 'bleue,noir;gris', '8306', 24, 'Breitling'),
(452050, 'El Primero', 'Tourbillon', '../Upload/Zenith_13-24-17-01-16.jpg', 'marron,noir', '45830', 27, 'Zenith'),
(302040, 'El Primero ', '36000 VPH ', '../Upload/Zenith_39-22-17-01-16.jpg', 'gris,noir ', '7455', 25, 'Zenith'),
(227061, 'Elite', '6150', '../Upload/Zenith_50-27-17-01-16.jpg', 'noir', '6736', 31, 'Zenith'),
(222310, 'Elite', 'Lady Moonphase', '../Upload/Zenith_55-33-17-01-16.jpg', 'gris,bleue,noir,argent', '4807', 23, 'Zenith'),
(202067, 'Elite', 'Captain Central', '../Upload/Zenith_41-31-17-01-16.jpg', 'noir', '4948', 25, 'Zenith'),
(201068, 'Elite ', 'Ultra Thin ', '../Upload/Zenith_42-29-17-01-16.jpg', 'noir,argent ', '4373', 22, 'Zenith'),
(197068, 'Star', '33', '../Upload/Zenith_23-38-17-01-16.jpg', 'noir,gris', '4272', 17, 'Zenith'),
(192569, 'Star', 'Moonphase', '../Upload/Zenith_43-35-17-01-16.jpg', 'noir', '5182', 19, 'Zenith'),
(192540, 'Star', 'Open', '../Upload/Zenith_51-36-17-01-16.jpg', 'marron', '6954', 18, 'Zenith'),
(182091, 'El Primero', '410', '../Upload/Zenith_49-20-17-01-16.jpg', 'noir,marron', '17225', 15, 'Zenith'),
(182040, 'El Primero', 'Chronomaster ', '../Upload/Zenith_51-18-17-01-16.jpg', 'noir', '17162', 13, 'Zenith');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `Nom` varchar(25) NOT NULL,
  `Prenom` varchar(25) NOT NULL,
  `Pays` varchar(35) NOT NULL,
  `Ville` varchar(35) NOT NULL,
  `Adresse` varchar(85) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Login` varchar(35) NOT NULL,
  `Password` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`Nom`, `Prenom`, `Pays`, `Ville`, `Adresse`, `Email`, `Login`, `Password`) VALUES
('ahmed ', 'chebbi ', 'Tunis ', 'Sfax ', 'Route aeroport km 8 ', 'il-pazzo@hotmail.fr', 'ilpazzo', 'brigade'),
('kamel   ', 'tijeni   ', 'Tunis   ', 'Sfax    ', 'route tunis km 3.5   ', 'k.tj@live.fr', 'k.tj', 'bbc');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Num_admin`);

--
-- Index pour la table `destination`
--
ALTER TABLE `destination`
  ADD PRIMARY KEY (`Num_Commande`);

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`Nom_societe`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`Reference`),
  ADD KEY `Fournisseur` (`Fournisseur`);

--
-- Index pour la table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`Reference`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Login`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `Num_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
