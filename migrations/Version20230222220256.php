<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230222220256 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carte_bancaire DROP FOREIGN KEY FK_59E3C22DF2C56620');
        $this->addSql('DROP INDEX UNIQ_59E3C22DE7927C74 ON carte_bancaire');
        $this->addSql('DROP INDEX IDX_59E3C22DF2C56620 ON carte_bancaire');
        $this->addSql('ALTER TABLE carte_bancaire CHANGE num_carte num_carte INT NOT NULL, CHANGE compte_id compte INT DEFAULT NULL');
        $this->addSql('ALTER TABLE carte_bancaire ADD CONSTRAINT FK_59E3C22DCFF65260 FOREIGN KEY (compte) REFERENCES compte (id)');
        $this->addSql('CREATE INDEX IDX_59E3C22DCFF65260 ON carte_bancaire (compte)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carte_bancaire DROP FOREIGN KEY FK_59E3C22DCFF65260');
        $this->addSql('DROP INDEX IDX_59E3C22DCFF65260 ON carte_bancaire');
        $this->addSql('ALTER TABLE carte_bancaire CHANGE num_carte num_carte BIGINT NOT NULL, CHANGE compte compte_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE carte_bancaire ADD CONSTRAINT FK_59E3C22DF2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_59E3C22DE7927C74 ON carte_bancaire (email)');
        $this->addSql('CREATE INDEX IDX_59E3C22DF2C56620 ON carte_bancaire (compte_id)');
    }
}
