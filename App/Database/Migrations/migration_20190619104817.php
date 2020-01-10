<?php
namespace App\Database\Migrations;
use Core\Database\Table;

class migration_20190619104817 {

    public function up(){
        
        $table = new Table();
        $table->table('m_forms');
        $table->addColumn("Id", "int", "11", false, null, true, true);
        $table->addColumn("FormName", "Varchar", "100");
        $table->addColumn("AliasName", "Varchar", "100");
        $table->addColumn("LocalName", "Varchar", "100");
        $table->addColumn("ClassName", "Varchar", "100");
        $table->addColumn("Resource", "Varchar", "100", true);
        $table->addColumn("IndexRoute", "Varchar", "100", true);
        $table->addColumn("Icon", "Varchar", "100", true);
        $table->create();

        $table1 = new Table();
        $table1->table('g_transactionnumbers');
        $table1->addColumn("Id", "int", "11", false, null, true, true);
        $table1->addColumn("Format", "Varchar", "50");
        $table1->addColumn("Year", "int", "11");
        $table1->addColumn("Month", "int", "11");
        $table1->addColumn("LastNumber", "int", "11");
        $table1->addColumn("M_Form_Id", "int", "11");
        $table1->addColumn("TypeTrans", "int", "11", true);
        $table1->create();

        $table2 = new Table();
        $table2->table('m_formsettings');
        $table2->addColumn("Id", "int", "11", false, null, true, true);
        $table2->addColumn("M_Form_Id", "int", "11");
        $table2->addColumn("TypeTrans", "int", "11", true);
        $table2->addColumn("Value", "int", "11");
        $table2->addColumn("Name", "varchar", "1000");
        $table2->addColumn("IntValue", "int", "11", true);
        $table2->addColumn("StringValue", "varchar", "100", true);
        $table2->addColumn("DecimalValue", "decimal", "18,2", true);
        $table2->addColumn("DateTimeValue", "datetime", "", true);
        $table2->addColumn("BooleanValue", "smallint", "11", true);
        $table2->addForeignKey("M_Form_Id", "m_forms", "Id");
        $table2->create();

        $table3 = new Table();
        $table3->table('m_enums');
        $table3->addColumn("Id", "int", "11", false, null, true, true);
        $table3->addColumn("Name", "varchar", "100");
        $table3->create();

        $table4 = new Table();
        $table4->table('m_enumdetails');
        $table4->addColumn("Id", "int", "11", false, null, true, true);
        $table4->addColumn("M_Enum_Id", "Int", "11");
        $table4->addColumn("Value", "Int", "11");
        $table4->addColumn("EnumName", "varchar", "50");
        $table4->addColumn("Ordering", "tinyint", "11");
        $table4->addColumn("Resource", "varchar", "50", true);
        $table4->addForeignKey("M_Enum_Id", "m_enums", "Id", "CASCADE");
        $table4->create();

        $table5 = new Table();
        $table5->table('m_accessroles');
        $table5->addColumn("Id", "int", "11", false, null, true, true);
        $table5->addColumn("M_Form_Id", "Int", "11");
        $table5->addColumn("M_Groupuser_Id", "Int", "11");
        $table5->addColumn("Read", "tinyint", "1", true);
        $table5->addColumn("Write", "tinyint", "1", true);
        $table5->addColumn("Delete", "tinyint", "1", true);
        $table5->addColumn("Print", "tinyint", "1", true);
        $table5->addForeignKey("M_Form_Id", "m_forms", "Id");
        $table5->addForeignKey("M_Groupuser_Id", "m_groupusers", "Id");
        $table5->create();
        
    }
}