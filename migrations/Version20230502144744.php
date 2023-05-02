<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230502144744 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE assistance ADD evenement_id INT NOT NULL');
        $this->addSql('ALTER TABLE assistance ADD CONSTRAINT FK_1B4F85F2FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)');
        $this->addSql('CREATE INDEX IDX_1B4F85F2FD02F13 ON assistance (evenement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE assistance DROP FOREIGN KEY FK_1B4F85F2FD02F13');
        $this->addSql('DROP INDEX IDX_1B4F85F2FD02F13 ON assistance');
        $this->addSql('ALTER TABLE assistance DROP evenement_id');
    }
}
