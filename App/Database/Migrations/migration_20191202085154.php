<?php
namespace App\Database\Migrations;
use Core\Database\Table;

class migration_20191202085154 {

    public function up(){
        
        $table = new Table();
        $table->table('m_warehouses');
        $table->addColumn("Id", "int", "11", false, null, true, true);
        $table->addColumn("Name", "Varchar", "100");
        $table->addColumn("Description", "Varchar", "100");
        $table->addColumn("CreatedBy", "Varchar", "50", true);
        $table->addColumn("ModifiedBy", "Varchar", "50", true);
        $table->addColumn("Created", "datetime", "", true);
        $table->addColumn("Modified", "datetime", "", true);
        $table->create();

    }
}