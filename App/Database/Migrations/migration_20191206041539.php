<?php
namespace App\Database\Migrations;
use Core\Database\Table;

class migration_20191206041539 {

    public function up(){
        
        $table = new Table();
        $table->table('m_users');
        $table->addColumn("M_Shop_Id", "int", "11", true, null, false, false, "Language");
        $table->addForeignKey("M_Shop_Id", "m_shops", "Id");
        $table->alter();
    }
}