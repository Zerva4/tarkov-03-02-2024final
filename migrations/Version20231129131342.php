<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231129131342 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
//        $this->addSql('DROP SEQUENCE article_id_seq CASCADE');
        $this->addSql('CREATE TABLE articles_category (id UUID NOT NULL, published BOOLEAN NOT NULL, slug VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A7D8EFDB989D9B62 ON articles_category (slug)');
        $this->addSql('CREATE INDEX articles_category_slug_idx ON articles_category (slug)');
        $this->addSql('COMMENT ON COLUMN articles_category.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE articles_category_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BF34118A2C2AC5D3 ON articles_category_translation (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX articles_category_translation_unique_translation ON articles_category_translation (translatable_id, locale)');
        $this->addSql('COMMENT ON COLUMN articles_category_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN articles_category_translation.translatable_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE articles_category_translation ADD CONSTRAINT FK_BF34118A2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES articles_category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE articles ADD category_id UUID DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN articles.category_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD316812469DE2 FOREIGN KEY (category_id) REFERENCES articles_category (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_BFDD316812469DE2 ON articles (category_id)');
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
        $this->addSql('ALTER TABLE articles DROP CONSTRAINT FK_BFDD316812469DE2');
        $this->addSql('CREATE SEQUENCE article_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE articles_category_translation DROP CONSTRAINT FK_BF34118A2C2AC5D3');
        $this->addSql('DROP TABLE articles_category');
        $this->addSql('DROP TABLE articles_category_translation');
        $this->addSql('COMMENT ON COLUMN items_properties_food_drink.energy IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_food_drink.hydration IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_food_drink.units IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_chest_rig.blunt_throughput IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_armor.blunt_throughput IS NULL');
        $this->addSql('COMMENT ON COLUMN items_properties_medical_item.cures IS NULL');
        $this->addSql('DROP INDEX IDX_BFDD316812469DE2');
        $this->addSql('ALTER TABLE articles DROP category_id');
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
    }
}
