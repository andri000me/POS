<?php
namespace App\Database\Seeds;
use Core\Database\Table;

class seed_20200123113713 {

    public function up(){
        
        $table = new Table();
        $table->table('m_forms');
        $table->addSeed('FormName', 'm_menuoptions');
        $table->addSeed('AliasName', 'Menu Options');
        $table->addSeed('LocalName', 'Menu Opsi');
        $table->addSeed('ClassName', 'Master Kitchen');
        $table->addSeed('Resource', 'Form.menuoption');
        $table->addSeed('IndexRoute', 'mmenuoption');
        $table->addSeed('Icon', 'fas fa-cookie');
        $table->seeds();
    }
}