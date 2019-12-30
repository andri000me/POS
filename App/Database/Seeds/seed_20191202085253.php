<?php
namespace App\Database\Seeds;
use Core\Database\Table;

class seed_20191202085253 {

    public function up(){
        
        $table = new Table();
        $table->table('m_forms');
        $table->addSeed('FormName', 'm_warehouses');
        $table->addSeed('AliasName', 'Warehouse');
        $table->addSeed('LocalName', 'Gudang');
        $table->addSeed('ClassName', 'Master General');
        $table->addSeed('Resource', 'Form.warehouse');
        $table->addSeed('IndexRoute', 'mwarehouse');
        $table->seeds();

    }
}