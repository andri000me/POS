<?php
namespace App\Database\Seeds;
use Core\Database\Table;

class seed_20200109125834 {

    public function up(){
        
        $table = new Table();
        $table->table('m_forms');
        $table->addSeed('FormName', 'm_mealtimes');
        $table->addSeed('AliasName', 'Meal Time');
        $table->addSeed('LocalName', 'Waktu Makan');
        $table->addSeed('ClassName', 'Master Kitchen');
        $table->addSeed('Resource', 'Form.mealtime');
        $table->addSeed('IndexRoute', 'mmealtime');
        $table->seeds();
    }
}