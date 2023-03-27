<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230327090707 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE assistant ADD responsable1_id INT DEFAULT NULL, ADD responsable2_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE assistant ADD CONSTRAINT FK_C2997CD16834F81E FOREIGN KEY (responsable1_id) REFERENCES center (id)');
        $this->addSql('ALTER TABLE assistant ADD CONSTRAINT FK_C2997CD17A8157F0 FOREIGN KEY (responsable2_id) REFERENCES center (id)');
        $this->addSql('CREATE INDEX IDX_C2997CD16834F81E ON assistant (responsable1_id)');
        $this->addSql('CREATE INDEX IDX_C2997CD17A8157F0 ON assistant (responsable2_id)');
        $this->addSql('ALTER TABLE date_ep ADD jury_id INT DEFAULT NULL, ADD lycee INT NOT NULL, ADD center INT NOT NULL, ADD enseigant1 VARCHAR(255) NOT NULL, ADD enseigant2 VARCHAR(255) NOT NULL, ADD enseigant3 VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE date_ep ADD CONSTRAINT FK_EF8AD1AE560103C FOREIGN KEY (jury_id) REFERENCES jury (id)');
        $this->addSql('CREATE INDEX IDX_EF8AD1AE560103C ON date_ep (jury_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE assistant DROP FOREIGN KEY FK_C2997CD16834F81E');
        $this->addSql('ALTER TABLE assistant DROP FOREIGN KEY FK_C2997CD17A8157F0');
        $this->addSql('DROP INDEX IDX_C2997CD16834F81E ON assistant');
        $this->addSql('DROP INDEX IDX_C2997CD17A8157F0 ON assistant');
        $this->addSql('ALTER TABLE assistant DROP responsable1_id, DROP responsable2_id');
        $this->addSql('ALTER TABLE date_ep DROP FOREIGN KEY FK_EF8AD1AE560103C');
        $this->addSql('DROP INDEX IDX_EF8AD1AE560103C ON date_ep');
        $this->addSql('ALTER TABLE date_ep DROP jury_id, DROP lycee, DROP center, DROP enseigant1, DROP enseigant2, DROP enseigant3');
    }
}
