<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241220143519 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE student (
                                id INT NOT NULL, 
                                name VARCHAR(255) NOT NULL, 
                                year INT NOT NULL, status VARCHAR(255) NOT NULL, 
                                PRIMARY KEY(id)) );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE student');
    }
}
