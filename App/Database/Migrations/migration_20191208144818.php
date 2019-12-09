<?php
namespace App\Database\Migrations;
use Core\Database\Table;

class migration_20191208144818 {

    public function up(){
        
        $table = new Table();
        $table->table('t_itemtransfers');
        $table->addColumn("Id", "int", "11", false, null, true, true);
        $table->addColumn("TransNo", "varchar", "50");
        $table->addColumn("TransDate", "datetime", "");
        $table->addColumn("M_Shop_Id_From", "int", "11");
        $table->addColumn("M_Shop_Id_To", "int", "11");
        $table->addColumn("Status", "int", "11", true);
        $table->addColumn("Sender", "varchar", "50", true);
        $table->addColumn("CreatedBy", "Varchar", "50", true);
        $table->addColumn("ModifiedBy", "Varchar", "50", true);
        $table->addColumn("Created", "datetime", "", true);
        $table->addColumn("Modified", "datetime", "", true);
        $table->addForeignKey("M_Shop_Id_From", "m_shops", "Id");
        $table->addForeignKey("M_Shop_Id_To", "m_shops", "Id");
        $table->create();

        $table2 = new Table();
        $table2->table('t_itemtransferdetails');
        $table2->addColumn("Id", "int", "11", false, null, true, true);
        $table2->addColumn("T_Itemtransfer_Id", "int", "11");
        $table2->addColumn("M_Item_Id", "int", "11");
        $table2->addColumn("M_Uom_Id", "int", "11");
        $table2->addColumn("M_Warehouse_Id", "int", "11", true);
        $table2->addColumn("Qty", "decimal", "18,2");
        $table2->addColumn("CreatedBy", "Varchar", "50", true);
        $table2->addColumn("ModifiedBy", "Varchar", "50", true);
        $table2->addColumn("Created", "datetime", "", true);
        $table2->addColumn("Modified", "datetime", "", true);
        $table2->addForeignKey("T_Itemtransfer_Id", "t_itemtransfers", "Id", "CASCADE");
        $table2->addForeignKey("M_Uom_Id", "m_uoms", "Id");
        $table2->addForeignKey("M_Warehouse_Id", "m_warehouses", "Id");
        $table2->addForeignKey("M_Item_Id", "m_items", "Id");
        $table2->create();
    }
}