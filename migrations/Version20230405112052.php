<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230405112052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adherent ADD site_id INT NOT NULL');
        $this->addSql('ALTER TABLE adherent ADD CONSTRAINT FK_90D3F060F6BD1646 FOREIGN KEY (site_id) REFERENCES site_adherent (id)');
        $this->addSql('CREATE INDEX IDX_90D3F060F6BD1646 ON adherent (site_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adherent DROP FOREIGN KEY FK_90D3F060F6BD1646');
        $this->addSql('DROP INDEX IDX_90D3F060F6BD1646 ON adherent');
        $this->addSql('ALTER TABLE adherent DROP site_id');
    }
}
