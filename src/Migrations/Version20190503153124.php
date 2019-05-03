<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190503153124 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE attachments (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, filename LONGTEXT NOT NULL, INDEX IDX_47C4FAD64584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carte_bleu (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, numero LONGTEXT NOT NULL, crypto INT NOT NULL, date_validite LONGTEXT NOT NULL, type LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_6E6DF159A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE panier (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, product_id INT NOT NULL, quantite_product INT NOT NULL, INDEX IDX_24CC0DF2A76ED395 (user_id), INDEX IDX_24CC0DF24584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, vendeur_id INT DEFAULT NULL, acheteur_id INT DEFAULT NULL, description LONGTEXT NOT NULL, price INT NOT NULL, name LONGTEXT NOT NULL, categorie LONGTEXT NOT NULL, nbr_ventes LONGTEXT NOT NULL, img LONGTEXT DEFAULT NULL, quantite INT NOT NULL, INDEX IDX_D34A04AD858C065E (vendeur_id), INDEX IDX_D34A04AD96A7BB5F (acheteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, pain_password VARCHAR(255) NOT NULL, userlastname LONGTEXT NOT NULL, adresse LONGTEXT NOT NULL, ville LONGTEXT NOT NULL, telephone LONGTEXT NOT NULL, date_naissance DATETIME DEFAULT NULL, pays LONGTEXT NOT NULL, code_postale INT NOT NULL, type_user LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attachments ADD CONSTRAINT FK_47C4FAD64584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE carte_bleu ADD CONSTRAINT FK_6E6DF159A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF24584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD858C065E FOREIGN KEY (vendeur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD96A7BB5F FOREIGN KEY (acheteur_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE attachments DROP FOREIGN KEY FK_47C4FAD64584665A');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF24584665A');
        $this->addSql('ALTER TABLE carte_bleu DROP FOREIGN KEY FK_6E6DF159A76ED395');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF2A76ED395');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD858C065E');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD96A7BB5F');
        $this->addSql('DROP TABLE attachments');
        $this->addSql('DROP TABLE carte_bleu');
        $this->addSql('DROP TABLE panier');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE user');
    }
}
