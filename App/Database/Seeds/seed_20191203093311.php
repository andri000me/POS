<?php
namespace App\Database\Seeds;
use Core\Database\Table;

class seed_20191203093311 {

    public function up(){

        $table = new Table();
        $table->table('m_forms');
        $table->addSeed('FormName', 't_itemstocks');
        $table->addSeed('AliasName', 'Item Stock');
        $table->addSeed('LocalName', 'Stok Barang');
        $table->addSeed('ClassName', 'Transaction');
        $table->addSeed('Resource', 'Form.itemstock');
        $table->addSeed('IndexRoute', 'titemstock');
        $table->seeds();

    }
}