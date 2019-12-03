<?php
namespace App\Database\Migrations;
use Core\Database\Table;

class migration_20191203090325 {

    public function up(){
        
        $table = new Table();
        $table->table('t_itemstocks');
        $table->addColumn("Id", "int", "11", false, null, true, true);
        $table->addColumn("TransNo", "int", "11");
        $table->addColumn("TransDate", "datetime", "");
        $table->addColumn("Recipient", "varchar", "50");
        $table->addColumn("CreatedBy", "Varchar", "50", true);
        $table->addColumn("ModifiedBy", "Varchar", "50", true);
        $table->addColumn("Created", "datetime", "", true);
        $table->addColumn("Modified", "datetime", "", true);
        $table->create();

        $table2 = new Table();
        $table2->table('t_itemstockdetails');
        $table2->addColumn("Id", "int", "11", false, null, true, true);
        $table2->addColumn("T_Itemstock_Id", "int", "11");
        $table2->addColumn("M_Uom_Id", "int", "11");
        $table2->addColumn("M_Warehouse_Id", "int", "11");
        $table2->addColumn("Qty", "decimal", "18,2");
        $table2->addColumn("CreatedBy", "Varchar", "50", true);
        $table2->addColumn("ModifiedBy", "Varchar", "50", true);
        $table2->addColumn("Created", "datetime", "", true);
        $table2->addColumn("Modified", "datetime", "", true);
        $table2->addForeignKey("T_Itemstock_Id", "t_itemstocks", "Id");
        $table2->addForeignKey("M_Uom_Id", "m_uoms", "Id");
        $table2->addForeignKey("M_Warehouse_Id", "m_warehouses", "Id");
        $table2->create();
    }
}