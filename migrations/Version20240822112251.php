public function up(Schema $schema): void
{
    // this up() migration is auto-generated, please modify it to your needs
    $this->addSql('CREATE TABLE chambres (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, etat VARCHAR(255) NOT NULL, statut VARCHAR(255) NOT NULL, batiment_id INT NOT NULL, localisation VARCHAR(255) NOT NULL, position VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id))');
}

public function down(Schema $schema): void
{
    // this down() migration is auto-generated, please modify it to your needs
    $this->addSql('DROP TABLE chambres');
}
