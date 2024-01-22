<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240122160742 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
//         this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE plats ADD categorie_plat_id INT NOT NULL, DROP categorie');
        $this->addSql('ALTER TABLE plats ADD CONSTRAINT FK_854A620A88BE1BC2 FOREIGN KEY (categorie_plat_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_854A620A88BE1BC2 ON plats (categorie_plat_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plats DROP FOREIGN KEY FK_854A620A88BE1BC2');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP INDEX IDX_854A620A88BE1BC2 ON plats');
        $this->addSql('ALTER TABLE plats ADD categorie VARCHAR(8) NOT NULL, DROP categorie_plat_id');
    }
}
