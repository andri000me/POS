<?php
namespace App\Database\Seeds;
use Core\Database\Table;

class seed_20191202091055 {

    public function up(){
        
        $table = new Table();
        $table->table('m_forms');
        $table->addSeed('FormName', 'm_uoms');
        $table->addSeed('AliasName', 'UoM');
        $table->addSeed('LocalName', 'Unit');
        $table->addSeed('ClassName', 'Master General');
        $table->addSeed('Resource', 'Form.uom');
        $table->addSeed('IndexRoute', 'muom');
        $table->seeds();
    }
}