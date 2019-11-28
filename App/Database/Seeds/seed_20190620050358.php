<?php
namespace App\Database\Seeds;
use Core\Database\Table;

class seed_20190620050358 {

    public function up(){

        $table = new Table();
        $table->table('m_forms');
        $table->addSeed('FormName', 'm_formsettings');
        $table->addSeed('AliasName', 'Setting');
        $table->addSeed('LocalName', 'Pengaturan');
        $table->addSeed('ClassName', 'Setting');
        $table->addSeed('Resource', 'Form.setting');
        $table->addSeed('IndexRoute', 'setting');
        $table->seeds();

    }
}