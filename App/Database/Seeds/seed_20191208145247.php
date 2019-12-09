<?php
namespace App\Database\Seeds;

use Core\Database\DBBuilder;
use Core\Database\Table;

class seed_20191208145247 {

    public function up(){
        
        $builder = new DBBuilder();
        $data = $builder->query("SELECT MAX(id) Id FROM m_enums")->fetchObject();
        $id = 1;
        if($data)
           $id  = (int)$data[0]->Id + 1;

        
        $table = new Table();
        $table->table('m_enums');
        $table->addSeed('Name', 'ItemtransferStatus');
        $table->seeds();

        $details = [
            [
                'M_Enum_Id' => $id,
                'Value' => 1,
                'EnumName' => 'Baru',
                'Ordering' => 1,
                'Resource' => 'Form.new'
            ],
            [
                'M_Enum_Id' => $id,
                'Value' => 2,
                'EnumName' => 'Sedang Transit',
                'Ordering' => 2,
                'Resource' => 'Form.intransit'
            ],
            [
                'M_Enum_Id' => $id,
                'Value' => 3,
                'EnumName' => 'Rilis',
                'Ordering' => 3,
                'Resource' => 'Form.release'
            ],
            [
                'M_Enum_Id' => $id,
                'Value' => 4,
                'EnumName' => 'Batal',
                'Ordering' => 4,
                'Resource' => 'Form.cancel'
            ]
        ];

        foreach($details as $detail){
            $table2 = new Table();
            $table2->table('m_enumdetails');
            foreach($detail as $key => $data){
                $table2->addSeed($key, $data);
            }
            $table2->seeds();
        }

    }
}