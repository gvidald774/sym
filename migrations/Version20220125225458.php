<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220125225458 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1435D52D7F8F253B ON alumno (dni)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9243D6CE3A909126 ON asignatura (nombre)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4E10122D3A909126 ON categoria (nombre)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_1435D52D7F8F253B ON alumno');
        $this->addSql('DROP INDEX UNIQ_9243D6CE3A909126 ON asignatura');
        $this->addSql('DROP INDEX UNIQ_4E10122D3A909126 ON categoria');
    }
}
