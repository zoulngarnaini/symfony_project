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
        $this->addSql('CREATE TABLE locataire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, genre VARCHAR(10) NOT NULL, adresse VARCHAR(255) NOT NULL, telephone VARCHAR(20) NOT NULL, date_naissance DATE NOT NULL, lieu_naissance VARCHAR(255) NOT NULL, niveau VARCHAR(255) NOT NULL, filiere VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL)');
        $this->addSql('CREATE TABLE paiement (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, chambre_locataire_id INTEGER NOT NULL, tranche_id INTEGER NOT NULL, user_id INTEGER NOT NULL, montant DOUBLE PRECISION NOT NULL, date_encaissement DATETIME NOT NULL, dateDePaiementBanque DATETIME  NULL, created_at DATETIME  NULL, updated_at DATETIME  NULL, CONSTRAINT FK_B1DC7A1E115EAC61 FOREIGN KEY (chambre_locataire_id) REFERENCES chambre_locataire (id)  DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_B1DC7A1EB76F6B31 FOREIGN KEY (tranche_id) REFERENCES tranche (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_B1DC7A1EA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
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
                        (3, \'Bâtiment C\', \'Bâtiment annexe avec 2 faces\', 2)
                    ');

               
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
                        (\'Chambre 401\', \'Libre\', \'Disponible\', 4, \'Étage 1\', \'À gauche\', NULL, NULL),
                        (\'Chambre 402\', \'Occupée\', \'Non disponible\', 4, \'Étage 1\', \'À droite\', NULL, NULL),
                        (\'Chambre 403\', \'Libre\', \'Disponible\', 4, \'Étage 2\', \'Au centre\', NULL, NULL),
                        (\'Chambre 404\', \'En maintenance\', \'Non disponible\', 4, \'Étage 2\', \'À gauche\', NULL, NULL),
                        (\'Chambre 405\', \'Libre\', \'Disponible\', 4, \'Étage 3\', \'À droite\', NULL, NULL),
                        (\'Chambre 406\', \'Occupée\', \'Non disponible\', 4, \'Étage 3\', \'Au centre\', NULL, NULL),
                        (\'Chambre 501\', \'Libre\', \'Disponible\', 5, \'Étage 1\', \'À gauche\', NULL, NULL),
                        (\'Chambre 502\', \'Occupée\', \'Non disponible\', 5, \'Étage 1\', \'À droite\', NULL, NULL),
                        (\'Chambre 503\', \'Libre\', \'Disponible\', 5, \'Étage 2\', \'Au centre\', NULL, NULL),
                        (\'Chambre 504\', \'En maintenance\', \'Non disponible\', 5, \'Étage 2\', \'À gauche\', NULL, NULL),
                        (\'Chambre 505\', \'Libre\', \'Disponible\', 5, \'Étage 3\', \'À droite\', NULL, NULL),
                        (\'Chambre 506\', \'Occupée\', \'Non disponible\', 5, \'Étage 3\', \'Au centre\', NULL, NULL),
                        (\'Chambre 601\', \'Libre\', \'Disponible\', 6, \'Étage 1\', \'À gauche\', NULL, NULL),
                        (\'Chambre 602\', \'Occupée\', \'Non disponible\', 6, \'Étage 1\', \'À droite\', NULL, NULL),
                        (\'Chambre 603\', \'Libre\', \'Disponible\', 6, \'Étage 2\', \'Au centre\', NULL, NULL),
                        (\'Chambre 604\', \'En maintenance\', \'Non disponible\', 6, \'Étage 2\', \'À gauche\', NULL, NULL),
                        (\'Chambre 605\', \'Libre\', \'Disponible\', 6, \'Étage 3\', \'À droite\', NULL, NULL),
                        (\'Chambre 606\', \'Occupée\', \'Non disponible\', 6, \'Étage 3\', \'Au centre\', NULL, NULL),
                        (\'Chambre 701\', \'Libre\', \'Disponible\', 7, \'Étage 1\', \'À gauche\', NULL, NULL),
                        (\'Chambre 702\', \'Occupée\', \'Non disponible\', 7, \'Étage 1\', \'À droite\', NULL, NULL),
                        (\'Chambre 703\', \'Libre\', \'Disponible\', 7, \'Étage 2\', \'Au centre\', NULL, NULL),
                        (\'Chambre 704\', \'En maintenance\', \'Non disponible\', 7, \'Étage 2\', \'À gauche\', NULL, NULL),
                        (\'Chambre 705\', \'Libre\', \'Disponible\', 7, \'Étage 3\', \'À droite\', NULL, NULL),
                        (\'Chambre 706\', \'Occupée\', \'Non disponible\', 7, \'Étage 3\', \'Au centre\', NULL, NULL)
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
                INSERT INTO paiement (id, chambre_locataire_id, montant, tranche_id, user_id, date_encaissement, dateDePaiementBanque, created_at, updated_at) VALUES
                (1, 1, 150, 1, 1, \'2024-01-15\', \'2024-01-16\', NULL, NULL),
                (2, 2, 200, 1, 2, \'2024-01-16\', \'2024-01-17\', NULL, NULL),
                (3, 3, 175, 2, 3, \'2024-01-17\', \'2024-01-18\', NULL, NULL),
                (4, 4, 250, 2, 4, \'2024-01-18\', \'2024-01-19\', NULL, NULL),
                (5, 5, 300, 3, 5, \'2024-01-19\', \'2024-01-20\', NULL, NULL),
                (6, 6, 180, 3, 6, \'2024-01-20\', \'2024-01-21\', NULL, NULL),
                (7, 7, 220, 4, 7, \'2024-01-21\', \'2024-01-22\', NULL, NULL),
                (8, 8, 240, 4, 8, \'2024-01-22\', \'2024-01-23\', NULL, NULL),
                (9, 9, 260, 5, 9, \'2024-01-23\', \'2024-01-24\', NULL, NULL),
                (10, 10, 210, 5, 10, \'2024-01-24\', \'2024-01-25\', NULL, NULL),
                (11, 1, 150, 1, 11, \'2024-02-01\', \'2024-02-02\', NULL, NULL),
                (12, 2, 200, 1, 12, \'2024-02-02\', \'2024-02-03\', NULL, NULL),
                (13, 3, 175, 2, 13, \'2024-02-03\', \'2024-02-04\', NULL, NULL),
                (14, 4, 250, 2, 14, \'2024-02-04\', \'2024-02-05\', NULL, NULL),
                (15, 5, 300, 3, 15, \'2024-02-05\', \'2024-02-06\', NULL, NULL),
                (16, 6, 180, 3, 16, \'2024-02-06\', \'2024-02-07\', NULL, NULL),
                (17, 7, 220, 4, 17, \'2024-02-07\', \'2024-02-08\', NULL, NULL),
                (18, 8, 240, 4, 18, \'2024-02-08\', \'2024-02-09\', NULL, NULL),
                (19, 9, 260, 5, 19, \'2024-02-09\', \'2024-02-10\', NULL, NULL),
                (20, 10, 210, 5, 20, \'2024-02-10\', \'2024-02-11\', NULL, NULL),
                (21, 1, 150, 1, 21, \'2024-03-01\', \'2024-03-02\', NULL, NULL),
                (22, 2, 200, 1, 22, \'2024-03-02\', \'2024-03-03\', NULL, NULL),
                (23, 3, 175, 2, 23, \'2024-03-03\', \'2024-03-04\', NULL, NULL),
                (24, 4, 250, 2, 24, \'2024-03-04\', \'2024-03-05\', NULL, NULL),
                (25, 5, 300, 3, 25, \'2024-03-05\', \'2024-03-06\', NULL, NULL),
                (26, 6, 180, 3, 26, \'2024-03-06\', \'2024-03-07\', NULL, NULL),
                (27, 7, 220, 4, 27, \'2024-03-07\', \'2024-03-08\', NULL, NULL),
                (28, 8, 240, 4, 28, \'2024-03-08\', \'2024-03-09\', NULL, NULL),
                (29, 9, 260, 5, 29, \'2024-03-09\', \'2024-03-10\', NULL, NULL),
                (30, 10, 210, 5, 30, \'2024-03-10\', \'2024-03-11\', NULL, NULL)
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
        $this->addSql('DROP TABLE paiement');
        $this->addSql('DROP TABLE realisation');
        $this->addSql('DROP TABLE realisation_chambre');
        $this->addSql('DROP TABLE tranche');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
