/*
SQLyog Professional v12.4.3 (64 bit)
MySQL - 10.1.33-MariaDB : Database - pos
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Data for the table `g_transactionnumbers` */

insert  into `g_transactionnumbers`(`Id`,`Format`,`Year`,`Month`,`LastNumber`,`M_Form_Id`,`TypeTrans`,`Branch`) values 
(1,'IST/{YYYY}{MM}/#####',2019,12,7,8,0,1),
(2,'IST/{YYYY}{MM}/#####',2019,12,4,8,NULL,2),
(3,'IST/{YYYY}{MM}/#####',2019,12,0,8,NULL,3),
(4,'ITF/{YYYY}{MM}/#####',2019,12,1,11,0,1),
(5,'ITF/{YYYY}{MM}/#####',2019,12,0,11,NULL,2),
(6,'ITF/{YYYY}{MM}/#####',2019,12,0,11,NULL,3),
(7,'ITR/{YYYY}{MM}/#####',2019,12,0,12,0,1),
(8,'ITR/{YYYY}{MM}/#####',2019,12,0,12,0,2),
(9,'ITR/{YYYY}{MM}/#####',2019,12,0,12,0,3);

/*Data for the table `m_accessroles` */

insert  into `m_accessroles`(`Id`,`M_Form_Id`,`M_Groupuser_Id`,`Read`,`Write`,`Delete`,`Print`) values 
(1,1,12,0,0,0,0),
(2,2,12,1,1,0,0),
(3,3,12,0,0,0,0),
(4,9,13,1,1,1,1),
(5,10,11,1,1,1,1),
(6,6,11,1,1,1,1),
(7,5,11,1,1,1,1),
(8,4,11,1,1,1,1),
(9,7,11,1,1,1,1),
(10,1,11,1,1,1,1),
(11,2,11,1,1,1,1),
(12,3,11,1,1,1,1),
(13,8,11,1,1,1,1),
(14,9,11,1,1,1,1),
(15,11,11,1,1,1,1),
(16,12,11,1,1,1,1);

/*Data for the table `m_categories` */

insert  into `m_categories`(`Id`,`Code`,`Name`,`Description`,`PhotoUrl`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,'','Croooot','Crot','','superadmin','superadmin','2019-11-29 16:01:29','2019-11-29 16:02:17'),
(2,'','Test','Test','','superadmin',NULL,'2019-12-02 16:34:38',NULL);

/*Data for the table `m_enumdetails` */

insert  into `m_enumdetails`(`Id`,`M_Enum_Id`,`Value`,`EnumName`,`Ordering`,`Resource`) values 
(1,1,1,'Baru',1,'Form.new'),
(2,1,2,'Rilis',2,'Form.release'),
(3,1,3,'Batal',3,'Form.cancel'),
(4,2,1,'Baru',1,'Form.new'),
(5,2,2,'Sedang Transit',2,'Form.intransit'),
(6,2,3,'Rilis',3,'Form.release'),
(7,2,4,'Batal',4,'Form.cancel'),
(8,3,1,'Baru',1,'Form.new'),
(9,3,2,'Diterima',2,'Form.received'),
(10,3,3,'Batal',3,'Form.cancel');

/*Data for the table `m_enums` */

insert  into `m_enums`(`Id`,`Name`) values 
(1,'ItemstockStatus'),
(2,'ItemtransferStatus'),
(3,'ItemreceiveStatus');

/*Data for the table `m_forms` */

insert  into `m_forms`(`Id`,`FormName`,`AliasName`,`LocalName`,`ClassName`,`Resource`,`IndexRoute`) values 
(1,'m_groupusers','Group User','Grup Pengguna','Master User','Form.groupuser','mgroupuser'),
(2,'m_users','User','Pengguna','Master User','Form.user','muser'),
(3,'m_formsettings','Setting','Pengaturan','Setting','Form.setting','setting'),
(4,'m_categories','Category','Kategori','Master Item','Form.category','mcategory'),
(5,'m_warehouses','Warehouse','Gudang','Master General','Form.warehouse','mwarehouse'),
(6,'m_uoms','UoM','Unit','Master General','Form.uom','muom'),
(7,'m_items','Item','Barang','Master Item','Form.item','mitem'),
(8,'t_itemstocks','Item Stock','Stok Barang','Transaction','Form.itemstock','titemstock'),
(9,'t_pos','POS','POS','Transaction','Form.pos','pos'),
(10,'m_shops','Shop','Toko','Master General','Form.shop','mshop'),
(11,'t_itemtransfers','Item Transfer','Transfer Barang','Transaction','Form.itemtransfer','titemtransfer'),
(12,'t_itemreceives','Item Receive','Terima Barang','Transaction','Form.itemreceive','titemreceive');

/*Data for the table `m_formsettings` */

insert  into `m_formsettings`(`Id`,`M_Form_Id`,`TypeTrans`,`Value`,`Name`,`IntValue`,`StringValue`,`DecimalValue`,`DateTimeValue`,`BooleanValue`) values 
(1,8,NULL,1,'NUMBERING_FORMAT',NULL,'IST/{YYYY}{MM}/5',NULL,NULL,NULL),
(2,11,NULL,1,'NUMBERING_FORMAT',NULL,'ITF/{YYYY}{MM}/5',NULL,NULL,NULL),
(3,12,0,1,'NUMBERING_FORMAT',0,'ITR/{YYYY}{MM}/5',0.00,'0000-00-00 00:00:00',0);

/*Data for the table `m_groupusers` */

insert  into `m_groupusers`(`Id`,`GroupName`,`Description`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(11,'Admin','Admin','superadmin',NULL,'2019-11-29 10:25:41',NULL),
(12,'Pegawai','Pegawai','superadmin','superadmin','2019-11-29 10:29:18','2019-11-29 13:04:36'),
(13,'<div><script src=\"http://localhost:8889/POS/assets/dist/js/test.js\"></script></div>','Kasir','superadmin',NULL,'2019-12-06 09:24:30',NULL);

/*Data for the table `m_items` */

insert  into `m_items`(`Id`,`Code`,`Name`,`M_Category_Id`,`M_Uom_Id`,`Cost`,`Price`,`PhotoUrl`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,'HE001','Citos',2,2,NULL,NULL,'','superadmin','superadmin','2019-12-02 16:32:31','2019-12-05 10:19:50'),
(2,'HE002','Taro',1,1,NULL,NULL,'','superadmin','superadmin','2019-12-02 16:34:51','2019-12-06 08:50:13'),
(3,'MI00123','Emi',2,1,NULL,NULL,'','superadmin',NULL,'2019-12-03 09:49:37',NULL);

/*Data for the table `m_itemstocks` */

insert  into `m_itemstocks`(`Id`,`M_Shop_Id`,`M_Item_Id`,`M_Uom_Id`,`M_Warehouse_Id`,`Qty`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(5,1,3,1,NULL,1000.00,'superadmin','superadmin','2019-12-05 14:27:47','2019-12-05 16:22:58'),
(6,1,1,2,NULL,10.00,'superadmin','Karni','2019-12-05 14:27:47','2019-12-06 15:40:22'),
(7,2,1,2,NULL,5.00,'Karni','Karni','2019-12-06 15:36:33','2019-12-06 15:43:24'),
(8,2,2,1,NULL,20.00,'Karni','Karni','2019-12-06 15:36:33','2019-12-06 15:43:24');

/*Data for the table `m_shops` */

insert  into `m_shops`(`Id`,`Code`,`Name`,`Address1`,`Address2`,`Email`,`Phone`,`City`,`Province`,`PostCode`,`Country`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,'TK0001','Laris','Jl. Mayor Kusumanto 43 Rt 04 Rw 05, Sekarsuli, Klaten Utara, Bramen, Sekarsuli, Klaten Utara, Klaten Regency, Central Java 57432',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'superadmin',NULL,'2019-12-06 10:13:40',NULL),
(2,'TK0002','Nguing','Jl. Rajawali, Klaten, Bareng, Kec. Klaten Tengah, Kabupaten Klaten, Jawa Tengah 57413',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'andik',NULL,'2019-12-06 10:55:33',NULL),
(3,'TK0003','MART','Jl. Ki Hajar Dewantoro, Macanan, Karanganom, Kec. Klaten Utara, Kabupaten Klaten, Jawa Tengah 57438',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Karni',NULL,'2019-12-06 16:14:16',NULL);

/*Data for the table `m_uomconversions` */

insert  into `m_uomconversions`(`Id`,`M_Item_Id`,`M_Uom_Id_From`,`M_Uom_Id_To`,`Qty`,`Ordering`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(5,2,4,2,5.00,1,'superadmin',NULL,'2019-12-03 14:42:54',NULL),
(7,2,2,1,12.00,2,'superadmin',NULL,'2019-12-03 14:47:35',NULL),
(8,3,4,2,10.00,1,'superadmin',NULL,'2019-12-03 14:50:47',NULL),
(9,3,2,1,10.00,2,'superadmin',NULL,'2019-12-03 14:50:58',NULL),
(10,1,2,1,15.00,1,'superadmin',NULL,'2019-12-03 15:00:26',NULL);

/*Data for the table `m_uoms` */

insert  into `m_uoms`(`Id`,`Name`,`Description`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,'Pcs','Pcs','superadmin',NULL,'2019-12-02 15:15:17',NULL),
(2,'Dus','Dus','superadmin',NULL,'2019-12-02 15:15:22',NULL),
(3,'Kg','Kg','superadmin',NULL,'2019-12-02 15:16:44',NULL),
(4,'Box','Box','superadmin',NULL,'2019-12-03 14:40:57',NULL);

/*Data for the table `m_users` */

insert  into `m_users`(`Id`,`M_Groupuser_Id`,`Username`,`Password`,`IsLoggedIn`,`IsActive`,`Language`,`M_Shop_Id`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,NULL,'superadmin','b6b370cc69bcccdd8fa30f665f735b6a',0,1,'id',NULL,NULL,NULL,NULL,NULL),
(2,11,'andik','df5db5fc718b7be2bb286d93510b98ba',0,1,'id',1,'superadmin',NULL,'2019-11-29 15:16:32',NULL),
(3,13,'herlani','18800810b21364f751699ee20478c0e8',0,1,'id',1,'superadmin',NULL,'2019-12-06 09:27:42',NULL),
(4,11,'Dharma','36670eda20199240d40a3dc2c53a94bb',0,1,'id',1,'superadmin',NULL,'2019-12-06 10:26:56',NULL),
(5,11,'Karni','ca921481dfa00894e03093ca134c1f9f',0,1,'id',2,'andik',NULL,'2019-12-06 10:59:04',NULL),
(6,11,'Tele','ef6246434e3cf1f55740af4b929cff65',0,1,'id',3,'superadmin',NULL,'2019-12-06 16:15:49',NULL);

/*Data for the table `m_warehouses` */

insert  into `m_warehouses`(`Id`,`Name`,`Description`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,'Gudang A','Gudang A','superadmin',NULL,'2019-12-02 15:04:19',NULL);

/*Data for the table `migrations` */

insert  into `migrations`(`Id`,`Version`,`ExecutedAt`) values 
(1,'20190619034744','2019-11-28 13:21:30'),
(2,'20190619104817','2019-11-28 13:21:30'),
(3,'20190624072311','2019-11-28 13:21:31'),
(4,'20191129093829','2019-11-29 15:39:58'),
(5,'20191129094026','2019-12-02 14:48:03'),
(6,'20191129094027','2019-12-02 14:51:24'),
(7,'20191202085154','2019-12-02 14:52:33'),
(8,'20191202091013','2019-12-02 15:10:38'),
(9,'20191203030739','2019-12-03 09:10:35'),
(10,'20191203043932','2019-12-03 10:47:35'),
(11,'20191203090325','2019-12-03 15:11:34'),
(12,'20191203090530','2019-12-03 15:11:35'),
(13,'20191206033329','2019-12-06 09:43:31'),
(14,'20191206041538','2019-12-06 10:17:03'),
(15,'20191206041539','2019-12-06 10:18:37'),
(16,'20191206043016','2019-12-06 10:31:32'),
(17,'20191206044413','2019-12-06 10:44:45'),
(18,'20191206044414','2019-12-06 10:45:13'),
(19,'20191206080643','2019-12-06 15:30:30'),
(20,'20191208144818','2019-12-09 10:25:11'),
(21,'20191223053506','2019-12-23 11:36:18'),
(22,'20191226092711','2019-12-26 15:27:31'),
(23,'20191226093022','2019-12-26 15:40:00'),
(24,'20191226105206','2019-12-26 16:54:16');

/*Data for the table `seeds` */

insert  into `seeds`(`Id`,`Version`,`ExecutedAt`) values 
(1,'20190619100642','2019-11-28 13:24:05'),
(2,'20190619110706','2019-11-28 13:24:05'),
(3,'20190620050358','2019-11-28 13:24:05'),
(4,'20191129094036','2019-11-29 15:41:48'),
(5,'20191202085253','2019-12-02 14:54:01'),
(6,'20191202091055','2019-12-02 15:12:06'),
(7,'20191202091718','2019-12-02 15:18:18'),
(8,'20191203093311','2019-12-03 15:47:39'),
(9,'20191203094924','2019-12-03 16:04:35'),
(10,'20191204075700','2019-12-04 14:02:55'),
(11,'20191206030734','2019-12-06 09:20:32'),
(12,'20191206034337','2019-12-06 09:44:30'),
(13,'20191208145132','2019-12-09 10:25:16'),
(14,'20191208145247','2019-12-09 10:25:17'),
(15,'20191208145412','2019-12-09 10:25:17'),
(16,'20191226094259','2019-12-26 15:43:56'),
(17,'20191226094358','2019-12-26 15:47:12'),
(18,'20191226095012','2019-12-26 15:51:37');

/*Data for the table `t_itemreceivedetails` */

/*Data for the table `t_itemreceives` */

/*Data for the table `t_itemstockdetails` */

insert  into `t_itemstockdetails`(`Id`,`T_Itemstock_Id`,`M_Item_Id`,`M_Uom_Id`,`M_Warehouse_Id`,`Qty`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(8,2,3,4,NULL,10.00,'superadmin',NULL,'2019-12-05 10:12:55',NULL),
(9,2,1,2,NULL,10.00,'superadmin','superadmin','2019-12-05 10:23:29','2019-12-05 10:55:49'),
(22,11,3,4,NULL,10.00,'superadmin',NULL,'2019-12-05 16:22:41',NULL),
(23,11,1,2,NULL,10.00,'superadmin',NULL,'2019-12-05 16:22:41',NULL),
(24,14,1,4,NULL,5.00,'Karni',NULL,'2019-12-06 15:36:12',NULL),
(25,14,2,1,NULL,20.00,'Karni',NULL,'2019-12-06 15:36:24',NULL),
(26,15,1,2,NULL,5.00,'Karni','Karni','2019-12-06 15:39:46','2019-12-06 15:39:54'),
(27,15,2,1,NULL,20.00,'Karni',NULL,'2019-12-06 15:39:46',NULL),
(28,16,1,2,NULL,5.00,'Karni',NULL,'2019-12-06 15:42:55',NULL),
(29,16,2,1,NULL,20.00,'Karni',NULL,'2019-12-06 15:42:55',NULL),
(30,17,1,2,NULL,5.00,'Karni',NULL,'2019-12-06 15:43:19',NULL),
(31,17,2,1,NULL,20.00,'Karni',NULL,'2019-12-06 15:43:19',NULL);

/*Data for the table `t_itemstocks` */

insert  into `t_itemstocks`(`Id`,`TransNo`,`TransDate`,`Status`,`Recipient`,`M_Shop_Id`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(2,'IST/201912/00002','2019-12-05 00:00:00',3,'',1,'superadmin','superadmin','2019-12-05 08:54:48','2019-12-05 15:39:20'),
(11,'IST/201912/00004','2019-12-05 00:00:00',2,NULL,1,'superadmin','superadmin','2019-12-05 16:22:41','2019-12-05 16:22:58'),
(12,'IST/201912/00005','2019-12-05 00:00:00',1,NULL,1,'superadmin','superadmin','2019-12-05 16:39:21','2019-12-05 16:40:47'),
(13,'IST/201912/00006','2019-12-06 00:00:00',1,NULL,1,'andik',NULL,'2019-12-06 10:42:06',NULL),
(14,'IST/201912/00001','2019-12-06 00:00:00',3,NULL,2,'Karni','Karni','2019-12-06 11:08:18','2019-12-06 15:37:58'),
(15,'IST/201912/00002','2019-12-06 00:00:00',3,NULL,2,'Karni','Karni','2019-12-06 15:39:46','2019-12-06 15:40:22'),
(16,'IST/201912/00003','2019-12-06 00:00:00',3,NULL,2,'Karni','Karni','2019-12-06 15:42:54','2019-12-06 15:43:08'),
(17,'IST/201912/00004','2019-12-06 00:00:00',2,NULL,2,'Karni','Karni','2019-12-06 15:43:19','2019-12-06 15:43:24'),
(18,'IST/201912/00007','2019-12-26 00:00:00',1,'',1,'andik','andik','2019-12-26 15:25:45','2019-12-26 15:26:01');

/*Data for the table `t_itemtransferdetails` */

insert  into `t_itemtransferdetails`(`Id`,`T_Itemtransfer_Id`,`M_Item_Id`,`M_Uom_Id`,`M_Warehouse_Id`,`Qty`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,7,1,2,NULL,10.00,'andik',NULL,'2019-12-23 11:10:44',NULL),
(2,7,2,4,NULL,20.00,'andik',NULL,'2019-12-23 11:13:27',NULL);

/*Data for the table `t_itemtransfers` */

insert  into `t_itemtransfers`(`Id`,`TransNo`,`TransDate`,`ReceivedDate`,`TransitDate`,`M_Shop_Id_From`,`M_Shop_Id_To`,`Status`,`Sender`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(7,'ITF/201912/00001','2019-12-26 00:00:00','0000-00-00 00:00:00','2019-12-26 15:28:39',1,2,2,'','andik','andik','2019-12-23 10:30:47','2019-12-26 15:28:39');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
