<?php
namespace App\Database\Migrations;
use Core\Database\Table;

class migration_20191206043016 {

    public function up(){
        
        $table = new Table();
        $table->table('g_transactionnumbers');
        $table->addColumn("Branch", "int", "11", true, null, false, false, "TypeTrans");
        $table->alter();
    }
}