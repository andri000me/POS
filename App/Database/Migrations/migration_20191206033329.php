<?php
namespace App\Database\Migrations;
use Core\Database\Table;

class migration_20191206033329 {

    public function up(){
        
        $table = new Table();
        $table->table('m_shops');
        $table->addColumn("Id", "int", "11", false, null, true, true);
        $table->addColumn("Code", "varchar", "50");
        $table->addColumn("Name", "varchar", "50");
        $table->addColumn("Address1", "varchar", "1000", true);
        $table->addColumn("Address2", "varchar", "1000", true);
        $table->addColumn("Email", "varchar", "50", true);
        $table->addColumn("Phone", "varchar", "50", true);
        $table->addColumn("City", "varchar", "50", true);
        $table->addColumn("Province", "varchar", "50", true);
        $table->addColumn("PostCode", "varchar", "50", true);
        $table->addColumn("Country", "varchar", "50", true);
        $table->addColumn("CreatedBy", "Varchar", "50", true);
        $table->addColumn("ModifiedBy", "Varchar", "50", true);
        $table->addColumn("Created", "datetime", "", true);
        $table->addColumn("Modified", "datetime", "", true);
        $table->create();
    }
}