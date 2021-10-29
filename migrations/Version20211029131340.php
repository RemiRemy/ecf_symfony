<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211029131340 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE libelle_produit (libelle_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_93E31D5D25DD318D (libelle_id), INDEX IDX_93E31D5DF347EFB (produit_id), PRIMARY KEY(libelle_id, produit_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE libelle_produit ADD CONSTRAINT FK_93E31D5D25DD318D FOREIGN KEY (libelle_id) REFERENCES libelle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE libelle_produit ADD CONSTRAINT FK_93E31D5DF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE libelle_produit');
    }
}
