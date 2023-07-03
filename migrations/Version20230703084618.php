<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230703084618 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fav_cards_private (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, link VARCHAR(255) NOT NULL, status INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_ABE0A582F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fav_cards_private_tags (fav_cards_private_id INT NOT NULL, tags_id INT NOT NULL, INDEX IDX_671B5B7AF78AA0A1 (fav_cards_private_id), INDEX IDX_671B5B7A8D7B4FB4 (tags_id), PRIMARY KEY(fav_cards_private_id, tags_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fav_cards_public (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, link VARCHAR(255) NOT NULL, status INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_168D914F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fav_cards_public_tags (fav_cards_public_id INT NOT NULL, tags_id INT NOT NULL, INDEX IDX_A37A88B56EFD59A1 (fav_cards_public_id), INDEX IDX_A37A88B58D7B4FB4 (tags_id), PRIMARY KEY(fav_cards_public_id, tags_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tags (id INT AUTO_INCREMENT NOT NULL, tag VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nickname VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fav_cards_private ADD CONSTRAINT FK_ABE0A582F675F31B FOREIGN KEY (author_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE fav_cards_private_tags ADD CONSTRAINT FK_671B5B7AF78AA0A1 FOREIGN KEY (fav_cards_private_id) REFERENCES fav_cards_private (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fav_cards_private_tags ADD CONSTRAINT FK_671B5B7A8D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tags (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fav_cards_public ADD CONSTRAINT FK_168D914F675F31B FOREIGN KEY (author_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE fav_cards_public_tags ADD CONSTRAINT FK_A37A88B56EFD59A1 FOREIGN KEY (fav_cards_public_id) REFERENCES fav_cards_public (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fav_cards_public_tags ADD CONSTRAINT FK_A37A88B58D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tags (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fav_cards_private DROP FOREIGN KEY FK_ABE0A582F675F31B');
        $this->addSql('ALTER TABLE fav_cards_private_tags DROP FOREIGN KEY FK_671B5B7AF78AA0A1');
        $this->addSql('ALTER TABLE fav_cards_private_tags DROP FOREIGN KEY FK_671B5B7A8D7B4FB4');
        $this->addSql('ALTER TABLE fav_cards_public DROP FOREIGN KEY FK_168D914F675F31B');
        $this->addSql('ALTER TABLE fav_cards_public_tags DROP FOREIGN KEY FK_A37A88B56EFD59A1');
        $this->addSql('ALTER TABLE fav_cards_public_tags DROP FOREIGN KEY FK_A37A88B58D7B4FB4');
        $this->addSql('DROP TABLE fav_cards_private');
        $this->addSql('DROP TABLE fav_cards_private_tags');
        $this->addSql('DROP TABLE fav_cards_public');
        $this->addSql('DROP TABLE fav_cards_public_tags');
        $this->addSql('DROP TABLE tags');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
