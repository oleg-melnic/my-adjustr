<?php

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema as Schema;
use Doctrine\Migrations\AbstractMigration;

class Version20200103213917 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE faq_categories ADD lockalias BOOLEAN NOT NULL');
        $this->addSql('alter table faq_categories alter column position set default 0');
        $this->addSql('alter table faq_categories alter column position drop not null');
        $this->addSql('ALTER TABLE faq_questions ADD lockalias BOOLEAN NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE faq_categories DROP lockalias');
        $this->addSql('alter table faq_categories alter column position drop default');
        $this->addSql('alter table faq_categories alter column position set not null');
        $this->addSql('ALTER TABLE faq_questions DROP lockalias');
    }
}
