<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251016031857 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inventory_log DROP FOREIGN KEY FK_F65507A1EA583AF1');
        $this->addSql('DROP TABLE inventory_log');
        $this->addSql('ALTER TABLE pcproducts CHANGE createdat createdat DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE servicebooking ADD customer_name_id INT NOT NULL, DROP customer_name');
        $this->addSql('ALTER TABLE servicebooking ADD CONSTRAINT FK_27F80F6B6DCA3868 FOREIGN KEY (customer_name_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_27F80F6B6DCA3868 ON servicebooking (customer_name_id)');
        $this->addSql('ALTER TABLE stocks CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE updated_at updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE stocks RENAME INDEX fk_stocks_pcproducts TO IDX_56F79805EA583AF1');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL, CHANGE password password VARCHAR(255) NOT NULL, CHANGE roles roles JSON NOT NULL, CHANGE phone_number phone_number VARCHAR(200) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE inventory_log (id INT AUTO_INCREMENT NOT NULL, productname_id INT NOT NULL, stock INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, availability_status VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'Available\' NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_F65507A1EA583AF1 (productname_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE inventory_log ADD CONSTRAINT FK_F65507A1EA583AF1 FOREIGN KEY (productname_id) REFERENCES pcproducts (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE servicebooking DROP FOREIGN KEY FK_27F80F6B6DCA3868');
        $this->addSql('DROP INDEX IDX_27F80F6B6DCA3868 ON servicebooking');
        $this->addSql('ALTER TABLE servicebooking ADD customer_name VARCHAR(255) NOT NULL, DROP customer_name_id');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(255) NOT NULL, CHANGE password password VARCHAR(100) NOT NULL, CHANGE roles roles VARCHAR(20) NOT NULL, CHANGE phone_number phone_number VARCHAR(200) NOT NULL');
        $this->addSql('ALTER TABLE stocks CHANGE created_at created_at DATETIME NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE stocks RENAME INDEX idx_56f79805ea583af1 TO FK_stocks_pcproducts');
        $this->addSql('ALTER TABLE pcproducts CHANGE createdat createdat DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }
}
