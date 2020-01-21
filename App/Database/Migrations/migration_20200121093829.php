<?php
namespace App\Database\Migrations;
use Core\Database\Table;

class migration_20200121093829 {

    public function up(){
        
        $table = new Table();
        $table->table('m_menuoptions');
        $table->addColumn("Id", "int", "11", false, null, true, true);
        $table->addColumn("Name", "varchar", "50", true);
        $table->addColumn("IsRequired", "smallint", "1", true);
        $table->addColumn("Description", "Varchar", "300", true);
        $table->addColumn("CreatedBy", "Varchar", "50", true);
        $table->addColumn("ModifiedBy", "Varchar", "50", true);
        $table->addColumn("Created", "datetime", "", true);
        $table->addColumn("Modified", "datetime", "", true);
        $table->create();
    }
}