<?php
namespace App\Database\Migrations;
use Core\Database\Table;

class migration_20191203090530 {

    public function up(){
        
        $table = new Table();
        $table->table('m_itemstocks');
        $table->addColumn("Id", "int", "11", false, null, true, true);
        $table->addColumn("M_Item_Id", "int", "11");
        $table->addColumn("M_Uom_Id", "int", "11");
        $table->addColumn("M_Warehouse_Id", "int", "11", true);
        $table->addColumn("Qty", "Decimal", "18,2");
        $table->addColumn("CreatedBy", "Varchar", "50", true);
        $table->addColumn("ModifiedBy", "Varchar", "50", true);
        $table->addColumn("Created", "datetime", "", true);
        $table->addColumn("Modified", "datetime", "", true);
        $table->addForeignKey("M_Uom_Id", "m_uoms", "Id");
        $table->addForeignKey("M_Warehouse_Id", "m_warehouses", "Id");
        $table->create();
        
    }
}