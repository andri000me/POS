<?php
namespace App\Database\Migrations;
use Core\Database\Table;

class migration_20191223053506 {

    public function up(){
        
        $table = new Table();
        $table->table('t_itemtransfers');
        $table->addColumn("ReceivedDate", "datetime", "", true, null, false, false, "TransDate");
        $table->alter();
        
    }
}