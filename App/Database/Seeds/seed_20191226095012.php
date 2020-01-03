<?php
namespace App\Database\Seeds;

use Core\Database\DBBuilder;
use Core\Database\Table;

class seed_20191226095012 {

    public function up(){
        
        $builder = new DBBuilder();
        $data = $builder->query("SELECT * FROM m_forms where FormName = 't_itemreceivings'")->fetchObject();
        $table = new Table();
        $table->table('m_formsettings');
        $table->addSeed('M_Form_Id', $data[0]->Id);
        $table->addSeed('Value', 1);
        $table->addSeed('Name', 'NUMBERING_FORMAT');
        $table->seeds();
    }
}