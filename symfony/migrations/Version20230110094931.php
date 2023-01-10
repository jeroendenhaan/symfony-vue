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
        $sql = <<<SQL
INSERT INTO `character` (name, race, age)
VALUES ('Frodo Baggins', 'Hobbit', 33);

INSERT INTO `character` (name, race, age)
VALUES ('Gandalf', 'Istar', 2019);

INSERT INTO `character` (name, race, age)
VALUES ('Aragorn', 'Human', 87);

INSERT INTO `character` (name, race, age)
VALUES ('Legolas', 'Elf', 2931);

INSERT INTO `character` (name, race, age)
VALUES ('Gimli', 'Dwarf', 139);

INSERT INTO `character` (name, race, age)
VALUES ('Saruman', 'Istar', 2019);

INSERT INTO `character` (name, race, age)
VALUES ('Bilbo Baggins', 'Hobbit', 111);

INSERT INTO `character` (name, race, age)
VALUES ('Galadriel', 'Elf', 6029);

INSERT INTO `character` (name, race, age)
VALUES ('Theoden', 'Human', 63);

INSERT INTO `character` (name, race, age)
VALUES ('Eomer', 'Human', 30);

INSERT INTO `character` (name, race, age)
VALUES ('Peregrin Took', 'Hobbit', 33);

INSERT INTO `character` (name, race, age)
VALUES ('Merry Brandybuck', 'Hobbit', 33);

INSERT INTO `character` (name, race, age)
VALUES ('Samwise Gamgee', 'Hobbit', 38);

INSERT INTO `character` (name, race, age)
VALUES ('Boromir', 'Human', 37);

INSERT INTO `character` (name, race, age)
VALUES ('Faramir', 'Human', 38);
SQL;

        // Fill with some test data
        $this->addSql($sql);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql("TRUNCATE TABLE person");

    }
}
