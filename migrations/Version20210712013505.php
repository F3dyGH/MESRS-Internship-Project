<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210712013505 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE category DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE category CHANGE id `int` INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE category ADD PRIMARY KEY (`int`)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category MODIFY `int` INT NOT NULL');
        $this->addSql('ALTER TABLE category DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE category CHANGE `int` id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE category ADD PRIMARY KEY (id)');
    }
}
