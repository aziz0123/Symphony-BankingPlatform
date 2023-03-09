<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230223094941 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carte_bancaire ADD date_exp DATE DEFAULT NULL, CHANGE num_carte num_carte INT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_59E3C22DFD574E8B ON carte_bancaire (num_carte)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_59E3C22DFD574E8B ON carte_bancaire');
        $this->addSql('ALTER TABLE carte_bancaire DROP date_exp, CHANGE num_carte num_carte BIGINT NOT NULL');
    }
}
