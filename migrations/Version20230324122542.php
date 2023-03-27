<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230324122542 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE epreuve ADD center_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE epreuve ADD CONSTRAINT FK_D6ADE47F5932F377 FOREIGN KEY (center_id) REFERENCES centre (id)');
        $this->addSql('CREATE INDEX IDX_D6ADE47F5932F377 ON epreuve (center_id)');
        $this->addSql('ALTER TABLE jury ADD epreuve_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE jury ADD CONSTRAINT FK_1335B02CAB990336 FOREIGN KEY (epreuve_id) REFERENCES epreuve (id)');
        $this->addSql('CREATE INDEX IDX_1335B02CAB990336 ON jury (epreuve_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE epreuve DROP FOREIGN KEY FK_D6ADE47F5932F377');
        $this->addSql('DROP INDEX IDX_D6ADE47F5932F377 ON epreuve');
        $this->addSql('ALTER TABLE epreuve DROP center_id');
        $this->addSql('ALTER TABLE jury DROP FOREIGN KEY FK_1335B02CAB990336');
        $this->addSql('DROP INDEX IDX_1335B02CAB990336 ON jury');
        $this->addSql('ALTER TABLE jury DROP epreuve_id');
    }
}
