<?php

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema as Schema;
use Doctrine\Migrations\AbstractMigration;

class Version20200115182550 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE blog_categories ADD lockalias BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE blog_categories ADD title VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE blog_categories ADD seo_title VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE blog_categories ADD seo_description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE blog_categories ADD seo_keywords VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE blog_categories ADD text TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE blog_categories ADD position INT DEFAULT 0');
        $this->addSql('ALTER TABLE blog_categories DROP lock_alias');
        $this->addSql('ALTER TABLE blog_categories DROP ord');
        $this->addSql('ALTER TABLE blog_categories DROP state');
        $this->addSql('ALTER TABLE blog_categories DROP name');
        $this->addSql('ALTER TABLE blog_categories ALTER alias SET NOT NULL');
        $this->addSql('ALTER TABLE blog_categories ALTER alias TYPE VARCHAR(255)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE blog_categories ADD lock_alias INT DEFAULT NULL');
        $this->addSql('ALTER TABLE blog_categories ADD ord INT DEFAULT NULL');
        $this->addSql('ALTER TABLE blog_categories ADD state INT DEFAULT NULL');
        $this->addSql('ALTER TABLE blog_categories ADD name VARCHAR(300) DEFAULT NULL');
        $this->addSql('ALTER TABLE blog_categories DROP lockalias');
        $this->addSql('ALTER TABLE blog_categories DROP title');
        $this->addSql('ALTER TABLE blog_categories DROP seo_title');
        $this->addSql('ALTER TABLE blog_categories DROP seo_description');
        $this->addSql('ALTER TABLE blog_categories DROP seo_keywords');
        $this->addSql('ALTER TABLE blog_categories DROP text');
        $this->addSql('ALTER TABLE blog_categories DROP position');
        $this->addSql('ALTER TABLE blog_categories ALTER alias DROP NOT NULL');
        $this->addSql('ALTER TABLE blog_categories ALTER alias TYPE VARCHAR(300)');
    }
}
