<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230703065949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fav_cards_private_tags (fav_cards_private_id INT NOT NULL, tags_id INT NOT NULL, INDEX IDX_671B5B7AF78AA0A1 (fav_cards_private_id), INDEX IDX_671B5B7A8D7B4FB4 (tags_id), PRIMARY KEY(fav_cards_private_id, tags_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fav_cards_public_tags (fav_cards_public_id INT NOT NULL, tags_id INT NOT NULL, INDEX IDX_A37A88B56EFD59A1 (fav_cards_public_id), INDEX IDX_A37A88B58D7B4FB4 (tags_id), PRIMARY KEY(fav_cards_public_id, tags_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fav_cards_private_tags ADD CONSTRAINT FK_671B5B7AF78AA0A1 FOREIGN KEY (fav_cards_private_id) REFERENCES fav_cards_private (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fav_cards_private_tags ADD CONSTRAINT FK_671B5B7A8D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tags (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fav_cards_public_tags ADD CONSTRAINT FK_A37A88B56EFD59A1 FOREIGN KEY (fav_cards_public_id) REFERENCES fav_cards_public (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fav_cards_public_tags ADD CONSTRAINT FK_A37A88B58D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tags (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fav_cards_private ADD author_id INT NOT NULL');
        $this->addSql('ALTER TABLE fav_cards_private ADD CONSTRAINT FK_ABE0A582F675F31B FOREIGN KEY (author_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_ABE0A582F675F31B ON fav_cards_private (author_id)');
        $this->addSql('ALTER TABLE fav_cards_public ADD author_id INT NOT NULL');
        $this->addSql('ALTER TABLE fav_cards_public ADD CONSTRAINT FK_168D914F675F31B FOREIGN KEY (author_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_168D914F675F31B ON fav_cards_public (author_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fav_cards_private_tags DROP FOREIGN KEY FK_671B5B7AF78AA0A1');
        $this->addSql('ALTER TABLE fav_cards_private_tags DROP FOREIGN KEY FK_671B5B7A8D7B4FB4');
        $this->addSql('ALTER TABLE fav_cards_public_tags DROP FOREIGN KEY FK_A37A88B56EFD59A1');
        $this->addSql('ALTER TABLE fav_cards_public_tags DROP FOREIGN KEY FK_A37A88B58D7B4FB4');
        $this->addSql('DROP TABLE fav_cards_private_tags');
        $this->addSql('DROP TABLE fav_cards_public_tags');
        $this->addSql('ALTER TABLE fav_cards_private DROP FOREIGN KEY FK_ABE0A582F675F31B');
        $this->addSql('DROP INDEX IDX_ABE0A582F675F31B ON fav_cards_private');
        $this->addSql('ALTER TABLE fav_cards_private DROP author_id');
        $this->addSql('ALTER TABLE fav_cards_public DROP FOREIGN KEY FK_168D914F675F31B');
        $this->addSql('DROP INDEX IDX_168D914F675F31B ON fav_cards_public');
        $this->addSql('ALTER TABLE fav_cards_public DROP author_id');
    }
}
