-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2025 at 09:53 AM
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
-- Database: `vijesti`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `prezime` varchar(50) NOT NULL,
  `korisnickoIme` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime`, `prezime`, `korisnickoIme`, `password`, `admin`) VALUES
(1, 'Denis', 'Osmić', 'admin', '$2y$10$Rwpb0hidUcStLqBuK88m4OMba8RJKyJkeIGN6k6QzR6nYC/WHlBSC', 1),
(4, 'Danijel', 'Osmić', 'dosmic', '$2y$10$lOBSHgOlHoBTVFAEC.8qc.LA084oIjOewqORHcERkVNyV8iq0hqSa', 0);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `about` text NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category` enum('elections','lesjt') NOT NULL,
  `archive` tinyint(1) DEFAULT 0,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `about`, `content`, `image`, `category`, `archive`, `date`) VALUES
(1, 'Denis Osmić postao gradonačelnik Pariza', 'Stvarno je', 'Istina je', 'img_6854282e21de90.29792183.png', 'lesjt', 1, '2025-06-19'),
(2, 'Naslov', 'hehehehheheheheee', 'hihihihihiihihihhiih', 'My name is Emporio.jpg', 'elections', 1, NULL),
(3, 'Naslov hehehehe valjda će sada biti i date', 'Kratki sadržaj', 'hahahahhahahaahahhaa', 'img_6855398b7f0134.06500565.png', 'elections', 1, '2025-06-21'),
(4, 'JT de 20h du jeudi 16 mai 2019', 'Le JT de 20 Heures du jeudi 16 mai 2019 est présenté par Anne-Sophie Lapix sur France 2.', 'Retrouvez dans le journal télévisé du soir : la sélection des faits marquants, les interviews et témoignages, les invités politiques et de la vie publique et l\'essentiel de tout ce qu\'il faut savoir de la journée. A noter : chaque sujet vidéo du journal est consultable indépendamment avec des informations à lire pour rappeler le contexte de l\'actualité. Poursuivez l\'expérience avec les titres de la rédaction de Franceinfo.\r\nLe JT de 20 Heures du jeudi 16 mai 2019 est présenté par Anne-Sophie Lapix sur France 2. Retrouvez dans le journal télévisé du soir : la sélection des faits marquants, les interviews et témoignages, les invités politiques et de la vie publique et l\'essentiel de tout ce qu\'il faut savoir de la journée. A noter : chaque sujet vidéo du journal est consultable indépendamment avec des informations à lire pour rappeler le contexte de l\'actualité. Poursuivez l\'expérience avec les titres de la rédaction de Franceinfo.', 'slika9.jpg', 'lesjt', 0, '2025-05-25'),
(5, 'Grand Soir 3 du jeudi 16 mai 2019', 'Le Grand Soir 3, du jeudi 16 mai 2019 présenté par Francis Letellier sur France 3 est consultable en ligne à la fois en direct et en replay pour voir et revoir ce journal télé qui décrypte l\'actualité d\'une journée.', 'Le Grand Soir 3, du jeudi 16 mai 2019 présenté par Francis Letellier sur France 3 est consultable en ligne à la fois en direct et en replay pour voir et revoir ce journal télé qui décrypte l\'actualité d\'une journée. Retrouvez les résultats de la question du jour, l\'Eurozapping, la revue de presse, ainsi que les grands reportages, les interviews et les explications de la rédaction sur toute l’actualité régionale, d\'outre-mer, nationale et internationale. Pour réagir à l\'information sur les réseaux sociaux : #grandsoir3 ou sur le compte @LeGrandSoir3', 'slika8.jpg', 'lesjt', 0, '2025-05-25'),
(6, 'Le JT de 7h de franceinfo du vendredi 17 mai 2019', 'Ovo je kratki sadržaj', 'Ovo je sadržaj.\r\nOvdje ide tekst.', 'slika7.jpg', 'lesjt', 0, '2025-05-25'),
(7, 'JT de 8h du vendredi 17 mai 2019', 'Le JT de 8 Heures sur France 2 du vendredi 17 mai 2019 présenté par Estelle Colin.', 'Le JT de 8 Heures sur France 2 du vendredi 17 mai 2019 présenté par Estelle Colin propose un bilan de l\'actualité en début de journée, à voir et revoir en direct et en replay ici. Pendant Télématin, le 8 Heures est une plage d\'information qui propose des reportages et témoignages sur les événements de la nuit et donne l\'agenda de la journée. Retrouvez chaque sujet du JT en replay découpé avec les élements de contexte à lire et partager.', 'slika6.jpg', 'lesjt', 0, '2025-05-25'),
(8, '80 km/h, PMA, chômage, européennes... Ce qu\'il faut retenir de l\'interview d\'Édouard Philippe sur franceinfo', 'Le Premier ministre était l\'invité du \"8h30&nbsp;Fauvelle-Dély\", jeudi 16 mai. Voici ce qu\'il fallait en retenir.&nbsp;', 'Invité de franceinfo jeudi 16 mai, Edouard Philippe a estimé que \"les conditions\"  étaient réunies pour qu\'il reste à Matignon, bien que la décision ne lui appartienne \"pas complètement\". \"Un Premier ministre, il est à Matignon quand, au fond, trois conditions sont réunies, a-t-il détaillé. La confiance du président, le soutien de la majorité parlementaire et puis des éléments qui lui sont propres : est-ce qu\'il est à l’aise avec ce qu\'il fait, est-ce qu\'il a envie de le faire. Aujourd\'hui, il me semble que ces trois conditions sont réunies.\" Mais \"la décision ne m\'appartient pas complètement\", a-t-il ajouté. \"Le président de la République a son mot à dire (…) et je respecte évidemment son analyse et ses choix en la matière\", explique le Premier ministre. Voici ce qu\'il fallait retenir de cet entretien sur franceinfo.\r\n\r\nLe président de la République qui pèse dans la campagne et son portrait sur des affiches de la liste Renaissance : \"C\'est très bien ainsi\", estime le Premier ministre. Pour Édouard Philippe, Emmanuel Macron assume de cette manière \"son engagement pro-européen\". Pour autant, en cas de score inférieur à la liste du Rassemblement national le soir du 26 mai, Édouard Philippe l\'affirme, \"la logique d\'ensemble de l\'action gouvernementale\" ne sera pas modifiée. Même si l\'on peut s\'attendre à une éventuelle inflexion de la politique gouvernemental.  ', 'slika5.jpg', 'elections', 0, '2025-05-25'),
(9, '\"Nous avons une capacité à nous adresser à des Français qui viennent d’horizons très différents\", assure Nicolas Bay du Rassemblement national', 'Le candidat RN aux élections européennes était l\'invité du 19h20 politique de franceinfo jeudi.', '\"Incontestablement, nous avons une capacité à nous adresser à des Français qui viennent d’horizons politiques et sociologiques très différents\", a déclaré jeudi 16 mai sur franceinfo Nicolas Bay, candidat RN aux élections européennes. Dans un sondage Odoxa-Dentsu Consulting pour franceinfo et Le Figaro, le Rassemblement national recueille 36% de bonnes opinions, son plus haut niveau de popularité de la décennie.\r\n\r\nSelon ce même sondage, 40% des électeurs de La France insoumise considèrent que le Rassemblement national défend bien les classes populaires. \"Il y a à droite de l’échiquier, et sans doute chez les électeurs de Jean-Luc Mélenchon à l’élection présidentielle, des Français qui veulent défendre la souveraineté nationale et dans le cadre des élections européennes, nous leur disons : il y a un vote utile pour défendre l’Europe des nations et pour battre Macron, c’est le vote Rassemblement national\", a déclaré le député européen sortant.\r\n\r\nSelon l’étude, 60% des Français considèrent que le RN est un parti comme un autre. Nicolas Bay y voit une \"bonne nouvelle\" \"Le Rassemblement national apparait aux yeux des Français pour ce qu’il est vraiment, loin des caricatures qui ont longtemps été colportées et entretenues contre nous\", a-t-il expliqué.\r\nSur franceinfo, le candidat aux élections européennes a également défendu la stratégie d’alliance du Rassemblement national avec d’autres partis populistes européens. \"Matteo Salvini a été très critiqué dans les médias français sans la possibilité de se défendre puisqu’il est homme politique en Italie. Par conséquent, beaucoup ont subi un flot ininterrompu de propagande anti-Salvini depuis des mois et des mois parce qu’il avait le courage de s’attaquer à l’immigration, de prendre des mesures qui se révèlent efficaces\", a-t-il estimé.\r\n\r\n\"Nous avons une capacité à avoir des alliés qui sont partout en croissance en Europe alors que la plupart de nos adversaires, à commencer par Emmanuel Macron, ont finalement assez peu d’alliés et souvent des forces supplétives dans leur pays en Europe\", a poursuivi Nicolas Bay.', 'slika4.jpg', 'elections', 0, '2025-05-25'),
(10, 'Italie : Matteo Salvini affaibli pour les européennes', 'Malgré son omniprésence politique, Matteo Salvini et son parti chutent dans les sondages italiens à l\'approche des élections européennes.', 'Survêtement aux couleurs de l\'Italie, Matteo Salvini(Nouvelle fenêtre) monte sur scène. Si les meetings du ministre de l\'Intérieur sont toujours bondés, désormais les opposants de font entendre. Son parti, la Ligue, a perdu 6 points d\'intentions de votes pour les élections européennes. \"Pour moi, s\'il y a des banderoles, des sifflets, des drapeaux rouges, ce n\'est pas grave, ça m\'amuse\", déclare Matteo Salvini. Depuis quelques semaines, il affronte une série de contrariétés : démission d\'un de ses proches accusé de corruption, tensions avec Luigi Di Maio et polémique autour d\'un meeting donné depuis un balcon où Mussolini s\'exprimait.\r\n\r\n\"Pour la première fois, il subit un retournement de tendance, les sondages le confirment, probablement parce qu\'il y a une sorte d\'overdose de sa présence\", estime Monica Guerzoni, politologue au Corriere della Sera. Matteo Salvini se voit aussi reprocher d\'abandonner son rôle de ministre de l\'Intérieur, lui qui n\'a passé que 19 jours dans ses bureaux lors des six derniers mois. Dans le même temps, il a tenu plus de 250 réunions publiques au cours desquelles il passe des heures à prendre des selfies avec ses supporters. Au-delà des élections européennes, le ministre vise le poste de président du Conseil.', 'slika3.jpg', 'elections', 0, '2025-05-25'),
(11, 'INFO FRANCEINFO. Européennes : les Républicains et le RN n\'ont pas signé le plaidoyer de Transparency International pour la lutte contre la corruption', '149 candidats français d\'autres partis l\'ont signé, dont sept têtes de listes, selon l\'ONG.', 'Dans le cadre des élections européennes, l\'ONG Transparency International, qui lutte contre la corruption, a invité tous les candidats à signer un plaidoyer afin qu\'ils s\'engagent à protéger l\'État de droit, à lutter contre l\'évasion fiscale et à améliorer la transparence des institutions européennes.\r\n\r\nSuite à un premier bilan effectué par l\'ONG, pour le moment, 149 candidats aux élections européennes en France ont signé ce plaidoyer, révèle franceinfo vendredi 17 mai. Parmi ces candidats qui s\'engagent, on retrouve sept têtes de liste aux européennes (La France insoumise, Renaissance, Parti communiste, Europe Ecologie-Les Verts, Debout la France, Envie d\'Europe et Parti Pirate). Aucun candidat des listes du Rassemblement national et des Républicains n\'a signé. Or, ces deux listes regroupent à elles seules 40% des candidats en position éligible.', 'slika2.jpg', 'elections', 0, '2025-05-25'),
(12, '\"Je vis sur la route, mais sans concert au bout\" : on a passé une journée avec Francis Lalanne, tête de liste \"gilets jaunes\" aux européennes', 'En Vendée, le chanteur a tenté de convaincre des sympathisants du mouvement de voter pour l\'Alliance jaune lors du scrutin du 26 mai. Et il n\'était pas toujours en terrain conquis.', 'Le rendez-vous a été donné à 8 heures, sur un morceau de terrain occupé par des \"gilets jaunes\" de Vendée depuis quelques mois. Pour le trouver, pas besoin d\'adresse. Il suffit de suivre la départementale qui rejoint Challans depuis La Roche-sur-Yon. Le campement est visible depuis la route, avec ses banderoles \"TVA = racket\", ses drapeaux jaunes, sa cabane et son odeur de palettes qui brûlent. Dans ce décor de village gaulois en résistance, Francis Lalanne n\'a pas enfilé les habits de barde, mais ceux de tête de liste pour les élections européennes.\r\n\r\n\"Ah, voilà Francis !\" s\'exclame la petite dizaine de \"gilets jaunes\" lorsque le chanteur traverse le pont de bois qui enjambe le fossé. Longs cheveux noués, jean noir, grosse doudoune et sac en toile Karl Lagerfeld sur le dos, le premier candidat de la liste Alliance jaune claque la bise au petit groupe d\'habitués du camp et échange quelques selfies. Il est accompagné par une figure locale du mouvement, le Vendéen Jonathan Ferandin, 49e de la liste, ainsi que de Jérémy Clément, en 3e position.', 'Slika1.jpg', 'elections', 0, '2025-05-25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `korisnickoIme` (`korisnickoIme`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
