<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230324125420 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE directeur ADD lycee_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE directeur ADD CONSTRAINT FK_937C8E43D1DC61BF FOREIGN KEY (lycee_id) REFERENCES lycee (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_937C8E43D1DC61BF ON directeur (lycee_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE directeur DROP FOREIGN KEY FK_937C8E43D1DC61BF');
        $this->addSql('DROP INDEX UNIQ_937C8E43D1DC61BF ON directeur');
        $this->addSql('ALTER TABLE directeur DROP lycee_id');
    }
}
