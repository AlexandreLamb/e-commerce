<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190430131213 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE carte_bleu (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, numero LONGTEXT NOT NULL, crypto INT NOT NULL, date_validite LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_6E6DF159A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE carte_bleu ADD CONSTRAINT FK_6E6DF159A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE product ADD acheteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD96A7BB5F FOREIGN KEY (acheteur_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD96A7BB5F ON product (acheteur_id)');
        $this->addSql('ALTER TABLE user ADD userlastname LONGTEXT NOT NULL, ADD adresse LONGTEXT NOT NULL, ADD ville LONGTEXT NOT NULL, ADD telephone LONGTEXT NOT NULL, ADD date_naissance DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE carte_bleu');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD96A7BB5F');
        $this->addSql('DROP INDEX IDX_D34A04AD96A7BB5F ON product');
        $this->addSql('ALTER TABLE product DROP acheteur_id');
        $this->addSql('ALTER TABLE user DROP userlastname, DROP adresse, DROP ville, DROP telephone, DROP date_naissance');
    }
}
