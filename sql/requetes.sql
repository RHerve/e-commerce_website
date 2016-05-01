/* INSERTION JEUX */

INSERT INTO `jeu`(`IdJeu`, `NomJeu`, `DescriptionJeu`) VALUES (1,'Mortal Kombat X','Mortal Kombat X est le dixième opus de la série de jeux de combats du même nom. Les joueurs s\'affrontent au cours de batailles particulièrement gores. Ils peuvent choisir parmi trois déclinaisons des 24 personnages de base, utiliser des éléments du décors et s\'achever avec des fatalities toujours plus exubérantes.')
INSERT INTO `jeu`(`IdJeu`, `NomJeu`, `DescriptionJeu`) VALUES (2,'Grand Theft Auto V','Jeu d\'action-aventure en monde ouvert, Grand Theft Auto (GTA) V vous place dans la peau de trois personnages inédits : Michael, Trevor et Franklin qui ont élu domicile à Los Santos, ville de la région de San Andreas. Braquages et missions font partie du quotidien du joueur qui pourra également cohabiter avec 16 utilisateurs dans cet univers persistant.')
INSERT INTO `jeu`(`IdJeu`, `NomJeu`, `DescriptionJeu`) VALUES (3,'Kirby et le pinceau arc-en-ciel','Kirby and the Rainbow Paintbrush pour WiiU est un jeu de plates-formes se déroulant dans l\'univers mignon et coloré du célèbre Kirby. Le joueur doit dessiner des lignes pour guider Kirby changé en boule à travers les niveaux.')
INSERT INTO `jeu`(`IdJeu`, `NomJeu`, `DescriptionJeu`) VALUES (4,'Batman Arkham Knight','Se déroulant un an après les événements de Batman Arkham City, Batman Arkham Knight est un jeu d\'action dans lequel l’Épouvantail menace d\'utiliser des armes chimiques sur la ville. Batman est donc au rendez-vous, accompagnée de sa Batmobile qui prend une importance capitale.')



/* INTERTION PLATEFORMES */

INSERT INTO `plateforme`(`IdPlateforme`, `NomPlateforme`, `PrixJeu`) VALUES (1,'Ps4',50)
INSERT INTO `plateforme`(`IdPlateforme`, `NomPlateforme`, `PrixJeu`) VALUES (2,'Xbox One',48)
INSERT INTO `plateforme`(`IdPlateforme`, `NomPlateforme`, `PrixJeu`) VALUES (3,'Pc',30)
INSERT INTO `plateforme`(`IdPlateforme`, `NomPlateforme`, `PrixJeu`) VALUES (4,'Wii u',38)


/* SELECTION NOM PLATEFORMES */

SELECT NomPlateformeProd
FROM plateformeprod
WHERE plateformeprod.IdPlateformeProd = jeu.IdPlateformeProd
AND NomJeu = "Mortal Kombat X";