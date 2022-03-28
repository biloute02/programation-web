CREATE TABLE Utilisateur (
    U_ID int AUTO_INCREMENT,
    email varchar(30) NOT NULL,
    mdp varchar(30) NOT NULL,
    pseudo varchar(15) NOT NULL,
    nom varchar(50),
    prenom varchar(50),
    date_naissance DATE,
    date_inscription DATE,
    PRIMARY KEY(U_ID),
    UNIQUE(email)
);

CREATE TABLE Photo (
    P_ID char(15),
    path char(100),
    U_ID int NOT NULL,
    FOREIGN KEY(U_ID) REFERENCES Utilisateur(U_ID),
    PRIMARY KEY(P_ID)
);

CREATE TABLE Annonce(
    A_ID char(15),
    statut VARCHAR(15),
    type_logement VARCHAR(20),
    date_deb DATE,
    date_fin DATE,
    adresse VARCHAR(50),
    ville VARCHAR(50),
    cp CHAR(5),
    pays VARCHAR(50),
    prix DECIMAL(6,2),
    surface INT,
    nb_pieces INT,
    PRIMARY KEY(A_ID)
);


CREATE TABLE reserve(
    U_ID int,
    A_ID CHAR(50),
    statut_res VARCHAR(15),
    PRIMARY KEY(U_ID, A_ID),
    FOREIGN KEY(U_ID) REFERENCES Utilisateur(U_ID),
    FOREIGN KEY(A_ID) REFERENCES Annonce(A_ID)
);

CREATE TABLE poste(
    U_ID int,
    A_ID CHAR(15),
    date_post DATE,
    FOREIGN KEY(U_ID) REFERENCES Utilisateur(U_ID),
    FOREIGN KEY(A_ID) REFERENCES Annonce(A_ID),
    PRIMARY KEY(U_ID, A_ID)
);

CREATE TABLE illustre(
    P_ID CHAR(15),
    A_ID CHAR(15),
    FOREIGN KEY(P_ID) REFERENCES Photo(P_ID),
    FOREIGN KEY(A_ID) REFERENCES Annonce(A_ID),
    PRIMARY KEY(P_ID, A_ID)
);

CREATE TABLE communiquer(
    U_ID_recoit int,
    U_ID_envoie int,
    date_envoi DATE,
    contenu_message VARCHAR(250),
    FOREIGN KEY(U_ID_recoit) REFERENCES Utilisateur(U_ID),
    FOREIGN KEY(U_ID_envoie) REFERENCES Utilisateur(U_ID),
    PRIMARY KEY(U_ID_recoit, U_ID_envoie, date_envoi)
);

CREATE TABLE evaluer(
    U_ID_est_evalue int,
    U_ID_evalue int,
    note INT,
    contenu_eval VARCHAR(300),
    FOREIGN KEY(U_ID_est_evalue) REFERENCES Utilisateur(U_ID),
    FOREIGN KEY(U_ID_evalue) REFERENCES Utilisateur(U_ID),
    PRIMARY KEY(U_ID_est_evalue, U_ID_evalue)
);
