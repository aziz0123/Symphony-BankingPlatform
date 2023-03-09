<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230223100856 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carte_bancaire DROP FOREIGN KEY FK_59E3C22D7FE4B2B');
        $this->addSql('ALTER TABLE carte_bancaire DROP FOREIGN KEY FK_59E3C22DCFF65260');
        $this->addSql('ALTER TABLE carte_bancaire ADD CONSTRAINT FK_59E3C22D7FE4B2B FOREIGN KEY (id_type) REFERENCES type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE carte_bancaire ADD CONSTRAINT FK_59E3C22DCFF65260 FOREIGN KEY (compte) REFERENCES compte (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carte_bancaire DROP FOREIGN KEY FK_59E3C22D7FE4B2B');
        $this->addSql('ALTER TABLE carte_bancaire DROP FOREIGN KEY FK_59E3C22DCFF65260');
        $this->addSql('ALTER TABLE carte_bancaire ADD CONSTRAINT FK_59E3C22D7FE4B2B FOREIGN KEY (id_type) REFERENCES type (id)');
        $this->addSql('ALTER TABLE carte_bancaire ADD CONSTRAINT FK_59E3C22DCFF65260 FOREIGN KEY (compte) REFERENCES compte (id)');
    }
}
