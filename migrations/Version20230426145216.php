<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230426145216 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE assistance (id INT AUTO_INCREMENT NOT NULL, adherent_id INT NOT NULL, date_assistance DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_1B4F85F225F06C53 (adherent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, type_assistance_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, montant_event BIGINT NOT NULL, INDEX IDX_B26681E7BE5AF (type_assistance_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_assistance (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE assistance ADD CONSTRAINT FK_1B4F85F225F06C53 FOREIGN KEY (adherent_id) REFERENCES adherent (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E7BE5AF FOREIGN KEY (type_assistance_id) REFERENCES type_assistance (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE assistance DROP FOREIGN KEY FK_1B4F85F225F06C53');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E7BE5AF');
        $this->addSql('DROP TABLE assistance');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE type_assistance');
    }
}
