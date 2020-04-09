<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200409174806 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sylius_product_attribute ADD landing_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sylius_product_attribute ADD CONSTRAINT FK_19F07F1BEFD99737 FOREIGN KEY (landing_id) REFERENCES ctic_cms_landing (id)');
        $this->addSql('CREATE INDEX IDX_19F07F1BEFD99737 ON sylius_product_attribute (landing_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sylius_product_attribute DROP FOREIGN KEY FK_19F07F1BEFD99737');
        $this->addSql('ALTER TABLE sylius_product_attribute DROP landing_id');
        $this->addSql('DROP INDEX IDX_19F07F1BEFD99737 ON sylius_product_attribute');
    }
}
