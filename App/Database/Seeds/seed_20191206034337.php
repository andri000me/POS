<?php
namespace App\Database\Seeds;
use Core\Database\Table;

class seed_20191206034337 {

    public function up(){
        
        $table = new Table();
        $table->table('m_forms');
        $table->addSeed('FormName', 'm_shops');
        $table->addSeed('AliasName', 'Shop');
        $table->addSeed('LocalName', 'Toko');
        $table->addSeed('ClassName', 'Master General');
        $table->addSeed('Resource', 'Form.shop');
        $table->addSeed('IndexRoute', 'mshop');
        $table->seeds();
    }
}