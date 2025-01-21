<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250121104633 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clothing (id INT AUTO_INCREMENT NOT NULL, categories_id INT NOT NULL, sizes_id INT NOT NULL, notes_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, price DOUBLE PRECISION NOT NULL, releas_date DATETIME NOT NULL, image_path VARCHAR(255) NOT NULL, INDEX IDX_139C38B1A21214B7 (categories_id), INDEX IDX_139C38B1423285E6 (sizes_id), INDEX IDX_139C38B1FC56F556 (notes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, average_rating NUMERIC(10, 2) NOT NULL, user_rating NUMERIC(10, 2) NOT NULL, INDEX IDX_CFBDFA1467B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE size (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE clothing ADD CONSTRAINT FK_139C38B1A21214B7 FOREIGN KEY (categories_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE clothing ADD CONSTRAINT FK_139C38B1423285E6 FOREIGN KEY (sizes_id) REFERENCES size (id)');
        $this->addSql('ALTER TABLE clothing ADD CONSTRAINT FK_139C38B1FC56F556 FOREIGN KEY (notes_id) REFERENCES note (id)');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA1467B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clothing DROP FOREIGN KEY FK_139C38B1A21214B7');
        $this->addSql('ALTER TABLE clothing DROP FOREIGN KEY FK_139C38B1423285E6');
        $this->addSql('ALTER TABLE clothing DROP FOREIGN KEY FK_139C38B1FC56F556');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA1467B3B43D');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE clothing');
        $this->addSql('DROP TABLE note');
        $this->addSql('DROP TABLE size');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
