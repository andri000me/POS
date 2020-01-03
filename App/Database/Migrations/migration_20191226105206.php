<?php
namespace App\Database\Migrations;
use Core\Database\Table;

class migration_20191226105206 {

    public function up(){
        

        $table = new Table();
        $table->table('t_itemreceivings');
        $table->addColumn("M_Shop_Id", "int", "11", true, null, false, false, "TransDate");
        $table->addForeignKey("M_Shop_Id", "m_shops", "Id");
        $table->alter();
    }
}