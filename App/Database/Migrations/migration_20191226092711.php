<?php
namespace App\Database\Migrations;
use Core\Database\Table;

class migration_20191226092711 {

    public function up(){
        
        $table = new Table();
        $table->table('t_itemtransfers');
        $table->addColumn("TransitDate", "datetime", "", true, null, false, false, "ReceivedDate");
        $table->alter();
    }
}