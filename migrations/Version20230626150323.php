<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230626150323 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fonctionnement (id INT AUTO_INCREMENT NOT NULL, type_fonctionnement_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, montant BIGINT NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_113829A06F4CA3AF (type_fonctionnement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_fonctionnement (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fonctionnement ADD CONSTRAINT FK_113829A06F4CA3AF FOREIGN KEY (type_fonctionnement_id) REFERENCES type_fonctionnement (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fonctionnement DROP FOREIGN KEY FK_113829A06F4CA3AF');
        $this->addSql('DROP TABLE fonctionnement');
        $this->addSql('DROP TABLE type_fonctionnement');
    }
}
