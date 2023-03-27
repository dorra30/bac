<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230324123849 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE section_classe (section_id INT NOT NULL, classe_id INT NOT NULL, INDEX IDX_C5CF4DB0D823E37A (section_id), INDEX IDX_C5CF4DB08F5EA509 (classe_id), PRIMARY KEY(section_id, classe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE section_classe ADD CONSTRAINT FK_C5CF4DB0D823E37A FOREIGN KEY (section_id) REFERENCES section (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE section_classe ADD CONSTRAINT FK_C5CF4DB08F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bareme_fille ADD specialite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bareme_fille ADD CONSTRAINT FK_401739182195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id)');
        $this->addSql('CREATE INDEX IDX_401739182195E0F0 ON bareme_fille (specialite_id)');
        $this->addSql('ALTER TABLE bareme_garcon ADD specialite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bareme_garcon ADD CONSTRAINT FK_D17D3BC22195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id)');
        $this->addSql('CREATE INDEX IDX_D17D3BC22195E0F0 ON bareme_garcon (specialite_id)');
        $this->addSql('ALTER TABLE classe ADD lycee_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF96D1DC61BF FOREIGN KEY (lycee_id) REFERENCES lycee (id)');
        $this->addSql('CREATE INDEX IDX_8F87BF96D1DC61BF ON classe (lycee_id)');
        $this->addSql('ALTER TABLE eleve ADD classe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F78F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('CREATE INDEX IDX_ECA105F78F5EA509 ON eleve (classe_id)');
        $this->addSql('ALTER TABLE enseigant ADD inspecteur_id INT DEFAULT NULL, ADD lycee_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE enseigant ADD CONSTRAINT FK_67F5BE0EB7728AA0 FOREIGN KEY (inspecteur_id) REFERENCES inspecteur (id)');
        $this->addSql('ALTER TABLE enseigant ADD CONSTRAINT FK_67F5BE0ED1DC61BF FOREIGN KEY (lycee_id) REFERENCES lycee (id)');
        $this->addSql('CREATE INDEX IDX_67F5BE0EB7728AA0 ON enseigant (inspecteur_id)');
        $this->addSql('CREATE INDEX IDX_67F5BE0ED1DC61BF ON enseigant (lycee_id)');
        $this->addSql('ALTER TABLE epreuve ADD specialite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE epreuve ADD CONSTRAINT FK_D6ADE47F2195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id)');
        $this->addSql('CREATE INDEX IDX_D6ADE47F2195E0F0 ON epreuve (specialite_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE section_classe DROP FOREIGN KEY FK_C5CF4DB0D823E37A');
        $this->addSql('ALTER TABLE section_classe DROP FOREIGN KEY FK_C5CF4DB08F5EA509');
        $this->addSql('DROP TABLE section_classe');
        $this->addSql('ALTER TABLE bareme_fille DROP FOREIGN KEY FK_401739182195E0F0');
        $this->addSql('DROP INDEX IDX_401739182195E0F0 ON bareme_fille');
        $this->addSql('ALTER TABLE bareme_fille DROP specialite_id');
        $this->addSql('ALTER TABLE bareme_garcon DROP FOREIGN KEY FK_D17D3BC22195E0F0');
        $this->addSql('DROP INDEX IDX_D17D3BC22195E0F0 ON bareme_garcon');
        $this->addSql('ALTER TABLE bareme_garcon DROP specialite_id');
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF96D1DC61BF');
        $this->addSql('DROP INDEX IDX_8F87BF96D1DC61BF ON classe');
        $this->addSql('ALTER TABLE classe DROP lycee_id');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F78F5EA509');
        $this->addSql('DROP INDEX IDX_ECA105F78F5EA509 ON eleve');
        $this->addSql('ALTER TABLE eleve DROP classe_id');
        $this->addSql('ALTER TABLE enseigant DROP FOREIGN KEY FK_67F5BE0EB7728AA0');
        $this->addSql('ALTER TABLE enseigant DROP FOREIGN KEY FK_67F5BE0ED1DC61BF');
        $this->addSql('DROP INDEX IDX_67F5BE0EB7728AA0 ON enseigant');
        $this->addSql('DROP INDEX IDX_67F5BE0ED1DC61BF ON enseigant');
        $this->addSql('ALTER TABLE enseigant DROP inspecteur_id, DROP lycee_id');
        $this->addSql('ALTER TABLE epreuve DROP FOREIGN KEY FK_D6ADE47F2195E0F0');
        $this->addSql('DROP INDEX IDX_D6ADE47F2195E0F0 ON epreuve');
        $this->addSql('ALTER TABLE epreuve DROP specialite_id');
    }
}
