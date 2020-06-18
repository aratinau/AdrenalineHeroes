<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200618124509 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, quantity INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE promotion (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, percent_discount INTEGER NOT NULL, minimum_rent_time INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE rented_product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, product_id INTEGER DEFAULT NULL, rent_from DATETIME DEFAULT NULL, rent_to DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_B29FDC204584665A ON rented_product (product_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE promotion');
        $this->addSql('DROP TABLE rented_product');
    }
}
