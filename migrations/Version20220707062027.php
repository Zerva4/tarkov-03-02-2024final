<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220707062027 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create root user';
    }

    public function up(Schema $schema): void
    {
        $sql = $sql = <<<SQL
            INSERT INTO user (email, roles, password) VALUES ('root@root.tld', '[\"ROLE_ADMIN\"]', '\$2y\$13\$v03eQv4s2Ls2CwzH3hGOquxN.FDmpifIok8lhYyQTqAm2Xyz6ev3K')
        SQL;
        $this->addSql($sql);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
