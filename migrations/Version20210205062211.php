<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210205062211 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annonces_users (annonces_id INT NOT NULL, users_id INT NOT NULL, PRIMARY KEY(annonces_id, users_id))');
        $this->addSql('CREATE INDEX IDX_F60119834C2885D7 ON annonces_users (annonces_id)');
        $this->addSql('CREATE INDEX IDX_F601198367B3B43D ON annonces_users (users_id)');
        $this->addSql('ALTER TABLE annonces_users ADD CONSTRAINT FK_F60119834C2885D7 FOREIGN KEY (annonces_id) REFERENCES annonces (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE annonces_users ADD CONSTRAINT FK_F601198367B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE annonces_users');
    }
}
