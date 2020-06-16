<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200616173339 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rented_product (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, rent_from DATETIME DEFAULT NULL, rent_to DATETIME DEFAULT NULL, INDEX IDX_B29FDC204584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rented_product ADD CONSTRAINT FK_B29FDC204584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product DROP rent_from, DROP rent_to');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE rented_product');
        $this->addSql('ALTER TABLE product ADD rent_from DATETIME DEFAULT NULL, ADD rent_to DATETIME DEFAULT NULL');
    }
}
