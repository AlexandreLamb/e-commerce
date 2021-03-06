<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190429112716 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product ADD vendeur_id INT NOT NULL, ADD categorie LONGTEXT NOT NULL, ADD nbr_ventes LONGTEXT NOT NULL, ADD photo LONGBLOB DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD858C065E FOREIGN KEY (vendeur_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD858C065E ON product (vendeur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD858C065E');
        $this->addSql('DROP INDEX IDX_D34A04AD858C065E ON product');
        $this->addSql('ALTER TABLE product DROP vendeur_id, DROP categorie, DROP nbr_ventes, DROP photo');
    }
}
