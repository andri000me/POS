<?php
namespace App\Database\Seeds;
use Core\Database\Table;

class seed_20191226094259 {

    public function up(){
        
        $table = new Table();
        $table->table('m_forms');
        $table->addSeed('FormName', 't_itemreceives');
        $table->addSeed('AliasName', 'Item Receive');
        $table->addSeed('LocalName', 'Terima Barang');
        $table->addSeed('ClassName', 'Transaction');
        $table->addSeed('Resource', 'Form.itemreceive');
        $table->addSeed('IndexRoute', 'titemreceive');
        $table->seeds();

    }
}