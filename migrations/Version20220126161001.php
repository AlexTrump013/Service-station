<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220126161001 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_detail');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TEMPORARY TABLE __temp__carinfo AS SELECT id, brand, model, year, vincode, numder, description FROM carinfo');
        $this->addSql('DROP TABLE carinfo');
        $this->addSql('CREATE TABLE carinfo (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, brand VARCHAR(255) NOT NULL COLLATE BINARY, model VARCHAR(255) NOT NULL COLLATE BINARY, year INTEGER NOT NULL, vincode VARCHAR(255) NOT NULL COLLATE BINARY, numder VARCHAR(255) NOT NULL COLLATE BINARY, description CLOB DEFAULT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO carinfo (id, brand, model, year, vincode, numder, description) SELECT id, brand, model, year, vincode, numder, description FROM __temp__carinfo');
        $this->addSql('DROP TABLE __temp__carinfo');
        $this->addSql('DROP INDEX IDX_F5299398BCD0CA89');
        $this->addSql('CREATE TEMPORARY TABLE __temp__order AS SELECT id, carinfo_id FROM "order"');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('CREATE TABLE "order" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, carinfo_id INTEGER NOT NULL, CONSTRAINT FK_F5299398BCD0CA89 FOREIGN KEY (carinfo_id) REFERENCES carinfo (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO "order" (id, carinfo_id) SELECT id, carinfo_id FROM __temp__order');
        $this->addSql('DROP TABLE __temp__order');
        $this->addSql('CREATE INDEX IDX_F5299398BCD0CA89 ON "order" (carinfo_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name CLOB NOT NULL COLLATE BINARY, price VARCHAR(255) NOT NULL COLLATE BINARY, sku VARCHAR(255) DEFAULT NULL COLLATE BINARY)');
        $this->addSql('CREATE TABLE product_detail (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, count INTEGER NOT NULL, oc VARCHAR(255) NOT NULL COLLATE BINARY, camera VARCHAR(255) NOT NULL COLLATE BINARY, ram VARCHAR(255) NOT NULL COLLATE BINARY, battery VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, password VARCHAR(255) NOT NULL COLLATE BINARY, email VARCHAR(180) NOT NULL COLLATE BINARY, roles CLOB NOT NULL COLLATE BINARY --(DC2Type:json)
        , lastname VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('ALTER TABLE carinfo ADD COLUMN image VARCHAR(255) DEFAULT NULL COLLATE BINARY');
        $this->addSql('DROP INDEX IDX_F5299398BCD0CA89');
        $this->addSql('CREATE TEMPORARY TABLE __temp__order AS SELECT id, carinfo_id FROM "order"');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('CREATE TABLE "order" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, carinfo_id INTEGER NOT NULL)');
        $this->addSql('INSERT INTO "order" (id, carinfo_id) SELECT id, carinfo_id FROM __temp__order');
        $this->addSql('DROP TABLE __temp__order');
        $this->addSql('CREATE INDEX IDX_F5299398BCD0CA89 ON "order" (carinfo_id)');
    }
}
