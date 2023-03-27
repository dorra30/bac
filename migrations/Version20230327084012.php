<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230327084012 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE center (id INT AUTO_INCREMENT NOT NULL, inspecteur_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_40F0EB24B7728AA0 (inspecteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE center ADD CONSTRAINT FK_40F0EB24B7728AA0 FOREIGN KEY (inspecteur_id) REFERENCES inspecteur (id)');
        $this->addSql('ALTER TABLE inspecteur ADD center_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inspecteur ADD CONSTRAINT FK_54C76B755932F377 FOREIGN KEY (center_id) REFERENCES center (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_54C76B755932F377 ON inspecteur (center_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inspecteur DROP FOREIGN KEY FK_54C76B755932F377');
        $this->addSql('ALTER TABLE center DROP FOREIGN KEY FK_40F0EB24B7728AA0');
        $this->addSql('DROP TABLE center');
        $this->addSql('DROP INDEX UNIQ_54C76B755932F377 ON inspecteur');
        $this->addSql('ALTER TABLE inspecteur DROP center_id');
    }
}
