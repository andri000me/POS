<?php
namespace App\Database\Migrations;
use Core\Database\Table;

class migration_20191203043932 {

    public function up(){
        
        $table = new Table();
        $table->table('m_uomconversions');
        $table->addColumn("Id", "int", "11", false, null, true, true);
        $table->addColumn("M_Item_Id", "int", "11");
        $table->addColumn("M_Uom_Id_From", "int", "11");
        $table->addColumn("M_Uom_Id_To", "int", "11");
        $table->addColumn("Qty", "Decimal", "18,2");
        $table->addColumn("CreatedBy", "Varchar", "50", true);
        $table->addColumn("ModifiedBy", "Varchar", "50", true);
        $table->addColumn("Created", "datetime", "", true);
        $table->addColumn("Modified", "datetime", "", true);
        $table->addForeignKey("M_Uom_Id_From", "m_uoms", "Id");
        $table->addForeignKey("M_Uom_Id_To", "m_uoms", "Id");
        $table->create();
    }
}