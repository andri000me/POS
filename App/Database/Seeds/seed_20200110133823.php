<?php
namespace App\Database\Seeds;
use Core\Database\Table;

class seed_20200110133823 {

    public function up(){
        
        $table = new Table();
        $table->table('m_forms');
        $table->addSeed('FormName', 'm_menus');
        $table->addSeed('AliasName', 'Menus');
        $table->addSeed('LocalName', 'Menu');
        $table->addSeed('ClassName', 'Master Kitchen');
        $table->addSeed('Resource', 'Form.menu');
        $table->addSeed('IndexRoute', 'mmenu');
        $table->addSeed('Icon', 'fas fa-utensils');
        $table->seeds();
    }
}