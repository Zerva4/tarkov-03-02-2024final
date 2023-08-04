<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230804161105 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE skills_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, title VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX skills_translation_unique_translation ON skills_translation (translatable_id, locale)');
        $this->addSql('CREATE INDEX skills_locale_idx ON skills_translation (locale)');
        $this->addSql('CREATE INDEX idx_517c959d2c2ac5d3 ON skills_translation (translatable_id)');
        $this->addSql('COMMENT ON COLUMN skills_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN skills_translation.translatable_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE maps_locations_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX maps_locations_translation_unique_translation ON maps_locations_translation (translatable_id, locale)');
        $this->addSql('CREATE INDEX maps_location_translation_idx ON maps_locations_translation (locale)');
        $this->addSql('CREATE INDEX idx_498201e92c2ac5d3 ON maps_locations_translation (translatable_id)');
        $this->addSql('COMMENT ON COLUMN maps_locations_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN maps_locations_translation.translatable_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE items_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, short_title VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX items_translation_unique_translation ON items_translation (translatable_id, locale)');
        $this->addSql('CREATE INDEX item_locale_idx ON items_translation (locale)');
        $this->addSql('CREATE INDEX idx_c4af85e2c2ac5d3 ON items_translation (translatable_id)');
        $this->addSql('COMMENT ON COLUMN items_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_translation.translatable_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE weather (id UUID NOT NULL, "timestamp" INT DEFAULT 0 NOT NULL, cloud DOUBLE PRECISION NOT NULL, wind_speed INT DEFAULT 0 NOT NULL, wind_direction INT DEFAULT 0 NOT NULL, wind_gustiness DOUBLE PRECISION NOT NULL, rain BOOLEAN NOT NULL, rain_intensivity INT DEFAULT 0 NOT NULL, fog DOUBLE PRECISION NOT NULL, temp INT DEFAULT 0 NOT NULL, pressure INT DEFAULT 0 NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN weather.id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE places_levels (id UUID NOT NULL, place_id UUID DEFAULT NULL, api_id VARCHAR(255) DEFAULT NULL, published BOOLEAN DEFAULT true NOT NULL, level_order INT DEFAULT 0 NOT NULL, level INT DEFAULT 0 NOT NULL, construction_time INT DEFAULT 0 NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX places_levels_api_id_idx ON places_levels (api_id)');
        $this->addSql('CREATE INDEX idx_fc0ce378da6a219 ON places_levels (place_id)');
        $this->addSql('COMMENT ON COLUMN places_levels.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN places_levels.place_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE users (id UUID NOT NULL, login VARCHAR(50) NOT NULL, email VARCHAR(180) NOT NULL, title VARCHAR(180) DEFAULT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_d5428aede7927c74 ON users (email)');
        $this->addSql('CREATE UNIQUE INDEX uniq_d5428aedaa08cb10 ON users (login)');
        $this->addSql('COMMENT ON COLUMN users.id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE places_levels_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, description TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX places_levels_translation_unique_translation ON places_levels_translation (translatable_id, locale)');
        $this->addSql('CREATE INDEX places_levels_locale_idx ON places_levels_translation (locale)');
        $this->addSql('CREATE INDEX idx_1cbb153d2c2ac5d3 ON places_levels_translation (translatable_id)');
        $this->addSql('COMMENT ON COLUMN places_levels_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN places_levels_translation.translatable_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE crafts (id UUID NOT NULL, place_id UUID DEFAULT NULL, unlock_quest_id UUID DEFAULT NULL, api_id VARCHAR(255) DEFAULT NULL, published BOOLEAN DEFAULT true NOT NULL, level INT DEFAULT NULL, duration INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX craft_api_id_idx ON crafts (api_id)');
        $this->addSql('CREATE INDEX idx_f12fd47863a7ed31 ON crafts (unlock_quest_id)');
        $this->addSql('CREATE INDEX idx_f12fd478da6a219 ON crafts (place_id)');
        $this->addSql('COMMENT ON COLUMN crafts.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN crafts.place_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN crafts.unlock_quest_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE quests_items_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, title VARCHAR(255) NOT NULL, short_title VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX quests_items_translation_unique_translation ON quests_items_translation (translatable_id, locale)');
        $this->addSql('CREATE INDEX quests_items_locale_idx ON quests_items_translation (locale)');
        $this->addSql('CREATE INDEX idx_bf3fa4b92c2ac5d3 ON quests_items_translation (translatable_id)');
        $this->addSql('COMMENT ON COLUMN quests_items_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN quests_items_translation.translatable_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE bosses (id UUID NOT NULL, published BOOLEAN NOT NULL, slug VARCHAR(255) NOT NULL, image_name VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN bosses.id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE tags (id UUID NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN tags.id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE items (id UUID NOT NULL, api_id VARCHAR(255) DEFAULT NULL, published BOOLEAN NOT NULL, image_name VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, types JSONB DEFAULT NULL, type_properties VARCHAR(50) DEFAULT NULL, properties JSONB DEFAULT NULL, base_price INT DEFAULT NULL, width INT DEFAULT NULL, height INT DEFAULT NULL, background_color VARCHAR(255) DEFAULT NULL, accuracy_modifier DOUBLE PRECISION DEFAULT NULL, recoil_modifier DOUBLE PRECISION DEFAULT NULL, ergonomics_modifier DOUBLE PRECISION DEFAULT NULL, has_grid BOOLEAN DEFAULT false NOT NULL, blocks_headphones BOOLEAN DEFAULT false NOT NULL, weight DOUBLE PRECISION DEFAULT NULL, velocity DOUBLE PRECISION DEFAULT NULL, loudness INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX items_api_key_idx ON items (api_id)');
        $this->addSql('CREATE INDEX items_slug_idx ON items (slug)');
        $this->addSql('COMMENT ON COLUMN items.id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE places (id UUID NOT NULL, api_id VARCHAR(255) DEFAULT NULL, published BOOLEAN DEFAULT true NOT NULL, order_place INT DEFAULT NULL, slug VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX place_api_id_idx ON places (api_id)');
        $this->addSql('CREATE INDEX place_slug_idx ON places (slug)');
        $this->addSql('CREATE UNIQUE INDEX uniq_feaf6c55989d9b62 ON places (slug)');
        $this->addSql('COMMENT ON COLUMN places.id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE barters_required_items (barter_id UUID NOT NULL, contained_item_id UUID NOT NULL, PRIMARY KEY(barter_id, contained_item_id))');
        $this->addSql('CREATE INDEX idx_d501ffc953cdede8 ON barters_required_items (contained_item_id)');
        $this->addSql('CREATE INDEX idx_d501ffc96a7d1f74 ON barters_required_items (barter_id)');
        $this->addSql('COMMENT ON COLUMN barters_required_items.barter_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN barters_required_items.contained_item_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE places_levels_required_levels (place_level_id UUID NOT NULL, place_level_required_id UUID NOT NULL, PRIMARY KEY(place_level_id, place_level_required_id))');
        $this->addSql('CREATE INDEX idx_ac4274f37de6118d ON places_levels_required_levels (place_level_required_id)');
        $this->addSql('CREATE INDEX idx_ac4274f375eaac24 ON places_levels_required_levels (place_level_id)');
        $this->addSql('COMMENT ON COLUMN places_levels_required_levels.place_level_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN places_levels_required_levels.place_level_required_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE maps_locations (id UUID NOT NULL, map_id UUID DEFAULT NULL, image_name VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_c383b3b953c55f64 ON maps_locations (map_id)');
        $this->addSql('COMMENT ON COLUMN maps_locations.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN maps_locations.map_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE crafts_required_contained_items (craft_id UUID NOT NULL, contained_item_id UUID NOT NULL, PRIMARY KEY(craft_id, contained_item_id))');
        $this->addSql('CREATE INDEX idx_47e43a6253cdede8 ON crafts_required_contained_items (contained_item_id)');
        $this->addSql('CREATE INDEX idx_47e43a62e836ccc8 ON crafts_required_contained_items (craft_id)');
        $this->addSql('COMMENT ON COLUMN crafts_required_contained_items.craft_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN crafts_required_contained_items.contained_item_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE places_levels_required_traders (place_level_id UUID NOT NULL, trader_required_id UUID NOT NULL, PRIMARY KEY(place_level_id, trader_required_id))');
        $this->addSql('CREATE INDEX idx_942e86a60bb4e04 ON places_levels_required_traders (trader_required_id)');
        $this->addSql('CREATE INDEX idx_942e86a75eaac24 ON places_levels_required_traders (place_level_id)');
        $this->addSql('COMMENT ON COLUMN places_levels_required_traders.place_level_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN places_levels_required_traders.trader_required_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE crafts_required_quest_items (craft_id UUID NOT NULL, quest_item_id UUID NOT NULL, PRIMARY KEY(craft_id, quest_item_id))');
        $this->addSql('CREATE INDEX idx_5f7665734648ef15 ON crafts_required_quest_items (quest_item_id)');
        $this->addSql('CREATE INDEX idx_5f766573e836ccc8 ON crafts_required_quest_items (craft_id)');
        $this->addSql('COMMENT ON COLUMN crafts_required_quest_items.craft_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN crafts_required_quest_items.quest_item_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE quests_keys (id UUID NOT NULL, item_id UUID DEFAULT NULL, map_id UUID DEFAULT NULL, quest_id UUID DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_ca786826209e9ef4 ON quests_keys (quest_id)');
        $this->addSql('CREATE INDEX idx_ca78682653c55f64 ON quests_keys (map_id)');
        $this->addSql('CREATE INDEX idx_ca786826126f525e ON quests_keys (item_id)');
        $this->addSql('COMMENT ON COLUMN quests_keys.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN quests_keys.item_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN quests_keys.map_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN quests_keys.quest_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE crafts_reward_contained_items (craft_id UUID NOT NULL, contained_item_id UUID NOT NULL, PRIMARY KEY(craft_id, contained_item_id))');
        $this->addSql('CREATE INDEX idx_10babdc253cdede8 ON crafts_reward_contained_items (contained_item_id)');
        $this->addSql('CREATE INDEX idx_10babdc2e836ccc8 ON crafts_reward_contained_items (craft_id)');
        $this->addSql('COMMENT ON COLUMN crafts_reward_contained_items.craft_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN crafts_reward_contained_items.contained_item_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE traders_levels (id UUID NOT NULL, trader_id UUID DEFAULT NULL, level INT NOT NULL, required_player_level INT NOT NULL, required_reputation DOUBLE PRECISION NOT NULL, required_sales INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_9b1ba77b1273968f ON traders_levels (trader_id)');
        $this->addSql('COMMENT ON COLUMN traders_levels.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN traders_levels.trader_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE articles_tags (article_translation_id UUID NOT NULL, tag_id UUID NOT NULL, PRIMARY KEY(article_translation_id, tag_id))');
        $this->addSql('CREATE INDEX idx_35405361bad26311 ON articles_tags (tag_id)');
        $this->addSql('CREATE INDEX idx_354053613a91a7ad ON articles_tags (article_translation_id)');
        $this->addSql('COMMENT ON COLUMN articles_tags.article_translation_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN articles_tags.tag_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE barters (id UUID NOT NULL, trader_id UUID DEFAULT NULL, quest_unlock_barters UUID DEFAULT NULL, api_id VARCHAR(255) DEFAULT NULL, published BOOLEAN NOT NULL, trader_level INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX barter_api_key_idx ON barters (api_id)');
        $this->addSql('CREATE INDEX idx_bfbbe81038f70db1 ON barters (quest_unlock_barters)');
        $this->addSql('CREATE INDEX idx_bfbbe8101273968f ON barters (trader_id)');
        $this->addSql('CREATE UNIQUE INDEX uniq_bfbbe81054963938 ON barters (api_id)');
        $this->addSql('COMMENT ON COLUMN barters.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN barters.trader_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN barters.quest_unlock_barters IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE updates_category (id UUID NOT NULL, published BOOLEAN NOT NULL, slug VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX updates_category_slug_idx ON updates_category (slug)');
        $this->addSql('CREATE UNIQUE INDEX uniq_dcf80a7a989d9b62 ON updates_category (slug)');
        $this->addSql('COMMENT ON COLUMN updates_category.id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE maps_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, title VARCHAR(255) NOT NULL, description TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX maps_translation_unique_translation ON maps_translation (translatable_id, locale)');
        $this->addSql('CREATE INDEX maps_locale_idx ON maps_translation (locale)');
        $this->addSql('CREATE INDEX idx_5b2588712c2ac5d3 ON maps_translation (translatable_id)');
        $this->addSql('COMMENT ON COLUMN maps_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN maps_translation.translatable_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE articles (id UUID NOT NULL, published BOOLEAN NOT NULL, image_poster VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX articles_slug_idx ON articles (slug)');
        $this->addSql('CREATE UNIQUE INDEX uniq_bfdd3168989d9b62 ON articles (slug)');
        $this->addSql('COMMENT ON COLUMN articles.id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE items_materials_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, title VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX items_materials_translation_unique_translation ON items_materials_translation (translatable_id, locale)');
        $this->addSql('CREATE INDEX item_material_locale_idx ON items_materials_translation (locale)');
        $this->addSql('CREATE INDEX idx_97113b212c2ac5d3 ON items_materials_translation (translatable_id)');
        $this->addSql('COMMENT ON COLUMN items_materials_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_materials_translation.translatable_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE traders_cash_offers (id UUID NOT NULL, item_id UUID DEFAULT NULL, trader_id UUID DEFAULT NULL, trader_level_id UUID DEFAULT NULL, currency_item_id UUID DEFAULT NULL, quest_unlock_id UUID DEFAULT NULL, price INT NOT NULL, currency VARCHAR(10) NOT NULL, price_rub INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_2e6279392100d7c6 ON traders_cash_offers (quest_unlock_id)');
        $this->addSql('CREATE INDEX idx_2e627939cfc6a8b1 ON traders_cash_offers (currency_item_id)');
        $this->addSql('CREATE INDEX idx_2e627939ec84eada ON traders_cash_offers (trader_level_id)');
        $this->addSql('CREATE INDEX idx_2e6279391273968f ON traders_cash_offers (trader_id)');
        $this->addSql('CREATE INDEX idx_2e627939126f525e ON traders_cash_offers (item_id)');
        $this->addSql('COMMENT ON COLUMN traders_cash_offers.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN traders_cash_offers.item_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN traders_cash_offers.trader_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN traders_cash_offers.trader_level_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN traders_cash_offers.currency_item_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN traders_cash_offers.quest_unlock_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE updates_category_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX updates_category_translation_unique_translation ON updates_category_translation (translatable_id, locale)');
        $this->addSql('CREATE INDEX idx_37aeb8c02c2ac5d3 ON updates_category_translation (translatable_id)');
        $this->addSql('COMMENT ON COLUMN updates_category_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN updates_category_translation.translatable_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE updates (id UUID NOT NULL, category_id UUID DEFAULT NULL, published BOOLEAN DEFAULT true NOT NULL, date_added TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, slug VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_added2 TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX updates_slug_idx ON updates (slug)');
        $this->addSql('CREATE INDEX updates_date_added_idx ON updates (date_added)');
        $this->addSql('CREATE INDEX idx_4548133012469de2 ON updates (category_id)');
        $this->addSql('CREATE UNIQUE INDEX uniq_45481330989d9b62 ON updates (slug)');
        $this->addSql('COMMENT ON COLUMN updates.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN updates.category_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE bosses_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX bosses_translation_unique_translation ON bosses_translation (translatable_id, locale)');
        $this->addSql('CREATE INDEX idx_4fad7f8b2c2ac5d3 ON bosses_translation (translatable_id)');
        $this->addSql('COMMENT ON COLUMN bosses_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN bosses_translation.translatable_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_75ea56e0fb7336f0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX idx_75ea56e016ba31db ON messenger_messages (delivered_at)');
        $this->addSql('CREATE INDEX idx_75ea56e0e3bd61ce ON messenger_messages (available_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE traders_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, full_name VARCHAR(255) DEFAULT NULL, short_name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX traders_translation_unique_translation ON traders_translation (translatable_id, locale)');
        $this->addSql('CREATE INDEX traders_translation_idx ON traders_translation (locale)');
        $this->addSql('CREATE INDEX idx_72a66a092c2ac5d3 ON traders_translation (translatable_id)');
        $this->addSql('COMMENT ON COLUMN traders_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN traders_translation.translatable_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE maps (id UUID NOT NULL, api_id VARCHAR(255) DEFAULT NULL, published BOOLEAN NOT NULL, image_name VARCHAR(255) DEFAULT NULL, min_players_number INT DEFAULT 0 NOT NULL, max_players_number INT DEFAULT 0 NOT NULL, raid_duration TIME(0) WITHOUT TIME ZONE DEFAULT NULL, slug VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX maps_slug_idx ON maps (slug)');
        $this->addSql('CREATE UNIQUE INDEX uniq_472e08a5989d9b62 ON maps (slug)');
        $this->addSql('COMMENT ON COLUMN maps.id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE places_levels_required_items (place_level_id UUID NOT NULL, contained_item_id UUID NOT NULL, PRIMARY KEY(place_level_id, contained_item_id))');
        $this->addSql('CREATE INDEX idx_8a13e62053cdede8 ON places_levels_required_items (contained_item_id)');
        $this->addSql('CREATE INDEX idx_8a13e62075eaac24 ON places_levels_required_items (place_level_id)');
        $this->addSql('COMMENT ON COLUMN places_levels_required_items.place_level_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN places_levels_required_items.contained_item_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE places_levels_required_skills (place_level_id UUID NOT NULL, skill_id UUID NOT NULL, PRIMARY KEY(place_level_id, skill_id))');
        $this->addSql('CREATE INDEX idx_e659069a5585c142 ON places_levels_required_skills (skill_id)');
        $this->addSql('CREATE INDEX idx_e659069a75eaac24 ON places_levels_required_skills (place_level_id)');
        $this->addSql('COMMENT ON COLUMN places_levels_required_skills.place_level_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN places_levels_required_skills.skill_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE quests_objectives_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, description VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX quests_objectives_translation_unique_translation ON quests_objectives_translation (translatable_id, locale)');
        $this->addSql('CREATE INDEX quests_objectives_locale_idx ON quests_objectives_translation (locale)');
        $this->addSql('CREATE INDEX idx_5e497b392c2ac5d3 ON quests_objectives_translation (translatable_id)');
        $this->addSql('COMMENT ON COLUMN quests_objectives_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN quests_objectives_translation.translatable_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE quests_received_items (quest_id UUID NOT NULL, contained_item_id UUID NOT NULL, PRIMARY KEY(quest_id, contained_item_id))');
        $this->addSql('CREATE INDEX idx_aa7f4d3a53cdede8 ON quests_received_items (contained_item_id)');
        $this->addSql('CREATE INDEX idx_aa7f4d3a209e9ef4 ON quests_received_items (quest_id)');
        $this->addSql('COMMENT ON COLUMN quests_received_items.quest_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN quests_received_items.contained_item_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE barters_reward_items (barter_id UUID NOT NULL, contained_item_id UUID NOT NULL, PRIMARY KEY(barter_id, contained_item_id))');
        $this->addSql('CREATE INDEX idx_25502a0753cdede8 ON barters_reward_items (contained_item_id)');
        $this->addSql('CREATE INDEX idx_25502a076a7d1f74 ON barters_reward_items (barter_id)');
        $this->addSql('COMMENT ON COLUMN barters_reward_items.barter_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN barters_reward_items.contained_item_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE quests_used_items (quest_id UUID NOT NULL, contained_item_id UUID NOT NULL, PRIMARY KEY(quest_id, contained_item_id))');
        $this->addSql('CREATE INDEX idx_4ef2481753cdede8 ON quests_used_items (contained_item_id)');
        $this->addSql('CREATE INDEX idx_4ef24817209e9ef4 ON quests_used_items (quest_id)');
        $this->addSql('COMMENT ON COLUMN quests_used_items.quest_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN quests_used_items.contained_item_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE traders_required (id UUID NOT NULL, trader_id UUID DEFAULT NULL, api_id VARCHAR(255) DEFAULT NULL, level INT DEFAULT 0 NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX traders_required_idx ON traders_required (api_id)');
        $this->addSql('CREATE INDEX idx_b53d3b171273968f ON traders_required (trader_id)');
        $this->addSql('COMMENT ON COLUMN traders_required.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN traders_required.trader_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE contained_items (id UUID NOT NULL, item_id UUID DEFAULT NULL, api_id VARCHAR(255) DEFAULT NULL, count DOUBLE PRECISION DEFAULT NULL, quantity DOUBLE PRECISION DEFAULT NULL, attributes JSONB DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX contained_item_idx ON contained_items (api_id)');
        $this->addSql('CREATE INDEX idx_989f25e8126f525e ON contained_items (item_id)');
        $this->addSql('COMMENT ON COLUMN contained_items.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN contained_items.item_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE quests_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, title VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, how_to_complete TEXT DEFAULT NULL, start_dialog TEXT DEFAULT NULL, successful_dialog TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX quests_translation_unique_translation ON quests_translation (translatable_id, locale)');
        $this->addSql('CREATE INDEX quests_locale_idx ON quests_translation (locale)');
        $this->addSql('CREATE INDEX idx_e0fe32b52c2ac5d3 ON quests_translation (translatable_id)');
        $this->addSql('COMMENT ON COLUMN quests_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN quests_translation.translatable_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE places_levels_required (id UUID NOT NULL, place_id UUID DEFAULT NULL, api_id VARCHAR(255) DEFAULT NULL, level INT DEFAULT 0 NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX places_levels_required_idx ON places_levels_required (api_id)');
        $this->addSql('CREATE INDEX idx_2d8f1030da6a219 ON places_levels_required (place_id)');
        $this->addSql('COMMENT ON COLUMN places_levels_required.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN places_levels_required.place_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE places_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, title VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX places_translation_unique_translation ON places_translation (translatable_id, locale)');
        $this->addSql('CREATE INDEX places_locale_idx ON places_translation (locale)');
        $this->addSql('CREATE INDEX idx_12a597262c2ac5d3 ON places_translation (translatable_id)');
        $this->addSql('COMMENT ON COLUMN places_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN places_translation.translatable_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE items_materials (id UUID NOT NULL, published BOOLEAN NOT NULL, api_id VARCHAR(255) DEFAULT NULL, destructibility DOUBLE PRECISION NOT NULL, min_repair_degradation DOUBLE PRECISION NOT NULL, max_repair_degradation DOUBLE PRECISION NOT NULL, explosion_destructibility DOUBLE PRECISION NOT NULL, min_repair_kit_degradation DOUBLE PRECISION NOT NULL, max_repair_kit_degradation DOUBLE PRECISION NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX items_materials_api_key_idx ON items_materials (api_id)');
        $this->addSql('COMMENT ON COLUMN items_materials.id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE skills (id UUID NOT NULL, api_id VARCHAR(255) DEFAULT NULL, level INT DEFAULT 0 NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX skill_api_id_idx ON skills (api_id)');
        $this->addSql('COMMENT ON COLUMN skills.id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE traders (id UUID NOT NULL, api_id VARCHAR(255) DEFAULT NULL, "position" INT DEFAULT 0 NOT NULL, published BOOLEAN NOT NULL, image_name VARCHAR(255) DEFAULT NULL, reset_time TIMESTAMP(0) WITH TIME ZONE DEFAULT NULL, slug VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX traders_api_key_idx ON traders (api_id)');
        $this->addSql('CREATE UNIQUE INDEX uniq_49ae8b1c989d9b62 ON traders (slug)');
        $this->addSql('COMMENT ON COLUMN traders.id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE articles_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, title VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, body TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX articles_translation_unique_translation ON articles_translation (translatable_id, locale)');
        $this->addSql('CREATE INDEX articles_locale_idx ON articles_translation (locale)');
        $this->addSql('CREATE INDEX idx_105c720e2c2ac5d3 ON articles_translation (translatable_id)');
        $this->addSql('COMMENT ON COLUMN articles_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN articles_translation.translatable_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE updates_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX updates_translation_unique_translation ON updates_translation (translatable_id, locale)');
        $this->addSql('CREATE INDEX idx_d08162432c2ac5d3 ON updates_translation (translatable_id)');
        $this->addSql('COMMENT ON COLUMN updates_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN updates_translation.translatable_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE bosses_health (id UUID NOT NULL, boss_id UUID DEFAULT NULL, published BOOLEAN NOT NULL, max INT DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_df0d99f1261fb672 ON bosses_health (boss_id)');
        $this->addSql('COMMENT ON COLUMN bosses_health.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN bosses_health.boss_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE quests_objectives (id UUID NOT NULL, quest_id UUID DEFAULT NULL, api_id VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, optional BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX quest_objective_api_idx ON quests_objectives (api_id)');
        $this->addSql('CREATE INDEX quest_objective_type_idx ON quests_objectives (type)');
        $this->addSql('CREATE INDEX idx_25909a9a209e9ef4 ON quests_objectives (quest_id)');
        $this->addSql('COMMENT ON COLUMN quests_objectives.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN quests_objectives.quest_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE quests_items (id UUID NOT NULL, api_id VARCHAR(255) DEFAULT NULL, published BOOLEAN NOT NULL, width SMALLINT NOT NULL, height SMALLINT NOT NULL, image_name VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX quests_items_api_key_idx ON quests_items (api_id)');
        $this->addSql('CREATE INDEX quests_items_slug_idx ON quests_items (slug)');
        $this->addSql('COMMENT ON COLUMN quests_items.id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE quests (id UUID NOT NULL, trader_id UUID DEFAULT NULL, map_id UUID DEFAULT NULL, api_id VARCHAR(255) DEFAULT NULL, "position" INT DEFAULT 0 NOT NULL, published BOOLEAN NOT NULL, image_name VARCHAR(255) DEFAULT NULL, experience INT DEFAULT NULL, min_player_level INT NOT NULL, slug VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, restartable BOOLEAN DEFAULT false NOT NULL, kappa_required BOOLEAN DEFAULT false NOT NULL, lightkeeper_required BOOLEAN DEFAULT false NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX quests_api_key_idx ON quests (api_id)');
        $this->addSql('CREATE INDEX quests_slug_idx ON quests (slug)');
        $this->addSql('CREATE UNIQUE INDEX uniq_989e5d34989d9b62 ON quests (slug)');
        $this->addSql('CREATE INDEX idx_989e5d3453c55f64 ON quests (map_id)');
        $this->addSql('CREATE INDEX idx_989e5d341273968f ON quests (trader_id)');
        $this->addSql('COMMENT ON COLUMN quests.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN quests.trader_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN quests.map_id IS \'(DC2Type:uuid)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE skills_translation');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE maps_locations_translation');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items_translation');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE weather');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE places_levels');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE users');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE places_levels_translation');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE crafts');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE quests_items_translation');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE bosses');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE tags');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE places');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE barters_required_items');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE places_levels_required_levels');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE maps_locations');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE crafts_required_contained_items');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE places_levels_required_traders');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE crafts_required_quest_items');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE quests_keys');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE crafts_reward_contained_items');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE traders_levels');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE articles_tags');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE barters');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE updates_category');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE maps_translation');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE articles');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items_materials_translation');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE traders_cash_offers');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE updates_category_translation');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE updates');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE bosses_translation');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE messenger_messages');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE traders_translation');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE maps');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE places_levels_required_items');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE places_levels_required_skills');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE quests_objectives_translation');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE quests_received_items');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE barters_reward_items');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE quests_used_items');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE traders_required');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE contained_items');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE quests_translation');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE places_levels_required');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE places_translation');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items_materials');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE skills');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE traders');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE articles_translation');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE updates_translation');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE bosses_health');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE quests_objectives');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE quests_items');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE quests');
    }
}
