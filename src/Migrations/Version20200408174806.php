<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200408174806 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ctic_cms_block_slider (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, accessibility TINYINT(1) NOT NULL, adaptive_height TINYINT(1) NOT NULL, autoplay TINYINT(1) NOT NULL, autoplay_speed INT NOT NULL, arrows TINYINT(1) NOT NULL, center_mode TINYINT(1) NOT NULL, center_padding VARCHAR(255) NOT NULL, dots TINYINT(1) NOT NULL, draggable TINYINT(1) NOT NULL, fade TINYINT(1) NOT NULL, infinite TINYINT(1) NOT NULL, pause_on_focus TINYINT(1) NOT NULL, pause_on_hover TINYINT(1) NOT NULL, pause_on_dots_hover TINYINT(1) NOT NULL, slide_rows INT NOT NULL, slides_per_row INT NOT NULL, slides_to_show INT NOT NULL, slides_to_scroll INT NOT NULL, speed INT NOT NULL, swipe TINYINT(1) NOT NULL, swipe_to_slide TINYINT(1) NOT NULL, touch_move TINYINT(1) NOT NULL, variable_width TINYINT(1) NOT NULL, vertical TINYINT(1) NOT NULL, vertical_swiping TINYINT(1) NOT NULL, rtl TINYINT(1) NOT NULL, wait_for_animate TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_7FAB80C7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ctic_cms_block_sliderelement (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, position INT NOT NULL, title VARCHAR(255) NOT NULL, title_animation VARCHAR(255) NOT NULL, main_phrase VARCHAR(255) NOT NULL, main_phrase_animation VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, link_animation VARCHAR(255) NOT NULL, link_text VARCHAR(255) NOT NULL, INDEX IDX_EF2AD510727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ctic_cms_block_sliderelementimage (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, type VARCHAR(255) DEFAULT NULL, path VARCHAR(255) NOT NULL, INDEX IDX_586BF6637E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ctic_cms_home (id INT AUTO_INCREMENT NOT NULL, landing_id INT NOT NULL, channel_id INT NOT NULL, enabled TINYINT(1) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_F4C1AD34EFD98736 (landing_id), INDEX IDX_F4C1AD3472F5A1AA (channel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ctic_cms_landing (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ctic_cms_landingelement (id INT AUTO_INCREMENT NOT NULL, block_id INT DEFAULT NULL, landing_id INT DEFAULT NULL, parent_id INT DEFAULT NULL, enabled TINYINT(1) NOT NULL, name VARCHAR(255) NOT NULL, is_container TINYINT(1) NOT NULL, position INT NOT NULL, columns INT NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_5B4FA51EE9ED820C (block_id), INDEX IDX_5B4FA51EEFD98736 (landing_id), INDEX IDX_5B4FA51E727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sylius_taxon_cover (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, path VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_93D0A9B27E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ctic_cms_block_slider ADD CONSTRAINT FK_7FAB80C7E3C61F9 FOREIGN KEY (owner_id) REFERENCES bitbag_cms_block_translation (id)');
        $this->addSql('ALTER TABLE ctic_cms_block_sliderelement ADD CONSTRAINT FK_EF2AD510727ACA70 FOREIGN KEY (parent_id) REFERENCES ctic_cms_block_slider (id)');
        $this->addSql('ALTER TABLE ctic_cms_block_sliderelementimage ADD CONSTRAINT FK_586BF6637E3C61F9 FOREIGN KEY (owner_id) REFERENCES ctic_cms_block_sliderelement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ctic_cms_home ADD CONSTRAINT FK_F4C1AD34EFD98736 FOREIGN KEY (landing_id) REFERENCES ctic_cms_landing (id)');
        $this->addSql('ALTER TABLE ctic_cms_home ADD CONSTRAINT FK_F4C1AD3472F5A1AA FOREIGN KEY (channel_id) REFERENCES sylius_channel (id)');
        $this->addSql('ALTER TABLE ctic_cms_landingelement ADD CONSTRAINT FK_5B4FA51EE9ED820C FOREIGN KEY (block_id) REFERENCES bitbag_cms_block (id)');
        $this->addSql('ALTER TABLE ctic_cms_landingelement ADD CONSTRAINT FK_5B4FA51EEFD98736 FOREIGN KEY (landing_id) REFERENCES ctic_cms_landing (id)');
        $this->addSql('ALTER TABLE ctic_cms_landingelement ADD CONSTRAINT FK_5B4FA51E727ACA70 FOREIGN KEY (parent_id) REFERENCES ctic_cms_landingelement (id)');
        $this->addSql('ALTER TABLE sylius_taxon_cover ADD CONSTRAINT FK_93D0A9B27E3C61F9 FOREIGN KEY (owner_id) REFERENCES sylius_taxon (id)');
        $this->addSql('ALTER TABLE bitbag_cms_page ADD landing_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bitbag_cms_page ADD CONSTRAINT FK_18F07F1BEFD98736 FOREIGN KEY (landing_id) REFERENCES ctic_cms_landing (id)');
        $this->addSql('CREATE INDEX IDX_18F07F1BEFD98736 ON bitbag_cms_page (landing_id)');
        $this->addSql('ALTER TABLE bitbag_cms_block_translation ADD taxon_id INT DEFAULT NULL, ADD page_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bitbag_cms_block_translation ADD CONSTRAINT FK_32897FDFDE13F470 FOREIGN KEY (taxon_id) REFERENCES sylius_taxon (id)');
        $this->addSql('ALTER TABLE bitbag_cms_block_translation ADD CONSTRAINT FK_32897FDFC4663E4 FOREIGN KEY (page_id) REFERENCES bitbag_cms_page (id)');
        $this->addSql('CREATE INDEX IDX_32897FDFDE13F470 ON bitbag_cms_block_translation (taxon_id)');
        $this->addSql('CREATE INDEX IDX_32897FDFC4663E4 ON bitbag_cms_block_translation (page_id)');
        $this->addSql('ALTER TABLE bitbag_cms_faq ADD landing_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bitbag_cms_faq ADD CONSTRAINT FK_A42D7607EFD98736 FOREIGN KEY (landing_id) REFERENCES ctic_cms_landing (id)');
        $this->addSql('CREATE INDEX IDX_A42D7607EFD98736 ON bitbag_cms_faq (landing_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ctic_cms_block_sliderelement DROP FOREIGN KEY FK_EF2AD510727ACA70');
        $this->addSql('ALTER TABLE ctic_cms_block_sliderelementimage DROP FOREIGN KEY FK_586BF6637E3C61F9');
        $this->addSql('ALTER TABLE bitbag_cms_page DROP FOREIGN KEY FK_18F07F1BEFD98736');
        $this->addSql('ALTER TABLE bitbag_cms_faq DROP FOREIGN KEY FK_A42D7607EFD98736');
        $this->addSql('ALTER TABLE ctic_cms_home DROP FOREIGN KEY FK_F4C1AD34EFD98736');
        $this->addSql('ALTER TABLE ctic_cms_landingelement DROP FOREIGN KEY FK_5B4FA51EEFD98736');
        $this->addSql('ALTER TABLE ctic_cms_landingelement DROP FOREIGN KEY FK_5B4FA51E727ACA70');
        $this->addSql('DROP TABLE ctic_cms_block_slider');
        $this->addSql('DROP TABLE ctic_cms_block_sliderelement');
        $this->addSql('DROP TABLE ctic_cms_block_sliderelementimage');
        $this->addSql('DROP TABLE ctic_cms_home');
        $this->addSql('DROP TABLE ctic_cms_landing');
        $this->addSql('DROP TABLE ctic_cms_landingelement');
        $this->addSql('DROP TABLE sylius_taxon_cover');
        $this->addSql('ALTER TABLE bitbag_cms_block_translation DROP FOREIGN KEY FK_32897FDFDE13F470');
        $this->addSql('ALTER TABLE bitbag_cms_block_translation DROP FOREIGN KEY FK_32897FDFC4663E4');
        $this->addSql('DROP INDEX IDX_32897FDFDE13F470 ON bitbag_cms_block_translation');
        $this->addSql('DROP INDEX IDX_32897FDFC4663E4 ON bitbag_cms_block_translation');
        $this->addSql('ALTER TABLE bitbag_cms_block_translation DROP taxon_id, DROP page_id');
        $this->addSql('DROP INDEX IDX_A42D7607EFD98736 ON bitbag_cms_faq');
        $this->addSql('ALTER TABLE bitbag_cms_faq DROP landing_id');
        $this->addSql('DROP INDEX IDX_18F07F1BEFD98736 ON bitbag_cms_page');
        $this->addSql('ALTER TABLE bitbag_cms_page DROP landing_id');
    }
}
