<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190403083504 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cinema (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(70) NOT NULL, address VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room (id INT AUTO_INCREMENT NOT NULL, cinema_name_id INT NOT NULL, room_num INT NOT NULL, air_conditioned INT NOT NULL, capacity INT NOT NULL, UNIQUE INDEX UNIQ_729F519B47FD3E0A (cinema_name_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE showtime (id INT AUTO_INCREMENT NOT NULL, cinema_name_id INT NOT NULL, room_num_id INT NOT NULL, id_movie_id INT NOT NULL, begin INT NOT NULL, end TIME NOT NULL, UNIQUE INDEX UNIQ_3248D9147FD3E0A (cinema_name_id), UNIQUE INDEX UNIQ_3248D91A30C550B (room_num_id), UNIQUE INDEX UNIQ_3248D91DF485A69 (id_movie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B47FD3E0A FOREIGN KEY (cinema_name_id) REFERENCES cinema (id)');
        $this->addSql('ALTER TABLE showtime ADD CONSTRAINT FK_3248D9147FD3E0A FOREIGN KEY (cinema_name_id) REFERENCES cinema (id)');
        $this->addSql('ALTER TABLE showtime ADD CONSTRAINT FK_3248D91A30C550B FOREIGN KEY (room_num_id) REFERENCES room (id)');
        $this->addSql('ALTER TABLE showtime ADD CONSTRAINT FK_3248D91DF485A69 FOREIGN KEY (id_movie_id) REFERENCES movie (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519B47FD3E0A');
        $this->addSql('ALTER TABLE showtime DROP FOREIGN KEY FK_3248D9147FD3E0A');
        $this->addSql('ALTER TABLE showtime DROP FOREIGN KEY FK_3248D91A30C550B');
        $this->addSql('DROP TABLE cinema');
        $this->addSql('DROP TABLE room');
        $this->addSql('DROP TABLE showtime');
    }
}
