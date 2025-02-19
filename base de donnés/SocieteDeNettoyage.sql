DROP DATABASE IF EXISTS GestionSocieteNettoyage;
CREATE DATABASE IF NOT EXISTS GestionSocieteNettoyage;

USE GestionSocieteNettoyage;

-- Table Service
CREATE TABLE IF NOT EXISTS Service (
    CodeS INT AUTO_INCREMENT PRIMARY KEY,
    NomS VARCHAR(255),
    TarifHr DECIMAL(10, 2),
    Duree INT,
    Description TEXT,
    TypeS ENUM('Nettoyage Résidentiel', 'Nettoyage Commercial', 'Nettoyage Industriel', 'Autres Services')
);

CREATE TABLE IF NOT EXISTS roles (
    numR INT AUTO_INCREMENT PRIMARY KEY,
    nomR VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    telephone VARCHAR(20),
    adresse VARCHAR(255),
    login VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    TypeCompte ENUM('Admin', 'RRH', 'GI', 'Employe', 'Client') NOT NULL,
    etat TINYINT(1) NOT NULL DEFAULT 1 -- 1 pour activé, 0 pour désactivé
);

CREATE TABLE IF NOT EXISTS personnel_administratif (
    id INT PRIMARY KEY,
    date_embauche DATE,
    role INT NOT NULL,
    FOREIGN KEY (id) REFERENCES users(id),
    FOREIGN KEY (role) REFERENCES roles(numR)
);

CREATE TABLE IF NOT EXISTS Client (
    id INT PRIMARY KEY,
    date_inscription DATE,
    type_client ENUM('Particulier', 'Entreprise') NOT NULL,
    FOREIGN KEY (id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS commentaire (
    CodeC INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT NOT NULL,
    contenu TEXT NOT NULL,
    note INT CHECK (note >= 1 AND note <= 5),
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_mise_a_jour TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES Client(id)
);

CREATE TABLE IF NOT EXISTS employe (
    id INT PRIMARY KEY,
    date_embauche DATE,
    statut ENUM('Actif', 'Congé', 'Maladie', 'Maternité/Paternité', 'Démissionnaire', 'Licencié') NOT NULL DEFAULT 'Actif',
    salaire DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (id) REFERENCES users(id)
);

-- Créer la table competence
CREATE TABLE IF NOT EXISTS competence (
    codeCp INT AUTO_INCREMENT PRIMARY KEY,
    nomCp VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS employe_competence (
    employe_id INT,
    competence_id INT,
    PRIMARY KEY (employe_id, competence_id),
    FOREIGN KEY (employe_id) REFERENCES employe(id),
    FOREIGN KEY (competence_id) REFERENCES competence(codeCp)
);

CREATE TABLE reservation (
    codeR INT AUTO_INCREMENT PRIMARY KEY,
    date_reservation DATE NOT NULL,
    date_prestation DATE NOT NULL,
    heure_prestation TIME NOT NULL,
    adresse_prestation VARCHAR(255) NOT NULL,
    montant DECIMAL(10, 2) NOT NULL,
    etat ENUM('traité', 'pas encore traité') DEFAULT 'pas encore traité',
    client_id INT,
    FOREIGN KEY (client_id) REFERENCES Client(id)
);

CREATE TABLE intervention (
    numI INT AUTO_INCREMENT PRIMARY KEY,
    etat ENUM('pas encore faite', 'faite payé', 'faite non payé') DEFAULT 'pas encore faite',
    codeR INT,
    id_c INT,
    FOREIGN KEY (codeR) REFERENCES reservation(codeR),
    FOREIGN KEY (id_c) REFERENCES contrat(id_c)
);

CREATE TABLE materiel (
    codeM INT AUTO_INCREMENT PRIMARY KEY,
    nomM VARCHAR(255) NOT NULL,
    type ENUM('électronique', 'mécanique', 'nettoyage', 'autre') NOT NULL,
    etat ENUM('neuf', 'bon', 'usagé', 'hors service') NOT NULL,
    quantite INT NOT NULL
);

CREATE TABLE IF NOT EXISTS detailResSER (
    codeR INT,
    CodeS INT,
    nbr_hr INT NOT NULL,
    instructions_speciales TEXT,
    PRIMARY KEY (codeR, CodeS),
    FOREIGN KEY (codeR) REFERENCES reservation(codeR) ON DELETE CASCADE,
    FOREIGN KEY (CodeS) REFERENCES Service(CodeS) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS materiel_intervention (
    intervention_id INT,
    materiel_id INT,
    quantite_utilisee INT NOT NULL,
    PRIMARY KEY (intervention_id, materiel_id),
    CodeS INT,
    FOREIGN KEY (CodeS) REFERENCES Service(CodeS) ON DELETE CASCADE,
    FOREIGN KEY (intervention_id) REFERENCES intervention(numI) ON DELETE CASCADE,
    FOREIGN KEY (materiel_id) REFERENCES materiel(codeM) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS employe_intervention (
    intervention_id INT,
    employe_id INT,
    CodeS INT,
    tache VARCHAR(255) NOT NULL,
    PRIMARY KEY (intervention_id, employe_id),
    FOREIGN KEY (CodeS) REFERENCES Service(CodeS) ON DELETE CASCADE,
    FOREIGN KEY (intervention_id) REFERENCES intervention(numI) ON DELETE CASCADE,
    FOREIGN KEY (employe_id) REFERENCES employe(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS ArretDeTravail (
    NumA INT AUTO_INCREMENT PRIMARY KEY,
    Type ENUM('Congé', 'Maladie', 'Maternité/Paternité', 'demission') NOT NULL,
    Date_deb DATE NOT NULL,
    Date_fin DATE ,
    Description TEXT,
    statut ENUM('accordé', 'refusé', 'pas encore traité') DEFAULT 'pas encore traité',
    id INT,
    FOREIGN KEY (id) REFERENCES employe(id) ON DELETE CASCADE
);

CREATE TABLE offre_demploi (
    idoff INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    type_contrat VARCHAR(50) NOT NULL CHECK (type_contrat IN ('CDD', 'CDI', 'Stage')),
    date_debut DATE NOT NULL,
    date_fin DATE,
    competences_requises TEXT NOT NULL,
    CHECK ((type_contrat = 'CDI' AND date_fin IS NULL) OR (type_contrat IN ('CDD', 'Stage') AND date_fin IS NOT NULL))
);
CREATE TABLE IF NOT EXISTS candidature (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    age INT NOT NULL,
    experience TEXT NOT NULL,
    education TEXT NOT NULL,
    offre_id INT,
    FOREIGN KEY (offre_id) REFERENCES offre_demploi(idoff)
);
-- Table contrat
CREATE TABLE IF NOT EXISTS contrat (
    id_c INT AUTO_INCREMENT PRIMARY KEY,
    date_deb DATE NOT NULL,
    date_fin DATE NOT NULL,
    montantc DECIMAL(10, 2),
    etat ENUM('actif','refusé', 'résilié', 'terminé', 'en attente de preparation','en attente de confirmation') NOT NULL DEFAULT 'en attente de confirmation',
    detailc TEXT NOT NULL,
    client_id INT NOT NULL,
    FOREIGN KEY (client_id) REFERENCES Client(id)
);

CREATE TABLE IF NOT EXISTS ServiceDansContrat (
    CodeS INT,
    id_c INT,
    detailsSer TEXT,
    intervention_id INT DEFAULT NULL,
    frequence  ENUM('tout les jours', 'une fois par semaine', 'une fois par mois', 'une fois chaque 3 mois') NOT NULL,
    PRIMARY KEY (CodeS, id_c),
    FOREIGN KEY (CodeS) REFERENCES Service(CodeS) ON DELETE CASCADE,
    FOREIGN KEY (intervention_id) REFERENCES intervention(numI) ,
    FOREIGN KEY (id_c) REFERENCES contrat(id_c) ON DELETE CASCADE
);
CREATE TABLE IF NOT EXISTS DatePaiment(
id_d INT AUTO_INCREMENT PRIMARY KEY,
date DATE 
);

CREATE TABLE IF NOT EXISTS paiement (
    id_p INT AUTO_INCREMENT PRIMARY KEY,
    date_paiement INT NOT NULL,
    montant DECIMAL(10, 2) NOT NULL,
    etat_paiement ENUM('payé', 'en retard', 'en attente') NOT NULL DEFAULT 'en attente',
    contrat_id INT NOT NULL,
    FOREIGN KEY (contrat_id) REFERENCES contrat(id_c),
    FOREIGN KEY (date_paiement) REFERENCES DatePaiment(id_d)
);


-- Insérer les rôles dans la table roles
INSERT INTO roles (nomR) VALUES ('Responsable RH'), ('Gestionnaire d\'Interventions');

-- Insérer un utilisateur pour le Responsable RH
INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, TypeCompte, etat)
VALUES ('Ales', 'chmesedinne', 'jean.dupont@example.com', '0123456789', '123 Rue Example', 'rhh', '123', 'RRH', 1);

-- Récupérer l'id de l'utilisateur nouvellement inséré pour le Responsable RH
SET @user_id_rh = LAST_INSERT_ID();

-- Insérer dans personnel_administratif pour le Responsable RH
INSERT INTO personnel_administratif (id, date_embauche, role)
VALUES (@user_id_rh, '2020-01-01', (SELECT numR FROM roles WHERE nomR='Responsable RH'));

-- Insérer un utilisateur pour le Gestionnaire d'Interventions
INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, TypeCompte, etat)
VALUES ('Martin', 'Sophie', 'sophie.martin@example.com', '0987654321', '456 Rue Example', 'gi', '123', 'GI', 1);

-- Récupérer l'id de l'utilisateur nouvellement inséré pour le Gestionnaire d'Interventions
SET @user_id_gi = LAST_INSERT_ID();

-- Insérer dans personnel_administratif pour le Gestionnaire d'Interventions
INSERT INTO personnel_administratif (id, date_embauche, role)
VALUES (@user_id_gi, '2021-06-15', (SELECT numR FROM roles WHERE nomR='Gestionnaire d\'Interventions'));

-- Insertion des services
-- Pour le nettoyage résidentiel
INSERT INTO Service (NomS, TarifHr, Duree, Description, TypeS) 
VALUES 
('Nettoyage complet de la maison', 25.00, 3, 'Nettoyage complet des espaces de vie, y compris le dépoussiérage, l''aspiration, le nettoyage des sols, le nettoyage des surfaces, etc.', 'Nettoyage Résidentiel'),
('Nettoyage de vitres', 35.00, 2, 'Nettoyage des fenêtres intérieures et extérieures, des portes vitrées et des miroirs.', 'Nettoyage Résidentiel'),
-- Pour le nettoyage commercial
('Entretien de bureaux', 30.00, 2, 'Nettoyage quotidien ou hebdomadaire des bureaux, des espaces communs, des halls d''entrée, des escaliers, etc.', 'Nettoyage Commercial'),
('Nettoyage de restaurants', 45.00, 3, 'Nettoyage des salles à manger, des cuisines, des zones de préparation alimentaire, des bars, etc.', 'Nettoyage Commercial'),
-- Pour le nettoyage industriel
('Nettoyage de sites de construction', 40.00, 4, 'Nettoyage des débris, de la poussière, de la saleté et de tout autre résidu après la construction ou la rénovation.', 'Nettoyage Industriel'),
('Nettoyage d\'entrepôts', 50.00, 4, 'Nettoyage des sols, des équipements, des machines, des zones de stockage, etc.', 'Nettoyage Industriel'),
-- Pour les autres services
('Nettoyage de véhicules', 20.00, 1, 'Nettoyage intérieur et extérieur de voitures, camions, autobus, etc.', 'Autres Services'),
('Nettoyage après sinistre', 60.00, 5, 'Nettoyage des dégâts causés par les incendies, les inondations, les tempêtes, etc.', 'Autres Services');

-- Insérer 10 utilisateurs pour les clients
INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, TypeCompte, etat)
VALUES 
('Safa', 'Imad', 'alice.bernard@example.com', '0123456789', '123 Rue Exemple', 'imad2', '123', 'Client', 1);

SET @user_id_1 = LAST_INSERT_ID();

INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, TypeCompte, etat)
VALUES 
('Aourane', 'Lyna', 'charles.durand@example.com', '0123456789', '456 Rue Exemple', 'cdurand', 'hashed_password2', 'Client', 1);

SET @user_id_2 = LAST_INSERT_ID();

INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, TypeCompte, etat)
VALUES 
('Zdadka', 'Hakim', 'david.petit@example.com', '0123456789', '789 Rue Exemple', 'dpetit', 'hashed_password3', 'Client', 1);

SET @user_id_3 = LAST_INSERT_ID();

-- Insertion des utilisateurs pour les clients (suite)
INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, TypeCompte, etat)
VALUES 
('Benfares', 'sarra', 'emma.moreau@example.com', '0123456789', '101 Rue Exemple', 'emoreau', 'hashed_password4', 'Client', 1);

SET @user_id_4 = LAST_INSERT_ID();

INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, TypeCompte, etat)
VALUES 
('Larbaoui', 'Amine', 'fabien.roux@example.com', '0123456789', '102 Rue Exemple', 'froux', 'hashed_password5', 'Client', 1);

SET @user_id_5 = LAST_INSERT_ID();

INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, TypeCompte, etat)
VALUES 
('Aksouh', 'Anis', 'georges.simon@example.com', '0123456789', '103 Rue Exemple', 'gsimon', 'hashed_password6', 'Client', 1);

SET @user_id_6 = LAST_INSERT_ID();

INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, TypeCompte, etat)
VALUES 
('Harzallah', 'Serine', 'helene.laurent@example.com', '0123456789', '104 Rue Exemple', 'hlaurent', 'hashed_password7', 'Client', 1);

SET @user_id_7 = LAST_INSERT_ID();

INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, TypeCompte, etat)
VALUES 
('Hachemi', 'Rahima', 'isabelle.lefevre@example.com', '0123456789', '105 Rue Exemple', 'ilefevre', 'hashed_password8', 'Client', 1);

SET @user_id_8 = LAST_INSERT_ID();

INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, TypeCompte, etat)
VALUES 
('Semati', 'Mehdi', 'jacques.blanc@example.com', '0123456789', '106 Rue Exemple', 'jblanc', 'hashed_password9', 'Client', 1);

SET @user_id_9 = LAST_INSERT_ID();

INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, TypeCompte, etat)
VALUES 
('Garnier', 'Katy', 'katy.garnier@example.com', '0123456789', '107 Rue Exemple', 'kgarnier', 'hashed_password10', 'Client', 1);

SET @user_id_10 = LAST_INSERT_ID();

-- Insérer dans clients pour les 10 utilisateurs nouvellement insérés
INSERT INTO Client (id, date_inscription, type_client)
VALUES 
(@user_id_1, '2023-01-01', 'Particulier'),
(@user_id_2, '2023-01-02', 'Entreprise'),
(@user_id_3, '2023-01-03', 'Particulier'),
(@user_id_4, '2023-01-04', 'Entreprise'),
(@user_id_5, '2023-01-05', 'Particulier'),
(@user_id_6, '2023-01-06', 'Entreprise'),
(@user_id_7, '2023-01-07', 'Particulier'),
(@user_id_8, '2023-01-08', 'Entreprise'),
(@user_id_9, '2023-01-09', 'Particulier'),
(@user_id_10, '2023-01-10', 'Entreprise');

-- Insertion de 10 commentaires
INSERT INTO commentaire (client_id, contenu, note) VALUES
(1, 'Excellent service, très satisfait.', 5),
(2, 'Le nettoyage était correct, mais pourrait être amélioré.', 3),
(3, 'Très professionnel et ponctuel.', 4),
(4, 'Pas satisfait du service fourni.', 2),
(5, 'Service impeccable, rien à redire.', 5),
(6, 'Le personnel était très courtois.', 4),
(7, 'Le travail a été fait rapidement et efficacement.', 5),
(8, 'Mauvaise expérience, je ne recommanderais pas.', 1),
(9, 'Bon rapport qualité-prix.', 4),
(10, 'Le nettoyage n\'était pas à la hauteur de mes attentes.', 2);

-- Insérer 20 utilisateurs pour les employés
INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, TypeCompte, etat) VALUES
('Imad', 'safa', 'barthelemy.vannier@example.com', '0123456789', '21 Rue Example', 'imad', '123', 'Employe', 1),
('Maurice', 'Jacob', 'jacob.maurice@example.com', '0123456790', '22 Rue Example', 'test1', '123', 'Employe', 1),
('Levett', 'Camille', 'camille.levett@example.com', '0123456791', '23 Rue Example', 'test2', '123', 'Employe', 1),
('bouakaz', 'anais', 'omer.ponce@example.com', '0123456792', '24 Rue Example', 'anais', '123', 'Employe', 1),
('Duchamp', 'Antoine', 'antoine.duchamp@example.com', '0123456793', '25 Rue Example', 'aduchamp', 'hashed_password25', 'Employe', 1),
('Loupe', 'Gérôme', 'gerome.loupe@example.com', '0123456794', '26 Rue Example', 'gloupe', 'hashed_password26', 'Employe', 1),
('Bourguignon', 'Gilles', 'gilles.bourguignon@example.com', '0123456795', '27 Rue Example', 'gbourguignon', 'hashed_password27', 'Employe', 1),
('Haillet', 'Félix', 'felix.haillet@example.com', '0123456796', '28 Rue Example', 'fhaillet', 'hashed_password28', 'Employe', 1),
('Trintignant', 'Pierre-Louis', 'pierre-louis.trintignant@example.com', '0123456797', '29 Rue Example', 'pltrintignant', 'hashed_password29', 'Employe', 1),
('Delacroix', 'Maximilien', 'maximilien.delacroix@example.com', '0123456798', '30 Rue Example', 'mdelacroix', 'hashed_password30', 'Employe', 1),
('meftouh', 'yasmine', 'chloe.heroux@example.com', '0123456799', '31 Rue Example', 'yasmine', '123', 'Employe', 1),
('Bougie', 'Camille', 'camille.bougie@example.com', '0123456800', '32 Rue Example', 'cbougie', 'hashed_password32', 'Employe', 1),
('Botrel', 'Sylvia', 'sylvia.botrel@example.com', '0123456801', '33 Rue Example', 'sbotrel', 'hashed_password33', 'Employe', 1),
('Trouvé', 'Laure', 'laure.trouve@example.com', '0123456802', '34 Rue Example', 'ltrouve', 'hashed_password34', 'Employe', 1),
('Barnier', 'Ange', 'ange.barnier@example.com', '0123456803', '35 Rue Example', 'abarnier', 'hashed_password35', 'Employe', 1),
('Picard', 'Odile', 'odile.picard@example.com', '0123456804', '36 Rue Example', 'opicard', 'hashed_password36', 'Employe', 1),
('Bullion', 'Barbe', 'barbe.bullion@example.com', '0123456805', '37 Rue Example', 'bbullion', 'hashed_password37', 'Employe', 1),
('Camille', 'Haydée', 'haydee.camille@example.com', '0123456806', '38 Rue Example', 'hcamille', 'hashed_password38', 'Employe', 1),
('Baudet', 'Jeanne', 'jeanne.baudet@example.com', '0123456807', '39 Rue Example', 'jbaudet', 'hashed_password39', 'Employe', 1),
('Morel', 'Marianne', 'marianne.morel@example.com', '0123456808', '40 Rue Example', 'mmorel', 'hashed_password40', 'Employe', 1);

-- Récupérer les IDs des utilisateurs nouvellement insérés pour les employés
SET @user_id_start = LAST_INSERT_ID();

-- Insérer dans employe pour les 20 utilisateurs nouvellement insérés
INSERT INTO employe (id, date_embauche, statut, salaire)
VALUES
(@user_id_start, '2023-01-01', 'Actif', 2500.00),
(@user_id_start + 1, '2023-01-02', 'Congé', 2200.00),
(@user_id_start + 2, '2023-01-03', 'Maladie', 2300.00),
(@user_id_start + 3, '2023-01-04', 'Actif', 2400.00),
(@user_id_start + 4, '2023-01-05', 'Congé', 2600.00),
(@user_id_start + 5, '2023-01-06', 'Actif', 2100.00),
(@user_id_start + 6, '2023-01-07', 'Démissionnaire', 2700.00),
(@user_id_start + 7, '2023-01-08', 'Congé', 2500.00),
(@user_id_start + 8, '2023-01-09', 'Licencié', 2000.00),
(@user_id_start + 9, '2023-01-10', 'Actif', 2300.00),
(@user_id_start + 10, '2023-01-11', 'Actif', 2200.00),
(@user_id_start + 11, '2023-01-12', 'Congé', 2400.00),
(@user_id_start + 12, '2023-01-13', 'Actif', 2100.00),
(@user_id_start + 13, '2023-01-14', 'Maternité/Paternité', 2700.00),
(@user_id_start + 14, '2023-01-15', 'Actif', 2300.00),
(@user_id_start + 15, '2023-01-16', 'Congé', 2200.00),
(@user_id_start + 16, '2023-01-17', 'Démissionnaire', 2600.00),
(@user_id_start + 17, '2023-01-18', 'Actif', 2500.00),
(@user_id_start + 18, '2023-01-19', 'Licencié', 2000.00),
(@user_id_start + 19, '2023-01-20', 'Actif', 2200.00);

-- Insérer 10 utilisateurs supplémentaires pour les clients
INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, TypeCompte, etat)
VALUES 
('aourane', 'lyna', 'lucie.martin@example.com', '0123456789', '108 Rue Exemple', 'lyna', '123', 'Client', 1);

SET @user_id_11 = LAST_INSERT_ID();

INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, TypeCompte, etat)
VALUES 
('Thomas', 'Mathieu', 'mathieu.thomas@example.com', '0123456789', '109 Rue Exemple', 'mthomas', 'hashed_password12', 'Client', 1);

SET @user_id_12 = LAST_INSERT_ID();

INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, TypeCompte, etat)
VALUES 
('Peugeot', 'Nathalie', 'nathalie.peugeot@example.com', '0123456789', '110 Rue Exemple', 'npeugeot', 'hashed_password13', 'Client', 1);

SET @user_id_13 = LAST_INSERT_ID();

INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, TypeCompte, etat)
VALUES 
('Renard', 'Olivier', 'olivier.renard@example.com', '0123456789', '111 Rue Exemple', 'orenard', 'hashed_password14', 'Client', 1);

SET @user_id_14 = LAST_INSERT_ID();

INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, TypeCompte, etat)
VALUES 
('Michel', 'Paul', 'paul.michel@example.com', '0123456789', '112 Rue Exemple', 'pmichel', 'hashed_password15', 'Client', 1);

SET @user_id_15 = LAST_INSERT_ID();

INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, TypeCompte, etat)
VALUES 
('Lemoine', 'Quentin', 'quentin.lemoine@example.com', '0123456789', '113 Rue Exemple', 'qlemoine', 'hashed_password16', 'Client', 1);

SET @user_id_16 = LAST_INSERT_ID();

INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, TypeCompte, etat)
VALUES 
('Girard', 'Rachel', 'rachel.girard@example.com', '0123456789', '114 Rue Exemple', 'test', 'test', 'Client', 1);

SET @user_id_17 = LAST_INSERT_ID();

INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, TypeCompte, etat)
VALUES 
('Faure', 'Sylvain', 'sylvain.faure@example.com', '0123456789', '115 Rue Exemple', 'sfaure', 'hashed_password18', 'Client', 1);

SET @user_id_18 = LAST_INSERT_ID();

INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, TypeCompte, etat)
VALUES 
('Leroy', 'Thomas', 'thomas.leroy@example.com', '0123456789', '116 Rue Exemple', 'tleroy', 'hashed_password19', 'Client', 1);

SET @user_id_19 = LAST_INSERT_ID();

INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, TypeCompte, etat)
VALUES 
('Henry', 'Ursule', 'ursule.henry@example.com', '0123456789', '117 Rue Exemple', 'uhenry', 'hashed_password20', 'Client', 1);

SET @user_id_20 = LAST_INSERT_ID();

-- Insérer dans clients pour les 10 utilisateurs nouvellement insérés
INSERT INTO Client (id, date_inscription, type_client)
VALUES 
(@user_id_11, '2023-01-11', 'Particulier'),
(@user_id_12, '2023-01-12', 'Entreprise'),
(@user_id_13, '2023-01-13', 'Particulier'),
(@user_id_14, '2023-01-14', 'Entreprise'),
(@user_id_15, '2023-01-15', 'Particulier'),
(@user_id_16, '2023-01-16', 'Entreprise'),
(@user_id_17, '2023-01-17', 'Particulier'),
(@user_id_18, '2023-01-18', 'Entreprise'),
(@user_id_19, '2023-01-19', 'Particulier'),
(@user_id_20, '2023-01-20', 'Entreprise');

-- Insérer une nouvelle réservation
INSERT INTO reservation (date_reservation, date_prestation, heure_prestation, adresse_prestation, montant, etat, client_id)
VALUES ('2024-06-01', '2024-06-05', '10:00:00', '50 Rue Example', 150.00, 'pas encore traité', 7);

-- Récupérer l'ID de la réservation nouvellement insérée
SET @reservation_id = LAST_INSERT_ID();

-- Insérer les détails de la réservation pour plusieurs services
INSERT INTO detailResSER (codeR, CodeS, nbr_hr, instructions_speciales)
VALUES 
(@reservation_id, 1, 3, 'Nettoyer particulièrement les coins et sous les meubles'),
(@reservation_id, 3, 2, 'Assurer un nettoyage complet des bureaux'),
(@reservation_id, 5, 4, 'Nettoyer tous les équipements industriels à fond');

-- Insérer des matériels
INSERT INTO materiel (nomM, type, etat, quantite) VALUES
('Aspirateur', 'nettoyage', 'neuf', 10),
('Balai', 'nettoyage', 'bon', 15),
('Chiffon microfibre', 'nettoyage', 'neuf', 50),
('Seau', 'nettoyage', 'bon', 20),
('Gant de nettoyage', 'nettoyage', 'neuf', 30),
('Nettoyant multi-surface', 'nettoyage', 'neuf', 25),
('Détachant', 'nettoyage', 'neuf', 10),
('Éponge', 'nettoyage', 'bon', 40),
('Système de lavage à vapeur', 'électronique', 'neuf', 5),
('Robot aspirateur', 'électronique', 'neuf', 8),
('Aspirateur industriel', 'électronique', 'bon', 3),
('Polisseuse de sol', 'électronique', 'neuf', 2),
('Machine à laver', 'électronique', 'bon', 7),
('Nettoyant haute pression', 'électronique', 'neuf', 4),
('Perceuse', 'mécanique', 'bon', 12),
('Tournevis électrique', 'mécanique', 'neuf', 20),
('Scie circulaire', 'mécanique', 'bon', 6),
('Ponceuse', 'mécanique', 'usagé', 5),
('Pistolet à clous', 'mécanique', 'bon', 10),
('Compresseur d\'air', 'mécanique', 'bon', 3),
('Générateur', 'mécanique', 'neuf', 2),
('Nettoyant pour vitres', 'nettoyage', 'neuf', 15),
('Raclette', 'nettoyage', 'bon', 25),
('Désinfectant', 'nettoyage', 'neuf', 30),
('Sac poubelle', 'autre', 'neuf', 100),
('Chariot de ménage', 'nettoyage', 'bon', 10),
('Pelle et balayette', 'nettoyage', 'bon', 15),
('Gants de protection', 'autre', 'neuf', 50),
('Tapis désinfectant', 'autre', 'neuf', 10),
('Lampe UV désinfectante', 'électronique', 'neuf', 5),
('Détecteur de fumée', 'électronique', 'bon', 10);

-- Insertion de 5 éléments dans la table ArretDeTravail pour 5 employés différents
INSERT INTO ArretDeTravail (Type, Date_deb, Date_fin, Description, statut, id) VALUES
('Maladie', '2024-06-05', '2024-06-12', 'Arrêt maladie pour grippe', 'pas encore traité', @user_id_start + 1),
('Maternité/Paternité', '2024-07-01', '2024-09-30', 'Congé maternité', 'pas encore traité', @user_id_start + 2),
('Congé', '2024-08-01', '2024-08-15', 'Congé estival', 'pas encore traité', @user_id_start + 3),
('Demission', '2024-06-15', '2024-06-22', 'Arrêt maladie pour fracture', 'pas encore traité', @user_id_start + 4);

-- Insérer des compétences dans la table competence
INSERT INTO competence (nomCp) VALUES 
('Nettoyage de vitres'),
('Nettoyage industriel'),
('Nettoyage de bureaux'),
('Nettoyage après sinistre'),
('Nettoyage de façades'),
('Nettoyage de moquettes'),
('Nettoyage de maisons'),
('Nettoyage de sols'),
('Nettoyage de cuisines'),
('Nettoyage de sanitaires');

INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, TypeCompte, etat)
VALUES 
('safa', 'imad', 'sf.im@example.com', '0123456789', '117 Rue Exemple', 'Simad', 'PASSWORD(azerty)', 'Client', 1);

SET @user_id_21 = LAST_INSERT_ID();
INSERT INTO Client (id, date_inscription, type_client)
VALUES 
(@user_id_21, '2023-01-11', 'Particulier');

INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, TypeCompte, etat)
VALUES 
('admin', 'admin', 'test.im@example.com', '01234567812', '117 Rue Exemple', 'Admin', '123', 'Admin', 1);


-- Insertion de 10 contrats pour 10 clients différents
INSERT INTO contrat (date_deb, date_fin, montantc, etat, detailc, client_id)
VALUES 
('2024-11-01', '2024-12-31', 12000.00, 'Actif', 'Contrat pour nettoyage complet de la maison', @user_id_1),
('2024-10-01', '2024-12-31', 80000.00, 'Actif', 'Contrat pour nettoyage de vitres', @user_id_2),
('2024-07-01', '2024-12-31', 15000.00, 'Actif', 'Contrat pour entretien de bureaux', @user_id_3),
('2024-05-01', '2024-12-31', 20000.00, 'en attente de preparation', 'Contrat pour nettoyage de restaurants', @user_id_4),
('2024-09-01', '2024-12-31', 18000.00, 'en attente de preparation', 'Contrat pour nettoyage de sites de construction', @user_id_5),
('2024-07-01', '2024-12-31', 16000.00, 'en attente de preparation', 'Contrat pour nettoyage d\'entrepôts', @user_id_6),
('2023-08-01', '2023-12-31', 11000.00, 'actif', 'Contrat pour nettoyage de véhicules', @user_id_7),
('2023-09-01', '2023-12-31', 25000.00, 'actif', 'Contrat pour nettoyage après sinistre', @user_id_8),
('2023-10-01', '2023-12-31', 13000.00, 'en attente de preparation', 'Contrat pour nettoyage de maisons et bureaux', @user_id_9),
('2023-11-01', '2023-12-31', 14000.00, 'en attente de confirmation', 'Contrat pour nettoyage de façades et sols', @user_id_10);

-- Récupérer les IDs des contrats nouvellement insérés
SET @contract_id_1 = LAST_INSERT_ID();
SET @contract_id_2 = @contract_id_1 + 1;
SET @contract_id_3 = @contract_id_2 + 1;
SET @contract_id_4 = @contract_id_3 + 1;
SET @contract_id_5 = @contract_id_4 + 1;
SET @contract_id_6 = @contract_id_5 + 1;
SET @contract_id_7 = @contract_id_6 + 1;
SET @contract_id_8 = @contract_id_7 + 1;
SET @contract_id_9 = @contract_id_8 + 1;
SET @contract_id_10 = @contract_id_9 + 1;

-- Insertion dans ServiceDansContrat pour les services associés aux contrats
<<<<<<< HEAD
INSERT INTO ServiceDansContrat (CodeS, id_c, detailsSer,frequence) VALUES 
(1, @contract_id_1, 'Nettoyage complet de la maison','une fois par mois'),
(2, @contract_id_2, 'Nettoyage de vitres','une fois par mois'),
(3, @contract_id_3, 'Entretien de bureaux','une fois par semaine'),
(4, @contract_id_4, 'Nettoyage de restaurants','une fois par semaine'),
(5, @contract_id_5, 'Nettoyage de sites de construction ','tout les jours'),
(6, @contract_id_6, 'Nettoyage d\'entrepôts ','une fois par mois'),
(7, @contract_id_7, 'Nettoyage de véhicules','une fois par mois'),
(8, @contract_id_8, 'Nettoyage après sinistre en urgence','une fois par mois'),
(1, @contract_id_9, 'Nettoyage de maisons ','une fois par mois'),
(3, @contract_id_9, 'Nettoyage de bureaux ','une fois par semaine'),
(5, @contract_id_10, 'Nettoyage de façades ','une fois par mois'),
(7, @contract_id_10, 'Nettoyage de sols','une fois par mois');


=======
INSERT INTO ServiceDansContrat (CodeS, id_c, detailsSer, intervention_id, frequence) VALUES 
(1, @contract_id_1, 'Nettoyage complet de la maison', NULL, 'une fois par mois'),
(2, @contract_id_2, 'Nettoyage de vitres', NULL, 'une fois par mois'),
(3, @contract_id_3, 'Entretien de bureaux', NULL, 'une fois par semaine'),
(4, @contract_id_4, 'Nettoyage de restaurants', NULL, 'une fois par semaine'),
(5, @contract_id_5, 'Nettoyage de sites de construction', NULL, 'tout les jours'),
(6, @contract_id_6, 'Nettoyage d\'entrepôts', NULL, 'une fois par mois'),
(7, @contract_id_7, 'Nettoyage de véhicules', NULL, 'une fois par mois'),
(8, @contract_id_8, 'Nettoyage après sinistre en urgence', NULL, 'une fois par mois'),
(1, @contract_id_9, 'Nettoyage de maisons', NULL, 'une fois par mois'),
(3, @contract_id_9, 'Nettoyage de bureaux', NULL, 'une fois par semaine'),
(5, @contract_id_10, 'Nettoyage de façades', NULL, 'une fois par mois'),
(7, @contract_id_10, 'Nettoyage de sols', NULL, 'une fois par mois');
<<<<<<< HEAD
>>>>>>> 236b116 (init)
=======

INSERT INTO reservation (date_reservation, date_prestation, heure_prestation, adresse_prestation, montant, etat, client_id)
VALUES 
('2023-05-15', '2023-05-20', '10:00:00', '123 Rue Principale, Alger', 150.00, 'traité', 1),
('2023-04-10', '2023-04-15', '14:00:00', '456 Avenue Liberté, Oran', 200.00, 'traité', 2),
('2023-03-05', '2023-03-10', '09:30:00', '789 Boulevard Industriel, Constantine', 250.00, 'pas encore traité', 3),
('2023-02-01', '2023-02-05', '08:00:00', '101 Rue de la Paix, Blida', 300.00, 'traité', 4),
('2023-01-20', '2023-01-25', '16:00:00', '202 Place de la Victoire, Tizi Ouzou', 180.00, 'pas encore traité', 5);


INSERT INTO paiement (date_paiement, montant, etat_paiement, contrat_id)
VALUES 
('2023-06-10', 150.00, 'payé', 1),
('2023-07-05', 180.00, 'en retard', 1),
('2023-08-20', 200.00, 'payé', 1),
('2023-09-15', 250.00, 'en retard', 1),
('2023-10-10', 300.00, 'payé', 1),
('2023-11-05', 180.00, 'en retard', 1),
('2023-05-20', 200.00, 'en retard', 2),
('2023-06-15', 250.00, 'en retard', 2),
('2023-07-10', 300.00, 'payé', 2),
('2023-08-05', 180.00, 'en retard', 2),
('2023-09-20', 200.00, 'payé', 2),
('2023-10-15', 250.00, 'en retard', 2),
('2023-11-10', 300.00, 'payé', 2),
('2023-04-15', 250.00, 'payé', 3),
('2023-05-10', 300.00, 'en retard', 3),
('2023-06-05', 180.00, 'payé', 3),
('2023-07-20', 200.00, 'en retard', 3),
('2023-08-15', 250.00, 'payé', 3),
('2023-09-10', 300.00, 'en retard', 3);

INSERT INTO ArretDeTravail (Type, Date_deb, Date_fin, Description, statut, id)
VALUES
('Congé', '2023-01-15', '2023-01-20', 'Congé annuel', 'accordé', 13),
('Congé', '2023-06-01', '2023-06-05', 'Congé de printemps', 'accordé', 13),
('Congé', '2023-12-03', '2023-12-10', 'Congé dhiver', 'accordé', 13),
('Congé', '2024-06-01','2024-06-10', 'Congé pour raison personnelle', 'accordé', 13),
('Congé', '2024-12-03','2024-12-10', 'Congé anticipé pour lannée prochaine', 'accordé', 13);

INSERT INTO reservation (date_reservation, date_prestation, heure_prestation, adresse_prestation, montant, etat, client_id)
VALUES 
('2024-06-10', '2024-06-15', '10:00:00', '123 Rue de la Liberté', 150.00, 'pas encore traité', 1),
('2024-07-05', '2024-07-10', '14:00:00', '456 Avenue du Soleil', 200.00, 'pas encore traité', 2),
('2024-08-20', '2024-08-25', '12:00:00', '789 Boulevard des Étoiles', 250.00, 'pas encore traité', 3);





-- Insertion des données avec id_c null et etat 'pas encore faite'
INSERT INTO intervention (etat,codeR, id_c)
VALUES 
('pas encore faite','7', NULL),
('pas encore faite','8', NULL),
('pas encore faite','9', NULL);

INSERT INTO employe_intervention (intervention_id, employe_id, CodeS, tache)
VALUES 
(1, 13, 3, 'Nettoyage des sols'),
(2, 13, 4, 'Nettoyage des vitres'),
(3, 13, 3, 'Nettoyage des bureaux'),
(4, 13, 3, 'Nettoyage des sanitaires'),
(5, 13, 3, 'Nettoyage des surfaces'),
(6, 13, 3, 'Nettoyage des espaces communs');


INSERT INTO reservation (date_reservation, date_prestation, heure_prestation, adresse_prestation, montant, etat, client_id)
VALUES 
('2023-05-15', '2024-07-20', '10:00:00', '123 Rue Principale, Alger', 150.00, 'traité', 1),
('2023-04-10', '2024-07-15', '14:00:00', '456 Avenue Liberté, Oran', 200.00, 'traité', 2);

