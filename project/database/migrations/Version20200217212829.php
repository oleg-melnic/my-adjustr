<?php

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema as Schema;
use Doctrine\Migrations\AbstractMigration;

class Version20200217212829 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE claims ADD prof_id BIGINT DEFAULT NULL');
        $this->addSql('ALTER TABLE claims ADD CONSTRAINT FK_BEA313BEABC1F7FE FOREIGN KEY (prof_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_BEA313BEABC1F7FE ON claims (prof_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE claims DROP CONSTRAINT FK_BEA313BEABC1F7FE');
        $this->addSql('DROP INDEX IDX_BEA313BEABC1F7FE');
        $this->addSql('ALTER TABLE claims DROP prof_id');
    }
}
