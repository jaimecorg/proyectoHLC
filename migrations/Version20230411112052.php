<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230411112052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cita (id INT AUTO_INCREMENT NOT NULL, mascota_id INT DEFAULT NULL, veterinario_id INT DEFAULT NULL, fecha DATETIME NOT NULL, INDEX IDX_3E379A62FB60C59E (mascota_id), INDEX IDX_3E379A621454BD8B (veterinario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cita_tratamiento (cita_id INT NOT NULL, tratamiento_id INT NOT NULL, INDEX IDX_AC14CBC41E011DDF (cita_id), INDEX IDX_AC14CBC444168F7D (tratamiento_id), PRIMARY KEY(cita_id, tratamiento_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE duenio (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(50) NOT NULL, apellidos VARCHAR(255) NOT NULL, correo VARCHAR(255) NOT NULL, telefono VARCHAR(20) NOT NULL, direccion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE empleado (id INT AUTO_INCREMENT NOT NULL, usuario VARCHAR(255) NOT NULL, clave VARCHAR(255) NOT NULL, permisos VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mascota (id INT AUTO_INCREMENT NOT NULL, duenio_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, especie VARCHAR(255) DEFAULT NULL, raza VARCHAR(255) DEFAULT NULL, fecha_nacimiento DATETIME DEFAULT NULL, INDEX IDX_11298D778621B8D1 (duenio_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tratamiento (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, descripcion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE veterinario (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(50) NOT NULL, apellidos VARCHAR(255) NOT NULL, especialidad VARCHAR(100) NOT NULL, correo VARCHAR(255) NOT NULL, telefono VARCHAR(20) NOT NULL, direccion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cita ADD CONSTRAINT FK_3E379A62FB60C59E FOREIGN KEY (mascota_id) REFERENCES mascota (id)');
        $this->addSql('ALTER TABLE cita ADD CONSTRAINT FK_3E379A621454BD8B FOREIGN KEY (veterinario_id) REFERENCES veterinario (id)');
        $this->addSql('ALTER TABLE cita_tratamiento ADD CONSTRAINT FK_AC14CBC41E011DDF FOREIGN KEY (cita_id) REFERENCES cita (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cita_tratamiento ADD CONSTRAINT FK_AC14CBC444168F7D FOREIGN KEY (tratamiento_id) REFERENCES tratamiento (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mascota ADD CONSTRAINT FK_11298D778621B8D1 FOREIGN KEY (duenio_id) REFERENCES duenio (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cita DROP FOREIGN KEY FK_3E379A62FB60C59E');
        $this->addSql('ALTER TABLE cita DROP FOREIGN KEY FK_3E379A621454BD8B');
        $this->addSql('ALTER TABLE cita_tratamiento DROP FOREIGN KEY FK_AC14CBC41E011DDF');
        $this->addSql('ALTER TABLE cita_tratamiento DROP FOREIGN KEY FK_AC14CBC444168F7D');
        $this->addSql('ALTER TABLE mascota DROP FOREIGN KEY FK_11298D778621B8D1');
        $this->addSql('DROP TABLE cita');
        $this->addSql('DROP TABLE cita_tratamiento');
        $this->addSql('DROP TABLE duenio');
        $this->addSql('DROP TABLE empleado');
        $this->addSql('DROP TABLE mascota');
        $this->addSql('DROP TABLE tratamiento');
        $this->addSql('DROP TABLE veterinario');
    }
}
