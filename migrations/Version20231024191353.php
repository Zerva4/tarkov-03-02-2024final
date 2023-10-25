<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231024191353 extends AbstractMigration
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

        $this->addSql('CREATE TABLE crafts_reward_contained_items (craft_id UUID NOT NULL, contained_item_id UUID NOT NULL, PRIMARY KEY(craft_id, contained_item_id))');
        $this->addSql('CREATE INDEX idx_10babdc253cdede8 ON crafts_reward_contained_items (contained_item_id)');
        $this->addSql('CREATE INDEX idx_10babdc2e836ccc8 ON crafts_reward_contained_items (craft_id)');
        $this->addSql('COMMENT ON COLUMN crafts_reward_contained_items.craft_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN crafts_reward_contained_items.contained_item_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE quests_advice (id UUID NOT NULL, published BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN quests_advice.id IS \'(DC2Type:uuid)\'');
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

        $this->addSql('CREATE TABLE items (id UUID NOT NULL, properties_id UUID DEFAULT NULL, api_id VARCHAR(255) DEFAULT NULL, published BOOLEAN NOT NULL, image_name VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, types JSONB DEFAULT NULL, type_item VARCHAR(50) DEFAULT NULL, base_price INT DEFAULT NULL, width INT DEFAULT NULL, height INT DEFAULT NULL, background_color VARCHAR(255) DEFAULT NULL, has_grid BOOLEAN DEFAULT false NOT NULL, blocks_headphones BOOLEAN DEFAULT false NOT NULL, weight DOUBLE PRECISION DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX items_api_key_idx ON items (api_id)');
        $this->addSql('CREATE INDEX items_slug_idx ON items (slug)');
        $this->addSql('CREATE UNIQUE INDEX uniq_e11ee94d3691d1ca ON items (properties_id)');
        $this->addSql('COMMENT ON COLUMN items.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items.properties_id IS \'(DC2Type:uuid)\'');
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

        $this->addSql('CREATE TABLE stimulation_effect (id UUID NOT NULL, properties_id UUID DEFAULT NULL, chance DOUBLE PRECISION DEFAULT \'0\', delay INT DEFAULT 0, duration INT DEFAULT 0, value DOUBLE PRECISION DEFAULT \'0\', percent BOOLEAN DEFAULT false NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_b7bc1ebf3691d1ca ON stimulation_effect (properties_id)');
        $this->addSql('COMMENT ON COLUMN stimulation_effect.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN stimulation_effect.properties_id IS \'(DC2Type:uuid)\'');
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

        $this->addSql('CREATE TABLE users (id UUID NOT NULL, login VARCHAR(50) NOT NULL, email VARCHAR(180) NOT NULL, title VARCHAR(180) DEFAULT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_d5428aede7927c74 ON users (email)');
        $this->addSql('CREATE UNIQUE INDEX uniq_d5428aedaa08cb10 ON users (login)');
        $this->addSql('COMMENT ON COLUMN users.id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE traders_cash_offers (id UUID NOT NULL, item_id UUID DEFAULT NULL, trader_id UUID DEFAULT NULL, trader_level_id UUID DEFAULT NULL, currency_item_id UUID DEFAULT NULL, quest_unlock_id UUID DEFAULT NULL, price INT NOT NULL, currency VARCHAR(10) DEFAULT NULL, price_rub INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
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

        $this->addSql('CREATE TABLE places (id UUID NOT NULL, api_id VARCHAR(255) DEFAULT NULL, published BOOLEAN DEFAULT true NOT NULL, order_place INT DEFAULT NULL, slug VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX place_api_id_idx ON places (api_id)');
        $this->addSql('CREATE INDEX place_slug_idx ON places (slug)');
        $this->addSql('CREATE UNIQUE INDEX uniq_feaf6c55989d9b62 ON places (slug)');
        $this->addSql('COMMENT ON COLUMN places.id IS \'(DC2Type:uuid)\'');
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

        $this->addSql('CREATE TABLE bosses_health (id UUID NOT NULL, boss_id UUID DEFAULT NULL, published BOOLEAN NOT NULL, max INT DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_df0d99f1261fb672 ON bosses_health (boss_id)');
        $this->addSql('COMMENT ON COLUMN bosses_health.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN bosses_health.boss_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_75ea56e016ba31db ON messenger_messages (delivered_at)');
        $this->addSql('CREATE INDEX idx_75ea56e0e3bd61ce ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX idx_75ea56e0fb7336f0 ON messenger_messages (queue_name)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE skills_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX skills_translation_unique_translation ON skills_translation (translatable_id, locale)');
        $this->addSql('CREATE INDEX skills_locale_idx ON skills_translation (locale)');
        $this->addSql('CREATE INDEX idx_517c959d2c2ac5d3 ON skills_translation (translatable_id)');
        $this->addSql('COMMENT ON COLUMN skills_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN skills_translation.translatable_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE updates (id UUID NOT NULL, category_id UUID DEFAULT NULL, published BOOLEAN DEFAULT true NOT NULL, date_added TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, date_added2 TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, slug VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX updates_slug_idx ON updates (slug)');
        $this->addSql('CREATE INDEX updates_date_added2_idx ON updates (date_added2)');
        $this->addSql('CREATE INDEX updates_date_added_idx ON updates (date_added)');
        $this->addSql('CREATE INDEX idx_4548133012469de2 ON updates (category_id)');
        $this->addSql('CREATE UNIQUE INDEX uniq_45481330989d9b62 ON updates (slug)');
        $this->addSql('COMMENT ON COLUMN updates.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN updates.category_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE quests_objectives_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX quests_objectives_translation_unique_translation ON quests_objectives_translation (translatable_id, locale)');
        $this->addSql('CREATE INDEX quests_objectives_locale_idx ON quests_objectives_translation (locale)');
        $this->addSql('CREATE INDEX idx_5e497b392c2ac5d3 ON quests_objectives_translation (translatable_id)');
        $this->addSql('COMMENT ON COLUMN quests_objectives_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN quests_objectives_translation.translatable_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE quests (id UUID NOT NULL, trader_id UUID DEFAULT NULL, map_id UUID DEFAULT NULL, api_id VARCHAR(255) DEFAULT NULL, "position" INT DEFAULT 0 NOT NULL, published BOOLEAN NOT NULL, image_name VARCHAR(255) DEFAULT NULL, experience INT DEFAULT NULL, min_player_level INT NOT NULL, restartable BOOLEAN DEFAULT false NOT NULL, kappa_required BOOLEAN DEFAULT false NOT NULL, lightkeeper_required BOOLEAN DEFAULT false NOT NULL, slug VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX quests_api_key_idx ON quests (api_id)');
        $this->addSql('CREATE INDEX quests_slug_idx ON quests (slug)');
        $this->addSql('CREATE INDEX idx_989e5d3453c55f64 ON quests (map_id)');
        $this->addSql('CREATE INDEX idx_989e5d341273968f ON quests (trader_id)');
        $this->addSql('CREATE UNIQUE INDEX uniq_989e5d34989d9b62 ON quests (slug)');
        $this->addSql('COMMENT ON COLUMN quests.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN quests.trader_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN quests.map_id IS \'(DC2Type:uuid)\'');
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

        $this->addSql('CREATE TABLE items_properties_armor (id UUID NOT NULL, class INT DEFAULT 0 NOT NULL, durability INT DEFAULT 0 NOT NULL, repair_cost INT DEFAULT 0 NOT NULL, speed_penalty DOUBLE PRECISION DEFAULT \'0\' NOT NULL, turn_penalty DOUBLE PRECISION DEFAULT \'0\' NOT NULL, ergo_penalty INT DEFAULT 0 NOT NULL, zones JSONB DEFAULT NULL, armor_type VARCHAR(64) DEFAULT \'\' NOT NULL, blunt_throughput DOUBLE PRECISION DEFAULT \'0\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON TABLE items_properties_armor IS \'Таблица свойств для брони\'');
        $this->addSql('COMMENT ON COLUMN items_properties_armor.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_properties_armor.class IS \'Класс брони\'');
        $this->addSql('COMMENT ON COLUMN items_properties_armor.durability IS \'Прочность\'');
        $this->addSql('COMMENT ON COLUMN items_properties_armor.repair_cost IS \'Стоимость ремонта за 1 ед.\'');
        $this->addSql('COMMENT ON COLUMN items_properties_armor.speed_penalty IS \'Снижение скорости в %\'');
        $this->addSql('COMMENT ON COLUMN items_properties_armor.turn_penalty IS \'Снижение поворота в %\'');
        $this->addSql('COMMENT ON COLUMN items_properties_armor.ergo_penalty IS \'Снижение эргономик в %\'');
        $this->addSql('COMMENT ON COLUMN items_properties_armor.zones IS \'Защита частей тела\'');
        $this->addSql('COMMENT ON COLUMN items_properties_armor.armor_type IS \'Тип защиты\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE items_properties_medical_item (id UUID NOT NULL, uses INT DEFAULT 0 NOT NULL, use_time INT DEFAULT 0 NOT NULL, cures JSONB DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON TABLE items_properties_medical_item IS \'Таблица свойств для мед. предметов\'');
        $this->addSql('COMMENT ON COLUMN items_properties_medical_item.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_properties_medical_item.uses IS \'Используется кол-во раз\'');
        $this->addSql('COMMENT ON COLUMN items_properties_medical_item.use_time IS \'Время использования\'');
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

        $this->addSql('CREATE TABLE maps_locations (id UUID NOT NULL, map_id UUID DEFAULT NULL, image_name VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_c383b3b953c55f64 ON maps_locations (map_id)');
        $this->addSql('COMMENT ON COLUMN maps_locations.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN maps_locations.map_id IS \'(DC2Type:uuid)\'');
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

        $this->addSql('CREATE TABLE barters_reward_items (barter_id UUID NOT NULL, contained_item_id UUID NOT NULL, PRIMARY KEY(barter_id, contained_item_id))');
        $this->addSql('CREATE INDEX idx_25502a0753cdede8 ON barters_reward_items (contained_item_id)');
        $this->addSql('CREATE INDEX idx_25502a076a7d1f74 ON barters_reward_items (barter_id)');
        $this->addSql('COMMENT ON COLUMN barters_reward_items.barter_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN barters_reward_items.contained_item_id IS \'(DC2Type:uuid)\'');
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

        $this->addSql('CREATE TABLE items_materials (id UUID NOT NULL, api_id VARCHAR(32) DEFAULT \'\' NOT NULL, published BOOLEAN NOT NULL, destructibility DOUBLE PRECISION DEFAULT \'0\' NOT NULL, min_repair_degradation DOUBLE PRECISION DEFAULT \'0\' NOT NULL, max_repair_degradation DOUBLE PRECISION DEFAULT \'0\' NOT NULL, explosion_destructibility DOUBLE PRECISION DEFAULT \'0\' NOT NULL, min_repair_kit_degradation DOUBLE PRECISION DEFAULT \'0\' NOT NULL, max_repair_kit_degradation DOUBLE PRECISION DEFAULT \'0\' NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX items_materials_api_key_idx ON items_materials (api_id)');
        $this->addSql('CREATE UNIQUE INDEX uniq_e7bc82b254963938 ON items_materials (api_id)');
        $this->addSql('COMMENT ON TABLE items_materials IS \'Таблица материалов для предметов\'');
        $this->addSql('COMMENT ON COLUMN items_materials.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_materials.api_id IS \'Идентификатор API\'');
        $this->addSql('COMMENT ON COLUMN items_materials.destructibility IS \'Разрушаемость\'');
        $this->addSql('COMMENT ON COLUMN items_materials.min_repair_degradation IS \'Мин. деградация при ремонте\'');
        $this->addSql('COMMENT ON COLUMN items_materials.max_repair_degradation IS \'Макс. деградация при ремонте\'');
        $this->addSql('COMMENT ON COLUMN items_materials.explosion_destructibility IS \'Разрущаемость от взрыва\'');
        $this->addSql('COMMENT ON COLUMN items_materials.min_repair_kit_degradation IS \'Мин. деградация ремкомплектапри ремонте\'');
        $this->addSql('COMMENT ON COLUMN items_materials.max_repair_kit_degradation IS \'Макс. деградация ремкомплектапри ремонте\'');
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

        $this->addSql('CREATE TABLE items_properties_barrel (id UUID NOT NULL, ergonomics DOUBLE PRECISION DEFAULT \'0\' NOT NULL, recoil_modifier DOUBLE PRECISION DEFAULT \'0\' NOT NULL, center_of_impact DOUBLE PRECISION DEFAULT \'0\' NOT NULL, deviation_curve DOUBLE PRECISION DEFAULT \'0\' NOT NULL, deviation_max DOUBLE PRECISION DEFAULT \'0\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON TABLE items_properties_barrel IS \'Таблица свойств для бочки\'');
        $this->addSql('COMMENT ON COLUMN items_properties_barrel.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_properties_barrel.ergonomics IS \'Эргономика\'');
        $this->addSql('COMMENT ON COLUMN items_properties_barrel.recoil_modifier IS \'Модификатор отдачи\'');
        $this->addSql('COMMENT ON COLUMN items_properties_barrel.center_of_impact IS \'Центр воздействия\'');
        $this->addSql('COMMENT ON COLUMN items_properties_barrel.deviation_curve IS \'Кривая отклонения\'');
        $this->addSql('COMMENT ON COLUMN items_properties_barrel.deviation_max IS \'Макс. отклонение\'');
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

        $this->addSql('CREATE TABLE weather (id UUID NOT NULL, "timestamp" INT DEFAULT 0 NOT NULL, cloud DOUBLE PRECISION NOT NULL, wind_speed INT DEFAULT 0 NOT NULL, wind_direction INT DEFAULT 0 NOT NULL, wind_gustiness DOUBLE PRECISION NOT NULL, rain BOOLEAN NOT NULL, rain_intensivity INT DEFAULT 0 NOT NULL, fog DOUBLE PRECISION NOT NULL, temp INT DEFAULT 0 NOT NULL, pressure INT DEFAULT 0 NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN weather.id IS \'(DC2Type:uuid)\'');
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

        $this->addSql('CREATE TABLE crafts_required_quest_items (craft_id UUID NOT NULL, quest_item_id UUID NOT NULL, PRIMARY KEY(craft_id, quest_item_id))');
        $this->addSql('CREATE INDEX idx_5f7665734648ef15 ON crafts_required_quest_items (quest_item_id)');
        $this->addSql('CREATE INDEX idx_5f766573e836ccc8 ON crafts_required_quest_items (craft_id)');
        $this->addSql('COMMENT ON COLUMN crafts_required_quest_items.craft_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN crafts_required_quest_items.quest_item_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE items_properties_surgical_kit (id UUID NOT NULL, uses INT DEFAULT 0 NOT NULL, use_time INT DEFAULT 0 NOT NULL, cures JSONB DEFAULT NULL, min_limb_health DOUBLE PRECISION DEFAULT \'0\' NOT NULL, max_limb_health DOUBLE PRECISION DEFAULT \'0\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON TABLE items_properties_surgical_kit IS \'Свойства хирурнических наборов\'');
        $this->addSql('COMMENT ON COLUMN items_properties_surgical_kit.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_properties_surgical_kit.uses IS \'Используется кол-во раз\'');
        $this->addSql('COMMENT ON COLUMN items_properties_surgical_kit.use_time IS \'Время использования\'');
        $this->addSql('COMMENT ON COLUMN items_properties_surgical_kit.cures IS \'Зоны\'');
        $this->addSql('COMMENT ON COLUMN items_properties_surgical_kit.min_limb_health IS \'Мин. здоровье конечностей\'');
        $this->addSql('COMMENT ON COLUMN items_properties_surgical_kit.max_limb_health IS \'Макс. здоровье конечностей\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE items_properties_chest_rig (id UUID NOT NULL, class INT DEFAULT 0 NOT NULL, durability INT DEFAULT 0 NOT NULL, repair_cost INT DEFAULT 0 NOT NULL, speed_penalty DOUBLE PRECISION DEFAULT \'0\' NOT NULL, turn_penalty DOUBLE PRECISION DEFAULT \'0\' NOT NULL, ergo_penalty INT DEFAULT 0 NOT NULL, zones JSONB DEFAULT NULL, capacity INT DEFAULT 0 NOT NULL, armor_type VARCHAR(64) DEFAULT \'\' NOT NULL, blunt_throughput DOUBLE PRECISION DEFAULT \'0\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON TABLE items_properties_chest_rig IS \'Таблица свойств для разгрозочного жилета\'');
        $this->addSql('COMMENT ON COLUMN items_properties_chest_rig.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_properties_chest_rig.class IS \'Класс\'');
        $this->addSql('COMMENT ON COLUMN items_properties_chest_rig.durability IS \'Прочность\'');
        $this->addSql('COMMENT ON COLUMN items_properties_chest_rig.repair_cost IS \'Стоимость ремонта за 1 ед.\'');
        $this->addSql('COMMENT ON COLUMN items_properties_chest_rig.speed_penalty IS \'Снижение скорости в %\'');
        $this->addSql('COMMENT ON COLUMN items_properties_chest_rig.turn_penalty IS \'Снижение поворота в %\'');
        $this->addSql('COMMENT ON COLUMN items_properties_chest_rig.ergo_penalty IS \'Снижение эргономик в %\'');
        $this->addSql('COMMENT ON COLUMN items_properties_chest_rig.zones IS \'Защита частей тела\'');
        $this->addSql('COMMENT ON COLUMN items_properties_chest_rig.capacity IS \'Емкость\'');
        $this->addSql('COMMENT ON COLUMN items_properties_chest_rig.armor_type IS \'Тип защиты\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE items_properties_magazine (id UUID NOT NULL, ergonomics DOUBLE PRECISION DEFAULT \'0\' NOT NULL, recoil_modifier DOUBLE PRECISION DEFAULT \'0\' NOT NULL, capacity INT DEFAULT 0 NOT NULL, load_modifier DOUBLE PRECISION DEFAULT \'0\' NOT NULL, ammo_check_modifier DOUBLE PRECISION DEFAULT \'0\' NOT NULL, malfunction_chance DOUBLE PRECISION DEFAULT \'0\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON TABLE items_properties_magazine IS \'Таблица свойств для магазина патронов\'');
        $this->addSql('COMMENT ON COLUMN items_properties_magazine.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_properties_magazine.ergonomics IS \'Эргономика\'');
        $this->addSql('COMMENT ON COLUMN items_properties_magazine.recoil_modifier IS \'Отдача в процентах\'');
        $this->addSql('COMMENT ON COLUMN items_properties_magazine.capacity IS \'Вместимость\'');
        $this->addSql('COMMENT ON COLUMN items_properties_magazine.load_modifier IS \'Модификатор загрузки\'');
        $this->addSql('COMMENT ON COLUMN items_properties_magazine.ammo_check_modifier IS \'Модификатор проверки боеприпасов\'');
        $this->addSql('COMMENT ON COLUMN items_properties_magazine.malfunction_chance IS \'Шанс неисправности\'');
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

        $this->addSql('CREATE TABLE quests_items (id UUID NOT NULL, api_id VARCHAR(255) DEFAULT NULL, published BOOLEAN NOT NULL, width SMALLINT NOT NULL, height SMALLINT NOT NULL, image_name VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX quests_items_api_key_idx ON quests_items (api_id)');
        $this->addSql('CREATE INDEX quests_items_slug_idx ON quests_items (slug)');
        $this->addSql('COMMENT ON COLUMN quests_items.id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE maps_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX maps_translation_unique_translation ON maps_translation (translatable_id, locale)');
        $this->addSql('CREATE INDEX maps_locale_idx ON maps_translation (locale)');
        $this->addSql('CREATE INDEX idx_5b2588712c2ac5d3 ON maps_translation (translatable_id)');
        $this->addSql('COMMENT ON COLUMN maps_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN maps_translation.translatable_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE quests_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, how_to_complete TEXT DEFAULT NULL, start_dialog TEXT DEFAULT NULL, successful_dialog TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX quests_translation_unique_translation ON quests_translation (translatable_id, locale)');
        $this->addSql('CREATE INDEX quests_locale_idx ON quests_translation (locale)');
        $this->addSql('CREATE INDEX idx_e0fe32b52c2ac5d3 ON quests_translation (translatable_id)');
        $this->addSql('COMMENT ON COLUMN quests_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN quests_translation.translatable_id IS \'(DC2Type:uuid)\'');
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

        $this->addSql('CREATE TABLE traders_levels (id UUID NOT NULL, trader_id UUID DEFAULT NULL, level INT NOT NULL, required_player_level INT NOT NULL, required_reputation DOUBLE PRECISION NOT NULL, required_sales INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_9b1ba77b1273968f ON traders_levels (trader_id)');
        $this->addSql('COMMENT ON COLUMN traders_levels.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN traders_levels.trader_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE items_properties_med_kit (id UUID NOT NULL, hit_points INT DEFAULT 0 NOT NULL, use_time INT DEFAULT 0 NOT NULL, max_heal_per_use INT DEFAULT 0 NOT NULL, cures JSONB DEFAULT NULL, hp_cost_light_bleeding INT DEFAULT 0 NOT NULL, hp_cost_heavy_bleeding INT DEFAULT 0 NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON TABLE items_properties_med_kit IS \'Таблица свойств для мед. аптечки\'');
        $this->addSql('COMMENT ON COLUMN items_properties_med_kit.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_properties_med_kit.hit_points IS \'Очки здоровья\'');
        $this->addSql('COMMENT ON COLUMN items_properties_med_kit.use_time IS \'Время использования\'');
        $this->addSql('COMMENT ON COLUMN items_properties_med_kit.max_heal_per_use IS \'Макс. лечение за использование\'');
        $this->addSql('COMMENT ON COLUMN items_properties_med_kit.cures IS \'Зоны излечения\'');
        $this->addSql('COMMENT ON COLUMN items_properties_med_kit.hp_cost_light_bleeding IS \'Кол-во очков за слабое кровотечение\'');
        $this->addSql('COMMENT ON COLUMN items_properties_med_kit.hp_cost_heavy_bleeding IS \'Кол-во очков за сильное кровотечение\'');
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

        $this->addSql('CREATE TABLE places_levels_required (id UUID NOT NULL, place_id UUID DEFAULT NULL, api_id VARCHAR(255) DEFAULT NULL, level INT DEFAULT 0 NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX places_levels_required_idx ON places_levels_required (api_id)');
        $this->addSql('CREATE INDEX idx_2d8f1030da6a219 ON places_levels_required (place_id)');
        $this->addSql('COMMENT ON COLUMN places_levels_required.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN places_levels_required.place_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE items_properties_food_drink (id UUID NOT NULL, energy INT DEFAULT 0 NOT NULL, hydration INT DEFAULT 0 NOT NULL, units INT DEFAULT 0 NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON TABLE items_properties_food_drink IS \'Таблица свойств для еды и напитков\'');
        $this->addSql('COMMENT ON COLUMN items_properties_food_drink.id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE items_materials_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX items_materials_translation_unique_translation ON items_materials_translation (translatable_id, locale)');
        $this->addSql('CREATE INDEX item_material_locale_idx ON items_materials_translation (locale)');
        $this->addSql('CREATE INDEX idx_97113b212c2ac5d3 ON items_materials_translation (translatable_id)');
        $this->addSql('COMMENT ON COLUMN items_materials_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_materials_translation.translatable_id IS \'(DC2Type:uuid)\'');
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

        $this->addSql('CREATE TABLE stimulation_effect_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, type VARCHAR(64) DEFAULT NULL, skill_name VARCHAR(64) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX stimulation_effect_translation_unique_translation ON stimulation_effect_translation (translatable_id, locale)');
        $this->addSql('CREATE INDEX idx_a8e1182a2c2ac5d3 ON stimulation_effect_translation (translatable_id)');
        $this->addSql('COMMENT ON TABLE stimulation_effect_translation IS \'Таблица переводов для эффектов стимуляции\'');
        $this->addSql('COMMENT ON COLUMN stimulation_effect_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN stimulation_effect_translation.translatable_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE items_properties_glasses (id UUID NOT NULL, class INT DEFAULT 0 NOT NULL, durability INT DEFAULT 0 NOT NULL, repair_cost INT DEFAULT 0 NOT NULL, blindness_protection DOUBLE PRECISION DEFAULT \'0\' NOT NULL, blunt_throughput DOUBLE PRECISION DEFAULT \'0\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON TABLE items_properties_glasses IS \'Таблица свойств для очков\'');
        $this->addSql('COMMENT ON COLUMN items_properties_glasses.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_properties_glasses.class IS \'Класс брони\'');
        $this->addSql('COMMENT ON COLUMN items_properties_glasses.durability IS \'Прочность\'');
        $this->addSql('COMMENT ON COLUMN items_properties_glasses.repair_cost IS \'Стоимость ремонта за 1 ед.\'');
        $this->addSql('COMMENT ON COLUMN items_properties_glasses.blindness_protection IS \'Защита от ослепления\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE items_properties_weapon_presets (item_properties_weapon_id UUID NOT NULL, item_id UUID NOT NULL, PRIMARY KEY(item_properties_weapon_id, item_id))');
        $this->addSql('CREATE INDEX idx_6b6c38ed126f525e ON items_properties_weapon_presets (item_id)');
        $this->addSql('CREATE INDEX idx_6b6c38edb7609ea4 ON items_properties_weapon_presets (item_properties_weapon_id)');
        $this->addSql('COMMENT ON COLUMN items_properties_weapon_presets.item_properties_weapon_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_properties_weapon_presets.item_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE items_properties_night_vision (id UUID NOT NULL, intensity DOUBLE PRECISION DEFAULT \'0\' NOT NULL, noise_intensity DOUBLE PRECISION DEFAULT \'0\' NOT NULL, noise_scale DOUBLE PRECISION DEFAULT \'0\' NOT NULL, diffuse_intensity DOUBLE PRECISION DEFAULT \'0\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON TABLE items_properties_night_vision IS \'Свойства предметов ночного видения\'');
        $this->addSql('COMMENT ON COLUMN items_properties_night_vision.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_properties_night_vision.intensity IS \'Интенсивность\'');
        $this->addSql('COMMENT ON COLUMN items_properties_night_vision.noise_intensity IS \'Интенсивность шума\'');
        $this->addSql('COMMENT ON COLUMN items_properties_night_vision.noise_scale IS \'Шкала шума\'');
        $this->addSql('COMMENT ON COLUMN items_properties_night_vision.diffuse_intensity IS \'Диффузная интенсивность\'');
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

        $this->addSql('CREATE TABLE quests_received_items (quest_id UUID NOT NULL, contained_item_id UUID NOT NULL, PRIMARY KEY(quest_id, contained_item_id))');
        $this->addSql('CREATE INDEX idx_aa7f4d3a53cdede8 ON quests_received_items (contained_item_id)');
        $this->addSql('CREATE INDEX idx_aa7f4d3a209e9ef4 ON quests_received_items (quest_id)');
        $this->addSql('COMMENT ON COLUMN quests_received_items.quest_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN quests_received_items.contained_item_id IS \'(DC2Type:uuid)\'');
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

        $this->addSql('CREATE TABLE items_properties_grenade (id UUID NOT NULL, type VARCHAR(32) DEFAULT \'\' NOT NULL, fuse DOUBLE PRECISION DEFAULT \'0\' NOT NULL, min_explosion_distance INT DEFAULT 0 NOT NULL, max_explosion_distance INT DEFAULT 0 NOT NULL, fragments INT DEFAULT 0 NOT NULL, contusion_radius INT DEFAULT 0 NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON TABLE items_properties_grenade IS \'Таблица свойств для гранат\'');
        $this->addSql('COMMENT ON COLUMN items_properties_grenade.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_properties_grenade.type IS \'Тип гранаты\'');
        $this->addSql('COMMENT ON COLUMN items_properties_grenade.fuse IS \'Задержка перед взрывом\'');
        $this->addSql('COMMENT ON COLUMN items_properties_grenade.min_explosion_distance IS \'Мин. расстояние взрыва\'');
        $this->addSql('COMMENT ON COLUMN items_properties_grenade.max_explosion_distance IS \'Макс. расстояние взрыва\'');
        $this->addSql('COMMENT ON COLUMN items_properties_grenade.fragments IS \'Кол-во осколков\'');
        $this->addSql('COMMENT ON COLUMN items_properties_grenade.contusion_radius IS \'Радиус кантузии\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE items_properties_backpack (id UUID NOT NULL, capacity INT DEFAULT 0 NOT NULL, speed_penalty DOUBLE PRECISION DEFAULT \'0\' NOT NULL, turn_penalty DOUBLE PRECISION DEFAULT \'0\' NOT NULL, ergo_penalty INT DEFAULT 0 NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON TABLE items_properties_backpack IS \'Таблица свойств для рюкзаков\'');
        $this->addSql('COMMENT ON COLUMN items_properties_backpack.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_properties_backpack.capacity IS \'Емкость\'');
        $this->addSql('COMMENT ON COLUMN items_properties_backpack.speed_penalty IS \'Снижение скорости в %\'');
        $this->addSql('COMMENT ON COLUMN items_properties_backpack.turn_penalty IS \'Снижение поворота в %\'');
        $this->addSql('COMMENT ON COLUMN items_properties_backpack.ergo_penalty IS \'Снижение эргономик в %\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE items_properties_weapon (id UUID NOT NULL, default_ammo_id UUID DEFAULT NULL, default_preset_id UUID DEFAULT NULL, api_caliber VARCHAR(64) DEFAULT \'\' NOT NULL, effective_distance INT DEFAULT 0 NOT NULL, ergonomics DOUBLE PRECISION DEFAULT \'0\' NOT NULL, fire_modes JSONB DEFAULT NULL, fire_rate INT DEFAULT 0 NOT NULL, max_durability INT DEFAULT 0 NOT NULL, recoil_vertical INT DEFAULT 0 NOT NULL, recoil_horizontal INT DEFAULT 0 NOT NULL, repair_cost INT DEFAULT 0 NOT NULL, sighting_range INT DEFAULT 0 NOT NULL, center_of_impact DOUBLE PRECISION DEFAULT \'0\' NOT NULL, deviation_curve DOUBLE PRECISION DEFAULT \'0\' NOT NULL, recoil_dispersion INT DEFAULT 0 NOT NULL, recoil_angle INT DEFAULT 0 NOT NULL, camera_recoil DOUBLE PRECISION DEFAULT \'0\' NOT NULL, camera_snap DOUBLE PRECISION DEFAULT \'0\' NOT NULL, deviation_max DOUBLE PRECISION DEFAULT \'0\' NOT NULL, convergence DOUBLE PRECISION DEFAULT \'0\' NOT NULL, default_width INT DEFAULT 0 NOT NULL, default_height INT DEFAULT 0 NOT NULL, default_ergonomics DOUBLE PRECISION DEFAULT \'0\' NOT NULL, default_recoil_vertical INT DEFAULT 0 NOT NULL, default_recoil_horizontal INT DEFAULT 0 NOT NULL, default_weight DOUBLE PRECISION DEFAULT \'0\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_d61c9e34110aa6c8 ON items_properties_weapon (default_preset_id)');
        $this->addSql('CREATE UNIQUE INDEX uniq_d61c9e346da59d65 ON items_properties_weapon (default_ammo_id)');
        $this->addSql('COMMENT ON TABLE items_properties_weapon IS \'Свойств для оружия\'');
        $this->addSql('COMMENT ON COLUMN items_properties_weapon.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_properties_weapon.default_ammo_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_properties_weapon.default_preset_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_properties_weapon.api_caliber IS \'Калибр\'');
        $this->addSql('COMMENT ON COLUMN items_properties_weapon.effective_distance IS \'Эффективная дистанция\'');
        $this->addSql('COMMENT ON COLUMN items_properties_weapon.ergonomics IS \'Эффективная дистанция\'');
        $this->addSql('COMMENT ON COLUMN items_properties_weapon.fire_modes IS \'Режимы стрельбы\'');
        $this->addSql('COMMENT ON COLUMN items_properties_weapon.fire_rate IS \'Скорострельность\'');
        $this->addSql('COMMENT ON COLUMN items_properties_weapon.max_durability IS \'Макс. прочность\'');
        $this->addSql('COMMENT ON COLUMN items_properties_weapon.recoil_vertical IS \'Вертикальная отдача\'');
        $this->addSql('COMMENT ON COLUMN items_properties_weapon.recoil_horizontal IS \'Горизонтальная отдача\'');
        $this->addSql('COMMENT ON COLUMN items_properties_weapon.repair_cost IS \'Стоимость ремонта за 1 ед.\'');
        $this->addSql('COMMENT ON COLUMN items_properties_weapon.sighting_range IS \'Прицельная дальность\'');
        $this->addSql('COMMENT ON COLUMN items_properties_weapon.center_of_impact IS \' Центр воздействия\'');
        $this->addSql('COMMENT ON COLUMN items_properties_weapon.deviation_curve IS \'Кривая отклонения\'');
        $this->addSql('COMMENT ON COLUMN items_properties_weapon.recoil_dispersion IS \'Дисперсия отдачи\'');
        $this->addSql('COMMENT ON COLUMN items_properties_weapon.recoil_angle IS \'Угол отдачи\'');
        $this->addSql('COMMENT ON COLUMN items_properties_weapon.camera_recoil IS \'Отдача камеры\'');
        $this->addSql('COMMENT ON COLUMN items_properties_weapon.camera_snap IS \'Щелчок камеры\'');
        $this->addSql('COMMENT ON COLUMN items_properties_weapon.deviation_max IS \'Макс. отклонение\'');
        $this->addSql('COMMENT ON COLUMN items_properties_weapon.convergence IS \'Конвергенция\'');
        $this->addSql('COMMENT ON COLUMN items_properties_weapon.default_width IS \'Ширина по умолчанию\'');
        $this->addSql('COMMENT ON COLUMN items_properties_weapon.default_height IS \'Высота по умолчанию\'');
        $this->addSql('COMMENT ON COLUMN items_properties_weapon.default_ergonomics IS \'Стандартная эргономика\'');
        $this->addSql('COMMENT ON COLUMN items_properties_weapon.default_recoil_vertical IS \'Вертикальная отдача по умолчанию\'');
        $this->addSql('COMMENT ON COLUMN items_properties_weapon.default_recoil_horizontal IS \'Горизонтальная отдача по умолчанию\'');
        $this->addSql('COMMENT ON COLUMN items_properties_weapon.default_weight IS \'Вес по умолчанию\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE items_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, short_name VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX items_translation_unique_translation ON items_translation (translatable_id, locale)');
        $this->addSql('CREATE INDEX item_locale_idx ON items_translation (locale)');
        $this->addSql('CREATE INDEX idx_c4af85e2c2ac5d3 ON items_translation (translatable_id)');
        $this->addSql('COMMENT ON COLUMN items_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_translation.translatable_id IS \'(DC2Type:uuid)\'');
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

        $this->addSql('CREATE TABLE items_properties_weapon_mod (id UUID NOT NULL, ergonomics DOUBLE PRECISION DEFAULT \'0\' NOT NULL, recoil_modifier DOUBLE PRECISION DEFAULT \'0\' NOT NULL, accuracy_modifier DOUBLE PRECISION DEFAULT \'0\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON TABLE items_properties_weapon_mod IS \'Свойства для модификаций оружия\'');
        $this->addSql('COMMENT ON COLUMN items_properties_weapon_mod.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_properties_weapon_mod.ergonomics IS \'Эргономика\'');
        $this->addSql('COMMENT ON COLUMN items_properties_weapon_mod.recoil_modifier IS \'Отдача в процентах\'');
        $this->addSql('COMMENT ON COLUMN items_properties_weapon_mod.accuracy_modifier IS \'Точность в процентах\'');
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

        $this->addSql('CREATE TABLE items_properties_headphone (id UUID NOT NULL, ambient_volume INT DEFAULT 0 NOT NULL, compressor_attack INT DEFAULT 0 NOT NULL, compressor_gain INT DEFAULT 0 NOT NULL, compressor_release INT DEFAULT 0 NOT NULL, compressor_threshold INT DEFAULT 0 NOT NULL, compressor_volume INT DEFAULT 0 NOT NULL, cutoff_frequency INT DEFAULT 0 NOT NULL, distance_modifier DOUBLE PRECISION DEFAULT \'0\' NOT NULL, distortion DOUBLE PRECISION DEFAULT \'0\' NOT NULL, dry_volume INT DEFAULT 0 NOT NULL, high_frequency_gain DOUBLE PRECISION DEFAULT \'0\' NOT NULL, resonance DOUBLE PRECISION DEFAULT \'0\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON TABLE items_properties_headphone IS \'Таблица свойств для наушников\'');
        $this->addSql('COMMENT ON COLUMN items_properties_headphone.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_properties_headphone.ambient_volume IS \'Звуки окружения\'');
        $this->addSql('COMMENT ON COLUMN items_properties_headphone.compressor_attack IS \'Время срабатывания сжатия\'');
        $this->addSql('COMMENT ON COLUMN items_properties_headphone.compressor_gain IS \'Общий уровень громкости\'');
        $this->addSql('COMMENT ON COLUMN items_properties_headphone.compressor_release IS \'Скорость восстановления звука\'');
        $this->addSql('COMMENT ON COLUMN items_properties_headphone.compressor_threshold IS \'Уровень срабатывания сжатия\'');
        $this->addSql('COMMENT ON COLUMN items_properties_headphone.compressor_volume IS \'Глубина сжатия\'');
        $this->addSql('COMMENT ON COLUMN items_properties_headphone.cutoff_frequency IS \'Обрезаемая частота\'');
        $this->addSql('COMMENT ON COLUMN items_properties_headphone.distance_modifier IS \'Увеличение дальности звука\'');
        $this->addSql('COMMENT ON COLUMN items_properties_headphone.distortion IS \'Перекручивание звука уже готового\'');
        $this->addSql('COMMENT ON COLUMN items_properties_headphone.dry_volume IS \'Уровень чистого звука\'');
        $this->addSql('COMMENT ON COLUMN items_properties_headphone.high_frequency_gain IS \'Высокочастные шумы\'');
        $this->addSql('COMMENT ON COLUMN items_properties_headphone.resonance IS \'Резонанс (Работает вместе с highFrequencyGain)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE quests_advice_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, body TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX quests_advice_translation_unique_translation ON quests_advice_translation (translatable_id, locale)');
        $this->addSql('CREATE INDEX idx_9b68b98a2c2ac5d3 ON quests_advice_translation (translatable_id)');
        $this->addSql('COMMENT ON COLUMN quests_advice_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN quests_advice_translation.translatable_id IS \'(DC2Type:uuid)\'');
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

        $this->addSql('CREATE TABLE items_properties_container (id UUID NOT NULL, capacity INT DEFAULT 0 NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON TABLE items_properties_container IS \'Таблица свойств для контейнера\'');
        $this->addSql('COMMENT ON COLUMN items_properties_container.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_properties_container.capacity IS \'Емкость\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE items_properties_weapon_ammo (item_properties_weapon_id UUID NOT NULL, item_id UUID NOT NULL, PRIMARY KEY(item_properties_weapon_id, item_id))');
        $this->addSql('CREATE INDEX idx_79cabe6d126f525e ON items_properties_weapon_ammo (item_id)');
        $this->addSql('CREATE INDEX idx_79cabe6db7609ea4 ON items_properties_weapon_ammo (item_properties_weapon_id)');
        $this->addSql('COMMENT ON COLUMN items_properties_weapon_ammo.item_properties_weapon_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_properties_weapon_ammo.item_id IS \'(DC2Type:uuid)\'');
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

        $this->addSql('CREATE TABLE quests_items_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, name VARCHAR(255) NOT NULL, short_name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX quests_items_translation_unique_translation ON quests_items_translation (translatable_id, locale)');
        $this->addSql('CREATE INDEX quests_items_locale_idx ON quests_items_translation (locale)');
        $this->addSql('CREATE INDEX idx_bf3fa4b92c2ac5d3 ON quests_items_translation (translatable_id)');
        $this->addSql('COMMENT ON COLUMN quests_items_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN quests_items_translation.translatable_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE items_calibers_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX items_calibers_translation_unique_translation ON items_calibers_translation (translatable_id, locale)');
        $this->addSql('CREATE INDEX item_calibres_translation_locale_idx ON items_calibers_translation (locale)');
        $this->addSql('CREATE INDEX idx_f464fe992c2ac5d3 ON items_calibers_translation (translatable_id)');
        $this->addSql('COMMENT ON COLUMN items_calibers_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_calibers_translation.translatable_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE items_properties_key (id UUID NOT NULL, uses INT DEFAULT 0 NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON TABLE items_properties_key IS \'Таблица свойств для ключей\'');
        $this->addSql('COMMENT ON COLUMN items_properties_key.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_properties_key.uses IS \'Используется кол-во раз\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE items_properties_scope (id UUID NOT NULL, ergonomics DOUBLE PRECISION DEFAULT \'0\' NOT NULL, sight_modes JSONB DEFAULT NULL, sighting_range INT DEFAULT 0 NOT NULL, recoil_modifier DOUBLE PRECISION DEFAULT \'0\' NOT NULL, zoom_levels JSONB DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON TABLE items_properties_scope IS \'Свойства прицелов\'');
        $this->addSql('COMMENT ON COLUMN items_properties_scope.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_properties_scope.ergonomics IS \'Эгономика\'');
        $this->addSql('COMMENT ON COLUMN items_properties_scope.sight_modes IS \'Режимы прицела\'');
        $this->addSql('COMMENT ON COLUMN items_properties_scope.sighting_range IS \'Прицельная дальность\'');
        $this->addSql('COMMENT ON COLUMN items_properties_scope.recoil_modifier IS \'Модификатор отдачи\'');
        $this->addSql('COMMENT ON COLUMN items_properties_scope.zoom_levels IS \'Уровни масштабирования\'');
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

        $this->addSql('CREATE TABLE bosses (id UUID NOT NULL, published BOOLEAN NOT NULL, slug VARCHAR(255) NOT NULL, image_name VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN bosses.id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE items_calibers (id UUID NOT NULL, published BOOLEAN DEFAULT false NOT NULL, api_id VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, is_ammo BOOLEAN DEFAULT false NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX items_calibers_api_key_idx ON items_calibers (api_id)');
        $this->addSql('CREATE INDEX items_calibers_slug_idx ON items_calibers (slug)');
        $this->addSql('COMMENT ON COLUMN items_calibers.id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE items_properties_helmet (id UUID NOT NULL, class INT DEFAULT 0 NOT NULL, durability INT DEFAULT 0 NOT NULL, repair_cost INT DEFAULT 0 NOT NULL, speed_penalty DOUBLE PRECISION DEFAULT \'0\' NOT NULL, turn_penalty DOUBLE PRECISION DEFAULT \'0\' NOT NULL, ergo_penalty DOUBLE PRECISION DEFAULT \'0\' NOT NULL, head_zones JSONB DEFAULT NULL, deafening VARCHAR(16) DEFAULT \'\' NOT NULL, block_headset BOOLEAN DEFAULT false NOT NULL, blindness_protection DOUBLE PRECISION DEFAULT \'0\' NOT NULL, ricochet_x DOUBLE PRECISION DEFAULT \'0\' NOT NULL, ricochet_y DOUBLE PRECISION DEFAULT \'0\' NOT NULL, ricochet_z DOUBLE PRECISION DEFAULT \'0\' NOT NULL, armor_type VARCHAR(64) DEFAULT \'\' NOT NULL, blunt_throughput DOUBLE PRECISION DEFAULT \'0\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON TABLE items_properties_helmet IS \'Таблица свойств для шлемов\'');
        $this->addSql('COMMENT ON COLUMN items_properties_helmet.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_properties_helmet.class IS \'Класс\'');
        $this->addSql('COMMENT ON COLUMN items_properties_helmet.durability IS \'Прочность\'');
        $this->addSql('COMMENT ON COLUMN items_properties_helmet.repair_cost IS \'Стоимость ремонта за 1 ед.\'');
        $this->addSql('COMMENT ON COLUMN items_properties_helmet.speed_penalty IS \'Снижение скорости в %\'');
        $this->addSql('COMMENT ON COLUMN items_properties_helmet.turn_penalty IS \'Снижение поворота в %\'');
        $this->addSql('COMMENT ON COLUMN items_properties_helmet.ergo_penalty IS \'Снижение эргономик в %\'');
        $this->addSql('COMMENT ON COLUMN items_properties_helmet.head_zones IS \'Защита зон головы\'');
        $this->addSql('COMMENT ON COLUMN items_properties_helmet.block_headset IS \'Блокировка наушников\'');
        $this->addSql('COMMENT ON COLUMN items_properties_helmet.blindness_protection IS \'Защита от ослепления\'');
        $this->addSql('COMMENT ON COLUMN items_properties_helmet.armor_type IS \'Тип защиты\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE items_properties_ammo (id UUID NOT NULL, api_caliber VARCHAR(64) DEFAULT \'\' NOT NULL, stack_max_size INT DEFAULT 0 NOT NULL, tracer BOOLEAN DEFAULT false NOT NULL, tracer_color VARCHAR(64) DEFAULT \'\' NOT NULL, ammo_type VARCHAR(64) DEFAULT \'\' NOT NULL, projectile_count INT DEFAULT 0 NOT NULL, damage INT DEFAULT 0 NOT NULL, armor_damage INT DEFAULT 0 NOT NULL, fragmentation_chance DOUBLE PRECISION DEFAULT \'0\' NOT NULL, ricochet_chance DOUBLE PRECISION DEFAULT \'0\' NOT NULL, penetration_chance DOUBLE PRECISION DEFAULT \'0\' NOT NULL, penetration_power INT DEFAULT 0 NOT NULL, accuracy_modifier DOUBLE PRECISION DEFAULT \'0\' NOT NULL, recoil_modifier DOUBLE PRECISION DEFAULT \'0\' NOT NULL, initial_speed DOUBLE PRECISION DEFAULT \'0\' NOT NULL, light_bleed_modifier DOUBLE PRECISION DEFAULT \'0\' NOT NULL, heavy_bleed_modifier DOUBLE PRECISION DEFAULT \'0\' NOT NULL, durability_burn_factor DOUBLE PRECISION DEFAULT \'0\' NOT NULL, heat_factor DOUBLE PRECISION DEFAULT \'0\' NOT NULL, stamina_burn_per_damage DOUBLE PRECISION DEFAULT \'0\' NOT NULL, ballistic_coefficient DOUBLE PRECISION DEFAULT \'0\' NOT NULL, bullet_diameter_millimeters DOUBLE PRECISION DEFAULT \'0\' NOT NULL, bullet_mass_grams DOUBLE PRECISION DEFAULT \'0\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON TABLE items_properties_ammo IS \'Таблица свойств для патронов\'');
        $this->addSql('COMMENT ON COLUMN items_properties_ammo.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_properties_ammo.api_caliber IS \'Калибр\'');
        $this->addSql('COMMENT ON COLUMN items_properties_ammo.stack_max_size IS \'Максимально кол-во в ячейке(стеке)\'');
        $this->addSql('COMMENT ON COLUMN items_properties_ammo.tracer IS \'Флаг трассируещего патрона\'');
        $this->addSql('COMMENT ON COLUMN items_properties_ammo.tracer_color IS \'Цвет трассирующего патрона\'');
        $this->addSql('COMMENT ON COLUMN items_properties_ammo.ammo_type IS \'Тип патрона (пуля, картечь)\'');
        $this->addSql('COMMENT ON COLUMN items_properties_ammo.projectile_count IS \'Кол-во пуль (1 пуля, 8 картечи и тд)\'');
        $this->addSql('COMMENT ON COLUMN items_properties_ammo.damage IS \'Наносимый урон\'');
        $this->addSql('COMMENT ON COLUMN items_properties_ammo.armor_damage IS \'Наносимый урон по броне\'');
        $this->addSql('COMMENT ON COLUMN items_properties_ammo.fragmentation_chance IS \'Шанс фрагментации в процентах\'');
        $this->addSql('COMMENT ON COLUMN items_properties_ammo.ricochet_chance IS \'Шанс рикошета в процентах\'');
        $this->addSql('COMMENT ON COLUMN items_properties_ammo.penetration_chance IS \'Шанс пробития в процентах\'');
        $this->addSql('COMMENT ON COLUMN items_properties_ammo.penetration_power IS \'Бронепробитие\'');
        $this->addSql('COMMENT ON COLUMN items_properties_ammo.accuracy_modifier IS \'Точность в процентах\'');
        $this->addSql('COMMENT ON COLUMN items_properties_ammo.recoil_modifier IS \'Отдача в процентах\'');
        $this->addSql('COMMENT ON COLUMN items_properties_ammo.initial_speed IS \'Скорость патрона\'');
        $this->addSql('COMMENT ON COLUMN items_properties_ammo.light_bleed_modifier IS \'Шанс вызова слабого кровотечения в процентах\'');
        $this->addSql('COMMENT ON COLUMN items_properties_ammo.heavy_bleed_modifier IS \'Шанс вызова сильного кровотечения в процентах\'');
        $this->addSql('COMMENT ON COLUMN items_properties_ammo.durability_burn_factor IS \'Износ в процентах\'');
        $this->addSql('COMMENT ON COLUMN items_properties_ammo.heat_factor IS \'Коэффициент нагрева в процентах\'');
        $this->addSql('COMMENT ON COLUMN items_properties_ammo.stamina_burn_per_damage IS \'Выносливость за выстрел\'');
        $this->addSql('COMMENT ON COLUMN items_properties_ammo.ballistic_coefficient IS \'Баллистический коэффициент\'');
        $this->addSql('COMMENT ON COLUMN items_properties_ammo.bullet_diameter_millimeters IS \'Диаметр пули в миллиметрах\'');
        $this->addSql('COMMENT ON COLUMN items_properties_ammo.bullet_mass_grams IS \'Масса пули в граммах\'');
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

        $this->addSql('CREATE TABLE items_properties_melee (id UUID NOT NULL, slash_damage INT DEFAULT 0 NOT NULL, stab_damage INT DEFAULT 0 NOT NULL, hit_radius DOUBLE PRECISION DEFAULT \'0\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON TABLE items_properties_melee IS \'Свойства предметов для ближнего боя\'');
        $this->addSql('COMMENT ON COLUMN items_properties_melee.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_properties_melee.slash_damage IS \'Рубящий урон\'');
        $this->addSql('COMMENT ON COLUMN items_properties_melee.stab_damage IS \'Урон ножом\'');
        $this->addSql('COMMENT ON COLUMN items_properties_melee.hit_radius IS \'Радиус удара\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE items_storage_grids (id UUID NOT NULL, width INT DEFAULT NULL, height INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON TABLE items_storage_grids IS \'Таблица свойств для брони\'');
        $this->addSql('COMMENT ON COLUMN items_storage_grids.id IS \'(DC2Type:uuid)\'');
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

        $this->addSql('CREATE TABLE places_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX places_translation_unique_translation ON places_translation (translatable_id, locale)');
        $this->addSql('CREATE INDEX places_locale_idx ON places_translation (locale)');
        $this->addSql('CREATE INDEX idx_12a597262c2ac5d3 ON places_translation (translatable_id)');
        $this->addSql('COMMENT ON COLUMN places_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN places_translation.translatable_id IS \'(DC2Type:uuid)\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE items_properties_magazine_ammo (item_properties_magazine_id UUID NOT NULL, item_id UUID NOT NULL, PRIMARY KEY(item_properties_magazine_id, item_id))');
        $this->addSql('CREATE INDEX idx_f62e3086126f525e ON items_properties_magazine_ammo (item_id)');
        $this->addSql('CREATE INDEX idx_f62e30863216c4ba ON items_properties_magazine_ammo (item_properties_magazine_id)');
        $this->addSql('COMMENT ON COLUMN items_properties_magazine_ammo.item_properties_magazine_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_properties_magazine_ammo.item_id IS \'(DC2Type:uuid)\'');
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

        $this->addSql('CREATE TABLE items_properties_painkiller (id UUID NOT NULL, uses INT DEFAULT 0 NOT NULL, use_time INT DEFAULT 0 NOT NULL, cures JSONB DEFAULT NULL, painkiller_duration INT DEFAULT 0 NOT NULL, energy_impact INT DEFAULT 0 NOT NULL, hydration_impact INT DEFAULT 0 NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON TABLE items_properties_painkiller IS \'Свойства для обезбаливающенр\'');
        $this->addSql('COMMENT ON COLUMN items_properties_painkiller.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_properties_painkiller.uses IS \'Используется кол-во раз\'');
        $this->addSql('COMMENT ON COLUMN items_properties_painkiller.use_time IS \'Время использования\'');
        $this->addSql('COMMENT ON COLUMN items_properties_painkiller.cures IS \'Зоны обезбаливания\'');
        $this->addSql('COMMENT ON COLUMN items_properties_painkiller.painkiller_duration IS \'Продолжительность обезбаливания\'');
        $this->addSql('COMMENT ON COLUMN items_properties_painkiller.energy_impact IS \'Энергетическое воздействие\'');
        $this->addSql('COMMENT ON COLUMN items_properties_painkiller.hydration_impact IS \'Увлажняющее воздействие\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE items_properties (id UUID NOT NULL, item_id UUID DEFAULT NULL, material_id UUID DEFAULT NULL, grids_id UUID DEFAULT NULL, caliber_id UUID DEFAULT NULL, type_property VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_19db0ff047f0dc79 ON items_properties (caliber_id)');
        $this->addSql('CREATE INDEX idx_19db0ff067382b86 ON items_properties (grids_id)');
        $this->addSql('CREATE INDEX idx_19db0ff0e308ac6f ON items_properties (material_id)');
        $this->addSql('CREATE UNIQUE INDEX uniq_19db0ff0126f525e ON items_properties (item_id)');
        $this->addSql('COMMENT ON COLUMN items_properties.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_properties.item_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_properties.material_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_properties.grids_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_properties.caliber_id IS \'(DC2Type:uuid)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE maps_locations_translation');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE crafts_reward_contained_items');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE quests_advice');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE places_levels');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE skills');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE crafts');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE stimulation_effect');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE places_levels_required_items');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE users');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE traders_cash_offers');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE places');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE contained_items');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE bosses_health');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE messenger_messages');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE skills_translation');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE updates');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE quests_objectives_translation');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE quests');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE crafts_required_contained_items');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items_properties_armor');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items_properties_medical_item');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE traders_required');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE places_levels_translation');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE maps_locations');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE bosses_translation');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE barters_reward_items');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE maps');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items_materials');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE quests_used_items');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items_properties_barrel');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE tags');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE weather');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE places_levels_required_levels');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE crafts_required_quest_items');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items_properties_surgical_kit');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items_properties_chest_rig');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items_properties_magazine');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE places_levels_required_traders');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE quests_items');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE maps_translation');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE quests_translation');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE traders_translation');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE traders_levels');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items_properties_med_kit');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE traders');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE places_levels_required');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items_properties_food_drink');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items_materials_translation');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE articles');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE stimulation_effect_translation');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items_properties_glasses');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items_properties_weapon_presets');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items_properties_night_vision');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE places_levels_required_skills');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE quests_received_items');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE articles_tags');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items_properties_grenade');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items_properties_backpack');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items_properties_weapon');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items_translation');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE updates_category');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items_properties_weapon_mod');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE quests_objectives');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items_properties_headphone');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE quests_advice_translation');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE articles_translation');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items_properties_container');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items_properties_weapon_ammo');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE barters');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE quests_items_translation');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items_calibers_translation');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items_properties_key');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items_properties_scope');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE updates_translation');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE bosses');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items_calibers');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items_properties_helmet');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items_properties_ammo');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE quests_keys');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items_properties_melee');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items_storage_grids');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE barters_required_items');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE places_translation');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items_properties_magazine_ammo');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE updates_category_translation');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items_properties_painkiller');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE items_properties');
    }
}
