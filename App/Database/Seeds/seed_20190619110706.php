<?php
namespace App\Database\Seeds;
use Core\Database\Table;

class seed_20190619110706 {

    public function up(){

        $table = new Table();
        $table->table('m_forms');
        $table->addSeed('FormName', 'm_groupusers');
        $table->addSeed('AliasName', 'Group User');
        $table->addSeed('LocalName', 'Grup Pengguna');
        $table->addSeed('ClassName', 'Master User');
        $table->addSeed('Resource', 'Form.groupuser');
        $table->addSeed('IndexRoute', 'mgroupuser');
        $table->seeds();
        
        $table2 = new Table();
        $table2->table('m_forms');
        $table2->addSeed('FormName', 'm_users');
        $table2->addSeed('AliasName', 'User');
        $table2->addSeed('LocalName', 'Pengguna');
        $table2->addSeed('ClassName', 'Master User');
        $table2->addSeed('Resource', 'Form.user');
        $table2->addSeed('IndexRoute', 'muser');
        $table2->seeds();
    }
}