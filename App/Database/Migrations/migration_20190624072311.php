<?php
namespace App\Database\Migrations;
use Core\Database\DBBuilder;

class migration_20190624072311 {

    public function up(){
        
        $builder = new DBBuilder();
        $sql = "CREATE OR REPLACE VIEW `view_m_accessroles` 
                    AS 
                    select `a`.`Id` AS `M_Groupuser_Id`,
                            `b`.`Id` AS `M_Form_Id`,
                            `b`.`FormName` AS `FormName`,
                            `b`.`AliasName` AS `AliasName`,
                            `b`.`LocalName` AS `LocalName`,
                            ifnull(`c`.`Read`,0) AS `Readd`,
                            ifnull(`c`.`Write`,0) AS `Writee`,
                            ifnull(`c`.`Delete`,0) AS `Deletee`,
                            ifnull(`c`.`Print`,0) AS `Printt`,
                            `b`.`ClassName` AS `ClassName`,0 
                            AS `Header` 
                    from `m_groupusers` `a` 
                    join `m_forms` `b` 
                    left join `m_accessroles` `c` on `c`.`M_Form_Id` = `b`.`Id`
                        and `c`.`M_Groupuser_Id` = `a`.`Id` 
                        
                    union all 
                    select distinct NULL AS `NULL`,
                        NULL AS `NULL`,
                        NULL AS `NULL`,
                        `m_forms`.`ClassName` AS `ClassName`,
                        NULL AS `NULL`,
                        NULL AS `NULL`,
                        NULL AS `NULL`,
                        NULL AS `NULL`,
                        NULL AS `NULL`,
                        `m_forms`.`ClassName` AS `ClassName`,
                        1 AS `Header` 
                    from `m_forms` 
                    
                    order by 10,11;";
        $builder
        ->query($sql)
        ->execute();
        
    }
}