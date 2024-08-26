<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240826030947 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annee_academiques (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description CLOB DEFAULT NULL, date_rentree DATE NOT NULL, evenements CLOB DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL)');
        $this->addSql('CREATE TABLE bailleurs (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL)');
        $this->addSql('CREATE TABLE batiment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, faces VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE chambre (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, batiment_id INTEGER NOT NULL, nom VARCHAR(255) NOT NULL, etat VARCHAR(255) NOT NULL, statut VARCHAR(255) NOT NULL, localisation VARCHAR(255) NOT NULL, position VARCHAR(255) NOT NULL, created_at DATETIME  NULL, updated_at DATETIME  NULL, CONSTRAINT FK_C509E4FFD6F6891B FOREIGN KEY (batiment_id) REFERENCES batiment (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_C509E4FFD6F6891B ON chambre (batiment_id)');
        $this->addSql('CREATE TABLE chambre_locataire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, chambre_id INTEGER NOT NULL, locataire_id INTEGER NOT NULL, annee_academique_id INTEGER NOT NULL, duree_occupation INTEGER NOT NULL, created_at DATETIME  NULL, updated_at DATETIME  NULL, CONSTRAINT FK_8E17FB029B177F54 FOREIGN KEY (chambre_id) REFERENCES chambre (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8E17FB02D8A38199 FOREIGN KEY (locataire_id) REFERENCES locataire (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8E17FB02B00F076 FOREIGN KEY (annee_academique_id) REFERENCES annee_academiques (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_8E17FB029B177F54 ON chambre_locataire (chambre_id)');
        $this->addSql('CREATE INDEX IDX_8E17FB02D8A38199 ON chambre_locataire (locataire_id)');
        $this->addSql('CREATE INDEX IDX_8E17FB02B00F076 ON chambre_locataire (annee_academique_id)');
        $this->addSql('CREATE TABLE chambre_permutation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL)');
        $this->addSql('CREATE TABLE contrats (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL)');
        $this->addSql('CREATE TABLE depense (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, chambre_id INTEGER NOT NULL, description VARCHAR(255) NOT NULL, montant DOUBLE PRECISION NOT NULL, date DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_340597579B177F54 FOREIGN KEY (chambre_id) REFERENCES chambre (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_340597579B177F54 ON depense (chambre_id)');
        $this->addSql('CREATE TABLE depense_realisation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL)');
        $this->addSql('CREATE TABLE locataire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER  NULL, nom VARCHAR(255)  NULL, prenom VARCHAR(255)  NULL, email VARCHAR(255)  NULL, genre VARCHAR(10)  NULL, adresse VARCHAR(255)  NULL, telephone VARCHAR(20)  NULL, date_naissance DATE  NULL, lieu_naissance VARCHAR(255)  NULL, niveau VARCHAR(255)  NULL, filiere VARCHAR(255)  NULL, created_at DATETIME  NULL, updated_at DATETIME  NULL)');
       
       $this->addSql("INSERT INTO annee_academiques (nom, description, date_rentree, evenements, created_at, updated_at) VALUES 
        ('2023-2024', 'Année académique 2023-2024', '2023-09-01', 'Début des cours: 2023-09-15;Examen mi-semestre: 2024-01-10;Vacances d hiver: 2023-12-20 au 2024-01-05', '2023-08-01 08:00:00', '2024-01-15 10:00:00'),
        ('2022-2023', 'Année académique 2022-2023', '2022-09-01', 'Début des cours: 2022-09-10;Examens finaux: 2023-05-20;Remise des diplômes: 2023-06-30', '2022-08-01 08:00:00', '2023-07-01 12:00:00'),
        ('2021-2022', 'Année académique 2021-2022', '2021-09-01', 'Inscription: 2021-08-25 au 2021-09-05;Vacances de Noël: 2021-12-23 au 2022-01-02;Examens finaux: 2022-05-15', '2021-07-20 09:00:00', '2022-06-01 11:00:00'),
        ('2020-2021', 'Année académique 2020-2021', '2020-09-01', 'Orientation: 2020-09-05;Début des cours: 2020-09-15;Vacances de printemps: 2021-04-10 au 2021-04-20', '2020-07-15 08:30:00', '2021-05-30 09:45:00'),
        ('2019-2020', 'Année académique 2019-2020', '2019-09-01', 'Rentrée officielle: 2019-09-01;Examen mi-semestre: 2020-01-15;Fin des cours: 2020-05-10', '2019-07-10 07:45:00', '2020-05-20 13:00:00')");
        
        $this->addSql('
                    CREATE TABLE paiement (
                    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, -- Clé primaire avec auto-incrémentation
                    chambre_locataire_id INTEGER NOT NULL, -- Référence à la table chambre_locataire
                    tranche_id INTEGER NOT NULL, -- Référence à la table tranche
                    user_id INTEGER NULL, -- Référence à la table users (peut être NULL)
                    annee_academique_id INTEGER NOT NULL, -- Référence à la table annee_academiques
                    montant DOUBLE PRECISION NOT NULL, -- Montant du paiement
                    date_encaissement DATETIME NULL, -- Date d\'encaissement (peut être NULL)
                    date_de_paiement_banque DATETIME NULL, -- Date de paiement à la banque (peut être NULL)
                    created_at DATETIME NULL, -- Date de création (peut être NULL)
                    updated_at DATETIME NULL, -- Date de mise à jour (peut être NULL)
                    
                    -- Clés étrangères
                    CONSTRAINT FK_B1DC7A1E115EAC61 FOREIGN KEY (chambre_locataire_id) REFERENCES chambre_locataire (id) DEFERRABLE INITIALLY IMMEDIATE,
                    CONSTRAINT FK_B1DC7A1EB76F6B31 FOREIGN KEY (tranche_id) REFERENCES tranche (id) NOT DEFERRABLE INITIALLY IMMEDIATE,
                    CONSTRAINT FK_B1DC7A1EA76ED395 FOREIGN KEY (annee_academique_id) REFERENCES annee_academiques (id) NOT DEFERRABLE INITIALLY IMMEDIATE,
                    CONSTRAINT FK_B1DC7A1EA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE
                )
            ');


        $this->addSql('CREATE INDEX IDX_B1DC7A1E115EAC61 ON paiement (chambre_locataire_id)');
        $this->addSql('CREATE INDEX IDX_B1DC7A1EB76F6B31 ON paiement (tranche_id)');
        $this->addSql('CREATE INDEX IDX_B1DC7A1EA76ED395 ON paiement (user_id)');
        $this->addSql('CREATE INDEX IDX_B1DC7A1EB00F076 ON paiement (annee_academique_id)');

        $this->addSql('CREATE TABLE realisation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, chambre_id INTEGER NOT NULL, description VARCHAR(255) NOT NULL, date DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_EAA5610E9B177F54 FOREIGN KEY (chambre_id) REFERENCES chambre (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_EAA5610E9B177F54 ON realisation (chambre_id)');
        $this->addSql('CREATE TABLE realisation_chambre (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL)');
        $this->addSql('CREATE TABLE tranche (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, created_at DATETIME  NULL, updated_at DATETIME  NULL)');
        $this->addSql('CREATE TABLE users (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , available_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , delivered_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('
                        INSERT INTO batiment (id, nom, description, faces) VALUES
                        (1, \'Bâtiment A\', \'Bâtiment principal avec 4 faces\', 4),
                        (2, \'Bâtiment B\', \'Bâtiment secondaire avec 3 faces\', 3),
                        (3, \'Bâtiment C\', \'Bâtiment annexe avec 2 faces\', 2),
                        (4, \'Bâtiment D\', \'Bâtiment annexe avec 2 faces\', 2),
                        (5, \'Bâtiment D\', \'Bâtiment annexe avec 2 faces\', 2)
                    ');

        $this->addSql('
                    INSERT INTO locataire (user_id, nom, prenom, genre, adresse, telephone, date_naissance, lieu_naissance, niveau, filiere, created_at, updated_at, email) VALUES
                    (1, \'Khan\', \'Ahmed\', \'Homme\', \'123 Rue de Paris\', \'0123456789\', \'1990-01-01\', \'Paris\', \'Licence\', \'Informatique\', NULL, NULL, \'ahmed.khan@example.com\'),
                    (2, \'El Amrani\', \'Fatima\', \'Femme\', \'456 Avenue des Champs\', \'0987654321\', \'1988-02-15\', \'Lyon\', \'Master\', \'Management\', NULL, NULL, \'fatima.elamrani@example.com\'),
                    (3, \'Haddad\', \'Omar\', \'Homme\', \'789 Boulevard de la République\', \'0147258369\', \'1995-03-22\', \'Marseille\', \'Doctorat\', \'Physique\', NULL, NULL, \'omar.haddad@example.com\'),
                    (4, \'Benali\', \'Amina\', \'Femme\', \'321 Rue du Général\', \'0612345678\', \'1992-04-10\', \'Nice\', \'Licence\', \'Économie\', NULL, NULL, \'amina.benali@example.com\'),
                    (5, \'Boussif\', \'Mohamed\', \'Homme\', \'654 Route de Montagne\', \'0712345678\', \'1989-05-05\', \'Toulouse\', \'Master\', \'Mathematics\', NULL, NULL, \'mohamed.boussif@example.com\'),
                    (6, \'Ait Ali\', \'Nadia\', \'Femme\', \'987 Chemin des Vignes\', \'0536789123\', \'1991-06-17\', \'Bordeaux\', \'Licence\', \'Sciences\', NULL, NULL, \'nadia.aitali@example.com\'),
                    (7, \'Chabane\', \'Rachid\', \'Homme\', \'741 Rue des Fleurs\', \'0667891234\', \'1987-07-29\', \'Lille\', \'Doctorat\', \'Chimie\', NULL, NULL, \'rachid.chabane@example.com\'),
                    (8, \'Zidane\', \'Samira\', \'Femme\', \'852 Place du Marché\', \'0394567891\', \'1993-08-12\', \'Strasbourg\', \'Master\', \'Biologie\', NULL, NULL, \'samira.zidane@example.com\'),
                    (9, \'Laaroussi\', \'Karim\', \'Homme\', \'963 Boulevard des Écoles\', \'0321678945\', \'1985-09-20\', \'Rennes\', \'Licence\', \'Histoire\', NULL, NULL, \'karim.laaroussi@example.com\'),
                    (10, \'Moussa\', \'Khadija\', \'Femme\', \'159 Avenue des Sports\', \'0713456789\', \'1994-10-31\', \'Nantes\', \'Master\', \'Philosophie\', NULL, NULL, \'khadija.moussa@example.com\'),
                    (11, \'Amani\', \'Rami\', \'Homme\', \'951 Rue des Arts\', \'0601234567\', \'1988-11-14\', \'Montpellier\', \'Licence\', \'Géographie\', NULL, NULL, \'rami.amani@example.com\'),
                    (12, \'Khadraoui\', \'Lina\', \'Femme\', \'753 Rue de la Liberté\', \'0657894321\', \'1990-12-25\', \'Brest\', \'Doctorat\', \'Écologie\', NULL, NULL, \'lina.khadraoui@example.com\'),
                    (13, \'Benzakour\', \'Said\', \'Homme\', \'321 Avenue des Arbres\', \'0712345678\', \'1989-01-30\', \'Le Havre\', \'Master\', \'Physique\', NULL, NULL, \'said.benzakour@example.com\'),
                    (14, \'Haddad\', \'Mouna\', \'Femme\', \'654 Boulevard des Vignes\', \'0698123456\', \'1991-02-15\', \'Reims\', \'Licence\', \'Sociologie\', NULL, NULL, \'mouna.haddad@example.com\'),
                    (15, \'El Azzouzi\', \'Sofia\', \'Femme\', \'987 Route des Écoles\', \'0389456123\', \'1986-03-28\', \'Toulon\', \'Master\', \'Droit\', NULL, NULL, \'sofia.elazzouzi@example.com\'),
                    (16, \'Ait Ahmed\', \'Ibrahim\', \'Homme\', \'852 Chemin du Lac\', \'0321678945\', \'1992-04-20\', \'Avignon\', \'Licence\', \'Gestion\', NULL, NULL, \'ibrahim.aitahmed@example.com\'),
                    (17, \'Bennacer\', \'Salima\', \'Femme\', \'951 Avenue des Fleurs\', \'0748561234\', \'1989-05-11\', \'Caen\', \'Doctorat\', \'Linguistique\', NULL, NULL, \'salima.bennacer@example.com\'),
                    (18, \'Belkacem\', \'Youssef\', \'Homme\', \'753 Boulevard des Écoles\', \'0693456789\', \'1991-06-08\', \'Aix-en-Provence\', \'Master\', \'Ingénierie\', NULL, NULL, \'youssef.belkacem@example.com\'),
                    (19, \'Chaoui\', \'Samia\', \'Femme\', \'321 Place des Arts\', \'0389123456\', \'1988-07-23\', \'Nîmes\', \'Licence\', \'Médecine\', NULL, NULL, \'samia.chaoui@example.com\'),
                    (20, \'Karam\', \'Yassir\', \'Homme\', \'654 Route de la Mer\', \'0536789012\', \'1990-08-15\', \'Colmar\', \'Doctorat\', \'Matériaux\', NULL, NULL, \'yassir.karam@example.com\'),
                    (21, \'Djerbi\', \'Leïla\', \'Femme\', \'987 Rue des Arbres\', \'0123456789\', \'1993-09-30\', \'Orléans\', \'Master\', \'Génie Civil\', NULL, NULL, \'leila.djerbi@example.com\'),
                    (22, \'Ben Salah\', \'Mounir\', \'Homme\', \'852 Boulevard du Soleil\', \'0345678912\', \'1985-10-20\', \'Saint-Étienne\', \'Licence\', \'Électronique\', NULL, NULL, \'mounir.bensalah@example.com\'),
                    (23, \'Djedidi\', \'Faten\', \'Femme\', \'951 Chemin des Fleurs\', \'0698123456\', \'1992-11-25\', \'Béziers\', \'Master\', \'Archéologie\', NULL, NULL, \'faten.djedidi@example.com\'),
                    (24, \'Brahimi\', \'Karima\', \'Femme\', \'753 Route du Parc\', \'0321678945\', \'1988-12-05\', \'Annecy\', \'Licence\', \'Économie\', NULL, NULL, \'karima.brahimi@example.com\'),
                    (25, \'Khalil\', \'Rachid\', \'Homme\', \'321 Avenue des Champs\', \'0712345678\', \'1991-01-12\', \'Metz\', \'Doctorat\', \'Gestion\', NULL, NULL, \'rachid.khalil@example.com\'),
                    (26, \'Khelifi\', \'Rima\', \'Femme\', \'654 Boulevard de la Mer\', \'0536789012\', \'1987-02-14\', \'Sète\', \'Licence\', \'Physique\', NULL, NULL, \'rima.khelifi@example.com\'),
                    (27, \'Belarbi\', \'Farid\', \'Homme\', \'987 Place du Marché\', \'0612345678\', \'1989-03-18\', \'Quimper\', \'Master\', \'Biologie\', NULL, NULL, \'farid.belarbi@example.com\'),
                    (28, \'Moulin\', \'Amina\', \'Femme\', \'852 Avenue des Arbres\', \'0698123456\', \'1993-04-22\', \'Albi\', \'Doctorat\', \'Histoire\', NULL, NULL, \'amina.moulin@example.com\'),
                    (29, \'Garaoui\', \'Nabil\', \'Homme\', \'321 Boulevard des Fleurs\', \'0543219876\', \'1990-07-15\', \'Lourdes\', \'Licence\', \'Médecine\', NULL, NULL, \'nabil.garaoui@example.com\'),
                    (30, \'Khemiri\', \'Sabrina\', \'Femme\', \'654 Chemin des Oliviers\', \'0678901234\', \'1988-05-19\', \'Aix-les-Bains\', \'Master\', \'Marketing\', NULL, NULL,\'nabil.garaoui@example.com\')');
                    
        $this->addSql('
                        INSERT INTO chambre (nom, etat, statut, batiment_id, localisation, position, created_at, updated_at) VALUES
                        (\'Chambre 101\', \'Libre\', \'Disponible\', 1, \'Étage 1\', \'À gauche\', NULL, NULL),
                        (\'Chambre 102\', \'Occupée\', \'Non disponible\', 1, \'Étage 1\', \'À droite\', NULL, NULL),
                        (\'Chambre 103\', \'Libre\', \'Disponible\', 1, \'Étage 2\', \'Au centre\', NULL, NULL),
                        (\'Chambre 104\', \'En maintenance\', \'Non disponible\', 1, \'Étage 2\', \'À gauche\', NULL, NULL),
                        (\'Chambre 105\', \'Libre\', \'Disponible\', 1, \'Étage 3\', \'À droite\', NULL, NULL),
                        (\'Chambre 106\', \'Occupée\', \'Non disponible\', 1, \'Étage 3\', \'Au centre\', NULL, NULL),
                        (\'Chambre 201\', \'Libre\', \'Disponible\', 2, \'Étage 1\', \'À gauche\', NULL, NULL),
                        (\'Chambre 202\', \'Occupée\', \'Non disponible\', 2, \'Étage 1\', \'À droite\', NULL, NULL),
                        (\'Chambre 203\', \'Libre\', \'Disponible\', 2, \'Étage 2\', \'Au centre\', NULL, NULL),
                        (\'Chambre 204\', \'En maintenance\', \'Non disponible\', 2, \'Étage 2\', \'À gauche\', NULL, NULL),
                        (\'Chambre 205\', \'Libre\', \'Disponible\', 2, \'Étage 3\', \'À droite\', NULL, NULL),
                        (\'Chambre 206\', \'Occupée\', \'Non disponible\', 2, \'Étage 3\', \'Au centre\', NULL, NULL),
                        (\'Chambre 301\', \'Libre\', \'Disponible\', 3, \'Étage 1\', \'À gauche\', NULL, NULL),
                        (\'Chambre 302\', \'Occupée\', \'Non disponible\', 3, \'Étage 1\', \'À droite\', NULL, NULL),
                        (\'Chambre 303\', \'Libre\', \'Disponible\', 3, \'Étage 2\', \'Au centre\', NULL, NULL),
                        (\'Chambre 304\', \'En maintenance\', \'Non disponible\', 3, \'Étage 2\', \'À gauche\', NULL, NULL),
                        (\'Chambre 305\', \'Libre\', \'Disponible\', 3, \'Étage 3\', \'À droite\', NULL, NULL),
                        (\'Chambre 306\', \'Occupée\', \'Non disponible\', 3, \'Étage 3\', \'Au centre\', NULL, NULL),
                        (\'Chambre 401\', \'Libre\', \'Disponible\', 2, \'Étage 1\', \'À gauche\', NULL, NULL),
                        (\'Chambre 402\', \'Occupée\', \'Non disponible\', 1, \'Étage 1\', \'À droite\', NULL, NULL),
                        (\'Chambre 403\', \'Libre\', \'Disponible\', 1, \'Étage 2\', \'Au centre\', NULL, NULL),
                        (\'Chambre 404\', \'En maintenance\', \'Non disponible\', 4, \'Étage 2\', \'À gauche\', NULL, NULL),
                        (\'Chambre 405\', \'Libre\', \'Disponible\', 2, \'Étage 3\', \'À droite\', NULL, NULL),
                        (\'Chambre 406\', \'Occupée\', \'Non disponible\', 3, \'Étage 3\', \'Au centre\', NULL, NULL),
                        (\'Chambre 501\', \'Libre\', \'Disponible\', 3, \'Étage 1\', \'À gauche\', NULL, NULL),
                        (\'Chambre 502\', \'Occupée\', \'Non disponible\', 5, \'Étage 1\', \'À droite\', NULL, NULL),
                        (\'Chambre 503\', \'Libre\', \'Disponible\', 3, \'Étage 2\', \'Au centre\', NULL, NULL),
                        (\'Chambre 504\', \'En maintenance\', \'Non disponible\', 1, \'Étage 2\', \'À gauche\', NULL, NULL),
                        (\'Chambre 505\', \'Libre\', \'Disponible\', 1, \'Étage 3\', \'À droite\', NULL, NULL),
                        (\'Chambre 506\', \'Occupée\', \'Non disponible\', 3, \'Étage 3\', \'Au centre\', NULL, NULL),
                        (\'Chambre 601\', \'Libre\', \'Disponible\', 1, \'Étage 1\', \'À gauche\', NULL, NULL),
                        (\'Chambre 602\', \'Occupée\', \'Non disponible\', 1, \'Étage 1\', \'À droite\', NULL, NULL),
                        (\'Chambre 603\', \'Libre\', \'Disponible\', 1, \'Étage 2\', \'Au centre\', NULL, NULL),
                        (\'Chambre 604\', \'En maintenance\', \'Non disponible\', 3, \'Étage 2\', \'À gauche\', NULL, NULL),
                        (\'Chambre 605\', \'Libre\', \'Disponible\', 2, \'Étage 3\', \'À droite\', NULL, NULL),
                        (\'Chambre 606\', \'Occupée\', \'Non disponible\', 2, \'Étage 3\', \'Au centre\', NULL, NULL),
                        (\'Chambre 701\', \'Libre\', \'Disponible\', 2, \'Étage 1\', \'À gauche\', NULL, NULL),
                        (\'Chambre 702\', \'Occupée\', \'Non disponible\', 3, \'Étage 1\', \'À droite\', NULL, NULL),
                        (\'Chambre 703\', \'Libre\', \'Disponible\', 3, \'Étage 2\', \'Au centre\', NULL, NULL),
                        (\'Chambre 704\', \'En maintenance\', \'Non disponible\', 4, \'Étage 2\', \'À gauche\', NULL, NULL),
                        (\'Chambre 705\', \'Libre\', \'Disponible\', 3, \'Étage 3\', \'À droite\', NULL, NULL),
                        (\'Chambre 706\', \'Occupée\', \'Non disponible\', 3, \'Étage 3\', \'Au centre\', NULL, NULL)
                    ');
                    
       $this->addSql('
                        INSERT INTO chambre_locataire (chambre_id, locataire_id, annee_academique_id, duree_occupation, created_at, updated_at) VALUES
                        (1, 1, 1, 12, NULL, NULL),
                        (2, 2, 1, 6, NULL, NULL),
                        (3, 3, 1, 9, NULL, NULL),
                        (4, 4, 1, 12, NULL, NULL),
                        (5, 5, 2, 6, NULL, NULL),
                        (6, 6, 2, 9, NULL, NULL),
                        (7, 7, 1, 12, NULL, NULL),
                        (8, 8, 2, 6, NULL, NULL),
                        (9, 9, 1, 9, NULL, NULL),
                        (10, 10, 2, 12, NULL, NULL),
                        (11, 11, 1, 6, NULL, NULL),
                        (12, 12, 2, 9, NULL, NULL),
                        (13, 13, 1, 12, NULL, NULL),
                        (14, 14, 2, 6, NULL, NULL),
                        (15, 15, 1, 9, NULL, NULL),
                        (16, 16, 2, 12, NULL, NULL),
                        (17, 17, 1, 6, NULL, NULL),
                        (18, 18, 2, 9, NULL, NULL),
                        (19, 19, 1, 12, NULL, NULL),
                        (20, 20, 2, 6, NULL, NULL),
                        (21, 21, 1, 9, NULL, NULL),
                        (22, 22, 2, 12, NULL, NULL),
                        (23, 23, 1, 6, NULL, NULL),
                        (24, 24, 2, 9, NULL, NULL),
                        (25, 25, 1, 12, NULL, NULL),
                        (26, 26, 2, 6, NULL, NULL),
                        (27, 27, 1, 9, NULL, NULL),
                        (28, 28, 2, 12, NULL, NULL),
                        (29, 29, 1, 6, NULL, NULL),
                        (30, 30, 2, 9, NULL, NULL)
       ');
       $this->addSql('
                    INSERT INTO tranche ( nom, description, created_at, updated_at) VALUES
                    (\'Tranche 1\', \'Description de la tranche 1\', NULL, NULL),
                    (\'Tranche 2\', \'Description de la tranche 2\', NULL, NULL),
                    (\'Tranche 3\', \'Description de la tranche 3\', NULL, NULL),
                    (\'Tranche 4\', \'Description de la tranche 4\', NULL, NULL),
                    (\'Tranche 5\', \'Description de la tranche 5\', NULL, NULL),
                    (\'Tranche 6\', \'Description de la tranche 6\', NULL, NULL)
                    
                
                ');
        
                $this->addSql('
                    INSERT INTO paiement (id, chambre_locataire_id, montant, tranche_id, user_id, date_encaissement, date_de_paiement_banque, created_at, updated_at, annee_academique_id, date_de_paiement_banque) VALUES
                    (1, 1, 150, 1, 1, \'2024-01-15\', \'2024-01-16\', NULL, NULL, 1, \'2024-01-16\'),
                    (2, 2, 200, 1, 2, \'2024-01-16\', \'2024-01-17\', NULL, NULL, 1, \'2024-01-17\'),
                    (3, 3, 175, 2, 3, \'2024-01-17\', \'2024-01-18\', NULL, NULL, 2, \'2024-01-18\'),
                    (4, 4, 250, 2, 4, \'2024-01-18\', \'2024-01-19\', NULL, NULL, 2, \'2024-01-19\'),
                    (5, 5, 300, 3, 5, \'2024-01-19\', \'2024-01-20\', NULL, NULL, 3, \'2024-01-20\'),
                    (6, 6, 180, 3, 6, \'2024-01-20\', \'2024-01-21\', NULL, NULL, 3, \'2024-01-21\'),
                    (7, 7, 220, 4, 7, \'2024-01-21\', \'2024-01-22\', NULL, NULL, 4, \'2024-01-22\'),
                    (8, 8, 240, 4, 8, \'2024-01-22\', \'2024-01-23\', NULL, NULL, 4, \'2024-01-23\'),
                    (9, 9, 260, 5, 9, \'2024-01-23\', \'2024-01-24\', NULL, NULL, 5, \'2024-01-24\'),
                    (10, 10, 210, 5, 10, \'2024-01-24\', \'2024-01-25\', NULL, NULL, 5, \'2024-01-25\'),
                    (11, 1, 150, 1, 11, \'2024-02-01\', \'2024-02-02\', NULL, NULL, 1, \'2024-02-02\'),
                    (12, 2, 200, 1, 12, \'2024-02-02\', \'2024-02-03\', NULL, NULL, 1, \'2024-02-03\'),
                    (13, 3, 175, 2, 13, \'2024-02-03\', \'2024-02-04\', NULL, NULL, 2, \'2024-02-04\'),
                    (14, 4, 250, 2, 14, \'2024-02-04\', \'2024-02-05\', NULL, NULL, 2, \'2024-02-05\'),
                    (15, 5, 300, 3, 15, \'2024-02-05\', \'2024-02-06\', NULL, NULL, 3, \'2024-02-06\'),
                    (16, 6, 180, 3, 16, \'2024-02-06\', \'2024-02-07\', NULL, NULL, 3, \'2024-02-07\'),
                    (17, 7, 220, 4, 17, \'2024-02-07\', \'2024-02-08\', NULL, NULL, 4, \'2024-02-08\'),
                    (18, 8, 240, 4, 18, \'2024-02-08\', \'2024-02-09\', NULL, NULL, 4, \'2024-02-09\'),
                    (19, 9, 260, 5, 19, \'2024-02-09\', \'2024-02-10\', NULL, NULL, 5, \'2024-02-10\'),
                    (20, 10, 210, 5, 20, \'2024-02-10\', \'2024-02-11\', NULL, NULL, 5, \'2024-02-11\'),
                    (21, 1, 150, 1, 21, \'2024-03-01\', \'2024-03-02\', NULL, NULL, 1, \'2024-03-02\'),
                    (22, 2, 200, 1, 22, \'2024-03-02\', \'2024-03-03\', NULL, NULL, 1, \'2024-03-03\'),
                    (23, 3, 175, 2, 23, \'2024-03-03\', \'2024-03-04\', NULL, NULL, 2, \'2024-03-04\'),
                    (24, 4, 250, 2, 24, \'2024-03-04\', \'2024-03-05\', NULL, NULL, 2, \'2024-03-05\'),
                    (25, 5, 300, 3, 25, \'2024-03-05\', \'2024-03-06\', NULL, NULL, 3, \'2024-03-06\'),
                    (26, 6, 180, 3, 26, \'2024-03-06\', \'2024-03-07\', NULL, NULL, 3, \'2024-03-07\'),
                    (27, 7, 220, 4, 27, \'2024-03-07\', \'2024-03-08\', NULL, NULL, 4, \'2024-03-08\'),
                    (28, 8, 240, 4, 28, \'2024-03-08\', \'2024-03-09\', NULL, NULL, 4, \'2024-03-09\'),
                    (29, 9, 260, 5, 29, \'2024-03-09\', \'2024-03-10\', NULL, NULL, 5, \'2024-03-10\'),
                    (30, 10, 210, 5, 30, \'2024-03-10\', \'2024-03-11\', NULL, NULL, 5, \'2024-03-11\')
            ');
            

                
            }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE annee_academiques');
        $this->addSql('DROP TABLE bailleurs');
        $this->addSql('DROP TABLE batiment');
        $this->addSql('DROP TABLE chambre');
        $this->addSql('DROP TABLE chambre_locataire');
        $this->addSql('DROP TABLE chambre_permutation');
        $this->addSql('DROP TABLE contrats');
        $this->addSql('DROP TABLE depense');
        $this->addSql('DROP TABLE depense_realisation');
        $this->addSql('DROP TABLE locataire');
        //$this->addSql('DROP TABLE paiement');
        $this->addSql('DROP TABLE realisation');
        $this->addSql('DROP TABLE realisation_chambre');
        $this->addSql('DROP TABLE tranche');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
