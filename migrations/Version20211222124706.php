<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211222124706 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__product_detail AS SELECT id, count, oc, memory, camera FROM product_detail');
        $this->addSql('DROP TABLE product_detail');
        $this->addSql('CREATE TABLE product_detail (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, count INTEGER NOT NULL, oc VARCHAR(255) NOT NULL COLLATE BINARY, camera VARCHAR(255) NOT NULL COLLATE BINARY, ram VARCHAR(255) NOT NULL, battery VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO product_detail (id, count, oc, ram, camera) SELECT id, count, oc, memory, camera FROM __temp__product_detail');
        $this->addSql('DROP TABLE __temp__product_detail');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__product_detail AS SELECT id, count, oc, camera FROM product_detail');
        $this->addSql('DROP TABLE product_detail');
        $this->addSql('CREATE TABLE product_detail (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, count INTEGER NOT NULL, oc VARCHAR(255) NOT NULL, camera VARCHAR(255) NOT NULL, memory VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO product_detail (id, count, oc, camera) SELECT id, count, oc, camera FROM __temp__product_detail');
        $this->addSql('DROP TABLE __temp__product_detail');
    }
}
