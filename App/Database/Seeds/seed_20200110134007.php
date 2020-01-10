<?php
namespace App\Database\Seeds;

use Core\Database\DBBuilder;
use Core\Database\Table;

class seed_20200110134007 {

    public function up(){
        
        $builder = new DBBuilder();
        $data = $builder->query("SELECT MAX(id) Id FROM m_enums")->fetchObject();
        $id = 1;
        if($data)
           $id  = (int)$data[0]->Id + 1;

        
        $table = new Table();
        $table->table('m_enums');
        $table->addSeed('Name', 'OrderRestriction');
        $table->seeds();

        $details = [
            [
                'M_Enum_Id' => $id,
                'Value' => 1,
                'EnumName' => 'None',
                'Ordering' => 1,
                'Resource' => 'Form.none'
            ],
            [
                'M_Enum_Id' => $id,
                'Value' => 2,
                'EnumName' => 'Hanya Kirim',
                'Ordering' => 2,
                'Resource' => 'Form.deliveryonly'
            ],
            [
                'M_Enum_Id' => $id,
                'Value' => 3,
                'EnumName' => 'Makan Ditempat',
                'Ordering' => 3,
                'Resource' => 'Form.collectiononly'
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