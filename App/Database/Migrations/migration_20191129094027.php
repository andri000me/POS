<?php
namespace App\Database\Migrations;
use Core\Database\Table;

class migration_20191129094027 {

    public function up(){
        
        $table = new Table();
        $table->table('m_items');
        $table->addColumn("Id", "int", "11", false, null, true, true);
        $table->addColumn("Code", "Varchar", "100");
        $table->addColumn("Name", "Varchar", "100");
        $table->addColumn("M_Category_Id", "int");
        $table->addColumn("Cost", "decimal","18,2", true);
        $table->addColumn("Price", "decimal","18,2", true);
        $table->addColumn("PhotoUrl", "Varchar", "1000");
        $table->addColumn("CreatedBy", "Varchar", "50", true);
        $table->addColumn("ModifiedBy", "Varchar", "50", true);
        $table->addColumn("Created", "datetime", "", true);
        $table->addColumn("Modified", "datetime", "", true);
        $table->addForeignKey("M_Category_Id", "m_categories", "Id");
        $table->create();
    }
}