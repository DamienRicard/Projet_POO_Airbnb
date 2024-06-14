-- Création de la table adress

CREATE TABLE IF NOT EXISTS `adress` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `adress` VARCHAR(255),
    `zip_code` INT,
    `city` VARCHAR(255),
    `country` VARCHAR(255),
    `phone` VARCHAR(255)
    );

INSERT INTO `adress` (`adress`, `zip_code`, `country`, `phone`, `city`) VALUES 
    ('5 rue des grillons', 66500, 'France', '0601020304', 'Perpignan'),
    ('10 avenue des Champs-Élysées', 75008, 'France', '0601020305', 'Paris'),
    ('15 boulevard de la Liberté', 31000, 'France', '0601020306', 'Toulouse'),
    ('20 rue de la République', 69002, 'France', '0601020307', 'Lyon'),
    ('25 rue Sainte-Catherine', 33000, 'France', '0601020308', 'Bordeaux'),
    ('30 cours Mirabeau', 13100, 'France', '0601020309', 'Aix-en-Provence'),
    ('35 rue de la Paix', 67000, 'France', '0601020310', 'Strasbourg'),
    ('40 rue du Faubourg Saint-Antoine', 75012, 'France', '0601020311', 'Paris'),
    ('45 rue de la Pompe', 75116, 'France', '0601020312', 'Paris'),
    ('50 boulevard Saint-Germain', 75005, 'France', '0601020313', 'Paris');


 
-- Création de la table user

CREATE TABLE IF NOT EXISTS `user` (
    `id` INT AUTO_INCREMENT PRIMARY KEY ,
    `email` VARCHAR(255),
    `password` VARCHAR(255),
    `lastname` VARCHAR(255),
    `firstname` VARCHAR(255),
    `is_active` BOOLEAN,
    `adress_id` INT,
    FOREIGN KEY (`adress_id`) REFERENCES `adress`(`id`)
    );

INSERT INTO `user` (`email`, `password`, `lastname`, `firstname`, `is_active`, `adress_id`) VALUES
    ('user1@example.com', '$2y$10$NfSuSVCA1VFfffhk/6IX4.vGRlzI9axiV933qvRkksuTNEr1ncFrS', 'Dupont', 'Jean', TRUE, 1),
    ('user2@example.com', '$2y$10$NfSuSVCA1VFfffhk/6IX4.vGRlzI9axiV933qvRkksuTNEr1ncFrS', 'Martin', 'Jacques', TRUE, 2),
    ('user3@example.com', '$2y$10$NfSuSVCA1VFfffhk/6IX4.vGRlzI9axiV933qvRkksuTNEr1ncFrS', 'Bernard', 'Pierre', TRUE, 3),
    ('user4@example.com', '$2y$10$NfSuSVCA1VFfffhk/6IX4.vGRlzI9axiV933qvRkksuTNEr1ncFrS', 'Thomas', 'Paul', TRUE, 4),
    ('user5@example.com', '$2y$10$NfSuSVCA1VFfffhk/6IX4.vGRlzI9axiV933qvRkksuTNEr1ncFrS', 'Petit', 'Nicolas', TRUE, 5),
    ('user6@example.com', '$2y$10$NfSuSVCA1VFfffhk/6IX4.vGRlzI9axiV933qvRkksuTNEr1ncFrS', 'Robert', 'Maxime', TRUE, 6),
    ('user7@example.com', '$2y$10$NfSuSVCA1VFfffhk/6IX4.vGRlzI9axiV933qvRkksuTNEr1ncFrS', 'Richard', 'François', TRUE, 7),
    ('user8@example.com', '$2y$10$NfSuSVCA1VFfffhk/6IX4.vGRlzI9axiV933qvRkksuTNEr1ncFrS', 'Lefevre', 'Julien', TRUE, 8),
    ('user9@example.com', '$2y$10$NfSuSVCA1VFfffhk/6IX4.vGRlzI9axiV933qvRkksuTNEr1ncFrS', 'Durand', 'Jérôme', TRUE, 9),
    ('user10@example.com', '$2y$10$NfSuSVCA1VFfffhk/6IX4.vGRlzI9axiV933qvRkksuTNEr1ncFrS', 'Moreau', 'Benjamin', TRUE, 10);

 
-- Création de la table typelogement

CREATE TABLE IF NOT EXISTS `type_logement` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `label` VARCHAR(255),
    `image_path` VARCHAR(255),
    `is_active` BOOLEAN
    );

INSERT INTO `typelogement` (`label`, `image_path`,`is_active`) VALUES
    ('luxe','img.png', TRUE),
    ('cabanes perchées','img1.png', TRUE),
    ('Avec vue','img2.png', TRUE),
    ('Campagne','img3.png', TRUE),
    ('Chateaux','img4.png', TRUE),
    ('Fermes','img5.png', TRUE),
    ('Tendances','img6.png', TRUE),
    ('Camping','img7.png', TRUE),
    ('Atypique','img8.png', TRUE),
    ('Arctique','img9.png', TRUE);
 

-- Création de la table logement

CREATE TABLE IF NOT EXISTS `logement` (
    `id` INT AUTO_INCREMENT PRIMARY KEY ,
    `title` VARCHAR(255),
    `description` TEXT,
    `price_per_night` INT,
    `nb_room` INT,
    `nb_bed` INT,
    `nb_bath` INT,
    `nb_traveler` INT,
    `is_active` BOOLEAN,
    `type_logement_id` INT,
    `user_id` INT,
    `adress_id` INT,
    FOREIGN KEY (`type_logement_id`) REFERENCES `typelogement`(`id`),
    FOREIGN KEY (`user_id`) REFERENCES `user`(`id`),
    FOREIGN KEY (`adress_id`) REFERENCES `adress`(`id`)
    );

INSERT INTO `logement` (`title`, `description`, `price_per_night`, `nb_room`, `nb_bed`, `nb_bath`, `nb_traveler`,`is_active`, `type_logement_id`, `user_id`, `adress_id`) VALUES
    ('Jolie appartement situé au calme', 'Séjournez dans cet appartement cosy situé en plein cœur de Paris. Il dispose d\'une chambre lumineuse, d\'une cuisine entièrement équipée, d\'un salon confortable et d\'une salle de bain privée. Parfaitement situé près des principales attractions, cafés et boutiques.', 50, 3, 3, 2, 4, TRUE, 1, 1, 1),
    ('Loft moderne avec vue sur la mer', 'Loft spacieux et moderne avec une vue imprenable sur la mer. Comprend une chambre avec un lit king-size, une cuisine équipée et un balcon.', 120, 2, 1, 1, 2, TRUE, 2, 2, 2),
    ('Studio charmant proche des musées', 'Studio confortable situé à proximité des principaux musées. Idéal pour les couples ou les voyageurs en solo.', 70, 1, 1, 1, 2, TRUE, 3, 3, 3),
    ('Maison familiale avec jardin', 'Grande maison familiale avec un jardin spacieux. Parfaite pour les familles avec enfants. Proche des parcs et des écoles.', 150, 5, 4, 2, 6, TRUE, 4, 4, 4),
    ('Appartement lumineux au centre-ville', 'Appartement lumineux avec une grande fenêtre donnant sur la rue principale. Proche des restaurants et des boutiques.', 90, 2, 2, 1, 4, TRUE, 5, 5, 5),
    ('Petit cottage à la campagne', 'Charmant petit cottage situé en pleine campagne. Idéal pour une escapade tranquille.', 60, 2, 1, 1, 3, TRUE, 6, 6, 6),
    ('Penthouse de luxe avec terrasse', 'Penthouse de luxe avec une grande terrasse offrant une vue panoramique sur la ville. Comprend trois chambres et deux salles de bain.', 300, 4, 3, 2, 6, TRUE, 7, 7, 7),
    ('Appartement confortable près de la gare', 'Appartement confortable et bien équipé, situé à deux pas de la gare principale. Pratique pour les voyageurs en transit.', 80, 2, 1, 1, 3, TRUE, 8, 8, 8),
    ('Villa spacieuse avec piscine', 'Villa spacieuse avec une grande piscine et un jardin privé. Parfaite pour les groupes ou les familles nombreuses.', 250, 6, 5, 3, 10, TRUE, 9, 9, 9),
    ('Chalet rustique en montagne', 'Chalet rustique et chaleureux situé en montagne. Idéal pour les amateurs de ski et de randonnée.', 110, 3, 3, 2, 5, TRUE, 10, 10, 10);


 
-- Création de la table equipement

CREATE TABLE IF NOT EXISTS `equipement` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `label` VARCHAR(255),
    `image_path` VARCHAR(255)
    );

INSERT INTO `equipement` (`label`, `image_path`) VALUES
    ('Produits de nettoyage', 'produit.svg'),
    ('Shampooing', 'shampooing.svg'),
    ('Douche extérieure', 'douche-ex.svg'),
    ('Eau chaude', 'eau-chaude.svg'),
    ('Lave-linge', 'lave-linge.svg'),
    ('Draps', 'draps.svg'),
    ('Oreillers et couvertures supplémentaires', 'oreiller.svg'),
    ('Stores', 'store.svg'),
    ('Fer à repasser',  'fer.svg'),
    ('Étendoir à linge', 'etendoir.svg'),
    ('TV HD', 'tv.svg'),
    ('Système audio', 'audio.svg'),
    ('Lit pour bébé', 'lit-baby.svg'),
    ('Lit parapluie', 'lit-parapluie.svg'),
    ('Jouets et livres pour enfants',  'jouet.svg'),
    ('Baignoire pour bébés', 'baignoir-baby.svg'),
    ('Vaisselle pour enfants', 'vaisselle-baby.svg'),
    ('Caches-prises', 'cache-prise.svg'),
    ('Barrières de sécurité pour bébé', 'security-barriere.svg'),
    ('Climatisation centrale', 'clim.svg'),
    ('Chauffage central', 'chauffage.svg'),
    ('Wi-Fi', 'wifi.svg'),
    ('Espace de travail', 'bureau.svg'),
    ('Cuisine', 'cuisine.svg'),
    ('Réfrigérateur', 'frigo.svg'),
    ('Four à micro-ondes', 'microndes.svg'),
    ('Équipements de cuisine de base', 'ustensible.svg'),
    ('Vaisselle et couverts', 'vaisselle.svg'),
    ('Four', 'four.svg'),
    ('Bouilloire électrique', 'bouilloire.svg'),
    ('Cafetière', 'cafetiere.svg'),
    ('Grille-pain', 'grille-pain.svg'),
    ('Table à manger', 'table-manger.svg'),
    ('Plaque de cuisson', 'plaque.svg'),
    ('Entrée privée', 'entrer.svg'),
    ('Entrée public', 'entrer.svg'),
    ('Privé : patio ou balcon', 'balcon.svg'),
    ('Mobilier extérieur', 'mobilier.svg'),
    ('Espace repas en plein air', 'mobilier.svg'),
    ('Barbecue', 'barbecue.svg'),
    ('Vélos', 'velo.svg'),
    ('Chaises longues', 'chaise-longue.svg'),
    ('Parking privé (2 places)', 'voiture.svg'),
    ('Parking gratuit dans la rue', 'voiture.svg');



-- Création de la table logement_equipement

CREATE TABLE IF NOT EXISTS `logement_equipement` (
    `logement_id` INT,
    `equipement_id` INT,
    PRIMARY KEY (`logement_id`, `equipement_id`),
    FOREIGN KEY (`logement_id`) REFERENCES `logement`(`id`),
    FOREIGN KEY (`equipement_id`) REFERENCES `equipement`(`id`)
    );

INSERT INTO `logement_equipement` (`logement_id`, `equipement_id`) VALUES
    (1, 1),
    (2, 2),
    (3, 3),
    (4, 4),
    (5, 5),
    (6, 1),
    (7, 2),
    (8, 3),
    (9, 4),
    (10, 5);
    
 

-- Création de la table reservation

CREATE TABLE IF NOT EXISTS `reservation` (
    `id` INT PRIMARY KEY AUTO_INCREMENT, 
    `date_start` DATE,
    `date_end` DATE,
    `nb_adult` INT,
    `nb_child` INT,
    `price_total` FLOAT,
    `logement_id` INT,
    `user_id` INT,
    FOREIGN KEY (`logement_id`) REFERENCES `logement`(`id`),
    FOREIGN KEY (`user_id`) REFERENCES `user`(`id`)
    );




-- Création de la table favoris
 CREATE TABLE IF NOT EXISTS `favoris` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `logement_id` INT,
    `user_id` INT,
    FOREIGN KEY (`logement_id`) REFERENCES `logement`(`id`),
    FOREIGN KEY (`user_id`) REFERENCES `user`(`id`)
    );
 

 

-- Création de la table media

CREATE TABLE IF NOT EXISTS `media` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `label` VARCHAR(255),
    `image_path` VARCHAR(255),
    `is_active` BOOLEAN,
    `logement_id` INT,
    FOREIGN KEY (`logement_id`) REFERENCES `logement`(`id`)
    );
