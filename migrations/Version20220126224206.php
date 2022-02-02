<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220126224206 extends AbstractMigration
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
        $this->addSql('DROP INDEX IDX_FBD8E0F8A35F2858');
        $this->addSql('CREATE TEMPORARY TABLE __temp__job AS SELECT id, _order_id, title, pricework FROM job');
        $this->addSql('DROP TABLE job');
        $this->addSql('CREATE TABLE job (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, _order_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL COLLATE BINARY, pricework INTEGER NOT NULL, CONSTRAINT FK_FBD8E0F8A35F2858 FOREIGN KEY (_order_id) REFERENCES "order" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO job (id, _order_id, title, pricework) SELECT id, _order_id, title, pricework FROM __temp__job');
        $this->addSql('DROP TABLE __temp__job');
        $this->addSql('CREATE INDEX IDX_FBD8E0F8A35F2858 ON job (_order_id)');
        $this->addSql('DROP INDEX IDX_F5299398BCD0CA89');
        $this->addSql('DROP INDEX IDX_F529939819EB6921');
        $this->addSql('DROP INDEX IDX_F529939813B3DB11');
        $this->addSql('CREATE TEMPORARY TABLE __temp__order AS SELECT id, carinfo_id, client_id, master_id FROM "order"');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('CREATE TABLE "order" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, carinfo_id INTEGER NOT NULL, client_id INTEGER NOT NULL, master_id INTEGER NOT NULL, CONSTRAINT FK_F5299398BCD0CA89 FOREIGN KEY (carinfo_id) REFERENCES carinfo (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_F529939819EB6921 FOREIGN KEY (client_id) REFERENCES person (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_F529939813B3DB11 FOREIGN KEY (master_id) REFERENCES person (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO "order" (id, carinfo_id, client_id, master_id) SELECT id, carinfo_id, client_id, master_id FROM __temp__order');
        $this->addSql('DROP TABLE __temp__order');
        $this->addSql('CREATE INDEX IDX_F5299398BCD0CA89 ON "order" (carinfo_id)');
        $this->addSql('CREATE INDEX IDX_F529939819EB6921 ON "order" (client_id)');
        $this->addSql('CREATE INDEX IDX_F529939813B3DB11 ON "order" (master_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__work AS SELECT id, _order_id, __order_id, title FROM work');
        $this->addSql('DROP TABLE work');
        $this->addSql('CREATE TABLE work (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, _order_id INTEGER NOT NULL, __order_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_534E6880A35F2858 FOREIGN KEY (_order_id) REFERENCES "order" (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_534E6880EEC38945 FOREIGN KEY (__order_id) REFERENCES "order" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO work (id, _order_id, __order_id, title) SELECT id, _order_id, __order_id, title FROM __temp__work');
        $this->addSql('DROP TABLE __temp__work');
        $this->addSql('CREATE INDEX IDX_534E6880A35F2858 ON work (_order_id)');
        $this->addSql('CREATE INDEX IDX_534E6880EEC38945 ON work (__order_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name CLOB NOT NULL COLLATE BINARY, price VARCHAR(255) NOT NULL COLLATE BINARY, sku VARCHAR(255) DEFAULT NULL COLLATE BINARY)');
        $this->addSql('CREATE TABLE product_detail (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, count INTEGER NOT NULL, oc VARCHAR(255) NOT NULL COLLATE BINARY, camera VARCHAR(255) NOT NULL COLLATE BINARY, ram VARCHAR(255) NOT NULL COLLATE BINARY, battery VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, password VARCHAR(255) NOT NULL COLLATE BINARY, email VARCHAR(180) NOT NULL COLLATE BINARY, roles CLOB NOT NULL COLLATE BINARY --(DC2Type:json)
        , lastname VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('DROP INDEX IDX_FBD8E0F8A35F2858');
        $this->addSql('CREATE TEMPORARY TABLE __temp__job AS SELECT id, _order_id, title, pricework FROM job');
        $this->addSql('DROP TABLE job');
        $this->addSql('CREATE TABLE job (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, _order_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, pricework INTEGER NOT NULL)');
        $this->addSql('INSERT INTO job (id, _order_id, title, pricework) SELECT id, _order_id, title, pricework FROM __temp__job');
        $this->addSql('DROP TABLE __temp__job');
        $this->addSql('CREATE INDEX IDX_FBD8E0F8A35F2858 ON job (_order_id)');
        $this->addSql('DROP INDEX IDX_F5299398BCD0CA89');
        $this->addSql('DROP INDEX IDX_F529939819EB6921');
        $this->addSql('DROP INDEX IDX_F529939813B3DB11');
        $this->addSql('CREATE TEMPORARY TABLE __temp__order AS SELECT id, carinfo_id, client_id, master_id FROM "order"');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('CREATE TABLE "order" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, carinfo_id INTEGER NOT NULL, client_id INTEGER NOT NULL, master_id INTEGER NOT NULL)');
        $this->addSql('INSERT INTO "order" (id, carinfo_id, client_id, master_id) SELECT id, carinfo_id, client_id, master_id FROM __temp__order');
        $this->addSql('DROP TABLE __temp__order');
        $this->addSql('CREATE INDEX IDX_F5299398BCD0CA89 ON "order" (carinfo_id)');
        $this->addSql('CREATE INDEX IDX_F529939819EB6921 ON "order" (client_id)');
        $this->addSql('CREATE INDEX IDX_F529939813B3DB11 ON "order" (master_id)');
        $this->addSql('DROP INDEX IDX_534E6880A35F2858');
        $this->addSql('DROP INDEX IDX_534E6880EEC38945');
        $this->addSql('CREATE TEMPORARY TABLE __temp__work AS SELECT id, _order_id, __order_id, title FROM work');
        $this->addSql('DROP TABLE work');
        $this->addSql('CREATE TABLE work (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, _order_id INTEGER NOT NULL, __order_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO work (id, _order_id, __order_id, title) SELECT id, _order_id, __order_id, title FROM __temp__work');
        $this->addSql('DROP TABLE __temp__work');
    }
}
