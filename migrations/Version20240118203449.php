<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240118203449 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie_plats DROP FOREIGN KEY FK_70328FDAAA14E1C8');
        $this->addSql('ALTER TABLE categorie_plats DROP FOREIGN KEY FK_70328FDABCF5E72D');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE categorie_plats');
        $this->addSql('ALTER TABLE plats CHANGE categorie categorie VARCHAR(8) NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD nom VARCHAR(50) NOT NULL, ADD prenom VARCHAR(50) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, libelle_cat VARCHAR(100) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE categorie_plats (categorie_id INT NOT NULL, plats_id INT NOT NULL, INDEX IDX_70328FDAAA14E1C8 (plats_id), INDEX IDX_70328FDABCF5E72D (categorie_id), PRIMARY KEY(categorie_id, plats_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE categorie_plats ADD CONSTRAINT FK_70328FDAAA14E1C8 FOREIGN KEY (plats_id) REFERENCES plats (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_plats ADD CONSTRAINT FK_70328FDABCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plats CHANGE categorie categorie VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE utilisateur DROP nom, DROP prenom');
    }
}
