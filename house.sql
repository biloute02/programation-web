CREATE TABLE Utilisateur (
    U_ID int AUTO_INCREMENT,
    email varchar(30) NOT NULL,
    mdp varchar(255) NOT NULL,
    pseudo varchar(15) NOT NULL,
    nom varchar (50),
    prenom varchar(50),
    date_naissance DATE,
    date_inscription DATE,
    PRIMARY KEY(U_ID),
    UNIQUE(email)
);

CREATE TABLE Annonce(
    A_ID int AUTO_INCREMENT,
    statut int,
    titre VARCHAR(30),
    type_logement VARCHAR(20),
    date_deb DATE,
    date_fin DATE,
    date_post DATE,
    adresse VARCHAR(50),
    ville VARCHAR(50),
    cp CHAR(5),
    pays VARCHAR(50),
    contenu_annonce TEXT,
    prix DECIMAL(6,2),
    surface INT,
    nb_pieces INT,
    U_ID int NOT NULL,
    FOREIGN KEY(U_ID) REFERENCES Utilisateur(U_ID),
    PRIMARY KEY(A_ID)
);

CREATE TABLE Photo (
    P_ID int AUTO_INCREMENT,
    chemin varchar(100),
    U_ID int NOT NULL,
    A_ID int NOT NULL,
    num_photo int,
    FOREIGN KEY(A_ID) REFERENCES Annonce(A_ID),
    FOREIGN KEY(U_ID) REFERENCES Utilisateur(U_ID),
    PRIMARY KEY(P_ID)
);

CREATE TABLE reserve(
    U_ID int,
    A_ID int,
    statut_res VARCHAR(15),
    PRIMARY KEY(U_ID, A_ID),
    FOREIGN KEY(U_ID) REFERENCES Utilisateur(U_ID),
    FOREIGN KEY(A_ID) REFERENCES Annonce(A_ID)
);

CREATE TABLE communiquer(
    U_ID_recoit int,
    U_ID_envoie int,
    date_envoi DATETIME,
    contenu_message TEXT,
    FOREIGN KEY(U_ID_recoit) REFERENCES Utilisateur(U_ID),
    FOREIGN KEY(U_ID_envoie) REFERENCES Utilisateur(U_ID),
    PRIMARY KEY(U_ID_recoit, U_ID_envoie, date_envoi)
);

CREATE TABLE evaluer(
    U_ID_est_evalue int,
    U_ID_evalue int,
    note INT,
    contenu_eval TEXT,
    FOREIGN KEY(U_ID_est_evalue) REFERENCES Utilisateur(U_ID),
    FOREIGN KEY(U_ID_evalue) REFERENCES Utilisateur(U_ID),
    PRIMARY KEY(U_ID_est_evalue, U_ID_evalue)
);



INSERT INTO Utilisateur(U_ID, email, mdp, pseudo, nom, prenom, date_naissance, date_inscription) values(1, 'jeanmichel72@email.com', '$2y$10$1Ijua.ce5f.YtCol7UN1PeMHElTUkt5sR3ebjTaK5vhOvlj4/WbzC', 'Janmi', 'Dupuis', 'Jean-Michel', STR_TO_DATE('12/05/1972', '%d/%c/%Y'), STR_TO_DATE('15/03/2022', '%d/%c/%Y'));
INSERT INTO Utilisateur(U_ID, email, mdp, pseudo, nom, prenom, date_naissance, date_inscription) values(2, 'titouan23@email.com', '$2y$10$BuqoZU99eEpLUJCqjW1/OuhChc2AU5YKy5JxfQCZ11m.QvfdBbLfC', 'Titouandu23', 'Bozac', 'Titouan', STR_TO_DATE('29/02/2000', '%d/%c/%Y'), STR_TO_DATE('13/12/2020', '%d/%c/%Y'));
INSERT INTO Utilisateur(U_ID, email, mdp, pseudo, nom, prenom, date_naissance, date_inscription) values(3, 'germain.dupont@mail.fr', '$2y$10$evGtWbnyekrRqp/swb9ORu.4gaSIJKz9o16rSXLHYv9JFo36sDbmG', 'Germain', 'Dupont', 'Germain', STR_TO_DATE('30/07/1959', '%d/%c/%Y'), STR_TO_DATE('23/04/2021', '%d/%c/%Y'));
INSERT INTO Utilisateur(U_ID, email, mdp, pseudo, nom, prenom, date_naissance, date_inscription) values(4, 'tristanb@email.fr', '$2y$10$MtqB3yKNgahKmNSxJOg8D./TssnKPRR70Lleoa.m./zZA/g16GEdG', 'Tristoune', 'Boulanger', 'Tristan', STR_TO_DATE('25/09/1995', '%d/%c/%Y'), STR_TO_DATE('19/01/2022', '%d/%c/%Y'));
INSERT INTO Utilisateur(U_ID, email, mdp, pseudo, nom, prenom, date_naissance, date_inscription) values(5, 'marlene.delafaille@email.fr', '$2y$10$s.sNfn9cnlWKNddyTymzA.4eYjrVVnvxPiMbndQQsmqf0Ws4l.aJG', 'Marlène', 'De Lafaille', 'Marlène', STR_TO_DATE('14/11/1979', '%d/%c/%Y'), STR_TO_DATE('05/03/2022', '%d/%c/%Y'));

INSERT INTO Annonce(A_ID, statut, titre, type_logement, date_deb, date_fin, date_post, adresse, ville, cp, pays, contenu_annonce, prix, surface, nb_pieces, U_ID) values(1, 0, "Appartement haussmanien", 'appartement', STR_TO_DATE('05/07/2021', '%d/%c/%Y'), STR_TO_DATE('31/07/2021', '%d/%c/%Y'), STR_TO_DATE('13/04/2021', '%d/%c/%Y'), '8 boulevard Dumas', 'Paris', '75016', 'France', "Charmant appartement haussmanien en plein coeur du 16&egrave;me arrondissement de Paris, id&eacute;al pour d&eacute;couvrir la ville. Situ&eacute; au troisi&egrave;me &eacute;tage avec ascenseur, l’appartement est calme et lumineux.
Possibilit&eacute; d’accueillir jusqu’&agrave; 6 personnes gr&acirc;ce aux 2 chambres &eacute;quip&eacute;es de lits doubles et au canap&eacute;-lit dans la salle de s&eacute;jour.

Cuisine &eacute;quip&eacute;e, t&eacute;l&eacute;vision et wifi &agrave; disposition, tout est pr&eacute;vu pour que vous passiez un s&eacute;jour id&eacute;al.

Animaux non autoris&eacute;s.", 70, 90, 3, 5);
INSERT INTO Annonce(A_ID, statut, titre, type_logement, date_deb, date_fin, date_post, adresse, ville, cp, pays, contenu_annonce, prix, surface, nb_pieces, U_ID) values(2, 1, "Maison &agrave; la campagne", 'maison', STR_TO_DATE('16/04/2022', '%d/%c/%Y'), STR_TO_DATE('30/04/2022', '%d/%c/%Y'), STR_TO_DATE('12/02/2022', '%d/%c/%Y'), '23 rue des Crocs', 'Saint-Pardoux-Morterolles', '23227', 'France', "Maison de campagne familiale. 4 chambres, 6 couchages (3 lits doubles, 1 lit superpos&eacute;), 2 salles de bain. Terrain de 1 hectare. Animaux autoris&eacute;s.", 400, 120, 5, 2);
INSERT INTO Annonce(A_ID, statut, titre, type_logement, date_deb, date_fin, date_post, adresse, ville, cp, pays, contenu_annonce, prix, surface, nb_pieces, U_ID) values(3, 1, "Appartement centre-ville", 'appartement', STR_TO_DATE('04/06/2022', '%d/%c/%Y'), STR_TO_DATE('25/06/2022', '%d/%c/%Y'), STR_TO_DATE('27/03/2022', '%d/%c/%Y'), '2 rue de la Fourchette', 'Lyon', '69000', 'France', "Petit appartement 2 pi&egrave;ces avec cuisine ouverte. WC s&eacute;par&eacute;s.
Proche centre-ville, quartier anim&eacute;, transports &agrave; proximit&eacute;.", 250, 50, 2, 3);
INSERT INTO Annonce(A_ID, statut, titre, type_logement, date_deb, date_fin, date_post, adresse, ville, cp, pays, contenu_annonce, prix, surface, nb_pieces, U_ID) values(4, 0, "Maison ami&eacute;noise",  'maison', STR_TO_DATE('06/08/2022', '%d/%c/%Y'), STR_TO_DATE('13/08/2022', '%d/%c/%Y'), STR_TO_DATE('18/03/2022', '%d/%c/%Y'), '14 avenue du Pr&eacute;', 'Amiens', '80000', 'France', "Maison ami&eacute;noise r&eacute;nov&eacute;e r&eacute;cemment, proche du centre-ville. 2 chambres, 1 salle de bain. Petit jardin &agrave; l’arri&grave;re.", 350, 90, 3, 1);
INSERT INTO Annonce(A_ID, statut, titre, type_logement, date_deb, date_fin, date_post, adresse, ville, cp, pays, contenu_annonce, prix, surface, nb_pieces, U_ID) values(5, 1, "Maison &agrave; la campagne", 'maison', STR_TO_DATE('14/05/2022', '%d/%c/%Y'), STR_TO_DATE('28/05/2022', '%d/%c/%Y'), STR_TO_DATE('12/02/2022', '%d/%c/%Y'), '23 rue des Crocs', 'Saint-Pardoux-Morterolles', '23227', 'France', "Maison de campagne familiale. 4 chambres, 6 couchages (3 lits doubles, 1 lit superpos&eacute;), 2 salles de bain. Terrain de 1 hectare. Animaux autoris&eacute;s.", 400, 120, 5, 2);

INSERT INTO Photo(P_ID, chemin, A_ID, U_ID, num_photo) values (1, './photos/1_0.jpg', 1, 5, 0);
INSERT INTO Photo(P_ID, chemin, A_ID, U_ID, num_photo) values (2, './photos/1_1.png', 1, 5, 1);
INSERT INTO Photo(P_ID, chemin, A_ID, U_ID, num_photo) values (3, './photos/2_0.jpg', 2, 2, 0);
INSERT INTO Photo(P_ID, chemin, A_ID, U_ID, num_photo) values (4, './photos/2_1.jpg', 2, 2, 1);
INSERT INTO Photo(P_ID, chemin, A_ID, U_ID, num_photo) values (5, './photos/3_0.jpg', 3, 3, 0);
INSERT INTO Photo(P_ID, chemin, A_ID, U_ID, num_photo) values (6, './photos/3_1.jpg', 3, 3, 1);
INSERT INTO Photo(P_ID, chemin, A_ID, U_ID, num_photo) values (7, './photos/3_2.jpg', 3, 3, 2);
INSERT INTO Photo(P_ID, chemin, A_ID, U_ID, num_photo) values (8, './photos/4_0.jpg', 4, 1, 0);
INSERT INTO Photo(P_ID, chemin, A_ID, U_ID, num_photo) values (9, './photos/4_1.jpg', 4, 1, 1);
INSERT INTO Photo(P_ID, chemin, A_ID, U_ID, num_photo) values (10, './photos/4_2.jpg', 4, 1, 2);
INSERT INTO Photo(P_ID, chemin, A_ID, U_ID, num_photo) values (11, './photos/5_0.jpg', 5, 2, 0);
INSERT INTO Photo(P_ID, chemin, A_ID, U_ID, num_photo) values (12, './photos/5_1.jpg', 5, 2, 1);

INSERT INTO reserve(U_ID, A_ID, statut_res) values (4, 4, 'Accepte');
INSERT INTO reserve(U_ID, A_ID, statut_res) values (3, 1, 'Accepte');

INSERT INTO communiquer(U_ID_recoit, U_ID_envoie, date_envoi, contenu_message) values(3, 2, STR_TO_DATE('30/03/2022 17:12:12', '%d/%c/%Y %H:%i:%S'), "Bonjour, si je réserve ce logement, je veux venir avec mon chien ?");
INSERT INTO communiquer(U_ID_recoit, U_ID_envoie, date_envoi, contenu_message) values(2, 3, STR_TO_DATE('30/03/2022 17:14:45', '%d/%c/%Y %H:%i:%S'), "Bonjour. Cela dépend, est-ce un gros chien ou un petit chien ? Cordialement.");
INSERT INTO communiquer(U_ID_recoit, U_ID_envoie, date_envoi, contenu_message) values(3, 2, STR_TO_DATE('30/03/2022 17:41:23', '%d/%c/%Y %H:%i:%S'), "C'est un berger australien");
INSERT INTO communiquer(U_ID_recoit, U_ID_envoie, date_envoi, contenu_message) values(2, 3, STR_TO_DATE('30/03/2022 17:45:54', '%d/%c/%Y %H:%i:%S'), "Malheureusement, ça me parait compliqué, je préférerais éviter");
INSERT INTO communiquer(U_ID_recoit, U_ID_envoie, date_envoi, contenu_message) values(3, 2, STR_TO_DATE('30/03/2022 18:30:33', '%d/%c/%Y %H:%i:%S'), "Ok");
INSERT INTO communiquer(U_ID_recoit, U_ID_envoie, date_envoi, contenu_message) values(1, 4, STR_TO_DATE('18/03/2022 15:34:21', '%d/%c/%Y %H:%i:%S'), "Bonjour, combien de couchages comptent les chambres ? Cordialement.");
INSERT INTO communiquer(U_ID_recoit, U_ID_envoie, date_envoi, contenu_message) values(4, 1, STR_TO_DATE('18/03/2022 19:02:00', '%d/%c/%Y %H:%i:%S'), "Bonsoir, la première chambre comporte un lit double, la seconde deux lits simples.");
INSERT INTO communiquer(U_ID_recoit, U_ID_envoie, date_envoi, contenu_message) values(1, 4, STR_TO_DATE('18/03/2022 19:30:42', '%d/%c/%Y %H:%i:%S'), "D'accord, merci bien.");

INSERT INTO evaluer(U_ID_est_evalue, U_ID_evalue, note, contenu_eval) values(5, 3, 4, "Logement propre, correspondant bien à l'annonce, mais propriétaire un peu désagrable.");
INSERT INTO evaluer(U_ID_est_evalue, U_ID_evalue, note, contenu_eval) values(3, 5, 2, "A rendu le logement sale, a vraisemblablement ramené un animal dans l'appartement sans mon accord au vu de la quantité de poils retrouvés sur le canapé.");