<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210526092333 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_E618D5BB6C6E55B564C19C1 ON produit');
        $this->addSql('CREATE FULLTEXT INDEX IDX_E618D5BB6C6E55B564C19C15A6F91CE ON produit (nom, category, marque)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_E618D5BB6C6E55B564C19C15A6F91CE ON Produit');
        $this->addSql('CREATE INDEX IDX_E618D5BB6C6E55B564C19C1 ON Produit (nom, category)');
    }
}
