<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240823XXXXXX extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create tables for Depense and Realisations entities';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs

        $this->addSql('CREATE TABLE depense (id INT AUTO_INCREMENT NOT NULL, chambre_id INT NOT NULL, description VARCHAR(255) NOT NULL, montant DOUBLE PRECISION NOT NULL, date DATETIME NOT NULL, INDEX IDX_XXXXXXX (chambre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE realisations (id INT AUTO_INCREMENT NOT NULL, chambre_id INT NOT NULL, description VARCHAR(255) NOT NULL, date DATETIME NOT NULL, INDEX IDX_XXXXXXX (chambre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE depense ADD CONSTRAINT FK_XXXXXXX FOREIGN KEY (chambre_id) REFERENCES chambre (id)');
        $this->addSql('ALTER TABLE realisations ADD CONSTRAINT FK_XXXXXXX FOREIGN KEY (chambre_id) REFERENCES chambre (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

        $this->addSql('DROP TABLE depense');
        $this->addSql('DROP TABLE realisations');
    }
}
