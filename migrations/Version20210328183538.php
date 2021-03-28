<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210328183538 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE schedule_show (id varchar(36) NOT NULL, hall_id varchar(36) DEFAULT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, price_amount DOUBLE PRECISION NOT NULL, INDEX IDX_D246F95A52AFCFD6 (hall_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE schedule_show ADD CONSTRAINT FK_D246F95A52AFCFD6 FOREIGN KEY (hall_id) REFERENCES schedule_hall (id)');
        $this->addSql('ALTER TABLE cinema_hall CHANGE id id varchar(36) NOT NULL');
        $this->addSql('ALTER TABLE schedule_hall CHANGE id id varchar(36) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE schedule_show');
        $this->addSql('ALTER TABLE cinema_hall CHANGE id id VARCHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE schedule_hall CHANGE id id VARCHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
