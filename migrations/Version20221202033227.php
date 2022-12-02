<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221202033227 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cards (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_rarety_id INTEGER DEFAULT NULL, id_mst_id INTEGER DEFAULT NULL, CONSTRAINT FK_4C258FD483092F FOREIGN KEY (id_rarety_id) REFERENCES rarety (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_4C258FDE0B0B93C FOREIGN KEY (id_mst_id) REFERENCES mst (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_4C258FD483092F ON cards (id_rarety_id)');
        $this->addSql('CREATE INDEX IDX_4C258FDE0B0B93C ON cards (id_mst_id)');
        $this->addSql('CREATE TABLE choice (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, label VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE mst (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(40) NOT NULL, description CLOB NOT NULL, mortality DOUBLE PRECISION DEFAULT NULL, transmission VARCHAR(255) NOT NULL, text VARCHAR(255) NOT NULL, treatment VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE questions (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, good_answer_id INTEGER DEFAULT NULL, win_id INTEGER DEFAULT NULL, label VARCHAR(255) NOT NULL, CONSTRAINT FK_8ADC54D5AFC6C4EA FOREIGN KEY (good_answer_id) REFERENCES choice (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8ADC54D5713E15F4 FOREIGN KEY (win_id) REFERENCES cards (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8ADC54D5AFC6C4EA ON questions (good_answer_id)');
        $this->addSql('CREATE INDEX IDX_8ADC54D5713E15F4 ON questions (win_id)');
        $this->addSql('CREATE TABLE rarety (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, label VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE testimony (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, mst_id INTEGER DEFAULT NULL, name VARCHAR(100) NOT NULL, age INTEGER NOT NULL, content CLOB NOT NULL, validate BOOLEAN NOT NULL, CONSTRAINT FK_523C9487C6870CD1 FOREIGN KEY (mst_id) REFERENCES mst (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_523C9487C6870CD1 ON testimony (mst_id)');
        $this->addSql('CREATE TABLE "user" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON "user" (username)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE cards');
        $this->addSql('DROP TABLE choice');
        $this->addSql('DROP TABLE mst');
        $this->addSql('DROP TABLE questions');
        $this->addSql('DROP TABLE rarety');
        $this->addSql('DROP TABLE testimony');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
