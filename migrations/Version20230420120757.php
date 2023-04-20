<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230420120757 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE don (id INT AUTO_INCREMENT NOT NULL, type_don_id INT NOT NULL, donnateur_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, montant_don VARCHAR(255) NOT NULL, date_don DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_F8F081D958EBFB59 (type_don_id), INDEX IDX_F8F081D9FD794C6D (donnateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_don (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE don ADD CONSTRAINT FK_F8F081D958EBFB59 FOREIGN KEY (type_don_id) REFERENCES type_don (id)');
        $this->addSql('ALTER TABLE don ADD CONSTRAINT FK_F8F081D9FD794C6D FOREIGN KEY (donnateur_id) REFERENCES adherent (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE don DROP FOREIGN KEY FK_F8F081D958EBFB59');
        $this->addSql('ALTER TABLE don DROP FOREIGN KEY FK_F8F081D9FD794C6D');
        $this->addSql('DROP TABLE don');
        $this->addSql('DROP TABLE type_don');
    }
}
