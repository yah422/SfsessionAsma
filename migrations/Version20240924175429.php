<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240924175429 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE programme (id INT AUTO_INCREMENT NOT NULL, duree INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE programme_module (programme_id INT NOT NULL, module_id INT NOT NULL, INDEX IDX_14A07B0262BB7AEE (programme_id), INDEX IDX_14A07B02AFC2B591 (module_id), PRIMARY KEY(programme_id, module_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE programme_session (programme_id INT NOT NULL, session_id INT NOT NULL, INDEX IDX_BE7985F62BB7AEE (programme_id), INDEX IDX_BE7985F613FECDF (session_id), PRIMARY KEY(programme_id, session_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE programme_module ADD CONSTRAINT FK_14A07B0262BB7AEE FOREIGN KEY (programme_id) REFERENCES programme (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE programme_module ADD CONSTRAINT FK_14A07B02AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE programme_session ADD CONSTRAINT FK_BE7985F62BB7AEE FOREIGN KEY (programme_id) REFERENCES programme (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE programme_session ADD CONSTRAINT FK_BE7985F613FECDF FOREIGN KEY (session_id) REFERENCES session (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE session ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D4BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_D044D5D4BCF5E72D ON session (categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D4BCF5E72D');
        $this->addSql('ALTER TABLE programme_module DROP FOREIGN KEY FK_14A07B0262BB7AEE');
        $this->addSql('ALTER TABLE programme_module DROP FOREIGN KEY FK_14A07B02AFC2B591');
        $this->addSql('ALTER TABLE programme_session DROP FOREIGN KEY FK_BE7985F62BB7AEE');
        $this->addSql('ALTER TABLE programme_session DROP FOREIGN KEY FK_BE7985F613FECDF');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE programme');
        $this->addSql('DROP TABLE programme_module');
        $this->addSql('DROP TABLE programme_session');
        $this->addSql('DROP INDEX IDX_D044D5D4BCF5E72D ON session');
        $this->addSql('ALTER TABLE session DROP categorie_id');
    }
}
