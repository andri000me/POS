<?php
namespace App\Database\Seeds;
use Core\Database\Table;

class seed_20191208145132 {

    public function up(){
        
        $table = new Table();
        $table->table('m_forms');
        $table->addSeed('FormName', 't_itemtransfers');
        $table->addSeed('AliasName', 'Item Transfer');
        $table->addSeed('LocalName', 'Transfer Barang');
        $table->addSeed('ClassName', 'Transaction');
        $table->addSeed('Resource', 'Form.itemtransfer');
        $table->addSeed('IndexRoute', 'titemtransfer');
        $table->seeds();

    }
}