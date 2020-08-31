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
		setupTable('Customers', "create table if not exists `Customers` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Title` VARCHAR(40) null , `Customer` VARCHAR(40) null , `Birthdate` DATE null , `Type` INT unsigned null , `Phone` VARCHAR(40) null , `Email` VARCHAR(80) null , `Address` VARCHAR(40) null , `City` INT unsigned null , `Province` INT unsigned null , `Country` INT unsigned null , `Status` VARCHAR(40) null default 'ACTIVE' ) CHARSET utf8", $silent);
		setupIndexes('Customers', array('Type','City','Province','Country'));
		setupTable('Retention', "create table if not exists `Retention` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Customer` INT unsigned null , `Phone` INT unsigned null , `Email` INT unsigned null , `Zone` INT unsigned null , `Interaction` TEXT null , `GIFTPACKAGE` TEXT null , `Assigned` INT unsigned null , `Status` VARCHAR(40) null default 'OPEN' , `CreateDate` DATETIME null , `ResolutionDate` DATETIME null ) CHARSET utf8", $silent);
		setupIndexes('Retention', array('Customer','Assigned'));
		setupTable('Alert', "create table if not exists `Alert` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Customer` INT unsigned null , `Satus` VARCHAR(40) null , `Comment` TEXT null , `Date` DATETIME null ) CHARSET utf8", $silent);
		setupIndexes('Alert', array('Customer'));
		setupTable('CustomerClass', "create table if not exists `CustomerClass` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Type` VARCHAR(40) null ) CHARSET utf8", $silent);
		setupTable('Staff', "create table if not exists `Staff` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Photo` VARCHAR(40) null , `Employee` VARCHAR(40) null , `Birthdate` DATE null , `Phone` VARCHAR(40) null , `Email` VARCHAR(80) null , `Address` VARCHAR(40) null , `City` INT unsigned null , `Province` INT unsigned null , `Country` INT unsigned null , `hireDate` DATE null , `Department` INT unsigned null , `Position` INT unsigned null , `Supervisor` INT unsigned null , `Manager` INT unsigned null , `Director` INT unsigned null , `Status` VARCHAR(40) null , `EmergencyContact` TEXT null , `EmergencyPhone` TEXT null ) CHARSET utf8", $silent);
		setupIndexes('Staff', array('City','Province','Country','Department','Position','Supervisor','Manager','Director'));
		setupTable('Country', "create table if not exists `Country` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Country` VARCHAR(40) null ) CHARSET utf8", $silent);
		setupTable('Province', "create table if not exists `Province` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Province` VARCHAR(40) null , `Country` INT unsigned null ) CHARSET utf8", $silent);
		setupIndexes('Province', array('Country'));
		setupTable('City', "create table if not exists `City` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Province` INT unsigned null , `City` VARCHAR(40) null ) CHARSET utf8", $silent);
		setupIndexes('City', array('Province'));
		setupTable('Warehouse', "create table if not exists `Warehouse` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Warehouse` VARCHAR(40) null , `Date` DATE null , `Freight` VARCHAR(40) null ) CHARSET utf8", $silent);
		setupTable('Tracking', "create table if not exists `Tracking` (   `id` INT unsigned not null auto_increment , primary key (`id`), `WhID` INT unsigned null , `Date` INT unsigned null default '1' , `Warehouse` INT unsigned null , `Tracking` VARCHAR(40) null , `Customer` INT unsigned null , `Dimensions` VARCHAR(40) null , `Weight` DECIMAL(10,2) null , `Volume` DECIMAL(10,2) null , `Total` DECIMAL(10,2) null , `Employee` INT unsigned null , `Freight` INT unsigned null , `Status` VARCHAR(40) null default 'READY FOR PICK UP' , `Zone` INT unsigned null , `DeliveredDate` DATETIME null ) CHARSET utf8", $silent);
		setupIndexes('Tracking', array('Warehouse','Customer','Employee'));
		setupTable('Status', "create table if not exists `Status` (   `id` INT unsigned not null auto_increment , primary key (`id`), `TrackID` INT unsigned null , `Invoice` INT unsigned null , `Tracking` INT unsigned null , `Dimensions` INT unsigned null , `RWeight` INT unsigned null , `VWeight` INT unsigned null , `Total` INT unsigned null , `FreightType` VARCHAR(40) not null , `DeliveryDate` DATETIME null , `Delivered` BLOB null ) CHARSET utf8", $silent);
		setupIndexes('Status', array('Invoice','Tracking'));
		setupTable('Invoice', "create table if not exists `Invoice` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Date` DATE null , `Title` INT unsigned null , `Customer` INT unsigned null , `Phone` INT unsigned null , `Email` INT unsigned null , `Address` INT unsigned null , `City` INT unsigned null , `Country` INT unsigned null , `PaymentStatus` VARCHAR(40) null default 'UNPAID' , `AmountDUE` DECIMAL(10,2) null , `AmountPAID` DECIMAL(10,2) null , `Balance` DECIMAL(10,2) null , `Status` VARCHAR(40) null default 'OPEN' , `tax` VARCHAR(40) null , `Total` VARCHAR(40) null ) CHARSET utf8", $silent);
		setupIndexes('Invoice', array('Customer'));
		setupTable('InvoiceDetails', "create table if not exists `InvoiceDetails` (   `id` INT unsigned not null auto_increment , primary key (`id`), `invoice` INT unsigned null , `order` INT null , `product` INT unsigned null , `qty` DECIMAL(10,2) null , `itemSale` INT unsigned null , `SubTotal` VARCHAR(40) null ) CHARSET utf8", $silent, array( "ALTER TABLE `InvoiceDetails` DROP `Ite`"));
		setupIndexes('InvoiceDetails', array('invoice','product'));
		setupTable('Products', "create table if not exists `Products` (   `id` INT unsigned not null auto_increment , primary key (`id`), `code` VARCHAR(40) null , `item` VARCHAR(40) null , `cost` DECIMAL(10,2) null default '0.00' , `profit` DECIMAL(10,2) null , `itemSale` DECIMAL(10,2) null , `uploads` VARCHAR(40) null ) CHARSET utf8", $silent);
		setupTable('WHJournal', "create table if not exists `WHJournal` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Date` DATE null , `Freightype` VARCHAR(40) null default 'AIR FREIGHT' , `Invoices` VARCHAR(40) null , `Warehouse` VARCHAR(40) null , `Tracking` VARCHAR(40) null , `GroundFreight` TEXT null , `Boxes` VARCHAR(40) null , `Dimensions` VARCHAR(40) null , `Volume` DECIMAL(10,2) null , `Weight` DECIMAL(10,2) null , `InternationalFreight` DECIMAL(10,2) null , `LocalFreight` DECIMAL(10,2) null , `Tip` DECIMAL(10,2) null , `Total` DECIMAL(10,2) null ) CHARSET utf8", $silent);
		setupTable('CRM', "create table if not exists `CRM` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Customer` INT unsigned null , `Interaction` VARCHAR(40) null default 'INBOUND' , `Inboundtype` VARCHAR(40) null default 'WHATSAPP' , `Type` VARCHAR(40) null , `Description` TEXT null , `Comments` TEXT null , `Priority` VARCHAR(40) null , `Status` VARCHAR(40) null , `Timestamp` DATETIME null , `Sent` BLOB null , `Assigned` INT unsigned null , `Url` VARCHAR(200) null ) CHARSET utf8", $silent);
		setupIndexes('CRM', array('Customer','Assigned'));
		setupTable('Payroll', "create table if not exists `Payroll` (   `id` INT unsigned not null auto_increment , primary key (`id`), `employee` INT unsigned null , `date` DATE null , `start` VARCHAR(40) null , `stop` VARCHAR(40) null , `horas` DECIMAL(10,2) null , `comment` TEXT null , `value` VARCHAR(40) null ) CHARSET utf8", $silent);
		setupIndexes('Payroll', array('employee'));
		setupTable('Brand', "create table if not exists `Brand` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Brand` VARCHAR(40) null ) CHARSET utf8", $silent);
		setupTable('Model', "create table if not exists `Model` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Model` VARCHAR(40) null , `Brand` INT unsigned null ) CHARSET utf8", $silent);
		setupIndexes('Model', array('Brand'));
		setupTable('System', "create table if not exists `System` (   `id` INT unsigned not null auto_increment , primary key (`id`), `System` VARCHAR(40) null ) CHARSET utf8", $silent);
		setupTable('Part', "create table if not exists `Part` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Part` VARCHAR(40) null , `System` INT unsigned null ) CHARSET utf8", $silent);
		setupIndexes('Part', array('System'));
		setupTable('DatabaseAUTO', "create table if not exists `DatabaseAUTO` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Type` VARCHAR(40) null , `Brand` INT unsigned null , `Model` INT unsigned null , `Year` VARCHAR(40) null , `System` INT unsigned null , `Part` INT unsigned null , `PartNO` TEXT null , `Dimensions` VARCHAR(40) null , `Volume` DECIMAL(10,2) null , `Weight` DECIMAL(10,2) null , `AirFreight` DECIMAL(10,2) null , `OceanFreight` DECIMAL(10,2) null , `Picture` VARCHAR(40) null ) CHARSET utf8", $silent);
		setupIndexes('DatabaseAUTO', array('Brand','Model','System','Part'));
		setupTable('GeneralDB', "create table if not exists `GeneralDB` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Description` TEXT null , `Dimensions` VARCHAR(40) null , `Vweight` DECIMAL(10,2) null , `Rweight` DECIMAL(10,2) null , `Ofreight` DECIMAL(10,2) null , `Afreight` DECIMAL(10,2) null , `photo` VARCHAR(40) null ) CHARSET utf8", $silent);
		setupTable('CustomerAuto', "create table if not exists `CustomerAuto` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Customer` INT unsigned null , `VehicleType` VARCHAR(40) null , `VIN` TEXT null , `Brand` INT unsigned null , `Model` INT unsigned null , `Year` INT unsigned null , `EngineNo` TEXT null , `Cylinder` VARCHAR(40) null , `Liters` TEXT null , `Transmission` VARCHAR(40) null , `GEAR` VARCHAR(40) null , `URL` TEXT null ) CHARSET utf8", $silent);
		setupIndexes('CustomerAuto', array('Customer','Brand','Model'));
		setupTable('Compras', "create table if not exists `Compras` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Customer` INT unsigned null , `Employee` INT unsigned null , `Description` INT unsigned null , `Url` VARCHAR(200) null , `Total` DECIMAL(10,2) null , `Odate` DATE null , `ETA` DATE null , `Status` VARCHAR(40) null default 'UNPAID' ) CHARSET utf8", $silent);
		setupIndexes('Compras', array('Customer','Employee','Description'));
		setupTable('TrackingCenter', "create table if not exists `TrackingCenter` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Date` DATE null , `Name` INT unsigned not null , `Zone` INT unsigned null , `Tracking` INT unsigned not null , `Carrier` VARCHAR(40) null , `Trackingurl` TEXT null , `CustStatus` VARCHAR(40) null default 'OPEN' , `TRADEXXstatus` VARCHAR(40) null default 'OPEN' , `Freight` VARCHAR(40) null , `Comments` TEXT null ) CHARSET utf8", $silent);
		setupIndexes('TrackingCenter', array('Name','Tracking'));
		setupTable('Claim', "create table if not exists `Claim` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Date` DATE null , `Invoice` TEXT null , `Warehouse` INT unsigned null , `Tracking` INT unsigned null , `Selecteds` VARCHAR(40) null , `Shippingt` VARCHAR(40) null , `Status` VARCHAR(40) not null ) CHARSET utf8", $silent);
		setupIndexes('Claim', array('Warehouse','Tracking'));
		setupTable('Activities', "create table if not exists `Activities` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Date` DATE null , `Description` TEXT null , `Comment` TEXT null , `Priority` VARCHAR(40) null , `Assigned` INT unsigned null , `Completed` BLOB null , `Stop` DATETIME null ) CHARSET utf8", $silent);
		setupIndexes('Activities', array('Assigned'));
		setupTable('Return', "create table if not exists `Return` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Date` DATE null , `Invoice` TEXT null , `Warehouse` INT unsigned null , `Tracking` INT unsigned null , `Shippingt` VARCHAR(40) null , `Status` VARCHAR(40) not null , `Amount` DECIMAL(10,2) null , `Refund` BLOB null ) CHARSET utf8", $silent);
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
		setupTable('Losses', "create table if not exists `Losses` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Customer` INT unsigned null , `Description` TEXT null , `Saleprice` DECIMAL(10,2) null , `OperationCost` DECIMAL(10,2) null , `Lost` DECIMAL(10,2) null , `Comment` TEXT null , `Recovered` DECIMAL(10,2) null , `Balance` DECIMAL(10,2) null , `Status` VARCHAR(40) null ) CHARSET utf8", $silent);
		setupIndexes('Losses', array('Customer'));
		setupTable('Subscriptions', "create table if not exists `Subscriptions` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Customer` INT unsigned null , `Vendor` VARCHAR(40) null , `AccountID` TEXT null , `LastPayment` DATE null , `DueDate` DATE null , `Status` VARCHAR(40) null , `Rate` DECIMAL(10,2) null , `AmountDue` DECIMAL(10,2) null ) CHARSET utf8", $silent);
		setupIndexes('Subscriptions', array('Customer'));
		setupTable('Accounting', "create table if not exists `Accounting` (   `id` INT unsigned not null auto_increment , primary key (`id`), `date` DATE null , `description` TEXT null , `master_acount` INT unsigned null , `account` INT unsigned null , `sub_account` INT unsigned null , `type` INT unsigned null , `amount` DECIMAL(10,2) null , `balance` DECIMAL(10,2) null ) CHARSET utf8", $silent);
		setupIndexes('Accounting', array('master_acount','account','sub_account','type'));
		setupTable('MasterAccount', "create table if not exists `MasterAccount` (   `id` INT unsigned not null auto_increment , primary key (`id`), `masterAccount` VARCHAR(40) null ) CHARSET utf8", $silent);
		setupTable('Account', "create table if not exists `Account` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Account` VARCHAR(40) null , `masterAccount` INT unsigned null ) CHARSET utf8", $silent);
		setupIndexes('Account', array('masterAccount'));
		setupTable('SubAccount', "create table if not exists `SubAccount` (   `id` INT unsigned not null auto_increment , primary key (`id`), `account` INT unsigned null , `subAccount` VARCHAR(40) null ) CHARSET utf8", $silent);
		setupIndexes('SubAccount', array('account'));
		setupTable('Type', "create table if not exists `Type` (   `id` INT unsigned not null auto_increment , primary key (`id`), `type` VARCHAR(40) null ) CHARSET utf8", $silent);
		setupTable('CCJournal', "create table if not exists `CCJournal` (   `id` INT unsigned not null auto_increment , primary key (`id`), `Card` INT unsigned null , `Date` DATE null , `Description` TEXT null , `Cleared` BLOB null , `Amount` VARCHAR(40) null , `Balance` DECIMAL(10,2) null , `Logged` INT unsigned not null , `Photo` VARCHAR(40) null ) CHARSET utf8", $silent);
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