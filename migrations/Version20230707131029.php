<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230707131029 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fav_cards_private CHANGE status status INT DEFAULT 1');
        $this->addSql('ALTER TABLE fav_cards_public CHANGE status status INT DEFAULT 2');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fav_cards_private CHANGE status status INT DEFAULT 1 NOT NULL');
        $this->addSql('ALTER TABLE fav_cards_public CHANGE status status INT DEFAULT 2 NOT NULL');
    }
}
