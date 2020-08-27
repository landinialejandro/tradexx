<?php
	// check this file's MD5 to make sure it wasn't called before
	$prevMD5=@implode('', @file(dirname(__FILE__).'/setup.md5'));
	$thisMD5=md5(@implode('', @file("./updateDB.php")));
	if($thisMD5==$prevMD5) {
		$setupAlreadyRun=true;
	}else{
		// set up tables
		if(!isset($silent)) {
			$silent=true;
		}

		// set up tables
		setupTable('Customers', "create table if not exists `Customers` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Title` VARCHAR(40) null , `Customer` VARCHAR(40) null , `Birthdate` DATE null , `Type` INT unsigned null , `Phone` VARCHAR(40) null , `Email` VARCHAR(80) null , `Address` VARCHAR(40) null , `City` INT unsigned null , `Province` INT unsigned null , `Country` INT unsigned null , `Status` VARCHAR(40) null default 'ACTIVE' ) CHARSET utf8", $silent, array( "ALTER TABLE `customers` RENAME `Customers`","UPDATE `membership_userrecords` SET `tableName`='Customers' where `tableName`='customers'","UPDATE `membership_userpermissions` SET `tableName`='Customers' where `tableName`='customers'","UPDATE `membership_grouppermissions` SET `tableName`='Customers' where `tableName`='customers'","ALTER TABLE `Customers` CHANGE `customer` `Customer` VARCHAR(40) null "));
		setupIndexes('Customers', array('Type','City','Province','Country'));
		setupTable('Retention', "create table if not exists `Retention` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Customer` INT unsigned null , `Phone` INT unsigned null , `Email` INT unsigned null , `Zone` INT unsigned null , `Interaction` TEXT null , `GIFTPACKAGE` TEXT null , `Assigned` INT unsigned null , `Status` VARCHAR(40) null default 'OPEN' , `CreateDate` DATETIME null , `ResolutionDate` DATETIME null ) CHARSET utf8", $silent, array( "ALTER TABLE `RETENTION` RENAME `Retention`","UPDATE `membership_userrecords` SET `tableName`='Retention' where `tableName`='RETENTION'","UPDATE `membership_userpermissions` SET `tableName`='Retention' where `tableName`='RETENTION'","UPDATE `membership_grouppermissions` SET `tableName`='Retention' where `tableName`='RETENTION'","ALTER TABLE `Retention` CHANGE `customer` `Customer` INT unsigned null ","ALTER TABLE `Retention` CHANGE `phone` `Phone` INT unsigned null ","ALTER TABLE `Retention` CHANGE `email` `Email` INT unsigned null ","ALTER TABLE `Retention` CHANGE `Email` `Email` VARCHAR(80) null "));
		setupIndexes('Retention', array('Customer','Assigned'));
		setupTable('Alert', "create table if not exists `Alert` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Customer` INT unsigned null , `Satus` VARCHAR(40) null , `Comment` TEXT null , `Date` DATETIME null ) CHARSET utf8", $silent, array( "ALTER TABLE `Alert` CHANGE `CUSTOMER` `Customer` INT unsigned null ","ALTER TABLE `Alert` CHANGE `STATUS` `Satus` VARCHAR(40) null ","ALTER TABLE `Alert` CHANGE `COMMENT` `Comment` TEXT null "));
		setupIndexes('Alert', array('Customer'));
		setupTable('CustomerClass', "create table if not exists `CustomerClass` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Type` VARCHAR(40) null ) CHARSET utf8", $silent);
		setupTable('Staff', "create table if not exists `Staff` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Photo` VARCHAR(40) null , `Employee` VARCHAR(40) null , `Birthdate` DATE null , `Phone` VARCHAR(40) null , `Email` VARCHAR(80) null , `Address` VARCHAR(40) null , `City` INT unsigned null , `Province` INT unsigned null , `Country` INT unsigned null , `hireDate` DATE null , `Department` INT unsigned null , `Position` INT unsigned null , `Supervisor` INT unsigned null , `Manager` INT unsigned null , `Director` INT unsigned null , `Status` VARCHAR(40) null , `EmergencyContact` TEXT null , `EmergencyPhone` TEXT null ) CHARSET utf8", $silent, array( "ALTER TABLE `STAFF` RENAME `Staff`","UPDATE `membership_userrecords` SET `tableName`='Staff' where `tableName`='STAFF'","UPDATE `membership_userpermissions` SET `tableName`='Staff' where `tableName`='STAFF'","UPDATE `membership_grouppermissions` SET `tableName`='Staff' where `tableName`='STAFF'","ALTER TABLE `Staff` CHANGE `employee` `Employee` VARCHAR(40) null ","ALTER TABLE `Staff` CHANGE `birthdate` `Birthdate` DATE null "));
		setupIndexes('Staff', array('City','Province','Country','Department','Position','Supervisor','Manager','Director'));
		setupTable('Country', "create table if not exists `Country` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Country` VARCHAR(40) null ) CHARSET utf8", $silent);
		setupTable('Province', "create table if not exists `Province` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Province` VARCHAR(40) null , `Country` INT unsigned null ) CHARSET utf8", $silent);
		setupIndexes('Province', array('Country'));
		setupTable('City', "create table if not exists `City` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Province` INT unsigned null , `City` VARCHAR(40) null ) CHARSET utf8", $silent);
		setupIndexes('City', array('Province'));
		setupTable('Warehouse', "create table if not exists `Warehouse` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Warehouse` VARCHAR(40) null , `Date` DATE null , `Freight` VARCHAR(40) null ) CHARSET utf8", $silent, array( "ALTER TABLE `warehouse` RENAME `Warehouse`","UPDATE `membership_userrecords` SET `tableName`='Warehouse' where `tableName`='warehouse'","UPDATE `membership_userpermissions` SET `tableName`='Warehouse' where `tableName`='warehouse'","UPDATE `membership_grouppermissions` SET `tableName`='Warehouse' where `tableName`='warehouse'","ALTER TABLE `Warehouse` CHANGE `warehouse` `Warehouse` VARCHAR(40) null ","ALTER TABLE `Warehouse` CHANGE `date` `Date` DATE null ","ALTER TABLE `Warehouse` CHANGE `Date` `Date` DATE null ","ALTER TABLE `Warehouse` CHANGE `freight` `Freight` VARCHAR(40) null "));
		setupTable('Tracking', "create table if not exists `Tracking` (   `id` INT unsigned not null auto_increment , primary key (`id`), `WhID` INT unsigned null , `Date` INT unsigned null default '1' , `Warehouse` INT unsigned null , `Tracking` VARCHAR(40) null , `Customer` INT unsigned null , `Dimensions` VARCHAR(40) null , `Weight` DECIMAL(10,2) null , `Volume` DECIMAL(10,2) null , `Total` DECIMAL(10,2) null , `Employee` INT unsigned null , `Freight` INT unsigned null , `Status` VARCHAR(40) null default 'READY FOR PICK UP' , `Zone` INT unsigned null , `DeliveredDate` DATETIME null ) CHARSET utf8", $silent, array( "ALTER TABLE `tracking` RENAME `Tracking`","UPDATE `membership_userrecords` SET `tableName`='Tracking' where `tableName`='tracking'","UPDATE `membership_userpermissions` SET `tableName`='Tracking' where `tableName`='tracking'","UPDATE `membership_grouppermissions` SET `tableName`='Tracking' where `tableName`='tracking'","ALTER TABLE `Tracking` CHANGE `date` `Date` INT unsigned null default '1' ","ALTER TABLE `Tracking` CHANGE `Date` `Date` DATE null ","ALTER TABLE `Tracking` CHANGE `warehouse` `Warehouse` INT unsigned null ","ALTER TABLE `Tracking` CHANGE `tracking` `Tracking` VARCHAR(40) null ","ALTER TABLE `Tracking` CHANGE `customer` `Customer` INT unsigned null ","ALTER TABLE `Tracking` CHANGE `dimensions` `Dimensions` VARCHAR(40) null ","ALTER TABLE `Tracking` CHANGE `weight` `Weight` DECIMAL(10,2) null ","ALTER TABLE `Tracking` CHANGE `volume` `Volume` DECIMAL(10,2) null ","ALTER TABLE `Tracking` CHANGE `total` `Total` DECIMAL(10,2) null "));
		setupIndexes('Tracking', array('Warehouse','Customer','Employee'));
		setupTable('Status', "create table if not exists `Status` (   `id` INT unsigned not null auto_increment , primary key (`id`), `TrackID` INT unsigned null , `Invoice` INT unsigned null , `Tracking` INT unsigned null , `Dimensions` INT unsigned null , `RWeight` INT unsigned null , `VWeight` INT unsigned null , `Total` INT unsigned null , `FreightType` VARCHAR(40) not null , `DeliveryDate` DATETIME null , `Delivered` BLOB null ) CHARSET utf8", $silent);
		setupIndexes('Status', array('Invoice','Tracking'));
		setupTable('Invoice', "create table if not exists `Invoice` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Date` DATE null , `Title` INT unsigned null , `Customer` INT unsigned null , `Phone` INT unsigned null , `Email` INT unsigned null , `Address` INT unsigned null , `City` INT unsigned null , `Country` INT unsigned null , `PaymentStatus` VARCHAR(40) null default 'UNPAID' , `AmountDUE` DECIMAL(10,2) null , `AmountPAID` DECIMAL(10,2) null , `Balance` DECIMAL(10,2) null , `Status` VARCHAR(40) null default 'OPEN' ) CHARSET utf8", $silent, array( "ALTER TABLE `Invoice` CHANGE `date` `Date` DATE null ","ALTER TABLE `Invoice` CHANGE `Date` `Date` DATE null "));
		setupIndexes('Invoice', array('Customer'));
		setupTable('Products', "create table if not exists `Products` (   `id` INT unsigned not null auto_increment , primary key (`id`), `invoice` INT unsigned null , `item` VARCHAR(40) null , `qty` VARCHAR(40) null , `total` VARCHAR(40) null , `uploads` VARCHAR(40) null ) CHARSET utf8", $silent, array( "ALTER TABLE Products ADD `field6` VARCHAR(40)","ALTER TABLE `Products` CHANGE `field6` `Uploads` VARCHAR(40) null ","ALTER TABLE `Products` CHANGE `Uploads` `uploads` VARCHAR(40) null ","ALTER TABLE `Products` CHANGE `Invoice` `invoice` INT unsigned null ","ALTER TABLE `Products` CHANGE `Item` `item` VARCHAR(40) null ","ALTER TABLE `Products` CHANGE `Qty` `qty` VARCHAR(40) null ","ALTER TABLE `Products` CHANGE `Total` `total` VARCHAR(40) null "));
		setupIndexes('Products', array('invoice'));
		setupTable('WHJournal', "create table if not exists `WHJournal` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Date` DATE null , `Freightype` VARCHAR(40) null default 'AIR FREIGHT' , `Invoices` VARCHAR(40) null , `Warehouse` VARCHAR(40) null , `Tracking` VARCHAR(40) null , `GroundFreight` TEXT null , `Boxes` VARCHAR(40) null , `Dimensions` VARCHAR(40) null , `Volume` DECIMAL(10,2) null , `Weight` DECIMAL(10,2) null , `InternationalFreight` DECIMAL(10,2) null , `LocalFreight` DECIMAL(10,2) null , `Tip` DECIMAL(10,2) null , `Total` DECIMAL(10,2) null ) CHARSET utf8", $silent, array( "ALTER TABLE `WHJournal` CHANGE `date` `Date` DATE null ","ALTER TABLE `WHJournal` CHANGE `Date` `Date` DATE null ","ALTER TABLE `WHJournal` CHANGE `freightype` `Freightype` VARCHAR(40) null default 'AIR FREIGHT' ","ALTER TABLE `WHJournal` CHANGE `invoices` `Invoices` VARCHAR(40) null ","ALTER TABLE `WHJournal` CHANGE `warehouse` `Warehouse` VARCHAR(40) null ","ALTER TABLE `WHJournal` CHANGE `tracking` `Tracking` VARCHAR(40) null ","ALTER TABLE `WHJournal` CHANGE `boxes` `Boxes` VARCHAR(40) null "));
		setupTable('CRM', "create table if not exists `CRM` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Customer` INT unsigned null , `Interaction` VARCHAR(40) null default 'INBOUND' , `Inboundtype` VARCHAR(40) null default 'WHATSAPP' , `Type` VARCHAR(40) null , `Description` TEXT null , `Comments` TEXT null , `Priority` VARCHAR(40) null , `Status` VARCHAR(40) null , `Timestamp` DATETIME null , `Sent` BLOB null , `Assigned` INT unsigned null , `Url` VARCHAR(200) null ) CHARSET utf8", $silent, array( "ALTER TABLE `CRM` CHANGE `customer` `Customer` INT unsigned null ","ALTER TABLE `CRM` CHANGE `inboundtype` `Inboundtype` VARCHAR(40) null default 'WHATSAPP' ","ALTER TABLE `CRM` CHANGE `type` `Type` VARCHAR(40) null ","ALTER TABLE `CRM` CHANGE `comments` `Comments` TEXT null ","ALTER TABLE `CRM` CHANGE `Comments` `Comments` TEXT null ","ALTER TABLE `CRM` CHANGE `priority` `Priority` VARCHAR(40) null ","ALTER TABLE `CRM` CHANGE `timestamp` `Timestamp` DATETIME null ","ALTER TABLE `CRM` CHANGE `sent` `Sent` BLOB null ","ALTER TABLE `CRM` CHANGE `assigned` `Assigned` INT unsigned null ","ALTER TABLE `CRM` CHANGE `url` `Url` VARCHAR(200) null "));
		setupIndexes('CRM', array('Customer','Assigned'));
		setupTable('Payroll', "create table if not exists `Payroll` (   `id` INT unsigned not null auto_increment , primary key (`id`), `employee` INT unsigned null , `date` DATE null , `start` VARCHAR(40) null , `stop` VARCHAR(40) null , `horas` DECIMAL(10,2) null , `comment` TEXT null , `value` VARCHAR(40) null ) CHARSET utf8", $silent, array( "ALTER TABLE `Payroll` CHANGE `employee` `Employee` INT unsigned null ","ALTER TABLE `Payroll` CHANGE `date` `Date` DATE null ","ALTER TABLE `Payroll` CHANGE `Date` `Date` DATE null ","ALTER TABLE `Payroll` CHANGE `start` `Start` VARCHAR(40) null ","ALTER TABLE `Payroll` CHANGE `stop` `Stop` VARCHAR(40) null ","ALTER TABLE `Payroll` CHANGE `horas` `Horas` DECIMAL(10,2) null ","ALTER TABLE `Payroll` CHANGE `comment` `Comment` TEXT null ","ALTER TABLE Payroll ADD `field8` VARCHAR(40)","ALTER TABLE `Payroll` CHANGE `field8` `value` VARCHAR(40) null ","ALTER TABLE `Payroll` CHANGE `Comment` `comment` TEXT null ","ALTER TABLE `Payroll` CHANGE `Horas` `horas` DECIMAL(10,2) null ","ALTER TABLE `Payroll` CHANGE `Stop` `stop` VARCHAR(40) null ","ALTER TABLE `Payroll` CHANGE `Start` `start` VARCHAR(40) null ","ALTER TABLE `Payroll` CHANGE `Date` `date` DATE null ","ALTER TABLE `Payroll` CHANGE `date` `date` DATE null ","ALTER TABLE `Payroll` CHANGE `Employee` `employee` INT unsigned null "));
		setupIndexes('Payroll', array('employee'));
		setupTable('Brand', "create table if not exists `Brand` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Brand` VARCHAR(40) null ) CHARSET utf8", $silent);
		setupTable('Model', "create table if not exists `Model` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Model` VARCHAR(40) null , `Brand` INT unsigned null ) CHARSET utf8", $silent);
		setupIndexes('Model', array('Brand'));
		setupTable('System', "create table if not exists `System` (   `id` INT unsigned not null auto_increment , primary key (`id`), `System` VARCHAR(40) null ) CHARSET utf8", $silent);
		setupTable('Part', "create table if not exists `Part` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Part` VARCHAR(40) null , `System` INT unsigned null ) CHARSET utf8", $silent);
		setupIndexes('Part', array('System'));
		setupTable('DatabaseAUTO', "create table if not exists `DatabaseAUTO` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Type` VARCHAR(40) null , `Brand` INT unsigned null , `Model` INT unsigned null , `Year` VARCHAR(40) null , `System` INT unsigned null , `Part` INT unsigned null , `PartNO` TEXT null , `Dimensions` VARCHAR(40) null , `Volume` DECIMAL(10,2) null , `Weight` DECIMAL(10,2) null , `AirFreight` DECIMAL(10,2) null , `OceanFreight` DECIMAL(10,2) null , `Picture` VARCHAR(40) null ) CHARSET utf8", $silent);
		setupIndexes('DatabaseAUTO', array('Brand','Model','System','Part'));
		setupTable('GeneralDB', "create table if not exists `GeneralDB` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Description` TEXT null , `Dimensions` VARCHAR(40) null , `Vweight` DECIMAL(10,2) null , `Rweight` DECIMAL(10,2) null , `Ofreight` DECIMAL(10,2) null , `Afreight` DECIMAL(10,2) null , `photo` VARCHAR(40) null ) CHARSET utf8", $silent, array( "ALTER TABLE `generalDB` RENAME `GeneralDB`","UPDATE `membership_userrecords` SET `tableName`='GeneralDB' where `tableName`='generalDB'","UPDATE `membership_userpermissions` SET `tableName`='GeneralDB' where `tableName`='generalDB'","UPDATE `membership_grouppermissions` SET `tableName`='GeneralDB' where `tableName`='generalDB'","ALTER TABLE `GeneralDB` CHANGE `description` `Description` TEXT null ","ALTER TABLE `GeneralDB` CHANGE `comments` `comments` TEXT null ","ALTER TABLE `GeneralDB` CHANGE `dimensions` `Dimensions` VARCHAR(40) null ","ALTER TABLE `GeneralDB` CHANGE `vweight` `Vweight` DECIMAL(10,2) null ","ALTER TABLE `GeneralDB` CHANGE `rweight` `Rweight` DECIMAL(10,2) null ","ALTER TABLE `GeneralDB` CHANGE `ofreight` `Ofreight` DECIMAL(10,2) null ","ALTER TABLE `GeneralDB` CHANGE `afreight` `Afreight` DECIMAL(10,2) null "));
		setupTable('CustomerAuto', "create table if not exists `CustomerAuto` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Customer` INT unsigned null , `VehicleType` VARCHAR(40) null , `VIN` TEXT null , `Brand` INT unsigned null , `Model` INT unsigned null , `Year` INT unsigned null , `EngineNo` TEXT null , `Cylinder` VARCHAR(40) null , `Liters` TEXT null , `Transmission` VARCHAR(40) null , `GEAR` VARCHAR(40) null , `URL` TEXT null ) CHARSET utf8", $silent, array( "ALTER TABLE `CustomerAuto` CHANGE `customer` `Customer` INT unsigned null ","ALTER TABLE `CustomerAuto` CHANGE `transmission` `Transmission` VARCHAR(40) null "));
		setupIndexes('CustomerAuto', array('Customer','Brand','Model'));
		setupTable('Compras', "create table if not exists `Compras` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Customer` INT unsigned null , `Employee` INT unsigned null , `Description` INT unsigned null , `Url` VARCHAR(200) null , `Total` DECIMAL(10,2) null , `Odate` DATE null , `ETA` DATE null , `Status` VARCHAR(40) null default 'UNPAID' ) CHARSET utf8", $silent, array( "ALTER TABLE `Compras` CHANGE `customer` `Customer` INT unsigned null ","ALTER TABLE `Compras` CHANGE `description` `Description` INT unsigned null ","ALTER TABLE `Compras` CHANGE `comments` `comments` TEXT null ","ALTER TABLE `Compras` CHANGE `URL` `Url` VARCHAR(200) null ","ALTER TABLE `Compras` CHANGE `total` `Total` DECIMAL(10,2) null ","ALTER TABLE `Compras` CHANGE `status` `Status` VARCHAR(40) null default 'UNPAID' "));
		setupIndexes('Compras', array('Customer','Employee','Description'));
		setupTable('TrackingCenter', "create table if not exists `TrackingCenter` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Date` DATE null , `Name` INT unsigned not null , `Zone` INT unsigned null , `Tracking` INT unsigned not null , `Carrier` VARCHAR(40) null , `Trackingurl` TEXT null , `CustStatus` VARCHAR(40) null default 'OPEN' , `TRADEXXstatus` VARCHAR(40) null default 'OPEN' , `Freight` VARCHAR(40) null , `Comments` TEXT null ) CHARSET utf8", $silent, array( "ALTER TABLE `trackingcenter` RENAME `TrackingCenter`","UPDATE `membership_userrecords` SET `tableName`='TrackingCenter' where `tableName`='trackingcenter'","UPDATE `membership_userpermissions` SET `tableName`='TrackingCenter' where `tableName`='trackingcenter'","UPDATE `membership_grouppermissions` SET `tableName`='TrackingCenter' where `tableName`='trackingcenter'","ALTER TABLE `TrackingCenter` CHANGE `date` `Date` DATE null ","ALTER TABLE `TrackingCenter` CHANGE `Date` `Date` DATE null ","ALTER TABLE `TrackingCenter` CHANGE `name` `Name` INT unsigned not null ","ALTER TABLE `TrackingCenter` CHANGE `tracking` `Tracking` INT unsigned not null ","ALTER TABLE `TrackingCenter` CHANGE `carrier` `Carrier` VARCHAR(40) null ","ALTER TABLE `TrackingCenter` CHANGE `trackingurl` `Trackingurl` TEXT null ","ALTER TABLE `TrackingCenter` CHANGE `freight` `Freight` VARCHAR(40) null ","ALTER TABLE `TrackingCenter` CHANGE `comments` `Comments` TEXT null ","ALTER TABLE `TrackingCenter` CHANGE `Comments` `Comments` TEXT null "));
		setupIndexes('TrackingCenter', array('Name','Tracking'));
		setupTable('Claim', "create table if not exists `Claim` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Date` DATE null , `Invoice` TEXT null , `Warehouse` INT unsigned null , `Tracking` INT unsigned null , `Selecteds` VARCHAR(40) null , `Shippingt` VARCHAR(40) null , `Status` VARCHAR(40) not null ) CHARSET utf8", $silent, array( "ALTER TABLE `claim` RENAME `Claim`","UPDATE `membership_userrecords` SET `tableName`='Claim' where `tableName`='claim'","UPDATE `membership_userpermissions` SET `tableName`='Claim' where `tableName`='claim'","UPDATE `membership_grouppermissions` SET `tableName`='Claim' where `tableName`='claim'","ALTER TABLE `Claim` CHANGE `DATE` `Date` DATE null ","ALTER TABLE `Claim` CHANGE `Date` `Date` DATE null ","ALTER TABLE `Claim` CHANGE `invoice` `Invoice` TEXT null ","ALTER TABLE `Claim` CHANGE `warehouse` `Warehouse` INT unsigned null ","ALTER TABLE `Claim` CHANGE `tracking` `Tracking` INT unsigned null ","ALTER TABLE `Claim` CHANGE `selecteds` `Selecteds` VARCHAR(40) null ","ALTER TABLE `Claim` CHANGE `shippingt` `Shippingt` VARCHAR(40) null ","ALTER TABLE `Claim` CHANGE `STATUS` `Status` VARCHAR(40) not null "));
		setupIndexes('Claim', array('Warehouse','Tracking'));
		setupTable('Activities', "create table if not exists `Activities` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Date` DATE null , `Description` TEXT null , `Comment` TEXT null , `Priority` VARCHAR(40) null , `Assigned` INT unsigned null , `Completed` BLOB null , `Stop` DATETIME null ) CHARSET utf8", $silent, array( "ALTER TABLE `Activities` CHANGE `date` `Date` DATETIME null ","ALTER TABLE `Activities` CHANGE `Date` `Date` DATE null ","ALTER TABLE `Activities` CHANGE `description` `Description` TEXT null ","ALTER TABLE `Activities` CHANGE `comments` `comments` TEXT null ","ALTER TABLE `Activities` CHANGE `comment` `Comment` TEXT null ","ALTER TABLE `Activities` CHANGE `assigned` `Assigned` INT unsigned null ","ALTER TABLE `Activities` CHANGE `completed` `Completed` BLOB null ","ALTER TABLE `Activities` CHANGE `stop` `Stop` DATETIME null "));
		setupIndexes('Activities', array('Assigned'));
		setupTable('Return', "create table if not exists `Return` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Date` DATE null , `Invoice` TEXT null , `Warehouse` INT unsigned null , `Tracking` INT unsigned null , `Shippingt` VARCHAR(40) null , `Status` VARCHAR(40) not null , `Amount` DECIMAL(10,2) null , `Refund` BLOB null ) CHARSET utf8", $silent, array( "ALTER TABLE `Return` CHANGE `DATE` `Date` DATE null ","ALTER TABLE `Return` CHANGE `Date` `Date` DATE null ","ALTER TABLE `Return` CHANGE `invoice` `Invoice` TEXT null ","ALTER TABLE `Return` CHANGE `warehouse` `Warehouse` INT unsigned null ","ALTER TABLE `Return` CHANGE `tracking` `Tracking` INT unsigned null ","ALTER TABLE `Return` CHANGE `shippingt` `Shippingt` VARCHAR(40) null ","ALTER TABLE `Return` CHANGE `STATUS` `Status` VARCHAR(40) not null "));
		setupIndexes('Return', array('Warehouse','Tracking'));
		setupTable('Department', "create table if not exists `Department` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Department` VARCHAR(40) null ) CHARSET utf8", $silent);
		setupTable('Position', "create table if not exists `Position` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Position` VARCHAR(40) null , `Department` INT unsigned null ) CHARSET utf8", $silent);
		setupIndexes('Position', array('Department'));
		setupTable('CEO', "create table if not exists `CEO` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Chief` VARCHAR(40) null , `Department` INT unsigned null ) CHARSET utf8", $silent);
		setupIndexes('CEO', array('Department'));
		setupTable('Manager', "create table if not exists `Manager` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Manager` VARCHAR(40) null , `Department` INT unsigned null ) CHARSET utf8", $silent);
		setupIndexes('Manager', array('Department'));
		setupTable('Supervisor', "create table if not exists `Supervisor` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Supervisor` VARCHAR(40) null , `Department` INT unsigned null ) CHARSET utf8", $silent);
		setupIndexes('Supervisor', array('Department'));
		setupTable('Losses', "create table if not exists `Losses` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Customer` INT unsigned null , `Description` TEXT null , `Saleprice` DECIMAL(10,2) null , `OperationCost` DECIMAL(10,2) null , `Lost` DECIMAL(10,2) null , `Comment` TEXT null , `Recovered` DECIMAL(10,2) null , `Balance` DECIMAL(10,2) null , `Status` VARCHAR(40) null ) CHARSET utf8", $silent, array( "ALTER TABLE `Losses` CHANGE `customer` `Customer` INT unsigned null "));
		setupIndexes('Losses', array('Customer'));
		setupTable('Subscriptions', "create table if not exists `Subscriptions` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Customer` INT unsigned null , `Vendor` VARCHAR(40) null , `AccountID` TEXT null , `LastPayment` DATE null , `DueDate` DATE null , `Status` VARCHAR(40) null , `Rate` DECIMAL(10,2) null , `AmountDue` DECIMAL(10,2) null ) CHARSET utf8", $silent, array( "ALTER TABLE `Subscriptions` CHANGE `customer` `Customer` INT unsigned null ","ALTER TABLE `Subscriptions` CHANGE `vendor` `Vendor` VARCHAR(40) null ","ALTER TABLE `Subscriptions` CHANGE `accountID` `AccountID` TEXT null ","ALTER TABLE `Subscriptions` CHANGE `dueDate` `DueDate` DATE null ","ALTER TABLE `Subscriptions` CHANGE `status` `Status` VARCHAR(40) null ","ALTER TABLE `Subscriptions` CHANGE `rate` `Rate` DECIMAL(10,2) null ","ALTER TABLE `Subscriptions` CHANGE `amountDue` `AmountDue` DECIMAL(10,2) null "));
		setupIndexes('Subscriptions', array('Customer'));
		setupTable('Accounting', "create table if not exists `Accounting` (   `id` INT unsigned not null auto_increment , primary key (`id`), `date` DATE null , `description` TEXT null , `master_acount` INT unsigned null , `account` INT unsigned null , `sub_account` INT unsigned null , `type` INT unsigned null , `amount` DECIMAL(10,2) null , `balance` DECIMAL(10,2) null ) CHARSET utf8", $silent, array( "ALTER TABLE `Accounting` CHANGE `date` `Date` DATETIME null ","ALTER TABLE `Accounting` CHANGE `Date` `Date` DATE null ","ALTER TABLE `Accounting` CHANGE `Date` `date` DATE null ","ALTER TABLE `Accounting` CHANGE `date` `date` DATE null ","ALTER TABLE `Accounting` CHANGE `Description` `description` TEXT null ","ALTER TABLE `Accounting` CHANGE `comments` `comments` TEXT null ","ALTER TABLE `Accounting` CHANGE `MasterAccount` `master_acount` INT unsigned null ","ALTER TABLE `Accounting` CHANGE `SubAccount` `sub_account` INT unsigned null ","ALTER TABLE `Accounting` CHANGE `Type` `t` INT unsigned null ","ALTER TABLE `Accounting` CHANGE `t` `type` INT unsigned null ","ALTER TABLE `Accounting` CHANGE `Amount` `amount` DECIMAL(10,2) null ","ALTER TABLE `Accounting` CHANGE `Balance` `balance` DECIMAL(10,2) null ","ALTER TABLE Accounting ADD `field9` VARCHAR(40)","ALTER TABLE `Accounting` CHANGE `field9` `account` VARCHAR(40) null "));
		setupIndexes('Accounting', array('master_acount','account','sub_account'));
		setupTable('MasterAccount', "create table if not exists `MasterAccount` (   `id` INT unsigned not null auto_increment , primary key (`id`), `masterAccount` VARCHAR(40) null ) CHARSET utf8", $silent, array( "ALTER TABLE `MASTERACCOUNT` RENAME `MasterAccount`","UPDATE `membership_userrecords` SET `tableName`='MasterAccount' where `tableName`='MASTERACCOUNT'","UPDATE `membership_userpermissions` SET `tableName`='MasterAccount' where `tableName`='MASTERACCOUNT'","UPDATE `membership_grouppermissions` SET `tableName`='MasterAccount' where `tableName`='MASTERACCOUNT'","ALTER TABLE `MasterAccount` DROP `Account`","ALTER TABLE `MasterAccount` CHANGE `Subaccount` `masterAccount` VARCHAR(40) null "));
		setupTable('Account', "create table if not exists `Account` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Account` VARCHAR(40) null , `masterAccount` INT unsigned null ) CHARSET utf8", $silent, array( "ALTER TABLE `ACCOUNT` RENAME `Account`","UPDATE `membership_userrecords` SET `tableName`='Account' where `tableName`='ACCOUNT'","UPDATE `membership_userpermissions` SET `tableName`='Account' where `tableName`='ACCOUNT'","UPDATE `membership_grouppermissions` SET `tableName`='Account' where `tableName`='ACCOUNT'","ALTER TABLE Account ADD `field3` VARCHAR(40)","ALTER TABLE `Account` CHANGE `field3` `master_account` VARCHAR(40) null ","ALTER TABLE `Account` CHANGE `master_account` `masterAccount` VARCHAR(40) null "));
		setupIndexes('Account', array('masterAccount'));
		setupTable('SubAccount', "create table if not exists `SubAccount` (   `id` INT unsigned not null auto_increment , primary key (`id`), `account` INT unsigned null , `subAccount` VARCHAR(40) null ) CHARSET utf8", $silent, array( "ALTER TABLE `table43` RENAME `SubAccount`","UPDATE `membership_userrecords` SET `tableName`='SubAccount' where `tableName`='table43'","UPDATE `membership_userpermissions` SET `tableName`='SubAccount' where `tableName`='table43'","UPDATE `membership_grouppermissions` SET `tableName`='SubAccount' where `tableName`='table43'","ALTER TABLE SubAccount ADD `field1` VARCHAR(40)","ALTER TABLE `SubAccount` CHANGE `field1` `id` VARCHAR(40) null ","ALTER TABLE `SubAccount` CHANGE `id` `id` INT unsigned not null auto_increment ","ALTER TABLE SubAccount ADD `field2` VARCHAR(40)","ALTER TABLE `SubAccount` CHANGE `field2` `SubAccount` VARCHAR(40) null ","ALTER TABLE SubAccount ADD `field3` VARCHAR(40)","ALTER TABLE `SubAccount` CHANGE `field3` `type` VARCHAR(40) null ","ALTER TABLE SubAccount ADD `field4` VARCHAR(40)","ALTER TABLE `SubAccount` CHANGE `field4` `account` VARCHAR(40) null ","ALTER TABLE `SubAccount` CHANGE `SubAccount` `subAccount` VARCHAR(40) null ","ALTER TABLE `SubAccount` DROP `type`"));
		setupIndexes('SubAccount', array('account'));
		setupTable('Type', "create table if not exists `Type` (   `id` INT unsigned not null auto_increment , primary key (`id`), `type` VARCHAR(40) null ) CHARSET utf8", $silent, array( "ALTER TABLE `Type` DROP `Account`","ALTER TABLE `Type` DROP `IDSubaccount`","ALTER TABLE `Type` CHANGE `Subaccount` `type` VARCHAR(40) null "));
		setupTable('CCJournal', "create table if not exists `CCJournal` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Card` INT unsigned null , `Date` DATE null , `Description` TEXT null , `Cleared` BLOB null , `Amount` VARCHAR(40) null , `Balance` DECIMAL(10,2) null , `Logged` INT unsigned not null , `Photo` VARCHAR(40) null ) CHARSET utf8", $silent, array( "ALTER TABLE `CCJournal` CHANGE `date` `Date` DATETIME null ","ALTER TABLE `CCJournal` CHANGE `Date` `Date` DATE null "));
		setupIndexes('CCJournal', array('Card','Logged'));
		setupTable('CC', "create table if not exists `CC` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Card` VARCHAR(40) null ) CHARSET utf8", $silent);
		setupTable('Receivable', "create table if not exists `Receivable` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Customer` INT unsigned null , `Phone` INT unsigned null , `Description` TEXT null , `Interaction` TEXT null , `ExpectedDate` DATE null , `LastUpdate` DATETIME null , `Status` VARCHAR(40) null default 'OPEN' , `Assigned` INT unsigned null , `Amount` DECIMAL(10,2) null ) CHARSET utf8", $silent);
		setupIndexes('Receivable', array('Customer','Assigned'));


		// save MD5
		if($fp=@fopen(dirname(__FILE__).'/setup.md5', 'w')) {
			fwrite($fp, $thisMD5);
			fclose($fp);
		}
	}


	function setupIndexes($tableName, $arrFields) {
		if(!is_array($arrFields)) {
			return false;
		}

		foreach($arrFields as $fieldName) {
			if(!$res=@db_query("SHOW COLUMNS FROM `$tableName` like '$fieldName'")) {
				continue;
			}
			if(!$row=@db_fetch_assoc($res)) {
				continue;
			}
			if($row['Key']=='') {
				@db_query("ALTER TABLE `$tableName` ADD INDEX `$fieldName` (`$fieldName`)");
			}
		}
	}


	function setupTable($tableName, $createSQL='', $silent=true, $arrAlter='') {
		global $Translation;
		ob_start();

		echo '<div style="padding: 5px; border-bottom:solid 1px silver; font-family: verdana, arial; font-size: 10px;">';

		// is there a table rename query?
		if(is_array($arrAlter)) {
			$matches=array();
			if(preg_match("/ALTER TABLE `(.*)` RENAME `$tableName`/", $arrAlter[0], $matches)) {
				$oldTableName=$matches[1];
			}
		}

		if($res=@db_query("select count(1) from `$tableName`")) { // table already exists
			if($row = @db_fetch_array($res)) {
				echo str_replace("<TableName>", $tableName, str_replace("<NumRecords>", $row[0],$Translation["table exists"]));
				if(is_array($arrAlter)) {
					echo '<br>';
					foreach($arrAlter as $alter) {
						if($alter!='') {
							echo "$alter ... ";
							if(!@db_query($alter)) {
								echo '<span class="label label-danger">' . $Translation['failed'] . '</span>';
								echo '<div class="text-danger">' . $Translation['mysql said'] . ' ' . db_error(db_link()) . '</div>';
							}else{
								echo '<span class="label label-success">' . $Translation['ok'] . '</span>';
							}
						}
					}
				}else{
					echo $Translation["table uptodate"];
				}
			}else{
				echo str_replace("<TableName>", $tableName, $Translation["couldnt count"]);
			}
		}else{ // given tableName doesn't exist

			if($oldTableName!='') { // if we have a table rename query
				if($ro=@db_query("select count(1) from `$oldTableName`")) { // if old table exists, rename it.
					$renameQuery=array_shift($arrAlter); // get and remove rename query

					echo "$renameQuery ... ";
					if(!@db_query($renameQuery)) {
						echo '<span class="label label-danger">' . $Translation['failed'] . '</span>';
						echo '<div class="text-danger">' . $Translation['mysql said'] . ' ' . db_error(db_link()) . '</div>';
					}else{
						echo '<span class="label label-success">' . $Translation['ok'] . '</span>';
					}

					if(is_array($arrAlter)) setupTable($tableName, $createSQL, false, $arrAlter); // execute Alter queries on renamed table ...
				}else{ // if old tableName doesn't exist (nor the new one since we're here), then just create the table.
					setupTable($tableName, $createSQL, false); // no Alter queries passed ...
				}
			}else{ // tableName doesn't exist and no rename, so just create the table
				echo str_replace("<TableName>", $tableName, $Translation["creating table"]);
				if(!@db_query($createSQL)) {
					echo '<span class="label label-danger">' . $Translation['failed'] . '</span>';
					echo '<div class="text-danger">' . $Translation['mysql said'] . db_error(db_link()) . '</div>';
				}else{
					echo '<span class="label label-success">' . $Translation['ok'] . '</span>';
				}
			}
		}

		echo "</div>";

		$out=ob_get_contents();
		ob_end_clean();
		if(!$silent) {
			echo $out;
		}
	}
?>