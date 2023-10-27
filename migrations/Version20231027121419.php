<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231027121419 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE quests_advice_mapping (quest_advice_id UUID NOT NULL, quest_id UUID NOT NULL, PRIMARY KEY(quest_advice_id, quest_id))');
        $this->addSql('CREATE INDEX IDX_146E1B9BB4C48FDD ON quests_advice_mapping (quest_advice_id)');
        $this->addSql('CREATE INDEX IDX_146E1B9B209E9EF4 ON quests_advice_mapping (quest_id)');
        $this->addSql('COMMENT ON COLUMN quests_advice_mapping.quest_advice_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN quests_advice_mapping.quest_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE quests_advice_mapping ADD CONSTRAINT FK_146E1B9BB4C48FDD FOREIGN KEY (quest_advice_id) REFERENCES quests_advice (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quests_advice_mapping ADD CONSTRAINT FK_146E1B9B209E9EF4 FOREIGN KEY (quest_id) REFERENCES quests (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quests_advices_mapping DROP CONSTRAINT fk_33861485b4c48fdd');
        $this->addSql('ALTER TABLE quests_advices_mapping DROP CONSTRAINT fk_33861485209e9ef4');
        $this->addSql('DROP TABLE quests_advices_mapping');
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
        $this->addSql('CREATE TABLE quests_advices_mapping (quest_advice_id UUID NOT NULL, quest_id UUID NOT NULL, PRIMARY KEY(quest_advice_id, quest_id))');
        $this->addSql('CREATE INDEX idx_33861485209e9ef4 ON quests_advices_mapping (quest_id)');
        $this->addSql('CREATE INDEX idx_33861485b4c48fdd ON quests_advices_mapping (quest_advice_id)');
        $this->addSql('COMMENT ON COLUMN quests_advices_mapping.quest_advice_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN quests_advices_mapping.quest_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE quests_advices_mapping ADD CONSTRAINT fk_33861485b4c48fdd FOREIGN KEY (quest_advice_id) REFERENCES quests_advice (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quests_advices_mapping ADD CONSTRAINT fk_33861485209e9ef4 FOREIGN KEY (quest_id) REFERENCES quests (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quests_advice_mapping DROP CONSTRAINT FK_146E1B9BB4C48FDD');
        $this->addSql('ALTER TABLE quests_advice_mapping DROP CONSTRAINT FK_146E1B9B209E9EF4');
        $this->addSql('DROP TABLE quests_advice_mapping');
        $this->addSql('COMMENT ON COLUMN items_properties_armor.blunt_throughput IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_chest_rig.blunt_throughput IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_food_drink.energy IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_food_drink.hydration IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_food_drink.units IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_glasses.blunt_throughput IS NULL');
        $this->addSql('COMMENT ON COLUMN stimulation_effect.chance IS NULL');
        $this->addSql('COMMENT ON COLUMN stimulation_effect.delay IS NULL');
        $this->addSql('COMMENT ON COLUMN stimulation_effect.duration IS NULL');
        $this->addSql('COMMENT ON COLUMN stimulation_effect.value IS NULL');
        $this->addSql('COMMENT ON COLUMN stimulation_effect.percent IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_medical_item.cures IS NULL');
        $this->addSql('COMMENT ON COLUMN stimulation_effect_translation.type IS NULL');
        $this->addSql('COMMENT ON COLUMN stimulation_effect_translation.skill_name IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_helmet.deafening IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_helmet.ricochet_x IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_helmet.ricochet_y IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_helmet.ricochet_z IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_helmet.blunt_throughput IS NULL');
    }
}
