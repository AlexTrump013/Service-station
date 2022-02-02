<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220125142547 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carinfo ADD COLUMN description CLOB DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__carinfo AS SELECT id, brand, model, year, vincode, numder FROM carinfo');
        $this->addSql('DROP TABLE carinfo');
        $this->addSql('CREATE TABLE carinfo (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, brand VARCHAR(255) NOT NULL, model VARCHAR(255) NOT NULL, year INTEGER NOT NULL, vincode VARCHAR(255) NOT NULL, numder VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO carinfo (id, brand, model, year, vincode, numder) SELECT id, brand, model, year, vincode, numder FROM __temp__carinfo');
        $this->addSql('DROP TABLE __temp__carinfo');
    }
}
