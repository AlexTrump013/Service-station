<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220131133222 extends AbstractMigration
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
        $this->addSql('DROP TABLE recordcard');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_8D45081D19EB6921');
        $this->addSql('CREATE TEMPORARY TABLE __temp__carinfo AS SELECT id, client_id, brand, model, year, vincode, numder FROM carinfo');
        $this->addSql('DROP TABLE carinfo');
        $this->addSql('CREATE TABLE carinfo (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, client_id INTEGER NOT NULL, brand VARCHAR(255) NOT NULL COLLATE BINARY, model VARCHAR(255) NOT NULL COLLATE BINARY, year INTEGER NOT NULL, vincode VARCHAR(255) NOT NULL COLLATE BINARY, numder VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_8D45081D19EB6921 FOREIGN KEY (client_id) REFERENCES person (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO carinfo (id, client_id, brand, model, year, vincode, numder) SELECT id, client_id, brand, model, year, vincode, numder FROM __temp__carinfo');
        $this->addSql('DROP TABLE __temp__carinfo');
        $this->addSql('CREATE INDEX IDX_8D45081D19EB6921 ON carinfo (client_id)');
        $this->addSql('DROP INDEX IDX_FBD8E0F8A35F2858');
        $this->addSql('CREATE TEMPORARY TABLE __temp__job AS SELECT id, _order_id, title, pricework FROM job');
        $this->addSql('DROP TABLE job');
        $this->addSql('CREATE TABLE job (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, _order_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL COLLATE BINARY, pricework INTEGER NOT NULL, CONSTRAINT FK_FBD8E0F8A35F2858 FOREIGN KEY (_order_id) REFERENCES "order" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO job (id, _order_id, title, pricework) SELECT id, _order_id, title, pricework FROM __temp__job');
        $this->addSql('DROP TABLE __temp__job');
        $this->addSql('CREATE INDEX IDX_FBD8E0F8A35F2858 ON job (_order_id)');
        $this->addSql('DROP INDEX IDX_F529939813B3DB11');
        $this->addSql('DROP INDEX IDX_F529939819EB6921');
        $this->addSql('DROP INDEX IDX_F5299398BCD0CA89');
        $this->addSql('CREATE TEMPORARY TABLE __temp__order AS SELECT id, carinfo_id, client_id, master_id, description, finalprice, status FROM "order"');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('CREATE TABLE "order" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, carinfo_id INTEGER NOT NULL, client_id INTEGER NOT NULL, master_id INTEGER NOT NULL, description VARCHAR(255) NOT NULL COLLATE BINARY, finalprice INTEGER NOT NULL, status VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_F5299398BCD0CA89 FOREIGN KEY (carinfo_id) REFERENCES carinfo (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_F529939819EB6921 FOREIGN KEY (client_id) REFERENCES person (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_F529939813B3DB11 FOREIGN KEY (master_id) REFERENCES person (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO "order" (id, carinfo_id, client_id, master_id, description, finalprice, status) SELECT id, carinfo_id, client_id, master_id, description, finalprice, status FROM __temp__order');
        $this->addSql('DROP TABLE __temp__order');
        $this->addSql('CREATE INDEX IDX_F529939813B3DB11 ON "order" (master_id)');
        $this->addSql('CREATE INDEX IDX_F529939819EB6921 ON "order" (client_id)');
        $this->addSql('CREATE INDEX IDX_F5299398BCD0CA89 ON "order" (carinfo_id)');
        $this->addSql('DROP INDEX IDX_D9C3F2AFBB3453DB');
        $this->addSql('CREATE TEMPORARY TABLE __temp__workstatus AS SELECT id, work_id, status FROM workstatus');
        $this->addSql('DROP TABLE workstatus');
        $this->addSql('CREATE TABLE workstatus (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, work_id INTEGER NOT NULL, status VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_D9C3F2AFBB3453DB FOREIGN KEY (work_id) REFERENCES work (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO workstatus (id, work_id, status) SELECT id, work_id, status FROM __temp__workstatus');
        $this->addSql('DROP TABLE __temp__workstatus');
        $this->addSql('CREATE INDEX IDX_D9C3F2AFBB3453DB ON workstatus (work_id)');
        $this->addSql('DROP INDEX IDX_430F90558D9F6D38');
        $this->addSql('DROP INDEX IDX_430F90559082CF81');
        $this->addSql('CREATE TEMPORARY TABLE __temp__workstatus_order AS SELECT workstatus_id, order_id FROM workstatus_order');
        $this->addSql('DROP TABLE workstatus_order');
        $this->addSql('CREATE TABLE workstatus_order (workstatus_id INTEGER NOT NULL, order_id INTEGER NOT NULL, PRIMARY KEY(workstatus_id, order_id), CONSTRAINT FK_430F90559082CF81 FOREIGN KEY (workstatus_id) REFERENCES "workstatus" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_430F90558D9F6D38 FOREIGN KEY (order_id) REFERENCES "order" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO workstatus_order (workstatus_id, order_id) SELECT workstatus_id, order_id FROM __temp__workstatus_order');
        $this->addSql('DROP TABLE __temp__workstatus_order');
        $this->addSql('CREATE INDEX IDX_430F90558D9F6D38 ON workstatus_order (order_id)');
        $this->addSql('CREATE INDEX IDX_430F90559082CF81 ON workstatus_order (workstatus_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name CLOB NOT NULL COLLATE BINARY, price VARCHAR(255) NOT NULL COLLATE BINARY, sku VARCHAR(255) DEFAULT NULL COLLATE BINARY)');
        $this->addSql('CREATE TABLE product_detail (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, count INTEGER NOT NULL, oc VARCHAR(255) NOT NULL COLLATE BINARY, camera VARCHAR(255) NOT NULL COLLATE BINARY, ram VARCHAR(255) NOT NULL COLLATE BINARY, battery VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('CREATE TABLE recordcard (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, number VARCHAR(255) NOT NULL COLLATE BINARY, phone VARCHAR(255) NOT NULL COLLATE BINARY, time DATE NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, vin VARCHAR(255) NOT NULL COLLATE BINARY, description VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, password VARCHAR(255) NOT NULL COLLATE BINARY, email VARCHAR(180) NOT NULL COLLATE BINARY, roles CLOB NOT NULL COLLATE BINARY --(DC2Type:json)
        , lastname VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('DROP INDEX IDX_8D45081D19EB6921');
        $this->addSql('CREATE TEMPORARY TABLE __temp__carinfo AS SELECT id, client_id, brand, model, year, vincode, numder FROM carinfo');
        $this->addSql('DROP TABLE carinfo');
        $this->addSql('CREATE TABLE carinfo (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, client_id INTEGER NOT NULL, brand VARCHAR(255) NOT NULL, model VARCHAR(255) NOT NULL, year INTEGER NOT NULL, vincode VARCHAR(255) NOT NULL, numder VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO carinfo (id, client_id, brand, model, year, vincode, numder) SELECT id, client_id, brand, model, year, vincode, numder FROM __temp__carinfo');
        $this->addSql('DROP TABLE __temp__carinfo');
        $this->addSql('CREATE INDEX IDX_8D45081D19EB6921 ON carinfo (client_id)');
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
        $this->addSql('CREATE TEMPORARY TABLE __temp__order AS SELECT id, carinfo_id, client_id, master_id, description, finalprice, status FROM "order"');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('CREATE TABLE "order" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, carinfo_id INTEGER NOT NULL, client_id INTEGER NOT NULL, master_id INTEGER NOT NULL, description VARCHAR(255) NOT NULL, finalprice INTEGER NOT NULL, status VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO "order" (id, carinfo_id, client_id, master_id, description, finalprice, status) SELECT id, carinfo_id, client_id, master_id, description, finalprice, status FROM __temp__order');
        $this->addSql('DROP TABLE __temp__order');
        $this->addSql('CREATE INDEX IDX_F5299398BCD0CA89 ON "order" (carinfo_id)');
        $this->addSql('CREATE INDEX IDX_F529939819EB6921 ON "order" (client_id)');
        $this->addSql('CREATE INDEX IDX_F529939813B3DB11 ON "order" (master_id)');
        $this->addSql('DROP INDEX IDX_D9C3F2AFBB3453DB');
        $this->addSql('CREATE TEMPORARY TABLE __temp__workstatus AS SELECT id, work_id, status FROM "workstatus"');
        $this->addSql('DROP TABLE "workstatus"');
        $this->addSql('CREATE TABLE "workstatus" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, work_id INTEGER NOT NULL, status VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO "workstatus" (id, work_id, status) SELECT id, work_id, status FROM __temp__workstatus');
        $this->addSql('DROP TABLE __temp__workstatus');
        $this->addSql('CREATE INDEX IDX_D9C3F2AFBB3453DB ON "workstatus" (work_id)');
        $this->addSql('DROP INDEX IDX_430F90559082CF81');
        $this->addSql('DROP INDEX IDX_430F90558D9F6D38');
        $this->addSql('CREATE TEMPORARY TABLE __temp__workstatus_order AS SELECT workstatus_id, order_id FROM workstatus_order');
        $this->addSql('DROP TABLE workstatus_order');
        $this->addSql('CREATE TABLE workstatus_order (workstatus_id INTEGER NOT NULL, order_id INTEGER NOT NULL, PRIMARY KEY(workstatus_id, order_id))');
        $this->addSql('INSERT INTO workstatus_order (workstatus_id, order_id) SELECT workstatus_id, order_id FROM __temp__workstatus_order');
        $this->addSql('DROP TABLE __temp__workstatus_order');
        $this->addSql('CREATE INDEX IDX_430F90559082CF81 ON workstatus_order (workstatus_id)');
        $this->addSql('CREATE INDEX IDX_430F90558D9F6D38 ON workstatus_order (order_id)');
    }
}
