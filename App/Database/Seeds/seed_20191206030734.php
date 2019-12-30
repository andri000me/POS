<?php
namespace App\Database\Seeds;
use Core\Database\Table;

class seed_20191206030734 {

    public function up(){
        
        $table = new Table();
        $table->table('m_forms');
        $table->addSeed('FormName', 't_pos');
        $table->addSeed('AliasName', 'POS');
        $table->addSeed('LocalName', 'POS');
        $table->addSeed('ClassName', 'Transaction');
        $table->addSeed('Resource', 'Form.pos');
        $table->addSeed('IndexRoute', 'pos');
        $table->seeds();

    }
}