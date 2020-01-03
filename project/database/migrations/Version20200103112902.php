<?php

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema as Schema;
use Doctrine\Migrations\AbstractMigration;

class Version20200103112902 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE blog_categories (id SERIAL NOT NULL, alias VARCHAR(300) DEFAULT NULL, lock_alias INT DEFAULT NULL, ord INT DEFAULT NULL, state INT DEFAULT NULL, name VARCHAR(300) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE blog_items (id SERIAL NOT NULL, category_id INT NOT NULL, alias VARCHAR(300) DEFAULT NULL, lock_alias INT DEFAULT NULL, public_from DATE DEFAULT NULL, public_to DATE DEFAULT NULL, created_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_by INT DEFAULT NULL, state INT DEFAULT NULL, name VARCHAR(300) DEFAULT NULL, anons VARCHAR(1000) DEFAULT NULL, text VARCHAR(3000) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_11F1AA8512469DE2 ON blog_items (category_id)');
        $this->addSql('CREATE TABLE faq_categories (id SERIAL NOT NULL, alias VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, seo_title VARCHAR(255) DEFAULT NULL, seo_description VARCHAR(255) DEFAULT NULL, seo_keywords VARCHAR(255) DEFAULT NULL, text TEXT DEFAULT NULL, position INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE faq_questions (id SERIAL NOT NULL, category_id INT NOT NULL, title VARCHAR(255) NOT NULL, answer TEXT NOT NULL, created_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, position INT NOT NULL, favorite BOOLEAN NOT NULL, alias VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9F373EB12469DE2 ON faq_questions (category_id)');
        $this->addSql('ALTER TABLE blog_items ADD CONSTRAINT FK_11F1AA8512469DE2 FOREIGN KEY (category_id) REFERENCES blog_categories (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE faq_questions ADD CONSTRAINT FK_9F373EB12469DE2 FOREIGN KEY (category_id) REFERENCES faq_categories (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE blog_items DROP CONSTRAINT FK_11F1AA8512469DE2');
        $this->addSql('ALTER TABLE faq_questions DROP CONSTRAINT FK_9F373EB12469DE2');
        $this->addSql('DROP TABLE blog_categories');
        $this->addSql('DROP TABLE blog_items');
        $this->addSql('DROP TABLE faq_categories');
        $this->addSql('DROP TABLE faq_questions');
    }
}
