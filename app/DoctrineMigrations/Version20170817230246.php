<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170817230246 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, hostname VARCHAR(255) NOT NULL, seo_description VARCHAR(255) DEFAULT NULL, seo_keywords VARCHAR(255) DEFAULT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, enabled TINYINT(1) NOT NULL, mission_text LONGTEXT DEFAULT NULL, show_menu_mission TINYINT(1) NOT NULL, show_menu_upload TINYINT(1) NOT NULL, public_visible TINYINT(1) NOT NULL, archive_intro_text LONGTEXT DEFAULT NULL, call_to_action_title VARCHAR(255) DEFAULT NULL, call_to_action_text LONGTEXT DEFAULT NULL, image_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo_city (city_id INT NOT NULL, photo_id INT NOT NULL, INDEX IDX_AC6AB0C08BAC62AF (city_id), INDEX IDX_AC6AB0C07E9E4C8C (photo_id), PRIMARY KEY(city_id, photo_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE photo_city ADD CONSTRAINT FK_AC6AB0C08BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE photo_city ADD CONSTRAINT FK_AC6AB0C07E9E4C8C FOREIGN KEY (photo_id) REFERENCES photo (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE photo_city DROP FOREIGN KEY FK_AC6AB0C08BAC62AF');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE photo_city');
    }
}
