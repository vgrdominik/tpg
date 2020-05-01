<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200501233335 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sylius_taxon ADD landing_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sylius_taxon ADD CONSTRAINT FK_CFD811CAEFD98736 FOREIGN KEY (landing_id) REFERENCES ctic_cms_landing (id)');
        $this->addSql('CREATE INDEX IDX_CFD811CAEFD98736 ON sylius_taxon (landing_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sylius_taxon DROP FOREIGN KEY FK_CFD811CAEFD98736');
        $this->addSql('DROP INDEX IDX_CFD811CAEFD98736 ON sylius_taxon');
        $this->addSql('ALTER TABLE sylius_taxon DROP landing_id');
    }
}
