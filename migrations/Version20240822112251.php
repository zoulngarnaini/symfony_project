<?php

public function up(Schema $schema): void
{
    // this up() migration is auto-generated, please modify it to your needs
    $this->addSql('CREATE TABLE annee_academiques (
                    id bigint(20) UNSIGNED NOT NULL,
                    `nom` varchar(255) NOT NULL,
                    `description` varchar(255) DEFAULT NULL,
                    `date_rentree` date DEFAULT NULL,
                    `evenements` varchar(255) DEFAULT NULL,
                    `created_at` timestamp NULL DEFAULT NULL,
                    `updated_at` timestamp NULL DEFAULT NULL
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
    $this->addSql('');
    $this->addSql('');
    $this->addSql('');
    $this->addSql('');
    $this->addSql('');
    $this->addSql('');
    $this->addSql('');
    $this->addSql('');
    $this->addSql('');
    $this->addSql('');
    $this->addSql('');
    $this->addSql('');
    $this->addSql('');
    $this->addSql('');
    $this->addSql('');
    $this->addSql('');
}

public function down(Schema $schema): void
{
    // this down() migration is auto-generated, please modify it to your needs
    $this->addSql('DROP TABLE chambres');
}
