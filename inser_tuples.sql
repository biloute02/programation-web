<<<<<<< HEAD
INSERT INTO Utilisateur(U_ID, email, mdp, pseudo, nom, prenom, date_naissance, date_inscription) values(1, 'jeanmichel72@email.com', '$2y$10$1Ijua.ce5f.YtCol7UN1PeMHElTUkt5sR3ebjTaK5vhOvlj4/WbzC', 'Janmi', 'Dupuis', 'Jean-Michel', TO_DATE('12/05/1972', 'DD/MM/YYYY'), TO_DATE('15/03/2022', 'DD/MM/YYYY'));
INSERT INTO Utilisateur(U_ID, email, mdp, pseudo, nom, prenom, date_naissance, date_inscription) values(2, 'titouan23@email.com', '$2y$10$BuqoZU99eEpLUJCqjW1/OuhChc2AU5YKy5JxfQCZ11m.QvfdBbLfC', 'Titouandu23', 'Bozac', 'Titouan', TO_DATE('29/02/2000', 'DD/MM/YYYY'), TO_DATE('13/12/2020', 'DD/MM/YYYY'));
INSERT INTO Utilisateur(U_ID, email, mdp, pseudo, nom, prenom, date_naissance, date_inscription) values(3, 'germain.dupont@mail.fr', '$2y$10$evGtWbnyekrRqp/swb9ORu.4gaSIJKz9o16rSXLHYv9JFo36sDbmG', 'Germain', 'Dupont', 'Germain', TO_DATE('30/07/1959', 'DD/MM/YYYY'), TO_DATE('23/04/2021', 'DD/MM/YYYY'));
INSERT INTO Utilisateur(U_ID, email, mdp, pseudo, nom, prenom, date_naissance, date_inscription) values(4, 'tristanb@email.fr', '$2y$10$MtqB3yKNgahKmNSxJOg8D./TssnKPRR70Lleoa.m./zZA/g16GEdG', 'Tristoune', 'Boulanger', 'Tristan', TO_DATE('25/09/1995', 'DD/MM/YYYY'), TO_DATE('19/01/2022', 'DD/MM/YYYY'));
INSERT INTO Utilisateur(U_ID, email, mdp, pseudo, nom, prenom, date_naissance, date_inscription) values(5, 'marlene.delafaille@email.fr', '$2y$10$s.sNfn9cnlWKNddyTymzA.4eYjrVVnvxPiMbndQQsmqf0Ws4l.aJG', 'Marlène', 'De Lafaille', 'Marlène', TO_DATE('14/11/1979', 'DD/MM/YYYY'), TO_DATE('05/03/2022', 'DD/MM/YYYY'));

INSERT INTO Photo(P_ID, chemin) values (1, './photos/appart_marlene_salon.jpg');
INSERT INTO Photo(P_ID, chemin) values (2, './photos/facade_appart_marlene.png');
INSERT INTO Photo(P_ID, chemin) values (3, './photos/appart_lyon_salon.jpg');
INSERT INTO Photo(P_ID, chemin) values (4, './photos/appart_lyon_cuisine.jpeg');
INSERT INTO Photo(P_ID, chemin) values (5, './photos/immeuble_lyon.jpg');
INSERT INTO Photo(P_ID, chemin) values (6, './photos/amiens_salon.jpeg');
INSERT INTO Photo(P_ID, chemin) values (7, './photos/amiens_chambre.jpg');
INSERT INTO Photo(P_ID, chemin) values (8, './photos/maison_amiens.jpg');
INSERT INTO Photo(P_ID, chemin) values (9, './photos/maison_creuse.jpg');
INSERT INTO Photo(P_ID, chemin) values (10, './photos/salon_creuse.jpg');

INSERT INTO Annonce(A_ID, statut, type_logement, date_deb, date_fin, adresse, ville, cp, pays, contenu_annonce, prix, surface, nb_pieces) values(1, 'passée', 'appartement', TO_DATE('05/07/2021', 'DD/MM/YYYY'), TO_DATE('31/07/2021', 'DD/MM/YYYY'), '8 boulevard Dumas', 'Paris', '75016', 'France', "Charmant appartement haussmanien en plein coeur du 16ème arrondissement de Paris, idéal pour découvrir la ville. Situé au troisième étage avec ascenseur, l’appartement est calme et lumineux.
Possibilité d’accueillir jusqu’à 6 personnes grâce aux 2 chambres équipées de lits doubles et au canapé-lit dans la salle de séjour. 
Cuisine équipée, télévision et WiFi à disposition, tout est prévu pour que vous passiez un séjour idéal.
Animaux non autorisés.", 70, 90, 3);
INSERT INTO Annonce(A_ID, statut, type_logement, date_deb, date_fin, adresse, ville, cp, pays, contenu_annonce, prix, surface, nb_pieces) values(2, 'en cours', 'maison', TO_DATE('16/04/2022', 'DD/MM/YYYY'), TO_DATE('30/04/2022', 'DD/MM/YYYY'), '23 rue des Crocs', 'Saint-Pardoux-Morterolles', '23227', 'France', "Maison de campagne familiale. 4 chambres, 6 couchages (3 lits doubles, 1 lit superposé), 2 salles de bain. Terrain de 1 hectare. Animaux autorisés.", 50, 120, 5);
INSERT INTO Annonce(A_ID, statut, type_logement, date_deb, date_fin, adresse, ville, cp, pays, contenu_annonce, prix, surface, nb_pieces) values(3, 'en cours', 'appartement', TO_DATE('04/06/2022', 'DD/MM/YYYY'), TO_DATE('25/06/2022', 'DD/MM/YYYY'), '2 rue de la Fourchette', 'Lyon', '69000', 'France', "Petit appartement 2 pièces avec cuisine ouverte. WC séparés.
Proche centre-ville, quartier animé, transports à proximité.", 50, 50, 2);
INSERT INTO Annonce(A_ID, statut, type_logement, date_deb, date_fin, adresse, ville, cp, pays, contenu_annonce, prix, surface, nb_pieces) values(4, 'réservée', 'maison', TO_DATE('06/08/2022', 'DD/MM/YYYY'), TO_DATE('13/08/2022', 'DD/MM/YYYY'), '14 avenue du Pré', 'Amiens', '80000', 'France', "Maison amiénoise rénovée récemment, proche du centre-ville. 2 chambres, 1 salle de bain. Petit jardin à l’arrière.", 40, 90, 3);
INSERT INTO Annonce(A_ID, statut, type_logement, date_deb, date_fin, adresse, ville, cp, pays, contenu_annonce, prix, surface, nb_pieces) values(5, 'en cours', 'maison', TO_DATE('14/05/2022', 'DD/MM/YYYY'), TO_DATE('28/05/2022', 'DD/MM/YYYY'), '23 rue des Crocs', 'Saint-Pardoux-Morterolles', '23227', 'France', "Maison de campagne familiale. 4 chambres, 6 couchages (3 lits doubles, 1 lit superposé), 2 salles de bain. Terrain de 1 hectare. Animaux autorisés.", 40, 120, 5);

INSERT INTO poste(U_ID, A_ID, date_post) values(5, 1, TO_DATE('13/04/2021', 'DD/MM/YYYY'));
INSERT INTO poste(U_ID, A_ID, date_post) values(2, 2, TO_DATE('12/02/2022', 'DD/MM/YYYY'));
INSERT INTO poste(U_ID, A_ID, date_post) values(3, 3, TO_DATE('27/03/2022', 'DD/MM/YYYY'));
INSERT INTO poste(U_ID, A_ID, date_post) values(1, 4, TO_DATE('18/03/2022', 'DD/MM/YYYY'));
INSERT INTO poste(U_ID, A_ID, date_post) values(2, 5, TO_DATE('12/02/2022', 'DD/MM/YYYY'));
=======
INSERT INTO Utilisateur(U_ID, email, mdp, pseudo, nom, prenom, date_naissance, date_inscription) values(1, 'jeanmichel72@email.com', '$2y$10$1Ijua.ce5f.YtCol7UN1PeMHElTUkt5sR3ebjTaK5vhOvlj4/WbzC', 'Janmi', 'Dupuis', 'Jean-Michel', STR_TO_DATE('12/05/1972', '%d/%c/%Y'), STR_TO_DATE('15/03/2022', '%d/%c/%Y'));
INSERT INTO Utilisateur(U_ID, email, mdp, pseudo, nom, prenom, date_naissance, date_inscription) values(2, 'titouan23@email.com', '$2y$10$BuqoZU99eEpLUJCqjW1/OuhChc2AU5YKy5JxfQCZ11m.QvfdBbLfC', 'Titouandu23', 'Bozac', 'Titouan', STR_TO_DATE('29/02/2000', '%d/%c/%Y'), STR_TO_DATE('13/12/2020', '%d/%c/%Y'));
INSERT INTO Utilisateur(U_ID, email, mdp, pseudo, nom, prenom, date_naissance, date_inscription) values(3, 'germain.dupont@mail.fr', '$2y$10$evGtWbnyekrRqp/swb9ORu.4gaSIJKz9o16rSXLHYv9JFo36sDbmG', 'Germain', 'Dupont', 'Germain', STR_TO_DATE('30/07/1959', '%d/%c/%Y'), STR_TO_DATE('23/04/2021', '%d/%c/%Y'));
INSERT INTO Utilisateur(U_ID, email, mdp, pseudo, nom, prenom, date_naissance, date_inscription) values(4, 'tristanb@email.fr', '$2y$10$MtqB3yKNgahKmNSxJOg8D./TssnKPRR70Lleoa.m./zZA/g16GEdG', 'Tristoune', 'Boulanger', 'Tristan', STR_TO_DATE('25/09/1995', '%d/%c/%Y'), STR_TO_DATE('19/01/2022', '%d/%c/%Y'));
INSERT INTO Utilisateur(U_ID, email, mdp, pseudo, nom, prenom, date_naissance, date_inscription) values(5, 'marlene.delafaille@email.fr', '$2y$10$s.sNfn9cnlWKNddyTymzA.4eYjrVVnvxPiMbndQQsmqf0Ws4l.aJG', 'Marlène', 'De Lafaille', 'Marlène', STR_TO_DATE('14/11/1979', '%d/%c/%Y'), STR_TO_DATE('05/03/2022', '%d/%c/%Y'));

INSERT INTO Photo(P_ID, chemin, U_ID) values (1, './photos/appart_marlene_salon.jpg', 5);
INSERT INTO Photo(P_ID, chemin, U_ID) values (2, './photos/facade_appart_marlene.png', 5);
INSERT INTO Photo(P_ID, chemin, U_ID) values (3, './photos/appart_lyon_salon.jpg', 3);
INSERT INTO Photo(P_ID, chemin, U_ID) values (4, './photos/appart_lyon_cuisine.jpeg', 3);
INSERT INTO Photo(P_ID, chemin, U_ID) values (5, './photos/immeuble_lyon.jpg', 3);
INSERT INTO Photo(P_ID, chemin, U_ID) values (6, './photos/amiens_salon.jpeg', 1);
INSERT INTO Photo(P_ID, chemin, U_ID) values (7, './photos/amiens_chambre.jpg', 1);
INSERT INTO Photo(P_ID, chemin, U_ID) values (8, './photos/maison_amiens.jpg', 1);
INSERT INTO Photo(P_ID, chemin, U_ID) values (9, './photos/maison_creuse.jpg', 2);
INSERT INTO Photo(P_ID, chemin, U_ID) values (10, './photos/salon_creuse.jpg', 2);

INSERT INTO Annonce(A_ID, statut, type_logement, date_deb, date_fin, date_post, adresse, ville, cp, pays, contenu_annonce, prix, surface, nb_pieces, U_ID) values(1, 0, 'appartement', STR_TO_DATE('05/07/2021', '%d/%c/%Y'), STR_TO_DATE('31/07/2021', '%d/%c/%Y'), STR_TO_DATE('13/04/2021', '%d/%c/%Y'), '8 boulevard Dumas', 'Paris', '75016', 'France', "Charmant appartement haussmanien en plein coeur du 16&zgrave;me arrondissement de Paris, idéal pour d&eacute;couvrir la ville. Situ&eacute; au troisième &eacute;tage avec ascenseur, l’appartement est calme et lumineux.
Possibilit&eacute; d’accueillir jusqu’&agrave; 6 personnes gr&acirc;ce aux 2 chambres &eacute;quip&eacute;es de lits doubles et au canap&eacute;-lit dans la salle de s&eacute;jour.

Cuisine &eacute;quip&eacute;e, t&eacute;l&eacute;vision et wifi &agrave; disposition, tout est pr&eacute;vu pour que vous passiez un s&eacute;jour id&eacute;al.

Animaux non autoris&eacute;s.", 70, 90, 3, 5);
INSERT INTO Annonce(A_ID, statut, type_logement, date_deb, date_fin, date_post, adresse, ville, cp, pays, contenu_annonce, prix, surface, nb_pieces, U_ID) values(2, 1, 'maison', STR_TO_DATE('16/04/2022', '%d/%c/%Y'), STR_TO_DATE('30/04/2022', '%d/%c/%Y'), STR_TO_DATE('12/02/2022', '%d/%c/%Y'), '23 rue des Crocs', 'Saint-Pardoux-Morterolles', '23227', 'France', "Maison de campagne familiale. 4 chambres, 6 couchages (3 lits doubles, 1 lit superpos&eacute;), 2 salles de bain. Terrain de 1 hectare. Animaux autoris&eacute;s.", 50, 120, 5, 2);
INSERT INTO Annonce(A_ID, statut, type_logement, date_deb, date_fin, date_post, adresse, ville, cp, pays, contenu_annonce, prix, surface, nb_pieces, U_ID) values(3, 1, 'appartement', STR_TO_DATE('04/06/2022', '%d/%c/%Y'), STR_TO_DATE('25/06/2022', '%d/%c/%Y'), STR_TO_DATE('27/03/2022', '%d/%c/%Y'), '2 rue de la Fourchette', 'Lyon', '69000', 'France', "Petit appartement 2 pi&egrave;ces avec cuisine ouverte. WC s&eacute;par&eacute;s.
Proche centre-ville, quartier anim&eacute;, transports &agrave; proximit&eacute;.", 50, 50, 2, 3);
INSERT INTO Annonce(A_ID, statut, type_logement, date_deb, date_fin, date_pos, adresse, ville, cp, pays, contenu_annonce, prix, surface, nb_pieces, U_ID) values(4, 0, 'maison', STR_TO_DATE('06/08/2022', '%d/%c/%Y'), STR_TO_DATE('13/08/2022', '%d/%c/%Y'), STR_TO_DATE('18/03/2022', '%d/%c/%Y'), '14 avenue du Pr&eacute;', 'Amiens', '80000', 'France', "Maison ami&eacute;noise r&eacute;nov&eacute;e r&eacute;cemment, proche du centre-ville. 2 chambres, 1 salle de bain. Petit jardin à l’arri&grave;re.", 40, 90, 3, 1);
INSERT INTO Annonce(A_ID, statut, type_logement, date_deb, date_fin, date_pos, adresse, ville, cp, pays, contenu_annonce, prix, surface, nb_pieces, U_ID) values(5, 1, 'maison', STR_TO_DATE('14/05/2022', '%d/%c/%Y'), STR_TO_DATE('28/05/2022', '%d/%c/%Y'), STR_TO_DATE('12/02/2022', '%d/%c/%Y'), '23 rue des Crocs', 'Saint-Pardoux-Morterolles', '23227', 'France', "Maison de campagne familiale. 4 chambres, 6 couchages (3 lits doubles, 1 lit superpos&eacute;), 2 salles de bain. Terrain de 1 hectare. Animaux autoris&eacute;s.", 40, 120, 5, 2);

INSERT INTO poste(U_ID, A_ID, date_post) values(5, 1, STR_TO_DATE('13/04/2021', '%d/%c/%Y'));
INSERT INTO poste(U_ID, A_ID, date_post) values(2, 2, STR_TO_DATE('12/02/2022', '%d/%c/%Y'));
INSERT INTO poste(U_ID, A_ID, date_post) values(3, 3, STR_TO_DATE('27/03/2022', '%d/%c/%Y'));
INSERT INTO poste(U_ID, A_ID, date_post) values(1, 4, STR_TO_DATE('18/03/2022', '%d/%c/%Y'));
INSERT INTO poste(U_ID, A_ID, date_post) values(2, 5, STR_TO_DATE('12/02/2022', '%d/%c/%Y'));
>>>>>>> 3c65cc1a521c105a42b8cc4c8c0dc6aa615aaca4

INSERT INTO illustre(P_ID, A_ID, num_photo) values(1, 1, 1);
INSERT INTO illustre(P_ID, A_ID, num_photo) values(2, 1, 2);
INSERT INTO illustre(P_ID, A_ID, num_photo) values(3, 3, 1);
INSERT INTO illustre(P_ID, A_ID, num_photo) values(4, 3, 2);
INSERT INTO illustre(P_ID, A_ID, num_photo) values(5, 3, 3);
INSERT INTO illustre(P_ID, A_ID, num_photo) values(6, 4, 1);
INSERT INTO illustre(P_ID, A_ID, num_photo) values(7, 4, 2);
INSERT INTO illustre(P_ID, A_ID, num_photo) values(8, 4, 3);
INSERT INTO illustre(P_ID, A_ID, num_photo) values(9, 2, 1);
INSERT INTO illustre(P_ID, A_ID, num_photo) values(10, 2, 2);
INSERT INTO illustre(P_ID, A_ID, num_photo) values(10, 5, 1);
INSERT INTO illustre(P_ID, A_ID, num_photo) values(9, 5, 2);

INSERT INTO reserve(U_ID, A_ID, statut_res) values (4, 4, 'ACCEPTEE');
INSERT INTO reserve(U_ID, A_ID, statut_res) values (3, 1, 'ACCEPTEE');

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
