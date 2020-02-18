<?php

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema as Schema;
use Doctrine\Migrations\AbstractMigration;
use Illuminate\Support\Facades\DB;

class Version20200207171737 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        DB::table('users')->update(['type' => 'admin']);
        $this->addSql('alter table users alter column type set not null');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {

    }
}
