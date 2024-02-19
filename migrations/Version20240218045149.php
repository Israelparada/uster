<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240218045149 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE trip DROP FOREIGN KEY trip_drivers_id_fk');
        $this->addSql('ALTER TABLE trip DROP FOREIGN KEY trip_vehicles_vehicles_id_fk');
        $this->addSql('DROP INDEX trip_drivers_id_fk ON trip');
        $this->addSql('DROP INDEX trip_vehicles_vehicles_id_fk ON trip');
        $this->addSql('ALTER TABLE trip ADD id INT AUTO_INCREMENT NOT NULL, ADD vehicle_id INT NOT NULL, ADD driver_id INT NOT NULL, DROP fk_vehicle_id, DROP fk_drivers_id, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE trip ADD CONSTRAINT FK_7656F53B545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicles (id)');
        $this->addSql('ALTER TABLE trip ADD CONSTRAINT FK_7656F53BC3423909 FOREIGN KEY (driver_id) REFERENCES drivers (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7656F53B545317D1 ON trip (vehicle_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7656F53BC3423909 ON trip (driver_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE trip MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE trip DROP FOREIGN KEY FK_7656F53B545317D1');
        $this->addSql('ALTER TABLE trip DROP FOREIGN KEY FK_7656F53BC3423909');
        $this->addSql('DROP INDEX UNIQ_7656F53B545317D1 ON trip');
        $this->addSql('DROP INDEX UNIQ_7656F53BC3423909 ON trip');
        $this->addSql('DROP INDEX `primary` ON trip');
        $this->addSql('ALTER TABLE trip ADD fk_vehicle_id INT NOT NULL, ADD fk_drivers_id INT NOT NULL, DROP id, DROP vehicle_id, DROP driver_id');
        $this->addSql('ALTER TABLE trip ADD CONSTRAINT trip_drivers_id_fk FOREIGN KEY (fk_drivers_id) REFERENCES drivers (id)');
        $this->addSql('ALTER TABLE trip ADD CONSTRAINT trip_vehicles_vehicles_id_fk FOREIGN KEY (fk_vehicle_id) REFERENCES vehicles (id)');
        $this->addSql('CREATE INDEX trip_drivers_id_fk ON trip (fk_drivers_id)');
        $this->addSql('CREATE INDEX trip_vehicles_vehicles_id_fk ON trip (fk_vehicle_id)');
    }
}
