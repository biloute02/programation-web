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

CREATE TABLE Photo (
    P_ID int AUTO_INCREMENT,
    chemin varchar(100),
    U_ID int NOT NULL,
    FOREIGN KEY(U_ID) REFERENCES Utilisateur(U_ID),
    PRIMARY KEY(P_ID)
);

CREATE TABLE Annonce(
<<<<<<< HEAD
    A_ID INT AUTO_INCREMENT,
    U_ID INT,
    statut VARCHAR(15),
    type_logement VARCHAR(20),
    date_deb DATE,
    date_fin DATE,
    date_post DATETIME,
=======
    A_ID int AUTO_INCREMENT,
    statut int,
    type_logement VARCHAR(20),
    date_deb DATE,
    date_fin DATE,
    date_post DATE,
>>>>>>> 3c65cc1a521c105a42b8cc4c8c0dc6aa615aaca4
    adresse VARCHAR(50),
    ville VARCHAR(50),
    cp CHAR(5),
    pays VARCHAR(50),
    contenu_annonce TEXT,
    prix DECIMAL(6,2),
    surface INT,
    nb_pieces INT,
<<<<<<< HEAD
    PRIMARY KEY(A_ID, U_ID)
=======
    U_ID int NOT NULL,
    FOREIGN KEY(U_ID) REFERENCES Utilisateur(U_ID),
    PRIMARY KEY(A_ID)
>>>>>>> 3c65cc1a521c105a42b8cc4c8c0dc6aa615aaca4
);

CREATE TABLE reserve(
    U_ID int,
    A_ID int,
    statut_res VARCHAR(15),
    PRIMARY KEY(U_ID, A_ID),
    FOREIGN KEY(U_ID) REFERENCES Utilisateur(U_ID),
    FOREIGN KEY(A_ID) REFERENCES Annonce(A_ID)
);

CREATE TABLE illustre(
    P_ID int,
    A_ID int,
    num_photo int,
    FOREIGN KEY(P_ID) REFERENCES Photo(P_ID),
    FOREIGN KEY(A_ID) REFERENCES Annonce(A_ID),
    PRIMARY KEY(P_ID, A_ID)
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
