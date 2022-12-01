<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221201215427 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE items_materials (id UUID NOT NULL, api_id VARCHAR(255) NOT NULL, destructibility DOUBLE PRECISION NOT NULL, min_repair_degradation DOUBLE PRECISION NOT NULL, max_repair_degradation DOUBLE PRECISION NOT NULL, explosion_destructibility DOUBLE PRECISION NOT NULL, min_repair_kit_degradation DOUBLE PRECISION NOT NULL, max_repair_kit_degradation DOUBLE PRECISION NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX items_materials_api_key_idx ON items_materials (api_id)');
        $this->addSql('COMMENT ON COLUMN items_materials.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE items_materials_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, title VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_97113B212C2AC5D3 ON items_materials_translation (translatable_id)');
        $this->addSql('CREATE INDEX item_material_locale_idx ON items_materials_translation (locale)');
        $this->addSql('CREATE UNIQUE INDEX items_materials_translation_unique_translation ON items_materials_translation (translatable_id, locale)');
        $this->addSql('COMMENT ON COLUMN items_materials_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_materials_translation.translatable_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE items_materials_translation ADD CONSTRAINT FK_97113B212C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES items_materials (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE items_materials_translation DROP CONSTRAINT FK_97113B212C2AC5D3');
        $this->addSql('DROP TABLE items_materials');
        $this->addSql('DROP TABLE items_materials_translation');
    }
}
