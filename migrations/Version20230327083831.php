<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230327083831 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coordinateur ADD lycee_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE coordinateur ADD CONSTRAINT FK_83AD9AC4D1DC61BF FOREIGN KEY (lycee_id) REFERENCES lycee (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_83AD9AC4D1DC61BF ON coordinateur (lycee_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coordinateur DROP FOREIGN KEY FK_83AD9AC4D1DC61BF');
        $this->addSql('DROP INDEX UNIQ_83AD9AC4D1DC61BF ON coordinateur');
        $this->addSql('ALTER TABLE coordinateur DROP lycee_id');
    }
}
