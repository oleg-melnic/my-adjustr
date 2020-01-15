<?php

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema as Schema;
use Doctrine\Migrations\AbstractMigration;

class Version20200115192349 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE blog_items ADD title VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE blog_items ADD lockalias BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE blog_items DROP lock_alias');
        $this->addSql('ALTER TABLE blog_items DROP name');
        $this->addSql('ALTER TABLE blog_items ALTER alias SET NOT NULL');
        $this->addSql('ALTER TABLE blog_items ALTER state SET NOT NULL');
        $this->addSql('alter table blog_items alter column created_date set not null;');
        $this->addSql('alter table blog_items alter column created_date drop default;');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE blog_items ADD lock_alias INT DEFAULT NULL');
        $this->addSql('ALTER TABLE blog_items ADD name VARCHAR(300) DEFAULT NULL');
        $this->addSql('ALTER TABLE blog_items DROP title');
        $this->addSql('ALTER TABLE blog_items DROP lockalias');
        $this->addSql('ALTER TABLE blog_items ALTER alias DROP NOT NULL');
        $this->addSql('ALTER TABLE blog_items ALTER state DROP NOT NULL');
    }
}
