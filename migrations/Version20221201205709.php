<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221201205709 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Init tables';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Tags (id UUID NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN Tags.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE Users (id UUID NOT NULL, login VARCHAR(50) NOT NULL, email VARCHAR(180) NOT NULL, title VARCHAR(180) DEFAULT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D5428AEDAA08CB10 ON Users (login)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D5428AEDE7927C74 ON Users (email)');
        $this->addSql('COMMENT ON COLUMN Users.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE articles (id UUID NOT NULL, published BOOLEAN NOT NULL, image_poster VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BFDD3168989D9B62 ON articles (slug)');
        $this->addSql('CREATE INDEX articles_slug_idx ON articles (slug)');
        $this->addSql('COMMENT ON COLUMN articles.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE articles_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, title VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, body TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_105C720E2C2AC5D3 ON articles_translation (translatable_id)');
        $this->addSql('CREATE INDEX articles_locale_idx ON articles_translation (locale)');
        $this->addSql('CREATE UNIQUE INDEX articles_translation_unique_translation ON articles_translation (translatable_id, locale)');
        $this->addSql('COMMENT ON COLUMN articles_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN articles_translation.translatable_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE articles_tags (article_translation_id UUID NOT NULL, tag_id UUID NOT NULL, PRIMARY KEY(article_translation_id, tag_id))');
        $this->addSql('CREATE INDEX IDX_354053613A91A7AD ON articles_tags (article_translation_id)');
        $this->addSql('CREATE INDEX IDX_35405361BAD26311 ON articles_tags (tag_id)');
        $this->addSql('COMMENT ON COLUMN articles_tags.article_translation_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN articles_tags.tag_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE enemies (id UUID NOT NULL, published BOOLEAN NOT NULL, image_name VARCHAR(255) DEFAULT NULL, types JSON DEFAULT NULL, slug VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_78024A3E989D9B62 ON enemies (slug)');
        $this->addSql('COMMENT ON COLUMN enemies.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE enemies_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, name VARCHAR(255) NOT NULL, behavior TEXT DEFAULT NULL, followers TEXT DEFAULT NULL, strategy TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6CA5E2102C2AC5D3 ON enemies_translation (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX enemies_translation_unique_translation ON enemies_translation (translatable_id, locale)');
        $this->addSql('COMMENT ON COLUMN enemies_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN enemies_translation.translatable_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE items (id UUID NOT NULL, api_id VARCHAR(255) NOT NULL, published BOOLEAN NOT NULL, image_name VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, types JSONB DEFAULT NULL, base_price INT DEFAULT NULL, width INT DEFAULT NULL, height INT DEFAULT NULL, background_color VARCHAR(255) DEFAULT NULL, accuracy_modifier DOUBLE PRECISION DEFAULT NULL, recoil_modifier DOUBLE PRECISION DEFAULT NULL, ergonomics_modifier DOUBLE PRECISION DEFAULT NULL, has_grid BOOLEAN DEFAULT false NOT NULL, blocks_headphones BOOLEAN DEFAULT false NOT NULL, weight DOUBLE PRECISION DEFAULT NULL, velocity DOUBLE PRECISION DEFAULT NULL, loudness INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX items_slug_idx ON items (slug)');
        $this->addSql('CREATE INDEX items_api_key_idx ON items (api_id)');
        $this->addSql('COMMENT ON COLUMN items.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE items_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, title VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C4AF85E2C2AC5D3 ON items_translation (translatable_id)');
        $this->addSql('CREATE INDEX item_locale_idx ON items_translation (locale)');
        $this->addSql('CREATE UNIQUE INDEX items_translation_unique_translation ON items_translation (translatable_id, locale)');
        $this->addSql('COMMENT ON COLUMN items_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_translation.translatable_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE maps (id UUID NOT NULL, api_id VARCHAR(255) NOT NULL, published BOOLEAN NOT NULL, image_name VARCHAR(255) DEFAULT NULL, min_players_number INT DEFAULT 0 NOT NULL, max_players_number INT DEFAULT 0 NOT NULL, raid_duration TIME(0) WITHOUT TIME ZONE DEFAULT NULL, slug VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_472E08A5989D9B62 ON maps (slug)');
        $this->addSql('CREATE INDEX maps_slug_idx ON maps (slug)');
        $this->addSql('COMMENT ON COLUMN maps.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE maps_locations (id UUID NOT NULL, map_id UUID DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C383B3B953C55F64 ON maps_locations (map_id)');
        $this->addSql('COMMENT ON COLUMN maps_locations.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN maps_locations.map_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE maps_locations_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_498201E92C2AC5D3 ON maps_locations_translation (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX maps_locations_translation_unique_translation ON maps_locations_translation (translatable_id, locale)');
        $this->addSql('COMMENT ON COLUMN maps_locations_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN maps_locations_translation.translatable_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE maps_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, title VARCHAR(255) NOT NULL, description TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5B2588712C2AC5D3 ON maps_translation (translatable_id)');
        $this->addSql('CREATE INDEX maps_locale_idx ON maps_translation (locale)');
        $this->addSql('CREATE UNIQUE INDEX maps_translation_unique_translation ON maps_translation (translatable_id, locale)');
        $this->addSql('COMMENT ON COLUMN maps_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN maps_translation.translatable_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE quests (id UUID NOT NULL, trader_id UUID DEFAULT NULL, map_id UUID DEFAULT NULL, api_id VARCHAR(255) NOT NULL, position INT DEFAULT 0 NOT NULL, published BOOLEAN NOT NULL, image_name VARCHAR(255) DEFAULT NULL, experience INT DEFAULT NULL, min_player_level INT NOT NULL, slug VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_989E5D34989D9B62 ON quests (slug)');
        $this->addSql('CREATE INDEX IDX_989E5D341273968F ON quests (trader_id)');
        $this->addSql('CREATE INDEX IDX_989E5D3453C55F64 ON quests (map_id)');
        $this->addSql('CREATE INDEX quests_slug_idx ON quests (slug)');
        $this->addSql('CREATE INDEX quests_api_key_idx ON quests (api_id)');
        $this->addSql('COMMENT ON COLUMN quests.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN quests.trader_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN quests.map_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE quests_used_items (quest_id UUID NOT NULL, item_id UUID NOT NULL, PRIMARY KEY(quest_id, item_id))');
        $this->addSql('CREATE INDEX IDX_4EF24817209E9EF4 ON quests_used_items (quest_id)');
        $this->addSql('CREATE INDEX IDX_4EF24817126F525E ON quests_used_items (item_id)');
        $this->addSql('COMMENT ON COLUMN quests_used_items.quest_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN quests_used_items.item_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE quests_received_items (quest_id UUID NOT NULL, item_id UUID NOT NULL, PRIMARY KEY(quest_id, item_id))');
        $this->addSql('CREATE INDEX IDX_AA7F4D3A209E9EF4 ON quests_received_items (quest_id)');
        $this->addSql('CREATE INDEX IDX_AA7F4D3A126F525E ON quests_received_items (item_id)');
        $this->addSql('COMMENT ON COLUMN quests_received_items.quest_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN quests_received_items.item_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE quests_items (id UUID NOT NULL, api_id VARCHAR(255) DEFAULT NULL, published BOOLEAN NOT NULL, width SMALLINT NOT NULL, height SMALLINT NOT NULL, image_name VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX quests_items_slug_idx ON quests_items (slug)');
        $this->addSql('CREATE INDEX quests_items_api_key_idx ON quests_items (api_id)');
        $this->addSql('COMMENT ON COLUMN quests_items.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE quests_items_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, title VARCHAR(255) NOT NULL, short_title VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BF3FA4B92C2AC5D3 ON quests_items_translation (translatable_id)');
        $this->addSql('CREATE INDEX quests_items_locale_idx ON quests_items_translation (locale)');
        $this->addSql('CREATE UNIQUE INDEX quests_items_translation_unique_translation ON quests_items_translation (translatable_id, locale)');
        $this->addSql('COMMENT ON COLUMN quests_items_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN quests_items_translation.translatable_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE quests_objectives (id UUID NOT NULL, quest_id UUID DEFAULT NULL, api_id VARCHAR(255) NOT NULL, type VARCHAR(255) DEFAULT NULL, optional BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_25909A9A209E9EF4 ON quests_objectives (quest_id)');
        $this->addSql('CREATE INDEX quest_objective_type_idx ON quests_objectives (type)');
        $this->addSql('CREATE INDEX quest_objective_api_idx ON quests_objectives (api_id)');
        $this->addSql('COMMENT ON COLUMN quests_objectives.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN quests_objectives.quest_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE quests_objectives_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, description VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5E497B392C2AC5D3 ON quests_objectives_translation (translatable_id)');
        $this->addSql('CREATE INDEX quests_objectives_locale_idx ON quests_objectives_translation (locale)');
        $this->addSql('CREATE UNIQUE INDEX quests_objectives_translation_unique_translation ON quests_objectives_translation (translatable_id, locale)');
        $this->addSql('COMMENT ON COLUMN quests_objectives_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN quests_objectives_translation.translatable_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE quests_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, title VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, how_to_complete TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E0FE32B52C2AC5D3 ON quests_translation (translatable_id)');
        $this->addSql('CREATE INDEX quests_locale_idx ON quests_translation (locale)');
        $this->addSql('CREATE UNIQUE INDEX quests_translation_unique_translation ON quests_translation (translatable_id, locale)');
        $this->addSql('COMMENT ON COLUMN quests_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN quests_translation.translatable_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE traders (id UUID NOT NULL, api_id VARCHAR(255) NOT NULL, position INT DEFAULT 0 NOT NULL, published BOOLEAN NOT NULL, image_name VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_49AE8B1C989D9B62 ON traders (slug)');
        $this->addSql('CREATE INDEX traders_api_key_idx ON traders (api_id)');
        $this->addSql('COMMENT ON COLUMN traders.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE traders_levels (id UUID NOT NULL, trader_id UUID DEFAULT NULL, level INT NOT NULL, required_player_level INT NOT NULL, required_reputation DOUBLE PRECISION NOT NULL, required_sales INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9B1BA77B1273968F ON traders_levels (trader_id)');
        $this->addSql('COMMENT ON COLUMN traders_levels.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN traders_levels.trader_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE traders_translation (id UUID NOT NULL, translatable_id UUID DEFAULT NULL, full_name VARCHAR(255) DEFAULT NULL, character_type VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_72A66A092C2AC5D3 ON traders_translation (translatable_id)');
        $this->addSql('CREATE INDEX traders_translation_idx ON traders_translation (locale)');
        $this->addSql('CREATE UNIQUE INDEX traders_translation_unique_translation ON traders_translation (translatable_id, locale)');
        $this->addSql('COMMENT ON COLUMN traders_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN traders_translation.translatable_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE articles_translation ADD CONSTRAINT FK_105C720E2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES articles (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE articles_tags ADD CONSTRAINT FK_354053613A91A7AD FOREIGN KEY (article_translation_id) REFERENCES articles_translation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE articles_tags ADD CONSTRAINT FK_35405361BAD26311 FOREIGN KEY (tag_id) REFERENCES Tags (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE enemies_translation ADD CONSTRAINT FK_6CA5E2102C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES enemies (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE items_translation ADD CONSTRAINT FK_C4AF85E2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES items (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE maps_locations ADD CONSTRAINT FK_C383B3B953C55F64 FOREIGN KEY (map_id) REFERENCES maps (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE maps_locations_translation ADD CONSTRAINT FK_498201E92C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES maps_locations (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE maps_translation ADD CONSTRAINT FK_5B2588712C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES maps (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quests ADD CONSTRAINT FK_989E5D341273968F FOREIGN KEY (trader_id) REFERENCES traders (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quests ADD CONSTRAINT FK_989E5D3453C55F64 FOREIGN KEY (map_id) REFERENCES maps (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quests_used_items ADD CONSTRAINT FK_4EF24817209E9EF4 FOREIGN KEY (quest_id) REFERENCES quests (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quests_used_items ADD CONSTRAINT FK_4EF24817126F525E FOREIGN KEY (item_id) REFERENCES items (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quests_received_items ADD CONSTRAINT FK_AA7F4D3A209E9EF4 FOREIGN KEY (quest_id) REFERENCES quests (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quests_received_items ADD CONSTRAINT FK_AA7F4D3A126F525E FOREIGN KEY (item_id) REFERENCES items (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quests_items_translation ADD CONSTRAINT FK_BF3FA4B92C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES quests_items (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quests_objectives ADD CONSTRAINT FK_25909A9A209E9EF4 FOREIGN KEY (quest_id) REFERENCES quests (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quests_objectives_translation ADD CONSTRAINT FK_5E497B392C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES quests_objectives (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quests_translation ADD CONSTRAINT FK_E0FE32B52C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES quests (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE traders_levels ADD CONSTRAINT FK_9B1BA77B1273968F FOREIGN KEY (trader_id) REFERENCES traders (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE traders_translation ADD CONSTRAINT FK_72A66A092C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES traders (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE articles_translation DROP CONSTRAINT FK_105C720E2C2AC5D3');
        $this->addSql('ALTER TABLE articles_tags DROP CONSTRAINT FK_354053613A91A7AD');
        $this->addSql('ALTER TABLE articles_tags DROP CONSTRAINT FK_35405361BAD26311');
        $this->addSql('ALTER TABLE enemies_translation DROP CONSTRAINT FK_6CA5E2102C2AC5D3');
        $this->addSql('ALTER TABLE items_translation DROP CONSTRAINT FK_C4AF85E2C2AC5D3');
        $this->addSql('ALTER TABLE maps_locations DROP CONSTRAINT FK_C383B3B953C55F64');
        $this->addSql('ALTER TABLE maps_locations_translation DROP CONSTRAINT FK_498201E92C2AC5D3');
        $this->addSql('ALTER TABLE maps_translation DROP CONSTRAINT FK_5B2588712C2AC5D3');
        $this->addSql('ALTER TABLE quests DROP CONSTRAINT FK_989E5D341273968F');
        $this->addSql('ALTER TABLE quests DROP CONSTRAINT FK_989E5D3453C55F64');
        $this->addSql('ALTER TABLE quests_used_items DROP CONSTRAINT FK_4EF24817209E9EF4');
        $this->addSql('ALTER TABLE quests_used_items DROP CONSTRAINT FK_4EF24817126F525E');
        $this->addSql('ALTER TABLE quests_received_items DROP CONSTRAINT FK_AA7F4D3A209E9EF4');
        $this->addSql('ALTER TABLE quests_received_items DROP CONSTRAINT FK_AA7F4D3A126F525E');
        $this->addSql('ALTER TABLE quests_items_translation DROP CONSTRAINT FK_BF3FA4B92C2AC5D3');
        $this->addSql('ALTER TABLE quests_objectives DROP CONSTRAINT FK_25909A9A209E9EF4');
        $this->addSql('ALTER TABLE quests_objectives_translation DROP CONSTRAINT FK_5E497B392C2AC5D3');
        $this->addSql('ALTER TABLE quests_translation DROP CONSTRAINT FK_E0FE32B52C2AC5D3');
        $this->addSql('ALTER TABLE traders_levels DROP CONSTRAINT FK_9B1BA77B1273968F');
        $this->addSql('ALTER TABLE traders_translation DROP CONSTRAINT FK_72A66A092C2AC5D3');
        $this->addSql('DROP TABLE Tags');
        $this->addSql('DROP TABLE Users');
        $this->addSql('DROP TABLE articles');
        $this->addSql('DROP TABLE articles_translation');
        $this->addSql('DROP TABLE articles_tags');
        $this->addSql('DROP TABLE enemies');
        $this->addSql('DROP TABLE enemies_translation');
        $this->addSql('DROP TABLE items');
        $this->addSql('DROP TABLE items_translation');
        $this->addSql('DROP TABLE maps');
        $this->addSql('DROP TABLE maps_locations');
        $this->addSql('DROP TABLE maps_locations_translation');
        $this->addSql('DROP TABLE maps_translation');
        $this->addSql('DROP TABLE quests');
        $this->addSql('DROP TABLE quests_used_items');
        $this->addSql('DROP TABLE quests_received_items');
        $this->addSql('DROP TABLE quests_items');
        $this->addSql('DROP TABLE quests_items_translation');
        $this->addSql('DROP TABLE quests_objectives');
        $this->addSql('DROP TABLE quests_objectives_translation');
        $this->addSql('DROP TABLE quests_translation');
        $this->addSql('DROP TABLE traders');
        $this->addSql('DROP TABLE traders_levels');
        $this->addSql('DROP TABLE traders_translation');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
