<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190403094938 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519B47FD3E0A');
        $this->addSql('ALTER TABLE showtime DROP FOREIGN KEY FK_3248D9147FD3E0A');
        $this->addSql('DROP TABLE cinema');
        $this->addSql('DROP TABLE movie_artist');
        $this->addSql('ALTER TABLE movie DROP FOREIGN KEY FK_1D5EF26F899FB366');
        $this->addSql('DROP INDEX IDX_1D5EF26F899FB366 ON movie');
        $this->addSql('ALTER TABLE movie ADD name VARCHAR(70) NOT NULL, DROP director_id, DROP year, CHANGE title address VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX UNIQ_729F519B47FD3E0A ON room');
        $this->addSql('ALTER TABLE room CHANGE cinema_name_id movie_name_id INT NOT NULL');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B5181DEF8 FOREIGN KEY (movie_name_id) REFERENCES movie (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_729F519B5181DEF8 ON room (movie_name_id)');
        $this->addSql('DROP INDEX UNIQ_3248D9147FD3E0A ON showtime');
        $this->addSql('ALTER TABLE showtime CHANGE cinema_name_id movie_name_id INT NOT NULL');
        $this->addSql('ALTER TABLE showtime ADD CONSTRAINT FK_3248D915181DEF8 FOREIGN KEY (movie_name_id) REFERENCES movie (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3248D915181DEF8 ON showtime (movie_name_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cinema (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(70) NOT NULL COLLATE utf8mb4_unicode_ci, address VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE movie_artist (movie_id INT NOT NULL, artist_id INT NOT NULL, INDEX IDX_F89E0BF28F93B6FC (movie_id), INDEX IDX_F89E0BF2B7970CF8 (artist_id), PRIMARY KEY(movie_id, artist_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE movie_artist ADD CONSTRAINT FK_F89E0BF28F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie_artist ADD CONSTRAINT FK_F89E0BF2B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie ADD director_id INT NOT NULL, ADD year INT NOT NULL, DROP name, CHANGE address title VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE movie ADD CONSTRAINT FK_1D5EF26F899FB366 FOREIGN KEY (director_id) REFERENCES artist (id)');
        $this->addSql('CREATE INDEX IDX_1D5EF26F899FB366 ON movie (director_id)');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519B5181DEF8');
        $this->addSql('DROP INDEX UNIQ_729F519B5181DEF8 ON room');
        $this->addSql('ALTER TABLE room CHANGE movie_name_id cinema_name_id INT NOT NULL');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B47FD3E0A FOREIGN KEY (cinema_name_id) REFERENCES cinema (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_729F519B47FD3E0A ON room (cinema_name_id)');
        $this->addSql('ALTER TABLE showtime DROP FOREIGN KEY FK_3248D915181DEF8');
        $this->addSql('DROP INDEX UNIQ_3248D915181DEF8 ON showtime');
        $this->addSql('ALTER TABLE showtime CHANGE movie_name_id cinema_name_id INT NOT NULL');
        $this->addSql('ALTER TABLE showtime ADD CONSTRAINT FK_3248D9147FD3E0A FOREIGN KEY (cinema_name_id) REFERENCES cinema (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3248D9147FD3E0A ON showtime (cinema_name_id)');
    }
}
