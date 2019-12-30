<?php
namespace App\Database\Migrations;
use Core\Database\Table;

class migration_20191203030739 {

    public function up(){
        
        $table = new Table();
        $table->table('m_items');
        $table->addColumn('M_Uom_Id', 'int', 11, true, null, false, false, "M_Category_Id");
        $table->addForeignKey('M_Uom_Id','m_uoms', 'Id');
        $table->alter();
    }
}