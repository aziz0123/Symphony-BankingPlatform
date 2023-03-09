<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230223100948 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1E7DF2E9E');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1E7DF2E9E FOREIGN KEY (source_account_id) REFERENCES compte (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1E7DF2E9E');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1E7DF2E9E FOREIGN KEY (source_account_id) REFERENCES compte (id)');
    }
}
