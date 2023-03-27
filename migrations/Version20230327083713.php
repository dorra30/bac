<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230327083713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lycee ADD diecteur_id INT DEFAULT NULL, ADD coordinateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lycee ADD CONSTRAINT FK_E314FD0BC7F26904 FOREIGN KEY (diecteur_id) REFERENCES directeur (id)');
        $this->addSql('ALTER TABLE lycee ADD CONSTRAINT FK_E314FD0BD32E46EA FOREIGN KEY (coordinateur_id) REFERENCES coordinateur (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E314FD0BC7F26904 ON lycee (diecteur_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E314FD0BD32E46EA ON lycee (coordinateur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lycee DROP FOREIGN KEY FK_E314FD0BC7F26904');
        $this->addSql('ALTER TABLE lycee DROP FOREIGN KEY FK_E314FD0BD32E46EA');
        $this->addSql('DROP INDEX UNIQ_E314FD0BC7F26904 ON lycee');
        $this->addSql('DROP INDEX UNIQ_E314FD0BD32E46EA ON lycee');
        $this->addSql('ALTER TABLE lycee DROP diecteur_id, DROP coordinateur_id');
    }
}
