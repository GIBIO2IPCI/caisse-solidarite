<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230530145436 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE autre_depense (id INT AUTO_INCREMENT NOT NULL, adherent_id INT NOT NULL, evenement_id INT NOT NULL, montant INT NOT NULL, INDEX IDX_EF24AAC125F06C53 (adherent_id), INDEX IDX_EF24AAC1FD02F13 (evenement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE autre_evenement (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, INDEX IDX_7455D2B2C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE autre_depense ADD CONSTRAINT FK_EF24AAC125F06C53 FOREIGN KEY (adherent_id) REFERENCES adherent (id)');
        $this->addSql('ALTER TABLE autre_depense ADD CONSTRAINT FK_EF24AAC1FD02F13 FOREIGN KEY (evenement_id) REFERENCES autre_evenement (id)');
        $this->addSql('ALTER TABLE autre_evenement ADD CONSTRAINT FK_7455D2B2C54C8C93 FOREIGN KEY (type_id) REFERENCES type_assistance (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE autre_depense DROP FOREIGN KEY FK_EF24AAC125F06C53');
        $this->addSql('ALTER TABLE autre_depense DROP FOREIGN KEY FK_EF24AAC1FD02F13');
        $this->addSql('ALTER TABLE autre_evenement DROP FOREIGN KEY FK_7455D2B2C54C8C93');
        $this->addSql('DROP TABLE autre_depense');
        $this->addSql('DROP TABLE autre_evenement');
    }
}
