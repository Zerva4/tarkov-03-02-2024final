<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231202200439 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE items_properties_preset (id UUID NOT NULL, base_item_id UUID DEFAULT NULL, ergonomics DOUBLE PRECISION DEFAULT \'0\' NOT NULL, recoil_vertical INT DEFAULT 0 NOT NULL, recoil_horizontal INT DEFAULT 0 NOT NULL, moa DOUBLE PRECISION DEFAULT \'0\' NOT NULL, "default" BOOLEAN DEFAULT false NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9370DDE02669EB3A ON items_properties_preset (base_item_id)');
        $this->addSql('COMMENT ON TABLE items_properties_preset IS \'\'');
        $this->addSql('COMMENT ON COLUMN items_properties_preset.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_properties_preset.base_item_id IS \'Базовое оружие(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_properties_preset.ergonomics IS \'Эргономика\'');
        $this->addSql('COMMENT ON COLUMN items_properties_preset.recoil_vertical IS \'Вертикальная отдача\'');
        $this->addSql('COMMENT ON COLUMN items_properties_preset.recoil_horizontal IS \'Горизонтальная отдача\'');
        $this->addSql('COMMENT ON COLUMN items_properties_preset.moa IS \'Точность\'');
        $this->addSql('COMMENT ON COLUMN items_properties_preset."default" IS \'По умолчанию\'');
        $this->addSql('CREATE TABLE items_properties_stimulation (id UUID NOT NULL, stimulation_effect_id UUID DEFAULT NULL, use_time INT DEFAULT 0 NOT NULL, cures JSONB DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E89198D2BED5BCD2 ON items_properties_stimulation (stimulation_effect_id)');
        $this->addSql('COMMENT ON TABLE items_properties_stimulation IS \'Свойства стимуляции\'');
        $this->addSql('COMMENT ON COLUMN items_properties_stimulation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_properties_stimulation.stimulation_effect_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_properties_stimulation.use_time IS \'Время действия\'');
        $this->addSql('ALTER TABLE items_properties_preset ADD CONSTRAINT FK_9370DDE02669EB3A FOREIGN KEY (base_item_id) REFERENCES items (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE items_properties_preset ADD CONSTRAINT FK_9370DDE0BF396750 FOREIGN KEY (id) REFERENCES items_properties (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE items_properties_stimulation ADD CONSTRAINT FK_E89198D2BED5BCD2 FOREIGN KEY (stimulation_effect_id) REFERENCES stimulation_effect (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE items_properties_stimulation ADD CONSTRAINT FK_E89198D2BF396750 FOREIGN KEY (id) REFERENCES items_properties (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
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
        $this->addSql('ALTER TABLE items_properties_preset DROP CONSTRAINT FK_9370DDE02669EB3A');
        $this->addSql('ALTER TABLE items_properties_preset DROP CONSTRAINT FK_9370DDE0BF396750');
        $this->addSql('ALTER TABLE items_properties_stimulation DROP CONSTRAINT FK_E89198D2BED5BCD2');
        $this->addSql('ALTER TABLE items_properties_stimulation DROP CONSTRAINT FK_E89198D2BF396750');
        $this->addSql('DROP TABLE items_properties_preset');
        $this->addSql('DROP TABLE items_properties_stimulation');
        $this->addSql('COMMENT ON COLUMN items_properties_chest_rig.blunt_throughput IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_armor.blunt_throughput IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_medical_item.cures IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_helmet.deafening IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_helmet.ricochet_x IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_helmet.ricochet_y IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_helmet.ricochet_z IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_helmet.blunt_throughput IS NULL');
        $this->addSql('COMMENT ON COLUMN stimulation_effect_translation.type IS NULL');
        $this->addSql('COMMENT ON COLUMN stimulation_effect_translation.skill_name IS NULL');
        $this->addSql('COMMENT ON COLUMN stimulation_effect.chance IS NULL');
        $this->addSql('COMMENT ON COLUMN stimulation_effect.delay IS NULL');
        $this->addSql('COMMENT ON COLUMN stimulation_effect.duration IS NULL');
        $this->addSql('COMMENT ON COLUMN stimulation_effect.value IS NULL');
        $this->addSql('COMMENT ON COLUMN stimulation_effect.percent IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_glasses.blunt_throughput IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_food_drink.energy IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_food_drink.hydration IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_food_drink.units IS NULL');
    }
}
