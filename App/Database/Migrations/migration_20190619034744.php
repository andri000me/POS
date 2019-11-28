<?php
namespace App\Database\Migrations;
use Core\Database\Table;

class migration_20190619034744 {

    public function up(){
        $table = new Table();
        $table->table('m_groupusers');
        $table->addColumn("Id", "int", "11", false, null, true, true);
        $table->addColumn("GroupName", "Varchar", "100");
        $table->addColumn("Description", "Varchar", "100");
        $table->addColumn("CreatedBy", "Varchar", "50", true);
        $table->addColumn("ModifiedBy", "Varchar", "50", true);
        $table->addColumn("Created", "datetime", "", true);
        $table->addColumn("Modified", "datetime", "", true);
        $table->create();

        $table2 = new Table();
        $table2->table('m_users');
        $table2->addColumn("Id", "int", "11", false, null, true, true);
        $table2->addColumn("M_Groupuser_Id", "int", "11", true);
        $table2->addColumn("Username", "Varchar", "100");
        $table2->addColumn("Password", "Varchar", "50");
        $table2->addColumn("IsLoggedIn", "smallint", "11", false, "0");
        $table2->addColumn("IsActive", "smallint", "11", false, "1");
        $table2->addColumn("Language", "varchar", "50", false, "id");
        $table2->addColumn("CreatedBy", "Varchar", "50", true);
        $table2->addColumn("ModifiedBy", "Varchar", "50", true);
        $table2->addColumn("Created", "datetime", "", true);
        $table2->addColumn("Modified", "datetime", "", true);
        $table2->addForeignKey("M_Groupuser_Id", "m_groupusers", "Id");
        $table2->create();

    }
}   