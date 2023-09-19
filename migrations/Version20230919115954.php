<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230919115954 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE items_calibers (id UUID NOT NULL, published BOOLEAN NOT NULL, api_id VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX items_calibers_slug_idx ON items_calibers (slug)');
        $this->addSql('CREATE INDEX items_calibers_api_key_idx ON items_calibers (api_id)');
        $this->addSql('COMMENT ON COLUMN items_calibers.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE items_calibers_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F464FE992C2AC5D3 ON items_calibers_translation (translatable_id)');
        $this->addSql('CREATE INDEX item_calibres_translation_locale_idx ON items_calibers_translation (locale)');
        $this->addSql('CREATE UNIQUE INDEX items_calibers_translation_unique_translation ON items_calibers_translation (translatable_id, locale)');
        $this->addSql('COMMENT ON COLUMN items_calibers_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_calibers_translation.translatable_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE items_calibers_translation ADD CONSTRAINT FK_F464FE992C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES items_calibers (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('COMMENT ON COLUMN items_properties_armor.blunt_throughput IS \'\'');
        $this->addSql('COMMENT ON COLUMN items_properties_chest_rig.blunt_throughput IS \'\'');
        $this->addSql('COMMENT ON COLUMN items_properties_food_drink.energy IS \'\'');
        $this->addSql('COMMENT ON COLUMN items_properties_food_drink.hydration IS \'\'');
        $this->addSql('COMMENT ON COLUMN items_properties_food_drink.units IS \'\'');
        $this->addSql('COMMENT ON COLUMN items_properties_glasses.blunt_throughput IS \'\'');
        $this->addSql('COMMENT ON COLUMN items_properties_helmet.deafening IS \'\'');
        $this->addSql('COMMENT ON COLUMN items_properties_helmet.ricochet_x IS \'\'');
        $this->addSql('COMMENT ON COLUMN items_properties_helmet.ricochet_y IS \'\'');
        $this->addSql('COMMENT ON COLUMN items_properties_helmet.ricochet_z IS \'\'');
        $this->addSql('COMMENT ON COLUMN items_properties_helmet.blunt_throughput IS \'\'');
        $this->addSql('COMMENT ON COLUMN items_properties_medical_item.cures IS \'\'');
        $this->addSql('COMMENT ON COLUMN stimulation_effect.chance IS \'\'');
        $this->addSql('COMMENT ON COLUMN stimulation_effect.delay IS \'\'');
        $this->addSql('COMMENT ON COLUMN stimulation_effect.duration IS \'\'');
        $this->addSql('COMMENT ON COLUMN stimulation_effect.value IS \'\'');
        $this->addSql('COMMENT ON COLUMN stimulation_effect.percent IS \'\'');
        $this->addSql('COMMENT ON COLUMN stimulation_effect_translation.type IS \'\'');
        $this->addSql('COMMENT ON COLUMN stimulation_effect_translation.skill_name IS \'\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE items_calibers_translation DROP CONSTRAINT FK_F464FE992C2AC5D3');
        $this->addSql('DROP TABLE items_calibers');
        $this->addSql('DROP TABLE items_calibers_translation');
        $this->addSql('COMMENT ON COLUMN stimulation_effect_translation.type IS NULL');
        $this->addSql('COMMENT ON COLUMN stimulation_effect_translation.skill_name IS NULL');
        $this->addSql('COMMENT ON COLUMN stimulation_effect.chance IS NULL');
        $this->addSql('COMMENT ON COLUMN stimulation_effect.delay IS NULL');
        $this->addSql('COMMENT ON COLUMN stimulation_effect.duration IS NULL');
        $this->addSql('COMMENT ON COLUMN stimulation_effect.value IS NULL');
        $this->addSql('COMMENT ON COLUMN stimulation_effect.percent IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_medical_item.cures IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_helmet.deafening IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_helmet.ricochet_x IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_helmet.ricochet_y IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_helmet.ricochet_z IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_helmet.blunt_throughput IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_glasses.blunt_throughput IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_food_drink.energy IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_food_drink.hydration IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_food_drink.units IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_chest_rig.blunt_throughput IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_armor.blunt_throughput IS NULL');
    }
}
