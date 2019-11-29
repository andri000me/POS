<?php
namespace App\Database\Seeds;
use Core\Database\Table;

class seed_20191129094036 {

    public function up(){
        
        $table = new Table();
        $table->table('m_forms');
        $table->addSeed('FormName', 'm_categories');
        $table->addSeed('AliasName', 'Category');
        $table->addSeed('LocalName', 'Kategori');
        $table->addSeed('ClassName', 'Master Item');
        $table->addSeed('Resource', 'Form.categories');
        $table->addSeed('IndexRoute', 'mcategory');
        $table->seeds();
    }
}