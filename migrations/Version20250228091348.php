<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250228091348 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE film_utilisateur (id INT AUTO_INCREMENT NOT NULL, film_id INT DEFAULT NULL, utilisateur_id INT DEFAULT NULL, date_ajout DATETIME DEFAULT NULL, INDEX IDX_65A44EBC567F5183 (film_id), INDEX IDX_65A44EBCFB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE film_utilisateur ADD CONSTRAINT FK_65A44EBC567F5183 FOREIGN KEY (film_id) REFERENCES film (id)');
        $this->addSql('ALTER TABLE film_utilisateur ADD CONSTRAINT FK_65A44EBCFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE utilisateur_film DROP FOREIGN KEY FK_4BC5D218567F5183');
        $this->addSql('ALTER TABLE utilisateur_film DROP FOREIGN KEY FK_4BC5D218FB88E14F');
        $this->addSql('DROP TABLE utilisateur_film');
        $this->addSql('ALTER TABLE film CHANGE titre titre VARCHAR(30) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE utilisateur_film (utilisateur_id INT NOT NULL, film_id INT NOT NULL, INDEX IDX_4BC5D218FB88E14F (utilisateur_id), INDEX IDX_4BC5D218567F5183 (film_id), PRIMARY KEY(utilisateur_id, film_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE utilisateur_film ADD CONSTRAINT FK_4BC5D218567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_film ADD CONSTRAINT FK_4BC5D218FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_utilisateur DROP FOREIGN KEY FK_65A44EBC567F5183');
        $this->addSql('ALTER TABLE film_utilisateur DROP FOREIGN KEY FK_65A44EBCFB88E14F');
        $this->addSql('DROP TABLE film_utilisateur');
        $this->addSql('ALTER TABLE film CHANGE titre titre VARCHAR(50) DEFAULT NULL');
    }
}
