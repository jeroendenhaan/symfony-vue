<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230110094931 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // Fill with some test data
        $this->addSql("INSERT INTO person (first_name, last_name, type) VALUES ('Gandalf', 'the Grey', 'Wizard')");
        $this->addSql("INSERT INTO person (first_name, last_name, type) VALUES ('Gimli', null, 'Dwarf')");
        $this->addSql("INSERT INTO person (first_name, last_name, type) VALUES ('Boromir', null, 'Dead')");
        $this->addSql("INSERT INTO person (first_name, last_name, type) VALUES ('Aragorn II', 'Elessar', 'King')");
        $this->addSql("INSERT INTO person (first_name, last_name, type) VALUES ('Samwise', 'Gamgee', 'Hobbit')");
        $this->addSql("INSERT INTO person (first_name, last_name, type) VALUES ('Frodo', 'Baggins', 'Hobbit')");
        $this->addSql("INSERT INTO person (first_name, last_name, type) VALUES ('Sauron', null, 'Bad guy')");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql("TRUNCATE TABLE person");

    }
}
