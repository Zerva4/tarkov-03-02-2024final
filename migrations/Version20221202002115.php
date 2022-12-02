<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221202002115 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Added fields created_at, updated_at for ItemMaterial entity';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE items_materials ALTER created_at TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE items_materials ALTER created_at SET NOT NULL');
        $this->addSql('ALTER TABLE items_materials ALTER updated_at TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE items_materials ALTER updated_at SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE items_materials ALTER created_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE items_materials ALTER created_at DROP NOT NULL');
        $this->addSql('ALTER TABLE items_materials ALTER updated_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE items_materials ALTER updated_at DROP NOT NULL');
    }
}
