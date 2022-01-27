<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220125115037 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE asignatura (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, curso INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asignatura_alumno (asignatura_id INT NOT NULL, alumno_id INT NOT NULL, INDEX IDX_BD5922FCC5C70C5B (asignatura_id), INDEX IDX_BD5922FCFC28E5EE (alumno_id), PRIMARY KEY(asignatura_id, alumno_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE asignatura_alumno ADD CONSTRAINT FK_BD5922FCC5C70C5B FOREIGN KEY (asignatura_id) REFERENCES asignatura (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE asignatura_alumno ADD CONSTRAINT FK_BD5922FCFC28E5EE FOREIGN KEY (alumno_id) REFERENCES alumno (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE asignatura_alumno DROP FOREIGN KEY FK_BD5922FCC5C70C5B');
        $this->addSql('DROP TABLE asignatura');
        $this->addSql('DROP TABLE asignatura_alumno');
    }
}
