<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240927142513 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE session_module (session_id INT NOT NULL, module_id INT NOT NULL, INDEX IDX_634F2C71613FECDF (session_id), INDEX IDX_634F2C71AFC2B591 (module_id), PRIMARY KEY(session_id, module_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE session_module ADD CONSTRAINT FK_634F2C71613FECDF FOREIGN KEY (session_id) REFERENCES session (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE session_module ADD CONSTRAINT FK_634F2C71AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE session_module DROP FOREIGN KEY FK_634F2C71613FECDF');
        $this->addSql('ALTER TABLE session_module DROP FOREIGN KEY FK_634F2C71AFC2B591');
        $this->addSql('DROP TABLE session_module');
    }
}
