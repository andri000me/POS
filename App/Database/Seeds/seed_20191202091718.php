<?php
namespace App\Database\Seeds;
use Core\Database\Table;

class seed_20191202091718 {

    public function up(){
        
        $table = new Table();
        $table->table('m_forms');
        $table->addSeed('FormName', 'm_items');
        $table->addSeed('AliasName', 'Item');
        $table->addSeed('LocalName', 'Barang');
        $table->addSeed('ClassName', 'Master Item');
        $table->addSeed('Resource', 'Form.item');
        $table->addSeed('IndexRoute', 'mitem');
        $table->seeds();
    }
}