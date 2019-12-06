<?php
namespace App\Database\Migrations;
use Core\Database\Table;

class migration_20191206080643 {

    public function up(){
        

        $table = new Table();
        $table->table('m_itemstocks');
        $table->addColumn("M_Shop_Id", "int", "11", true, null, false, false, "Id");
        $table->addForeignKey("M_Shop_Id", "m_shops", "Id");
        $table->alter();
    }
}