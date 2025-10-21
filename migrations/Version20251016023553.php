<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251016023553 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE stocks (id INT AUTO_INCREMENT NOT NULL, productname_id INT NOT NULL, stock INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', image VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_56F79805EA583AF1 (productname_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE stocks ADD CONSTRAINT FK_56F79805EA583AF1 FOREIGN KEY (productname_id) REFERENCES pcproducts (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inventory_log DROP FOREIGN KEY FK_F65507A1EA583AF1');
        $this->addSql('DROP TABLE inventory_log');
        $this->addSql('ALTER TABLE pcproducts CHANGE createdat createdat DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE inventory_log (id INT AUTO_INCREMENT NOT NULL, productname_id INT NOT NULL, stock INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, availability_status VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'Available\' NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_F65507A1EA583AF1 (productname_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE inventory_log ADD CONSTRAINT FK_F65507A1EA583AF1 FOREIGN KEY (productname_id) REFERENCES pcproducts (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE stocks DROP FOREIGN KEY FK_56F79805EA583AF1');
        $this->addSql('DROP TABLE stocks');
        $this->addSql('ALTER TABLE pcproducts CHANGE createdat createdat DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }
}
