<?php
namespace App\Database\Migrations;
use Core\Database\Table;

class migration_20191129093829 {

    public function up(){
        
        $table = new Table();
        $table->table('m_categories');
        $table->addColumn("Id", "int", "11", false, null, true, true);
        $table->addColumn("Code", "Varchar", "100", null);
        $table->addColumn("Name", "Varchar", "100");
        $table->addColumn("Description", "Varchar", "100");
        $table->addColumn("PhotoUrl", "Varchar", "1000", null);
        $table->addColumn("CreatedBy", "Varchar", "50", true);
        $table->addColumn("ModifiedBy", "Varchar", "50", true);
        $table->addColumn("Created", "datetime", "", true);
        $table->addColumn("Modified", "datetime", "", true);
        $table->create();
    }
}