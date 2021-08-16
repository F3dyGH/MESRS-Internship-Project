<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210816033642 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //$this->addSql('ALTER TABLE category CHANGE prod prod VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE inst_form ADD inst_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inst_form ADD CONSTRAINT FK_57146EF072930994 FOREIGN KEY (inst_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_57146EF072930994 ON inst_form (inst_id)');
        //$this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE name name VARCHAR(255) NOT NULL, CHANGE lastname lastname VARCHAR(255) NOT NULL, CHANGE username username VARCHAR(255) NOT NULL, CHANGE image image VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(255) NOT NULL, CHANGE updated_at updated_at DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category CHANGE prod prod VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE inst_form DROP FOREIGN KEY FK_57146EF072930994');
        $this->addSql('DROP INDEX IDX_57146EF072930994 ON inst_form');
        $this->addSql('ALTER TABLE inst_form DROP inst_id');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD821004EF');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON DEFAULT NULL, CHANGE name name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE lastname lastname VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE username username VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE updated_at updated_at DATETIME DEFAULT NULL, CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
