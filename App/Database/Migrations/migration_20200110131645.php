<?php
namespace App\Database\Migrations;
use Core\Database\Table;

class migration_20200110131645 {

    public function up(){
        
        $table = new Table();
        $table->table('m_menus');
        $table->addColumn("Id", "int", "11", false, null, true, true);
        $table->addColumn("Name", "varchar", "50", true);
        $table->addColumn("Price", "decimal", "18,2", true);
        $table->addColumn("M_Menucategory_Id", "int", "11", true);
        $table->addColumn("M_Mealtime_Id", "int", "11", true);
        $table->addColumn("M_Shop_Id", "int", "11", true);
        $table->addColumn("OrderRestriction", "int", "11", true);
        $table->addColumn("Description", "Varchar", "300", true);
        $table->addColumn("PhotoUrl", "Varchar", "1000", true);
        $table->addColumn("Status", "smallint", "1", true);
        $table->addColumn("CreatedBy", "Varchar", "50", true);
        $table->addColumn("ModifiedBy", "Varchar", "50", true);
        $table->addColumn("Created", "datetime", "", true);
        $table->addColumn("Modified", "datetime", "", true);
        $table->addForeignKey("M_Menucategory_Id", "m_categories", "Id");
        $table->addForeignKey("M_Mealtime_Id", "m_mealtimes", "Id");
        $table->addForeignKey("M_Shop_Id", "m_shops", "Id");
        $table->create();
    }
}