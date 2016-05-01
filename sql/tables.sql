CREATE TABLE Jeu (
	IdJeu int(6) NOT NULL AUTO_INCREMENT Primary key,
	NomJeu varchar(50) NOT NULL,
	DescriptionJeu varchar(500) NOT NULL,
    image_petite varchar(500) NOT NULL,
    image_grande varchar(500) NOT NULL,
    QuantiteJeu int(6),
    IdPlateformeProd int(6) NOT NULL,
    FOREIGN KEY (IdPlateformeProd) REFERENCES PlateformeProd (IdPlateformeProd)
);

CREATE TABLE User (
	NumUser int(6) NOT NULL AUTO_INCREMENT Primary key,
	PrenomUser varchar(50) NOT NULL,
	PseudoUser varchar(50) NOT NULL,
	EmailUser varchar(50) NOT NULL,
	MdpUser varchar(50) NOT NULL
);

CREATE TABLE Plateforme (
	IdPlateforme int(6) NOT NULL AUTO_INCREMENT Primary key,
	NomPlateforme varchar(50) NOT NULL,
	PrixJeu varchar(500) NOT NULL
);

CREATE TABLE PlateformeProd (
	IdPlateformeProd int(6) NOT NULL AUTO_INCREMENT Primary key,
	NomPlateformeProd varchar(50) NOT NULL,
	PrixJeuProd int(3) NOT NULL
);

CREATE TABLE Genre (
	IdGenre int(6) NOT NULL AUTO_INCREMENT Primary key,
	NomGenre varchar(50) NOT NULL
);

CREATE TABLE Facture (
	NumFacture int(6) NOT NULL AUTO_INCREMENT Primary key,
	NumUser int(6) NOT NULL,
	Foreign Key (NumUser) references User(NumUser)
);

CREATE TABLE DateCommande (
	Jjmmaaaa date NOT NULL Primary key
);

CREATE TABLE Correspondre (
	IdGenre int(6) NOT NULL,
	IdJeu int(6) NOT NULL,
	Primary key (IdGenre, IdJeu),
	Foreign key (IdGenre) references Genre(IdGenre),
	Foreign key (IdJeu) references Jeu(IdJeu)
);

CREATE TABLE Appartenir (
	IdPlateforme int(6) NOT NULL,
	IdJeu int(6) NOT NULL,
	Primary key (IdJeu, IdPlateforme),
	Foreign key (IdJeu) references Jeu(IdJeu),
	Foreign key (IdPlateforme) references Plateforme(IdPlateforme)
);

CREATE TABLE Commander (
	NumUser int(6) NOT NULL,
	IdJeu int(6) NOT NULL,
	Jjmmaaaa date NOT NULL,
	Quantite int(6) NOT NULL,
	Primary key (NumUser, IdJeu, Jjmmaaaa),
	Foreign key (NumUser) references User(NumUser),
	Foreign key (IdJeu) references Jeu(IdJeu),
	Foreign key (Jjmmaaaa) references DateCommande(Jjmmaaaa)
);
