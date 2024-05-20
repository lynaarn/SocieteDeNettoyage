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

-- Insérer les rôles dans la table roles
INSERT INTO roles (nomR) VALUES ('Responsable RH'), ('Gestionnaire d\'Interventions');

-- Insérer un utilisateur pour le Responsable RH
INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, etat)
VALUES ('Dupont', 'Jean', 'jean.dupont@example.com', '0123456789', '123 Rue Example', 'jdupont', 'hashed_password', 1);

-- Récupérer l'id de l'utilisateur nouvellement inséré pour le Responsable RH
SET @user_id_rh = LAST_INSERT_ID();

-- Insérer dans personnel_administratif pour le Responsable RH
INSERT INTO personnel_administratif (id, date_embauche, role)
VALUES (@user_id_rh, '2020-01-01', (SELECT numR FROM roles WHERE nomR='Responsable RH'));

-- Insérer un utilisateur pour le Gestionnaire d'Interventions
INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, etat)
VALUES ('Martin', 'Sophie', 'sophie.martin@example.com', '0987654321', '456 Rue Example', 'smartin', 'hashed_password', 1);

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
INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, etat)
VALUES 
('Bernard', 'Alice', 'alice.bernard@example.com', '0123456789', '123 Rue Exemple', 'abernard', 'hashed_password1', 1);

SET @user_id_1 = LAST_INSERT_ID();

INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, etat)
VALUES 
('Durand', 'Charles', 'charles.durand@example.com', '0123456789', '456 Rue Exemple', 'cdurand', 'hashed_password2', 1);

SET @user_id_2 = LAST_INSERT_ID();

INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, etat)
VALUES 
('Petit', 'David', 'david.petit@example.com', '0123456789', '789 Rue Exemple', 'dpetit', 'hashed_password3', 1);

SET @user_id_3 = LAST_INSERT_ID();

-- Insertion des utilisateurs pour les clients (suite)
INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, etat)
VALUES 
('Moreau', 'Emma', 'emma.moreau@example.com', '0123456789', '101 Rue Exemple', 'emoreau', 'hashed_password4', 1);

SET @user_id_4 = LAST_INSERT_ID();

INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, etat)
VALUES 
('Roux', 'Fabien', 'fabien.roux@example.com', '0123456789', '102 Rue Exemple', 'froux', 'hashed_password5', 1);

SET @user_id_5 = LAST_INSERT_ID();

INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, etat)
VALUES 
('Simon', 'Georges', 'georges.simon@example.com', '0123456789', '103 Rue Exemple', 'gsimon', 'hashed_password6', 1);

SET @user_id_6 = LAST_INSERT_ID();

INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, etat)
VALUES 
('Laurent', 'Hélène', 'helene.laurent@example.com', '0123456789', '104 Rue Exemple', 'hlaurent', 'hashed_password7', 1);

SET @user_id_7 = LAST_INSERT_ID();

INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, etat)
VALUES 
('Lefevre', 'Isabelle', 'isabelle.lefevre@example.com', '0123456789', '105 Rue Exemple', 'ilefevre', 'hashed_password8', 1);

SET @user_id_8 = LAST_INSERT_ID();

INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, etat)
VALUES 
('Blanc', 'Jacques', 'jacques.blanc@example.com', '0123456789', '106 Rue Exemple', 'jblanc', 'hashed_password9', 1);

SET @user_id_9 = LAST_INSERT_ID();

INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, etat)
VALUES 
('Garnier', 'Katy', 'katy.garnier@example.com', '0123456789', '107 Rue Exemple', 'kgarnier', 'hashed_password10', 1);

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