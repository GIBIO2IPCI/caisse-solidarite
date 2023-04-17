<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230414121301 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service_fonction DROP FOREIGN KEY FK_F0768E80ED5CA9E6');
        $this->addSql('ALTER TABLE service_fonction DROP FOREIGN KEY FK_F0768E8057889920');
        $this->addSql('DROP TABLE service_fonction');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE service_fonction (service_id INT NOT NULL, fonction_id INT NOT NULL, INDEX IDX_F0768E8057889920 (fonction_id), INDEX IDX_F0768E80ED5CA9E6 (service_id), PRIMARY KEY(service_id, fonction_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE service_fonction ADD CONSTRAINT FK_F0768E80ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_fonction ADD CONSTRAINT FK_F0768E8057889920 FOREIGN KEY (fonction_id) REFERENCES fonction (id) ON DELETE CASCADE');
    }
}
