<?php
namespace App\Database\Migrations;
use Core\Database\Table;

class migration_20191226093022 {

    public function up(){
        
        $table = new Table();
        $table->table('t_itemreceives');
        $table->addColumn("Id", "int", "11", false, null, true, true);
        $table->addColumn("TransNo", "varchar", "50");
        $table->addColumn("TransDate", "datetime", "");
        $table->addColumn("Status", "int", "11", true);
        $table->addColumn("CreatedBy", "Varchar", "50", true);
        $table->addColumn("ModifiedBy", "Varchar", "50", true);
        $table->addColumn("Created", "datetime", "", true);
        $table->addColumn("Modified", "datetime", "", true);
        $table->create();

        $table2 = new Table();
        $table2->table('t_itemreceivedetails');
        $table2->addColumn("Id", "int", "11", false, null, true, true);
        $table2->addColumn("T_Itemtransfer_Id", "int", "11");
        $table2->addColumn("T_Itemreceive_Id", "int", "11");
        $table2->addColumn("CreatedBy", "Varchar", "50", true);
        $table2->addColumn("ModifiedBy", "Varchar", "50", true);
        $table2->addColumn("Created", "datetime", "", true);
        $table2->addColumn("Modified", "datetime", "", true);
        $table2->addForeignKey("T_Itemtransfer_Id", "t_itemtransfers", "Id");
        $table2->addForeignKey("T_Itemreceive_Id", "t_itemreceives", "Id", "CASCADE");
        $table2->create();
    }
}