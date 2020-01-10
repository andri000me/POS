<?php
namespace App\Database\Seeds;
use Core\Database\Table;

class seed_20200110101209 {

    public function up(){
        
        $table = new Table();
        $table->table('m_forms');
        $table->addSeed('FormName', 'm_menucategories');
        $table->addSeed('AliasName', 'Menu Category');
        $table->addSeed('LocalName', 'Kategori Menu');
        $table->addSeed('ClassName', 'Master Kitchen');
        $table->addSeed('Resource', 'Form.menucategory');
        $table->addSeed('IndexRoute', 'mmenucategory');
        $table->addSeed('Icon', 'fa fa-list-alt');
        $table->seeds();
    }
}