<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230901150113 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
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
        $this->addSql('ALTER TABLE items_properties_scope ALTER sighting_range TYPE INT');
        $this->addSql('ALTER TABLE items_properties_weapon ALTER ergonomics TYPE DOUBLE PRECISION');
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
        $this->addSql('ALTER TABLE items_properties_weapon ALTER ergonomics TYPE INT');
        $this->addSql('COMMENT ON COLUMN items_properties_chest_rig.blunt_throughput IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_armor.blunt_throughput IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_helmet.deafening IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_helmet.ricochet_x IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_helmet.ricochet_y IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_helmet.ricochet_z IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_helmet.blunt_throughput IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_medical_item.cures IS NULL');
        $this->addSql('ALTER TABLE items_properties_scope ALTER sighting_range TYPE DOUBLE PRECISION');
        $this->addSql('COMMENT ON COLUMN stimulation_effect_translation.type IS NULL');
        $this->addSql('COMMENT ON COLUMN stimulation_effect_translation.skill_name IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_glasses.blunt_throughput IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_food_drink.energy IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_food_drink.hydration IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_food_drink.units IS NULL');
        $this->addSql('COMMENT ON COLUMN stimulation_effect.chance IS NULL');
        $this->addSql('COMMENT ON COLUMN stimulation_effect.delay IS NULL');
        $this->addSql('COMMENT ON COLUMN stimulation_effect.duration IS NULL');
        $this->addSql('COMMENT ON COLUMN stimulation_effect.value IS NULL');
        $this->addSql('COMMENT ON COLUMN stimulation_effect.percent IS NULL');
    }
}
