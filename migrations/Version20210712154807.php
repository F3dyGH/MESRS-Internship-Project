<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210712154807 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category ADD prod VARCHAR(255) NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE nom name VARCHAR(255) NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE product ADD idcat_id INT DEFAULT NULL, ADD name VARCHAR(255) NOT NULL, ADD price DOUBLE PRECISION NOT NULL, ADD image VARCHAR(255) NOT NULL, ADD description VARCHAR(255) NOT NULL');
        $this->addSql('CREATE INDEX IDX_D34A04AD821004EF ON product (idcat_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE category DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE category ADD nom VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, DROP name, DROP prod, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD821004EF');
        $this->addSql('DROP INDEX IDX_D34A04AD821004EF ON product');
        $this->addSql('ALTER TABLE product DROP idcat_id, DROP name, DROP price, DROP image, DROP description');
    }
}
