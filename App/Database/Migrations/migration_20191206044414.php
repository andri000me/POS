<?php
namespace App\Database\Migrations;
use Core\Database\Table;

class migration_20191206044414 {

    public function up(){
        
        $table = new Table();
        $table->table('t_itemstocks');
        $table->addColumn("M_Shop_Id", "int", "11", true, null, false, false, "Recipient");
        $table->addForeignKey("M_Shop_Id", "m_shops", "Id");
        $table->alter();
    }
}