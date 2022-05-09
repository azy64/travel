<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220509114201 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE etape (id INT AUTO_INCREMENT NOT NULL, voyage_id INT NOT NULL, transport_id INT NOT NULL, depart VARCHAR(100) NOT NULL, arrival VARCHAR(100) NOT NULL, depart_date DATETIME NOT NULL, arrival_date DATETIME NOT NULL, seat VARCHAR(4) DEFAULT NULL, gate VARCHAR(5) DEFAULT NULL, INDEX IDX_285F75DD68C9E5AF (voyage_id), UNIQUE INDEX UNIQ_285F75DD9909C13F (transport_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transport (id INT AUTO_INCREMENT NOT NULL, type_transport_id INT NOT NULL, number VARCHAR(5) NOT NULL, INDEX IDX_66AB212E1E4A7B3A (type_transport_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_transport (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyages (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE etape ADD CONSTRAINT FK_285F75DD68C9E5AF FOREIGN KEY (voyage_id) REFERENCES voyages (id)');
        $this->addSql('ALTER TABLE etape ADD CONSTRAINT FK_285F75DD9909C13F FOREIGN KEY (transport_id) REFERENCES transport (id)');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212E1E4A7B3A FOREIGN KEY (type_transport_id) REFERENCES type_transport (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etape DROP FOREIGN KEY FK_285F75DD9909C13F');
        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212E1E4A7B3A');
        $this->addSql('ALTER TABLE etape DROP FOREIGN KEY FK_285F75DD68C9E5AF');
        $this->addSql('DROP TABLE etape');
        $this->addSql('DROP TABLE transport');
        $this->addSql('DROP TABLE type_transport');
        $this->addSql('DROP TABLE voyages');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
