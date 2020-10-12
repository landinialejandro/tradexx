<?php

	#########################################################
	/*
	~~~~~~ LIST OF FUNCTIONS ~~~~~~
		getTableList() -- returns an associative array (tableName => tableData, tableData is array(tableCaption, tableDescription, tableIcon)) of tables accessible by current user
		get_table_groups() -- returns an associative array (table_group => tables_array)
		logInMember() -- checks POST login. If not valid, redirects to index.php, else returns TRUE
		getTablePermissions($tn) -- returns an array of permissions allowed for logged member to given table (allowAccess, allowInsert, allowView, allowEdit, allowDelete) -- allowAccess is set to true if any access level is allowed
		get_sql_fields($tn) -- returns the SELECT part of the table view query
		get_sql_from($tn[, true, [, false]]) -- returns the FROM part of the table view query, with full joins (unless third paramaeter is set to true), optionally skipping permissions if true passed as 2nd param.
		get_joined_record($table, $id[, true]) -- returns assoc array of record values for given PK value of given table, with full joins, optionally skipping permissions if true passed as 3rd param.
		get_defaults($table) -- returns assoc array of table fields as array keys and default values (or empty), excluding automatic values as array values
		htmlUserBar() -- returns html code for displaying user login status to be used on top of pages.
		showNotifications($msg, $class) -- returns html code for displaying a notification. If no parameters provided, processes the GET request for possible notifications.
		parseMySQLDate(a, b) -- returns a if valid mysql date, or b if valid mysql date, or today if b is true, or empty if b is false.
		parseCode(code) -- calculates and returns special values to be inserted in automatic fields.
		addFilter(i, filterAnd, filterField, filterOperator, filterValue) -- enforce a filter over data
		clearFilters() -- clear all filters
		loadView($view, $data) -- passes $data to templates/{$view}.php and returns the output
		loadTable($table, $data) -- loads table template, passing $data to it
		filterDropdownBy($filterable, $filterers, $parentFilterers, $parentPKField, $parentCaption, $parentTable, &$filterableCombo) -- applies cascading drop-downs for a lookup field, returns js code to be inserted into the page
		br2nl($text) -- replaces all variations of HTML <br> tags with a new line character
		htmlspecialchars_decode($text) -- inverse of htmlspecialchars()
		entitiesToUTF8($text) -- convert unicode entities (e.g. &#1234;) to actual UTF8 characters, requires multibyte string PHP extension
		func_get_args_byref() -- returns an array of arguments passed to a function, by reference
		permissions_sql($table, $level) -- returns an array containing the FROM and WHERE additions for applying permissions to an SQL query
		error_message($msg[, $back_url]) -- returns html code for a styled error message .. pass explicit false in second param to suppress back button
		toMySQLDate($formattedDate, $sep = datalist_date_separator, $ord = datalist_date_format)
		reIndex(&$arr) -- returns a copy of the given array, with keys replaced by 1-based numeric indices, and values replaced by original keys
		get_embed($provider, $url[, $width, $height, $retrieve]) -- returns embed code for a given url (supported providers: youtube, googlemap)
		check_record_permission($table, $id, $perm = 'view') -- returns true if current user has the specified permission $perm ('view', 'edit' or 'delete') for the given recors, false otherwise
		NavMenus($options) -- returns the HTML code for the top navigation menus. $options is not implemented currently.
		StyleSheet() -- returns the HTML code for included style sheet files to be placed in the <head> section.
		getUploadDir($dir) -- if dir is empty, returns upload dir configured in defaultLang.php, else returns $dir.
		PrepareUploadedFile($FieldName, $MaxSize, $FileTypes='jpg|jpeg|gif|png', $NoRename=false, $dir="") -- validates and moves uploaded file for given $FieldName into the given $dir (or the default one if empty)
		get_home_links($homeLinks, $default_classes, $tgroup) -- process $homeLinks array and return custom links for homepage. Applies $default_classes to links if links have classes defined, and filters links by $tgroup (using '*' matches all table_group values)
		quick_search_html($search_term, $label, $separate_dv = true) -- returns HTML code for the quick search box.
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	*/

	#########################################################

	function getTableList($skip_authentication = false) {
		$arrAccessTables = array();
		$arrTables = array(
			/* 'table_name' => ['table caption', 'homepage description', 'icon', 'table group name'] */   
			'Customers' => array('CUSTOMERS', '', 'resources/table_icons/Customers.png', 'CRM'),
			'Retention' => array('RETENTION', '', 'resources/table_icons/Customer.png', 'CRM'),
			'Alert' => array('CUSTOMER ALERT', '', 'resources/table_icons/Warning.png', 'CRM'),
			'CustomerClass' => array('CUSTOMER TYPE', '', 'resources/table_icons/Customer type.png', 'CRM'),
			'Staff' => array('STAFF', '', 'resources/table_icons/Staff.png', 'HR'),
			'Country' => array('Country', '', 'table.gif', 'hidden'),
			'Province' => array('Province', '', 'table.gif', 'hidden'),
			'City' => array('City', '', 'table.gif', 'hidden'),
			'Warehouse' => array('WAREHOUSE', '', 'resources/table_icons/Warehouse.png', 'Warehouse'),
			'Tracking' => array('TRACKING', '', 'resources/table_icons/Tracking center 1.png', 'Warehouse'),
			'Status' => array('STATUS', '', 'resources/table_icons/status.png', 'Warehouse'),
			'Invoice' => array('INVOICE', 'Documentos de cotizacion o faturas', 'resources/table_icons/Invoices.png', 'Accounting'),
			'InvoiceDetails' => array('Datails', '', 'resources/table_icons/basket_put.png', 'hidden'),
			'Products' => array('PRODUCTS', 'Products list', 'resources/table_icons/general.png', 'Accounting'),
			'WHJournal' => array('WH JOURNAL', '', 'resources/table_icons/WH Journal.png', 'Accounting'),
			'CRM' => array('CRM', '', 'resources/table_icons/CRM.png', 'CRM'),
			'Payroll' => array('PAYROLL', '', 'resources/table_icons/Subscriptions.png', 'HR'),
			'Brand' => array('Brand', '', 'table.gif', 'hidden'),
			'Model' => array('Model', '', 'table.gif', 'hidden'),
			'System' => array('System', '', 'table.gif', 'hidden'),
			'Part' => array('Part', '', 'table.gif', 'hidden'),
			'DatabaseAUTO' => array('CAR DATABASE', '', 'resources/table_icons/vehicle 1.png', 'Databases'),
			'GeneralDB' => array('GENERAL DATABASE', '', 'resources/table_icons/general.png', 'Databases'),
			'CustomerAuto' => array('CUSTOMER\'S VEHICLES', '', 'resources/table_icons/vehicle 1.png', 'Databases'),
			'Compras' => array('PURCHASE ORDERS', '', 'resources/table_icons/Products 1.png', 'CRM'),
			'TrackingCenter' => array('TRACKING CENTER', '', 'resources/table_icons/Tracking center 1.png', 'Warehouse'),
			'Claim' => array('CLAIM', '', 'resources/table_icons/Claim.png', 'Accounting'),
			'Activities' => array('ACTIVITIES', '', 'resources/table_icons/Staff.png', 'CRM'),
			'Return' => array('RETURN', '', 'resources/table_icons/Products 1.png', 'Accounting'),
			'Department' => array('Department', '', 'table.gif', 'hidden'),
			'Position' => array('Position', '', 'table.gif', 'hidden'),
			'CEO' => array('C.E.O.', '', 'table.gif', 'hidden'),
			'Manager' => array('MANAGER', '', 'table.gif', 'hidden'),
			'Supervisor' => array('SUPERVISOR', '', 'table.gif', 'hidden'),
			'Losses' => array('LOSSES', '', 'resources/table_icons/Losses.png', 'Accounting'),
			'Subscriptions' => array('SUSCRIPTIONS', '', 'resources/table_icons/Subscriptions.png', 'CRM'),
			'Accounting' => array('CASH FLOW', '', 'resources/table_icons/Cashflow.png', 'Accounting'),
			'AccountPlan' => array('Account Plan', '', 'resources/table_icons/chart_curve.png', 'Accounting'),
			'MasterAccount' => array('Master Account', '', 'table.gif', 'hidden'),
			'Account' => array('ACCOUNT', '', 'table.gif', 'hidden'),
			'SubAccount' => array('SubAccount', '', 'table.gif', 'hidden'),
			'Type' => array('Type', '', 'table.gif', 'hidden'),
			'CCJournal' => array('CC JOURNAL', '', 'resources/table_icons/Purchase order.png', 'Accounting'),
			'CC' => array('CC', '', 'table.gif', 'hidden'),
			'Receivable' => array('Receivable', '', 'resources/table_icons/Account receivable.png', 'Accounting')
		);
		if($skip_authentication || getLoggedAdmin()) return $arrTables;

		if(is_array($arrTables)) {
			foreach($arrTables as $tn => $tc) {
				$arrPerm = getTablePermissions($tn);
				if($arrPerm[0]) {
					$arrAccessTables[$tn] = $tc;
				}
			}
		}

		return $arrAccessTables;
	}

	#########################################################

	function get_table_groups($skip_authentication = false) {
		$tables = getTableList($skip_authentication);
		$all_groups = array('CRM', 'Warehouse', 'Databases', 'HR', 'Accounting', 'hidden');

		$groups = array();
		foreach($all_groups as $grp) {
			foreach($tables as $tn => $td) {
				if($td[3] && $td[3] == $grp) $groups[$grp][] = $tn;
				if(!$td[3]) $groups[0][] = $tn;
			}
		}

		return $groups;
	}

	#########################################################

	function getTablePermissions($tn) {
		static $table_permissions = array();
		if(isset($table_permissions[$tn])) return $table_permissions[$tn];

		$groupID = getLoggedGroupID();
		$memberID = makeSafe(getLoggedMemberID());
		$res_group = sql("select tableName, allowInsert, allowView, allowEdit, allowDelete from membership_grouppermissions where groupID='{$groupID}'", $eo);
		$res_user = sql("select tableName, allowInsert, allowView, allowEdit, allowDelete from membership_userpermissions where lcase(memberID)='{$memberID}'", $eo);

		while($row = db_fetch_assoc($res_group)) {
			$table_permissions[$row['tableName']] = array(
				1 => intval($row['allowInsert']),
				2 => intval($row['allowView']),
				3 => intval($row['allowEdit']),
				4 => intval($row['allowDelete']),
				'insert' => intval($row['allowInsert']),
				'view' => intval($row['allowView']),
				'edit' => intval($row['allowEdit']),
				'delete' => intval($row['allowDelete'])
			);
		}

		// user-specific permissions, if specified, overwrite his group permissions
		while($row = db_fetch_assoc($res_user)) {
			$table_permissions[$row['tableName']] = array(
				1 => intval($row['allowInsert']),
				2 => intval($row['allowView']),
				3 => intval($row['allowEdit']),
				4 => intval($row['allowDelete']),
				'insert' => intval($row['allowInsert']),
				'view' => intval($row['allowView']),
				'edit' => intval($row['allowEdit']),
				'delete' => intval($row['allowDelete'])
			);
		}

		// if user has any type of access, set 'access' flag
		foreach($table_permissions as $t => $p) {
			$table_permissions[$t]['access'] = $table_permissions[$t][0] = false;

			if($p['insert'] || $p['view'] || $p['edit'] || $p['delete']) {
				$table_permissions[$t]['access'] = $table_permissions[$t][0] = true;
			}
		}

		return $table_permissions[$tn];
	}

	#########################################################

	function get_sql_fields($table_name) {
		$sql_fields = array(
			'Customers' => "`Customers`.`id` as 'id', `Customers`.`Title` as 'Title', `Customers`.`Customer` as 'Customer', if(`Customers`.`Birthdate`,date_format(`Customers`.`Birthdate`,'%m/%d/%Y'),'') as 'Birthdate', IF(    CHAR_LENGTH(`CustomerClass1`.`Type`), CONCAT_WS('',   `CustomerClass1`.`Type`), '') as 'Type', `Customers`.`Phone` as 'Phone', `Customers`.`Email` as 'Email', `Customers`.`Address` as 'Address', IF(    CHAR_LENGTH(`City1`.`City`), CONCAT_WS('',   `City1`.`City`), '') as 'City', IF(    CHAR_LENGTH(`Province1`.`Province`), CONCAT_WS('',   `Province1`.`Province`), '') as 'Province', IF(    CHAR_LENGTH(`Country1`.`Country`), CONCAT_WS('',   `Country1`.`Country`), '') as 'Country', `Customers`.`Status` as 'Status'",
			'Retention' => "`Retention`.`id` as 'id', IF(    CHAR_LENGTH(`Customers1`.`Customer`), CONCAT_WS('',   `Customers1`.`Customer`), '') as 'Customer', IF(    CHAR_LENGTH(`Customers1`.`Phone`), CONCAT_WS('',   `Customers1`.`Phone`), '') as 'Phone', IF(    CHAR_LENGTH(`Customers1`.`Email`), CONCAT_WS('',   `Customers1`.`Email`), '') as 'Email', IF(    CHAR_LENGTH(`Province1`.`Province`), CONCAT_WS('',   `Province1`.`Province`), '') as 'Zone', `Retention`.`Interaction` as 'Interaction', `Retention`.`GIFTPACKAGE` as 'GIFTPACKAGE', IF(    CHAR_LENGTH(`Staff1`.`Employee`), CONCAT_WS('',   `Staff1`.`Employee`), '') as 'Assigned', `Retention`.`Status` as 'Status', if(`Retention`.`CreateDate`,date_format(`Retention`.`CreateDate`,'%m/%d/%Y %h:%i %p'),'') as 'CreateDate', if(`Retention`.`ResolutionDate`,date_format(`Retention`.`ResolutionDate`,'%m/%d/%Y %h:%i %p'),'') as 'ResolutionDate'",
			'Alert' => "`Alert`.`id` as 'id', IF(    CHAR_LENGTH(`Customers1`.`Customer`), CONCAT_WS('',   `Customers1`.`Customer`), '') as 'Customer', `Alert`.`Satus` as 'Satus', `Alert`.`Comment` as 'Comment', if(`Alert`.`Date`,date_format(`Alert`.`Date`,'%m/%d/%Y %h:%i %p'),'') as 'Date'",
			'CustomerClass' => "`CustomerClass`.`id` as 'id', `CustomerClass`.`Type` as 'Type'",
			'Staff' => "`Staff`.`id` as 'id', `Staff`.`Photo` as 'Photo', `Staff`.`Employee` as 'Employee', if(`Staff`.`Birthdate`,date_format(`Staff`.`Birthdate`,'%m/%d/%Y'),'') as 'Birthdate', `Staff`.`Phone` as 'Phone', `Staff`.`Email` as 'Email', `Staff`.`Address` as 'Address', IF(    CHAR_LENGTH(`City1`.`City`), CONCAT_WS('',   `City1`.`City`), '') as 'City', IF(    CHAR_LENGTH(`Province1`.`Province`), CONCAT_WS('',   `Province1`.`Province`), '') as 'Province', IF(    CHAR_LENGTH(`Country1`.`Country`), CONCAT_WS('',   `Country1`.`Country`), '') as 'Country', if(`Staff`.`hireDate`,date_format(`Staff`.`hireDate`,'%m/%d/%Y'),'') as 'hireDate', IF(    CHAR_LENGTH(`Department1`.`Department`), CONCAT_WS('',   `Department1`.`Department`), '') as 'Department', IF(    CHAR_LENGTH(`Position1`.`Position`), CONCAT_WS('',   `Position1`.`Position`), '') as 'Position', IF(    CHAR_LENGTH(`Supervisor1`.`Supervisor`), CONCAT_WS('',   `Supervisor1`.`Supervisor`), '') as 'Supervisor', IF(    CHAR_LENGTH(`Manager1`.`Manager`), CONCAT_WS('',   `Manager1`.`Manager`), '') as 'Manager', IF(    CHAR_LENGTH(`CEO1`.`Chief`), CONCAT_WS('',   `CEO1`.`Chief`), '') as 'Director', `Staff`.`Status` as 'Status', `Staff`.`EmergencyContact` as 'EmergencyContact', `Staff`.`EmergencyPhone` as 'EmergencyPhone', `Staff`.`userName` as 'userName'",
			'Country' => "`Country`.`id` as 'id', `Country`.`Country` as 'Country'",
			'Province' => "`Province`.`id` as 'id', `Province`.`Province` as 'Province', IF(    CHAR_LENGTH(`Country1`.`Country`), CONCAT_WS('',   `Country1`.`Country`), '') as 'Country'",
			'City' => "`City`.`id` as 'id', IF(    CHAR_LENGTH(`Province1`.`Province`), CONCAT_WS('',   `Province1`.`Province`), '') as 'Province', `City`.`City` as 'City'",
			'Warehouse' => "`Warehouse`.`id` as 'id', `Warehouse`.`Warehouse` as 'Warehouse', if(`Warehouse`.`Date`,date_format(`Warehouse`.`Date`,'%m/%d/%Y'),'') as 'Date', `Warehouse`.`Freight` as 'Freight'",
			'Tracking' => "`Tracking`.`id` as 'id', IF(    CHAR_LENGTH(`Warehouse1`.`id`), CONCAT_WS('',   `Warehouse1`.`id`), '') as 'WhID', IF(    CHAR_LENGTH(if(`Warehouse1`.`Date`,date_format(`Warehouse1`.`Date`,'%m/%d/%Y'),'')), CONCAT_WS('',   if(`Warehouse1`.`Date`,date_format(`Warehouse1`.`Date`,'%m/%d/%Y'),'')), '') as 'Date', IF(    CHAR_LENGTH(`Warehouse1`.`Warehouse`), CONCAT_WS('',   `Warehouse1`.`Warehouse`), '') as 'Warehouse', `Tracking`.`Tracking` as 'Tracking', IF(    CHAR_LENGTH(`Customers1`.`Customer`), CONCAT_WS('',   `Customers1`.`Customer`), '') as 'Customer', `Tracking`.`Dimensions` as 'Dimensions', `Tracking`.`Weight` as 'Weight', `Tracking`.`Volume` as 'Volume', `Tracking`.`Total` as 'Total', IF(    CHAR_LENGTH(`Staff1`.`Employee`), CONCAT_WS('',   `Staff1`.`Employee`), '') as 'Employee', IF(    CHAR_LENGTH(`Warehouse1`.`Freight`), CONCAT_WS('',   `Warehouse1`.`Freight`), '') as 'Freight', `Tracking`.`Status` as 'Status', IF(    CHAR_LENGTH(`Province1`.`Province`), CONCAT_WS('',   `Province1`.`Province`), '') as 'Zone', if(`Tracking`.`DeliveredDate`,date_format(`Tracking`.`DeliveredDate`,'%m/%d/%Y %h:%i %p'),'') as 'DeliveredDate'",
			'Status' => "`Status`.`id` as 'id', IF(    CHAR_LENGTH(`Tracking1`.`id`), CONCAT_WS('',   `Tracking1`.`id`), '') as 'TrackID', IF(    CHAR_LENGTH(`Invoice1`.`id`), CONCAT_WS('',   `Invoice1`.`id`), '') as 'Invoice', IF(    CHAR_LENGTH(`Tracking1`.`Tracking`), CONCAT_WS('',   `Tracking1`.`Tracking`), '') as 'Tracking', IF(    CHAR_LENGTH(`Tracking1`.`Dimensions`), CONCAT_WS('',   `Tracking1`.`Dimensions`), '') as 'Dimensions', IF(    CHAR_LENGTH(`Tracking1`.`Weight`), CONCAT_WS('',   `Tracking1`.`Weight`), '') as 'RWeight', IF(    CHAR_LENGTH(`Tracking1`.`Volume`), CONCAT_WS('',   `Tracking1`.`Volume`), '') as 'VWeight', IF(    CHAR_LENGTH(`Tracking1`.`Total`), CONCAT_WS('',   `Tracking1`.`Total`), '') as 'Total', `Status`.`FreightType` as 'FreightType', if(`Status`.`DeliveryDate`,date_format(`Status`.`DeliveryDate`,'%m/%d/%Y %h:%i %p'),'') as 'DeliveryDate', `Status`.`Delivered` as 'Delivered'",
			'Invoice' => "`Invoice`.`id` as 'id', `Invoice`.`type` as 'type', `Invoice`.`number` as 'number', if(`Invoice`.`Date`,date_format(`Invoice`.`Date`,'%m/%d/%Y'),'') as 'Date', IF(    CHAR_LENGTH(`Customers1`.`Title`), CONCAT_WS('',   `Customers1`.`Title`), '') as 'Title', IF(    CHAR_LENGTH(`Customers1`.`Customer`), CONCAT_WS('',   `Customers1`.`Customer`), '') as 'Customer', IF(    CHAR_LENGTH(`Customers1`.`Phone`), CONCAT_WS('',   `Customers1`.`Phone`), '') as 'Phone', IF(    CHAR_LENGTH(`Customers1`.`Email`), CONCAT_WS('',   `Customers1`.`Email`), '') as 'Email', IF(    CHAR_LENGTH(`Customers1`.`Address`), CONCAT_WS('',   `Customers1`.`Address`), '') as 'Address', IF(    CHAR_LENGTH(`City1`.`City`), CONCAT_WS('',   `City1`.`City`), '') as 'City', IF(    CHAR_LENGTH(`Country1`.`Country`), CONCAT_WS('',   `Country1`.`Country`), '') as 'Country', `Invoice`.`PaymentStatus` as 'PaymentStatus', `Invoice`.`AmountDUE` as 'AmountDUE', `Invoice`.`AmountPAID` as 'AmountPAID', `Invoice`.`Balance` as 'Balance', `Invoice`.`Status` as 'Status', `Invoice`.`tax` as 'tax', `Invoice`.`Total` as 'Total', `Invoice`.`usrAdd` as 'usrAdd', `Invoice`.`whenAdd` as 'whenAdd', `Invoice`.`usrUpdated` as 'usrUpdated', `Invoice`.`whenUpdated` as 'whenUpdated', IF(    CHAR_LENGTH(`Invoice1`.`id`) || CHAR_LENGTH(`Invoice1`.`number`), CONCAT_WS('',   `Invoice1`.`id`, ' - ', `Invoice1`.`number`), '') as 'related'",
			'InvoiceDetails' => "`InvoiceDetails`.`id` as 'id', IF(    CHAR_LENGTH(`Invoice1`.`id`), CONCAT_WS('',   `Invoice1`.`id`), '') as 'invoice', `InvoiceDetails`.`order` as 'order', IF(    CHAR_LENGTH(`Products1`.`code`) || CHAR_LENGTH(`Products1`.`item`), CONCAT_WS('',   `Products1`.`code`, ' - ', `Products1`.`item`), '') as 'product', `InvoiceDetails`.`qty` as 'qty', IF(    CHAR_LENGTH(`Products1`.`itemSale`), CONCAT_WS('',   `Products1`.`itemSale`), '') as 'itemSale', `InvoiceDetails`.`SubTotal` as 'SubTotal'",
			'Products' => "`Products`.`id` as 'id', `Products`.`code` as 'code', `Products`.`item` as 'item', `Products`.`cost` as 'cost', `Products`.`profit` as 'profit', `Products`.`itemSale` as 'itemSale', `Products`.`uploads` as 'uploads'",
			'WHJournal' => "`WHJournal`.`id` as 'id', if(`WHJournal`.`Date`,date_format(`WHJournal`.`Date`,'%m/%d/%Y'),'') as 'Date', `WHJournal`.`Freightype` as 'Freightype', `WHJournal`.`Invoices` as 'Invoices', `WHJournal`.`Warehouse` as 'Warehouse', `WHJournal`.`Tracking` as 'Tracking', `WHJournal`.`GroundFreight` as 'GroundFreight', `WHJournal`.`Boxes` as 'Boxes', `WHJournal`.`Dimensions` as 'Dimensions', `WHJournal`.`Volume` as 'Volume', `WHJournal`.`Weight` as 'Weight', `WHJournal`.`InternationalFreight` as 'InternationalFreight', `WHJournal`.`LocalFreight` as 'LocalFreight', `WHJournal`.`Tip` as 'Tip', `WHJournal`.`Total` as 'Total'",
			'CRM' => "`CRM`.`id` as 'id', IF(    CHAR_LENGTH(`Customers1`.`Customer`), CONCAT_WS('',   `Customers1`.`Customer`), '') as 'Customer', `CRM`.`Interaction` as 'Interaction', `CRM`.`Inboundtype` as 'Inboundtype', `CRM`.`Type` as 'Type', `CRM`.`Description` as 'Description', `CRM`.`Comments` as 'Comments', `CRM`.`Priority` as 'Priority', `CRM`.`Status` as 'Status', if(`CRM`.`Timestamp`,date_format(`CRM`.`Timestamp`,'%m/%d/%Y %h:%i %p'),'') as 'Timestamp', `CRM`.`Sent` as 'Sent', IF(    CHAR_LENGTH(`Staff1`.`Employee`), CONCAT_WS('',   `Staff1`.`Employee`), '') as 'Assigned', `CRM`.`Url` as 'Url'",
			'Payroll' => "`Payroll`.`id` as 'id', IF(    CHAR_LENGTH(`Staff1`.`Employee`), CONCAT_WS('',   `Staff1`.`Employee`), '') as 'employee', if(`Payroll`.`date`,date_format(`Payroll`.`date`,'%m/%d/%Y'),'') as 'date', `Payroll`.`start` as 'start', `Payroll`.`stop` as 'stop', `Payroll`.`horas` as 'horas', `Payroll`.`comment` as 'comment', `Payroll`.`value` as 'value', `Payroll`.`status` as 'status'",
			'Brand' => "`Brand`.`id` as 'id', `Brand`.`Brand` as 'Brand'",
			'Model' => "`Model`.`id` as 'id', `Model`.`Model` as 'Model', IF(    CHAR_LENGTH(`Brand1`.`Brand`), CONCAT_WS('',   `Brand1`.`Brand`), '') as 'Brand'",
			'System' => "`System`.`id` as 'id', `System`.`System` as 'System'",
			'Part' => "`Part`.`id` as 'id', `Part`.`Part` as 'Part', IF(    CHAR_LENGTH(`System1`.`System`), CONCAT_WS('',   `System1`.`System`), '') as 'System'",
			'DatabaseAUTO' => "`DatabaseAUTO`.`id` as 'id', `DatabaseAUTO`.`Type` as 'Type', IF(    CHAR_LENGTH(`Brand1`.`Brand`), CONCAT_WS('',   `Brand1`.`Brand`), '') as 'Brand', IF(    CHAR_LENGTH(`Model1`.`Model`), CONCAT_WS('',   `Model1`.`Model`), '') as 'Model', `DatabaseAUTO`.`Year` as 'Year', IF(    CHAR_LENGTH(`System1`.`System`), CONCAT_WS('',   `System1`.`System`), '') as 'System', IF(    CHAR_LENGTH(`Part1`.`Part`), CONCAT_WS('',   `Part1`.`Part`), '') as 'Part', `DatabaseAUTO`.`PartNO` as 'PartNO', `DatabaseAUTO`.`Dimensions` as 'Dimensions', `DatabaseAUTO`.`Volume` as 'Volume', `DatabaseAUTO`.`Weight` as 'Weight', `DatabaseAUTO`.`AirFreight` as 'AirFreight', `DatabaseAUTO`.`OceanFreight` as 'OceanFreight', `DatabaseAUTO`.`Picture` as 'Picture'",
			'GeneralDB' => "`GeneralDB`.`id` as 'id', `GeneralDB`.`Description` as 'Description', `GeneralDB`.`Dimensions` as 'Dimensions', `GeneralDB`.`Vweight` as 'Vweight', `GeneralDB`.`Rweight` as 'Rweight', `GeneralDB`.`Ofreight` as 'Ofreight', `GeneralDB`.`Afreight` as 'Afreight', `GeneralDB`.`photo` as 'photo'",
			'CustomerAuto' => "`CustomerAuto`.`id` as 'id', IF(    CHAR_LENGTH(`Customers1`.`Customer`), CONCAT_WS('',   `Customers1`.`Customer`), '') as 'Customer', `CustomerAuto`.`VehicleType` as 'VehicleType', `CustomerAuto`.`VIN` as 'VIN', IF(    CHAR_LENGTH(`Brand1`.`Brand`), CONCAT_WS('',   `Brand1`.`Brand`), '') as 'Brand', IF(    CHAR_LENGTH(`Model1`.`Model`), CONCAT_WS('',   `Model1`.`Model`), '') as 'Model', `CustomerAuto`.`Year` as 'Year', `CustomerAuto`.`EngineNo` as 'EngineNo', `CustomerAuto`.`Cylinder` as 'Cylinder', `CustomerAuto`.`Liters` as 'Liters', `CustomerAuto`.`Transmission` as 'Transmission', `CustomerAuto`.`GEAR` as 'GEAR', `CustomerAuto`.`URL` as 'URL'",
			'Compras' => "`Compras`.`id` as 'id', IF(    CHAR_LENGTH(`Customers1`.`Customer`), CONCAT_WS('',   `Customers1`.`Customer`), '') as 'Customer', IF(    CHAR_LENGTH(`Staff1`.`Employee`), CONCAT_WS('',   `Staff1`.`Employee`), '') as 'Employee', IF(    CHAR_LENGTH(`Products1`.`item`), CONCAT_WS('',   `Products1`.`item`), '') as 'Description', `Compras`.`Url` as 'Url', `Compras`.`Total` as 'Total', if(`Compras`.`Odate`,date_format(`Compras`.`Odate`,'%m/%d/%Y'),'') as 'Odate', if(`Compras`.`ETA`,date_format(`Compras`.`ETA`,'%m/%d/%Y'),'') as 'ETA', `Compras`.`Status` as 'Status'",
			'TrackingCenter' => "`TrackingCenter`.`id` as 'id', if(`TrackingCenter`.`Date`,date_format(`TrackingCenter`.`Date`,'%m/%d/%Y'),'') as 'Date', IF(    CHAR_LENGTH(`Customers1`.`Customer`), CONCAT_WS('',   `Customers1`.`Customer`), '') as 'Name', IF(    CHAR_LENGTH(`Province1`.`Province`), CONCAT_WS('',   `Province1`.`Province`), '') as 'Zone', IF(    CHAR_LENGTH(`Tracking1`.`Tracking`), CONCAT_WS('',   `Tracking1`.`Tracking`), '') as 'Tracking', `TrackingCenter`.`Carrier` as 'Carrier', `TrackingCenter`.`Trackingurl` as 'Trackingurl', `TrackingCenter`.`CustStatus` as 'CustStatus', `TrackingCenter`.`TRADEXXstatus` as 'TRADEXXstatus', `TrackingCenter`.`Freight` as 'Freight', `TrackingCenter`.`Comments` as 'Comments'",
			'Claim' => "`Claim`.`id` as 'id', if(`Claim`.`Date`,date_format(`Claim`.`Date`,'%m/%d/%Y'),'') as 'Date', `Claim`.`Invoice` as 'Invoice', IF(    CHAR_LENGTH(`Warehouse1`.`Warehouse`), CONCAT_WS('',   `Warehouse1`.`Warehouse`), '') as 'Warehouse', IF(    CHAR_LENGTH(`Tracking1`.`Tracking`), CONCAT_WS('',   `Tracking1`.`Tracking`), '') as 'Tracking', `Claim`.`Selecteds` as 'Selecteds', `Claim`.`Shippingt` as 'Shippingt', `Claim`.`Status` as 'Status'",
			'Activities' => "`Activities`.`id` as 'id', if(`Activities`.`Date`,date_format(`Activities`.`Date`,'%m/%d/%Y'),'') as 'Date', `Activities`.`Description` as 'Description', `Activities`.`Comment` as 'Comment', `Activities`.`Priority` as 'Priority', IF(    CHAR_LENGTH(`Staff1`.`Employee`), CONCAT_WS('',   `Staff1`.`Employee`), '') as 'Assigned', `Activities`.`Completed` as 'Completed', if(`Activities`.`Stop`,date_format(`Activities`.`Stop`,'%m/%d/%Y %h:%i %p'),'') as 'Stop'",
			'Return' => "`Return`.`id` as 'id', if(`Return`.`Date`,date_format(`Return`.`Date`,'%m/%d/%Y'),'') as 'Date', `Return`.`Invoice` as 'Invoice', IF(    CHAR_LENGTH(`Warehouse1`.`Warehouse`), CONCAT_WS('',   `Warehouse1`.`Warehouse`), '') as 'Warehouse', IF(    CHAR_LENGTH(`Tracking1`.`Tracking`), CONCAT_WS('',   `Tracking1`.`Tracking`), '') as 'Tracking', `Return`.`Shippingt` as 'Shippingt', `Return`.`Status` as 'Status', `Return`.`Amount` as 'Amount', `Return`.`Refund` as 'Refund'",
			'Department' => "`Department`.`id` as 'id', `Department`.`Department` as 'Department'",
			'Position' => "`Position`.`id` as 'id', `Position`.`Position` as 'Position', IF(    CHAR_LENGTH(`Department1`.`Department`), CONCAT_WS('',   `Department1`.`Department`), '') as 'Department'",
			'CEO' => "`CEO`.`id` as 'id', `CEO`.`Chief` as 'Chief', IF(    CHAR_LENGTH(`Department1`.`Department`), CONCAT_WS('',   `Department1`.`Department`), '') as 'Department'",
			'Manager' => "`Manager`.`id` as 'id', `Manager`.`Manager` as 'Manager', IF(    CHAR_LENGTH(`Department1`.`Department`), CONCAT_WS('',   `Department1`.`Department`), '') as 'Department'",
			'Supervisor' => "`Supervisor`.`id` as 'id', `Supervisor`.`Supervisor` as 'Supervisor', IF(    CHAR_LENGTH(`Department1`.`Department`), CONCAT_WS('',   `Department1`.`Department`), '') as 'Department'",
			'Losses' => "`Losses`.`id` as 'id', IF(    CHAR_LENGTH(`Customers1`.`Customer`), CONCAT_WS('',   `Customers1`.`Customer`), '') as 'Customer', `Losses`.`Description` as 'Description', `Losses`.`Saleprice` as 'Saleprice', `Losses`.`OperationCost` as 'OperationCost', `Losses`.`Lost` as 'Lost', `Losses`.`Comment` as 'Comment', `Losses`.`Recovered` as 'Recovered', `Losses`.`Balance` as 'Balance', `Losses`.`Status` as 'Status'",
			'Subscriptions' => "`Subscriptions`.`id` as 'id', IF(    CHAR_LENGTH(`Customers1`.`Customer`), CONCAT_WS('',   `Customers1`.`Customer`), '') as 'Customer', `Subscriptions`.`Vendor` as 'Vendor', `Subscriptions`.`AccountID` as 'AccountID', if(`Subscriptions`.`LastPayment`,date_format(`Subscriptions`.`LastPayment`,'%m/%d/%Y'),'') as 'LastPayment', if(`Subscriptions`.`DueDate`,date_format(`Subscriptions`.`DueDate`,'%m/%d/%Y'),'') as 'DueDate', `Subscriptions`.`Status` as 'Status', `Subscriptions`.`Rate` as 'Rate', `Subscriptions`.`AmountDue` as 'AmountDue'",
			'Accounting' => "`Accounting`.`id` as 'id', IF(    CHAR_LENGTH(`Invoice1`.`number`) || CHAR_LENGTH(`Customers1`.`Customer`), CONCAT_WS('',   `Invoice1`.`number`, ' - ', `Customers1`.`Customer`), '') as 'invoice', if(`Accounting`.`date`,date_format(`Accounting`.`date`,'%m/%d/%Y'),'') as 'date', `Accounting`.`description` as 'description', IF(    CHAR_LENGTH(`AccountPlan1`.`description`) || CHAR_LENGTH(`AccountPlan1`.`code`), CONCAT_WS('',   `AccountPlan1`.`description`, ' - ', `AccountPlan1`.`code`), '') as 'account_plan', IF(    CHAR_LENGTH(`MasterAccount1`.`masterAccount`) || CHAR_LENGTH(`MasterAccount1`.`code`), CONCAT_WS('',   `MasterAccount1`.`masterAccount`, ' - ', `MasterAccount1`.`code`), '') as 'master_account', IF(    CHAR_LENGTH(`Account1`.`Account`) || CHAR_LENGTH(`Account1`.`code`), CONCAT_WS('',   `Account1`.`Account`, ' - ', `Account1`.`code`), '') as 'account', IF(    CHAR_LENGTH(`SubAccount1`.`subAccount`) || CHAR_LENGTH(`SubAccount1`.`code`), CONCAT_WS('',   `SubAccount1`.`subAccount`, ' - ', `SubAccount1`.`code`), '') as 'sub_account', IF(    CHAR_LENGTH(`Type1`.`type`), CONCAT_WS('',   `Type1`.`type`), '') as 'type', FORMAT(`Accounting`.`amount`, 2) as 'amount', `Accounting`.`balance` as 'balance', `Accounting`.`status` as 'status'",
			'AccountPlan' => "`AccountPlan`.`id` as 'id', `AccountPlan`.`description` as 'description', `AccountPlan`.`code` as 'code', IF(    CHAR_LENGTH(`MasterAccount1`.`masterAccount`) || CHAR_LENGTH(`MasterAccount1`.`code`), CONCAT_WS('',   `MasterAccount1`.`masterAccount`, ' - ', `MasterAccount1`.`code`), '') as 'master_account', IF(    CHAR_LENGTH(`Account1`.`Account`) || CHAR_LENGTH(`Account1`.`code`), CONCAT_WS('',   `Account1`.`Account`, ' - ', `Account1`.`code`), '') as 'account', IF(    CHAR_LENGTH(`SubAccount1`.`subAccount`) || CHAR_LENGTH(`SubAccount1`.`code`), CONCAT_WS('',   `SubAccount1`.`subAccount`, ' - ', `SubAccount1`.`code`), '') as 'sub_account', IF(    CHAR_LENGTH(`Type1`.`type`), CONCAT_WS('',   `Type1`.`type`), '') as 'type'",
			'MasterAccount' => "`MasterAccount`.`id` as 'id', `MasterAccount`.`masterAccount` as 'masterAccount', `MasterAccount`.`code` as 'code'",
			'Account' => "`Account`.`id` as 'id', `Account`.`Account` as 'Account', `Account`.`code` as 'code'",
			'SubAccount' => "`SubAccount`.`id` as 'id', `SubAccount`.`subAccount` as 'subAccount', `SubAccount`.`code` as 'code'",
			'Type' => "`Type`.`id` as 'id', `Type`.`type` as 'type'",
			'CCJournal' => "`CCJournal`.`id` as 'id', IF(    CHAR_LENGTH(`CC1`.`Card`), CONCAT_WS('',   `CC1`.`Card`), '') as 'Card', if(`CCJournal`.`Date`,date_format(`CCJournal`.`Date`,'%m/%d/%Y'),'') as 'Date', `CCJournal`.`Description` as 'Description', `CCJournal`.`Cleared` as 'Cleared', FORMAT(`CCJournal`.`Amount`, 2) as 'Amount', `CCJournal`.`Balance` as 'Balance', IF(    CHAR_LENGTH(`Staff1`.`Employee`), CONCAT_WS('',   `Staff1`.`Employee`), '') as 'Logged', `CCJournal`.`Photo` as 'Photo'",
			'CC' => "`CC`.`id` as 'id', `CC`.`Card` as 'Card'",
			'Receivable' => "`Receivable`.`id` as 'id', IF(    CHAR_LENGTH(`Customers1`.`Customer`), CONCAT_WS('',   `Customers1`.`Customer`), '') as 'Customer', IF(    CHAR_LENGTH(`Customers1`.`Phone`), CONCAT_WS('',   `Customers1`.`Phone`), '') as 'Phone', `Receivable`.`Description` as 'Description', `Receivable`.`Interaction` as 'Interaction', if(`Receivable`.`ExpectedDate`,date_format(`Receivable`.`ExpectedDate`,'%m/%d/%Y'),'') as 'ExpectedDate', if(`Receivable`.`LastUpdate`,date_format(`Receivable`.`LastUpdate`,'%m/%d/%Y %h:%i %p'),'') as 'LastUpdate', `Receivable`.`Status` as 'Status', IF(    CHAR_LENGTH(`Staff1`.`Employee`), CONCAT_WS('',   `Staff1`.`Employee`), '') as 'Assigned', `Receivable`.`Amount` as 'Amount'",
		);

		if(isset($sql_fields[$table_name])) {
			return $sql_fields[$table_name];
		}

		return false;
	}

	#########################################################

	function get_sql_from($table_name, $skip_permissions = false, $skip_joins = false) {
		$sql_from = array(
			'Customers' => "`Customers` LEFT JOIN `CustomerClass` as CustomerClass1 ON `CustomerClass1`.`id`=`Customers`.`Type` LEFT JOIN `City` as City1 ON `City1`.`id`=`Customers`.`City` LEFT JOIN `Province` as Province1 ON `Province1`.`id`=`Customers`.`Province` LEFT JOIN `Country` as Country1 ON `Country1`.`id`=`Customers`.`Country` ",
			'Retention' => "`Retention` LEFT JOIN `Customers` as Customers1 ON `Customers1`.`id`=`Retention`.`Customer` LEFT JOIN `Staff` as Staff1 ON `Staff1`.`id`=`Retention`.`Assigned` LEFT JOIN `Province` as Province1 ON `Province1`.`id`=`Customers1`.`Province` ",
			'Alert' => "`Alert` LEFT JOIN `Customers` as Customers1 ON `Customers1`.`id`=`Alert`.`Customer` ",
			'CustomerClass' => "`CustomerClass` ",
			'Staff' => "`Staff` LEFT JOIN `City` as City1 ON `City1`.`id`=`Staff`.`City` LEFT JOIN `Province` as Province1 ON `Province1`.`id`=`Staff`.`Province` LEFT JOIN `Country` as Country1 ON `Country1`.`id`=`Staff`.`Country` LEFT JOIN `Department` as Department1 ON `Department1`.`id`=`Staff`.`Department` LEFT JOIN `Position` as Position1 ON `Position1`.`id`=`Staff`.`Position` LEFT JOIN `Supervisor` as Supervisor1 ON `Supervisor1`.`id`=`Staff`.`Supervisor` LEFT JOIN `Manager` as Manager1 ON `Manager1`.`id`=`Staff`.`Manager` LEFT JOIN `CEO` as CEO1 ON `CEO1`.`id`=`Staff`.`Director` ",
			'Country' => "`Country` ",
			'Province' => "`Province` LEFT JOIN `Country` as Country1 ON `Country1`.`id`=`Province`.`Country` ",
			'City' => "`City` LEFT JOIN `Province` as Province1 ON `Province1`.`id`=`City`.`Province` ",
			'Warehouse' => "`Warehouse` ",
			'Tracking' => "`Tracking` LEFT JOIN `Warehouse` as Warehouse1 ON `Warehouse1`.`id`=`Tracking`.`Warehouse` LEFT JOIN `Customers` as Customers1 ON `Customers1`.`id`=`Tracking`.`Customer` LEFT JOIN `Staff` as Staff1 ON `Staff1`.`id`=`Tracking`.`Employee` LEFT JOIN `Province` as Province1 ON `Province1`.`id`=`Customers1`.`Province` ",
			'Status' => "`Status` LEFT JOIN `Invoice` as Invoice1 ON `Invoice1`.`id`=`Status`.`Invoice` LEFT JOIN `Tracking` as Tracking1 ON `Tracking1`.`id`=`Status`.`Tracking` ",
			'Invoice' => "`Invoice` LEFT JOIN `Customers` as Customers1 ON `Customers1`.`id`=`Invoice`.`Customer` LEFT JOIN `Invoice` as Invoice1 ON `Invoice1`.`id`=`Invoice`.`related` LEFT JOIN `City` as City1 ON `City1`.`id`=`Customers1`.`City` LEFT JOIN `Country` as Country1 ON `Country1`.`id`=`Customers1`.`Country` ",
			'InvoiceDetails' => "`InvoiceDetails` LEFT JOIN `Invoice` as Invoice1 ON `Invoice1`.`id`=`InvoiceDetails`.`invoice` LEFT JOIN `Products` as Products1 ON `Products1`.`id`=`InvoiceDetails`.`product` ",
			'Products' => "`Products` ",
			'WHJournal' => "`WHJournal` ",
			'CRM' => "`CRM` LEFT JOIN `Customers` as Customers1 ON `Customers1`.`id`=`CRM`.`Customer` LEFT JOIN `Staff` as Staff1 ON `Staff1`.`id`=`CRM`.`Assigned` ",
			'Payroll' => "`Payroll` LEFT JOIN `Staff` as Staff1 ON `Staff1`.`id`=`Payroll`.`employee` ",
			'Brand' => "`Brand` ",
			'Model' => "`Model` LEFT JOIN `Brand` as Brand1 ON `Brand1`.`id`=`Model`.`Brand` ",
			'System' => "`System` ",
			'Part' => "`Part` LEFT JOIN `System` as System1 ON `System1`.`id`=`Part`.`System` ",
			'DatabaseAUTO' => "`DatabaseAUTO` LEFT JOIN `Brand` as Brand1 ON `Brand1`.`id`=`DatabaseAUTO`.`Brand` LEFT JOIN `Model` as Model1 ON `Model1`.`id`=`DatabaseAUTO`.`Model` LEFT JOIN `System` as System1 ON `System1`.`id`=`DatabaseAUTO`.`System` LEFT JOIN `Part` as Part1 ON `Part1`.`id`=`DatabaseAUTO`.`Part` ",
			'GeneralDB' => "`GeneralDB` ",
			'CustomerAuto' => "`CustomerAuto` LEFT JOIN `Customers` as Customers1 ON `Customers1`.`id`=`CustomerAuto`.`Customer` LEFT JOIN `Brand` as Brand1 ON `Brand1`.`id`=`CustomerAuto`.`Brand` LEFT JOIN `Model` as Model1 ON `Model1`.`id`=`CustomerAuto`.`Model` ",
			'Compras' => "`Compras` LEFT JOIN `Customers` as Customers1 ON `Customers1`.`id`=`Compras`.`Customer` LEFT JOIN `Staff` as Staff1 ON `Staff1`.`id`=`Compras`.`Employee` LEFT JOIN `Products` as Products1 ON `Products1`.`id`=`Compras`.`Description` ",
			'TrackingCenter' => "`TrackingCenter` LEFT JOIN `Customers` as Customers1 ON `Customers1`.`id`=`TrackingCenter`.`Name` LEFT JOIN `Tracking` as Tracking1 ON `Tracking1`.`id`=`TrackingCenter`.`Tracking` LEFT JOIN `Province` as Province1 ON `Province1`.`id`=`Customers1`.`Province` ",
			'Claim' => "`Claim` LEFT JOIN `Warehouse` as Warehouse1 ON `Warehouse1`.`id`=`Claim`.`Warehouse` LEFT JOIN `Tracking` as Tracking1 ON `Tracking1`.`id`=`Claim`.`Tracking` ",
			'Activities' => "`Activities` LEFT JOIN `Staff` as Staff1 ON `Staff1`.`id`=`Activities`.`Assigned` ",
			'Return' => "`Return` LEFT JOIN `Warehouse` as Warehouse1 ON `Warehouse1`.`id`=`Return`.`Warehouse` LEFT JOIN `Tracking` as Tracking1 ON `Tracking1`.`id`=`Return`.`Tracking` ",
			'Department' => "`Department` ",
			'Position' => "`Position` LEFT JOIN `Department` as Department1 ON `Department1`.`id`=`Position`.`Department` ",
			'CEO' => "`CEO` LEFT JOIN `Department` as Department1 ON `Department1`.`id`=`CEO`.`Department` ",
			'Manager' => "`Manager` LEFT JOIN `Department` as Department1 ON `Department1`.`id`=`Manager`.`Department` ",
			'Supervisor' => "`Supervisor` LEFT JOIN `Department` as Department1 ON `Department1`.`id`=`Supervisor`.`Department` ",
			'Losses' => "`Losses` LEFT JOIN `Customers` as Customers1 ON `Customers1`.`id`=`Losses`.`Customer` ",
			'Subscriptions' => "`Subscriptions` LEFT JOIN `Customers` as Customers1 ON `Customers1`.`id`=`Subscriptions`.`Customer` ",
			'Accounting' => "`Accounting` LEFT JOIN `Invoice` as Invoice1 ON `Invoice1`.`id`=`Accounting`.`invoice` LEFT JOIN `Customers` as Customers1 ON `Customers1`.`id`=`Invoice1`.`Customer` LEFT JOIN `AccountPlan` as AccountPlan1 ON `AccountPlan1`.`id`=`Accounting`.`account_plan` LEFT JOIN `MasterAccount` as MasterAccount1 ON `MasterAccount1`.`id`=`AccountPlan1`.`master_account` LEFT JOIN `Account` as Account1 ON `Account1`.`id`=`AccountPlan1`.`account` LEFT JOIN `SubAccount` as SubAccount1 ON `SubAccount1`.`id`=`AccountPlan1`.`sub_account` LEFT JOIN `Type` as Type1 ON `Type1`.`id`=`AccountPlan1`.`type` ",
			'AccountPlan' => "`AccountPlan` LEFT JOIN `MasterAccount` as MasterAccount1 ON `MasterAccount1`.`id`=`AccountPlan`.`master_account` LEFT JOIN `Account` as Account1 ON `Account1`.`id`=`AccountPlan`.`account` LEFT JOIN `SubAccount` as SubAccount1 ON `SubAccount1`.`id`=`AccountPlan`.`sub_account` LEFT JOIN `Type` as Type1 ON `Type1`.`id`=`AccountPlan`.`type` ",
			'MasterAccount' => "`MasterAccount` ",
			'Account' => "`Account` ",
			'SubAccount' => "`SubAccount` ",
			'Type' => "`Type` ",
			'CCJournal' => "`CCJournal` LEFT JOIN `CC` as CC1 ON `CC1`.`id`=`CCJournal`.`Card` LEFT JOIN `Staff` as Staff1 ON `Staff1`.`id`=`CCJournal`.`Logged` ",
			'CC' => "`CC` ",
			'Receivable' => "`Receivable` LEFT JOIN `Customers` as Customers1 ON `Customers1`.`id`=`Receivable`.`Customer` LEFT JOIN `Staff` as Staff1 ON `Staff1`.`id`=`Receivable`.`Assigned` ",
		);

		$pkey = array(
			'Customers' => 'id',
			'Retention' => 'id',
			'Alert' => 'id',
			'CustomerClass' => 'id',
			'Staff' => 'id',
			'Country' => 'id',
			'Province' => 'id',
			'City' => 'id',
			'Warehouse' => 'id',
			'Tracking' => 'id',
			'Status' => 'id',
			'Invoice' => 'id',
			'InvoiceDetails' => 'id',
			'Products' => 'id',
			'WHJournal' => 'id',
			'CRM' => 'id',
			'Payroll' => 'id',
			'Brand' => 'id',
			'Model' => 'id',
			'System' => 'id',
			'Part' => 'id',
			'DatabaseAUTO' => 'id',
			'GeneralDB' => 'id',
			'CustomerAuto' => 'id',
			'Compras' => 'id',
			'TrackingCenter' => 'id',
			'Claim' => 'id',
			'Activities' => 'id',
			'Return' => 'id',
			'Department' => 'id',
			'Position' => 'id',
			'CEO' => 'id',
			'Manager' => 'id',
			'Supervisor' => 'id',
			'Losses' => 'id',
			'Subscriptions' => 'id',
			'Accounting' => 'id',
			'AccountPlan' => 'id',
			'MasterAccount' => 'id',
			'Account' => 'id',
			'SubAccount' => 'id',
			'Type' => 'id',
			'CCJournal' => 'id',
			'CC' => 'id',
			'Receivable' => 'id',
		);

		if(!isset($sql_from[$table_name])) return false;

		$from = ($skip_joins ? "`{$table_name}`" : $sql_from[$table_name]);

		if($skip_permissions) return $from . ' WHERE 1=1';

		// mm: build the query based on current member's permissions
		$perm = getTablePermissions($table_name);
		if($perm[2] == 1) { // view owner only
			$from .= ", membership_userrecords WHERE `{$table_name}`.`{$pkey[$table_name]}`=membership_userrecords.pkValue and membership_userrecords.tableName='{$table_name}' and lcase(membership_userrecords.memberID)='" . getLoggedMemberID() . "'";
		}elseif($perm[2] == 2) { // view group only
			$from .= ", membership_userrecords WHERE `{$table_name}`.`{$pkey[$table_name]}`=membership_userrecords.pkValue and membership_userrecords.tableName='{$table_name}' and membership_userrecords.groupID='" . getLoggedGroupID() . "'";
		}elseif($perm[2] == 3) { // view all
			$from .= ' WHERE 1=1';
		}else{ // view none
			return false;
		}

		return $from;
	}

	#########################################################

	function get_joined_record($table, $id, $skip_permissions = false) {
		$sql_fields = get_sql_fields($table);
		$sql_from = get_sql_from($table, $skip_permissions);

		if(!$sql_fields || !$sql_from) return false;

		$pk = getPKFieldName($table);
		if(!$pk) return false;

		$safe_id = makeSafe($id, false);
		$sql = "SELECT {$sql_fields} FROM {$sql_from} AND `{$table}`.`{$pk}`='{$safe_id}'";
		$eo['silentErrors'] = true;
		$res = sql($sql, $eo);
		if($row = db_fetch_assoc($res)) return $row;

		return false;
	}

	#########################################################

	function get_defaults($table) {
		/* array of tables and their fields, with default values (or empty), excluding automatic values */
		$defaults = array(
			'Customers' => array(
				'id' => '',
				'Title' => '',
				'Customer' => '',
				'Birthdate' => '',
				'Type' => 'REGULAR',
				'Phone' => '',
				'Email' => '',
				'Address' => '',
				'City' => '',
				'Province' => '',
				'Country' => '',
				'Status' => 'ACTIVE'
			),
			'Retention' => array(
				'id' => '',
				'Customer' => '',
				'Phone' => '',
				'Email' => '',
				'Zone' => '',
				'Interaction' => '',
				'GIFTPACKAGE' => '',
				'Assigned' => '',
				'Status' => 'OPEN',
				'CreateDate' => '',
				'ResolutionDate' => ''
			),
			'Alert' => array(
				'id' => '',
				'Customer' => '',
				'Satus' => '',
				'Comment' => '',
				'Date' => ''
			),
			'CustomerClass' => array(
				'id' => '',
				'Type' => ''
			),
			'Staff' => array(
				'id' => '',
				'Photo' => '',
				'Employee' => '',
				'Birthdate' => '',
				'Phone' => '',
				'Email' => '',
				'Address' => '',
				'City' => '',
				'Province' => '',
				'Country' => '',
				'hireDate' => '',
				'Department' => '',
				'Position' => '',
				'Supervisor' => '',
				'Manager' => '',
				'Director' => '',
				'Status' => '',
				'EmergencyContact' => '',
				'EmergencyPhone' => '',
				'userName' => ''
			),
			'Country' => array(
				'id' => '',
				'Country' => ''
			),
			'Province' => array(
				'id' => '',
				'Province' => '',
				'Country' => ''
			),
			'City' => array(
				'id' => '',
				'Province' => '',
				'City' => ''
			),
			'Warehouse' => array(
				'id' => '',
				'Warehouse' => '',
				'Date' => '1',
				'Freight' => ''
			),
			'Tracking' => array(
				'id' => '',
				'WhID' => '',
				'Date' => '1',
				'Warehouse' => '',
				'Tracking' => '',
				'Customer' => '',
				'Dimensions' => '',
				'Weight' => '',
				'Volume' => '',
				'Total' => '',
				'Employee' => '',
				'Freight' => '',
				'Status' => 'READY FOR PICK UP',
				'Zone' => '',
				'DeliveredDate' => ''
			),
			'Status' => array(
				'id' => '',
				'TrackID' => '',
				'Invoice' => '',
				'Tracking' => '',
				'Dimensions' => '',
				'RWeight' => '',
				'VWeight' => '',
				'Total' => '',
				'FreightType' => '',
				'DeliveryDate' => '',
				'Delivered' => ''
			),
			'Invoice' => array(
				'id' => '',
				'type' => 'Quote',
				'number' => '',
				'Date' => '1',
				'Title' => '',
				'Customer' => '',
				'Phone' => '',
				'Email' => '',
				'Address' => '',
				'City' => '',
				'Country' => '',
				'PaymentStatus' => 'UNPAID',
				'AmountDUE' => '',
				'AmountPAID' => '',
				'Balance' => '',
				'Status' => 'OPEN',
				'tax' => '',
				'Total' => '',
				'usrAdd' => '',
				'whenAdd' => '',
				'usrUpdated' => '',
				'whenUpdated' => '',
				'related' => ''
			),
			'InvoiceDetails' => array(
				'id' => '',
				'invoice' => '',
				'order' => '',
				'product' => '',
				'qty' => '',
				'itemSale' => '',
				'SubTotal' => ''
			),
			'Products' => array(
				'id' => '',
				'code' => '',
				'item' => '',
				'cost' => '',
				'profit' => '',
				'itemSale' => '',
				'uploads' => ''
			),
			'WHJournal' => array(
				'id' => '',
				'Date' => '1',
				'Freightype' => 'AIR FREIGHT',
				'Invoices' => '',
				'Warehouse' => '',
				'Tracking' => '',
				'GroundFreight' => '',
				'Boxes' => '',
				'Dimensions' => '',
				'Volume' => '',
				'Weight' => '',
				'InternationalFreight' => '',
				'LocalFreight' => '',
				'Tip' => '',
				'Total' => ''
			),
			'CRM' => array(
				'id' => '',
				'Customer' => '',
				'Interaction' => 'INBOUND',
				'Inboundtype' => 'WHATSAPP',
				'Type' => '',
				'Description' => '',
				'Comments' => '',
				'Priority' => '',
				'Status' => '',
				'Timestamp' => '',
				'Sent' => '',
				'Assigned' => '',
				'Url' => ''
			),
			'Payroll' => array(
				'id' => '',
				'employee' => '',
				'date' => '1',
				'start' => '',
				'stop' => '',
				'horas' => '',
				'comment' => '',
				'value' => '',
				'status' => 'UNPAID'
			),
			'Brand' => array(
				'id' => '',
				'Brand' => ''
			),
			'Model' => array(
				'id' => '',
				'Model' => '',
				'Brand' => ''
			),
			'System' => array(
				'id' => '',
				'System' => ''
			),
			'Part' => array(
				'id' => '',
				'Part' => '',
				'System' => ''
			),
			'DatabaseAUTO' => array(
				'id' => '',
				'Type' => '',
				'Brand' => '',
				'Model' => '',
				'Year' => '',
				'System' => '',
				'Part' => '',
				'PartNO' => '',
				'Dimensions' => '',
				'Volume' => '',
				'Weight' => '',
				'AirFreight' => '',
				'OceanFreight' => '',
				'Picture' => ''
			),
			'GeneralDB' => array(
				'id' => '',
				'Description' => '',
				'Dimensions' => '',
				'Vweight' => '',
				'Rweight' => '',
				'Ofreight' => '',
				'Afreight' => '',
				'photo' => ''
			),
			'CustomerAuto' => array(
				'id' => '',
				'Customer' => '',
				'VehicleType' => '',
				'VIN' => '',
				'Brand' => '',
				'Model' => '',
				'Year' => '',
				'EngineNo' => '',
				'Cylinder' => '',
				'Liters' => '',
				'Transmission' => '',
				'GEAR' => '',
				'URL' => ''
			),
			'Compras' => array(
				'id' => '',
				'Customer' => '',
				'Employee' => '',
				'Description' => '',
				'Url' => '',
				'Total' => '',
				'Odate' => '',
				'ETA' => '',
				'Status' => 'UNPAID'
			),
			'TrackingCenter' => array(
				'id' => '',
				'Date' => '1',
				'Name' => '',
				'Zone' => '',
				'Tracking' => '',
				'Carrier' => '',
				'Trackingurl' => '',
				'CustStatus' => 'OPEN',
				'TRADEXXstatus' => 'OPEN',
				'Freight' => '',
				'Comments' => ''
			),
			'Claim' => array(
				'id' => '',
				'Date' => '1',
				'Invoice' => '',
				'Warehouse' => '',
				'Tracking' => '',
				'Selecteds' => '',
				'Shippingt' => '',
				'Status' => ''
			),
			'Activities' => array(
				'id' => '',
				'Date' => '1',
				'Description' => '',
				'Comment' => '',
				'Priority' => '',
				'Assigned' => '',
				'Completed' => '',
				'Stop' => ''
			),
			'Return' => array(
				'id' => '',
				'Date' => '1',
				'Invoice' => '',
				'Warehouse' => '',
				'Tracking' => '',
				'Shippingt' => '',
				'Status' => '',
				'Amount' => '',
				'Refund' => ''
			),
			'Department' => array(
				'id' => '',
				'Department' => ''
			),
			'Position' => array(
				'id' => '',
				'Position' => '',
				'Department' => ''
			),
			'CEO' => array(
				'id' => '',
				'Chief' => '',
				'Department' => ''
			),
			'Manager' => array(
				'id' => '',
				'Manager' => '',
				'Department' => ''
			),
			'Supervisor' => array(
				'id' => '',
				'Supervisor' => '',
				'Department' => ''
			),
			'Losses' => array(
				'id' => '',
				'Customer' => '',
				'Description' => '',
				'Saleprice' => '',
				'OperationCost' => '',
				'Lost' => '',
				'Comment' => '',
				'Recovered' => '',
				'Balance' => '',
				'Status' => ''
			),
			'Subscriptions' => array(
				'id' => '',
				'Customer' => '',
				'Vendor' => '',
				'AccountID' => '',
				'LastPayment' => '',
				'DueDate' => '',
				'Status' => '',
				'Rate' => '',
				'AmountDue' => ''
			),
			'Accounting' => array(
				'id' => '',
				'invoice' => '',
				'date' => '1',
				'description' => '',
				'account_plan' => '',
				'master_account' => '',
				'account' => '',
				'sub_account' => '',
				'type' => '',
				'amount' => '',
				'balance' => '',
				'status' => 'OPEN'
			),
			'AccountPlan' => array(
				'id' => '',
				'description' => '',
				'code' => '',
				'master_account' => '',
				'account' => '',
				'sub_account' => '',
				'type' => ''
			),
			'MasterAccount' => array(
				'id' => '',
				'masterAccount' => '',
				'code' => ''
			),
			'Account' => array(
				'id' => '',
				'Account' => '',
				'code' => ''
			),
			'SubAccount' => array(
				'id' => '',
				'subAccount' => '',
				'code' => ''
			),
			'Type' => array(
				'id' => '',
				'type' => ''
			),
			'CCJournal' => array(
				'id' => '',
				'Card' => '',
				'Date' => '1',
				'Description' => '',
				'Cleared' => '',
				'Amount' => '',
				'Balance' => '',
				'Logged' => '',
				'Photo' => ''
			),
			'CC' => array(
				'id' => '',
				'Card' => ''
			),
			'Receivable' => array(
				'id' => '',
				'Customer' => '',
				'Phone' => '',
				'Description' => '',
				'Interaction' => '',
				'ExpectedDate' => '',
				'LastUpdate' => '',
				'Status' => 'OPEN',
				'Assigned' => '',
				'Amount' => ''
			)
		);

		return isset($defaults[$table]) ? $defaults[$table] : array();
	}

	#########################################################

	function logInMember() {
		$redir = 'index.php';
		if($_POST['signIn'] != '') {
			if($_POST['username'] != '' && $_POST['password'] != '') {
				$username = makeSafe(strtolower($_POST['username']));
				$hash = sqlValue("select passMD5 from membership_users where lcase(memberID)='{$username}' and isApproved=1 and isBanned=0");
				$password = $_POST['password'];

				if(password_match($password, $hash)) {
					$_SESSION['memberID'] = $username;
					$_SESSION['memberGroupID'] = sqlValue("SELECT `groupID` FROM `membership_users` WHERE LCASE(`memberID`)='{$username}'");

					if($_POST['rememberMe'] == 1) {
						RememberMe::login($username);
					}else{
						RememberMe::delete();
					}

					// harden user's password hash
					password_harden($username, $password, $hash);

					// hook: login_ok
					if(function_exists('login_ok')) {
						$args=array();
						if(!$redir=login_ok(getMemberInfo(), $args)) {
							$redir='index.php';
						}
					}

					redirect($redir);
					exit;
				}
			}

			// hook: login_failed
			if(function_exists('login_failed')) {
				$args=array();
				login_failed(array(
					'username' => $_POST['username'],
					'password' => $_POST['password'],
					'IP' => $_SERVER['REMOTE_ADDR']
					), $args);
			}

			if(!headers_sent()) header('HTTP/1.0 403 Forbidden');
			redirect("index.php?loginFailed=1");
			exit;
		}

		/* do we have a JWT auth header? */
		jwt_check_login();

		if(!empty($_SESSION['memberID']) && !empty($_SESSION['memberGroupID'])) return;

		/* check if a rememberMe cookie exists and sign in user if so */
		if(RememberMe::check()) {
			$username = makeSafe(strtolower(RememberMe::user()));
			$_SESSION['memberID'] = $username;
			$_SESSION['memberGroupID'] = sqlValue("SELECT `groupID` FROM `membership_users` WHERE LCASE(`memberID`)='{$username}'");
		}
	}

	#########################################################

	function htmlUserBar() {
		global $adminConfig, $Translation;
		if(!defined('PREPEND_PATH')) define('PREPEND_PATH', '');

		ob_start();
		$home_page = (basename($_SERVER['PHP_SELF'])=='index.php' ? true : false);

		?>
		<nav class="navbar navbar-default navbar-fixed-top hidden-print" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<!-- application title is obtained from the name besides the yellow database icon in AppGini, use underscores for spaces -->
				<a class="navbar-brand" href="<?php echo PREPEND_PATH; ?>index.php"><i class="glyphicon glyphicon-home"></i> Tradexx</a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<?php if(!$home_page) { ?>
						<?php echo NavMenus(); ?>
					<?php } ?>
				</ul>

				<?php if(getLoggedAdmin()) { ?>
					<ul class="nav navbar-nav">
						<a href="<?php echo PREPEND_PATH; ?>admin/pageHome.php" class="btn btn-danger navbar-btn hidden-xs" title="<?php echo html_attr($Translation['admin area']); ?>"><i class="glyphicon glyphicon-cog"></i> <?php echo $Translation['admin area']; ?></a>
						<a href="<?php echo PREPEND_PATH; ?>admin/pageHome.php" class="btn btn-danger navbar-btn visible-xs btn-lg" title="<?php echo html_attr($Translation['admin area']); ?>"><i class="glyphicon glyphicon-cog"></i> <?php echo $Translation['admin area']; ?></a>
					</ul>
				<?php } ?>

				<?php if(!$_GET['signIn'] && !$_GET['loginFailed']) { ?>
					<?php if(getLoggedMemberID() == $adminConfig['anonymousMember']) { ?>
						<p class="navbar-text navbar-right">&nbsp;</p>
						<a href="<?php echo PREPEND_PATH; ?>index.php?signIn=1" class="btn btn-success navbar-btn navbar-right"><?php echo $Translation['sign in']; ?></a>
						<p class="navbar-text navbar-right">
							<?php echo $Translation['not signed in']; ?>
						</p>
					<?php }else{ ?>
						<ul class="nav navbar-nav navbar-right hidden-xs" style="min-width: 330px;">
							<a class="btn navbar-btn btn-default" href="<?php echo PREPEND_PATH; ?>index.php?signOut=1"><i class="glyphicon glyphicon-log-out"></i> <?php echo $Translation['sign out']; ?></a>
							<p class="navbar-text">
								<?php echo $Translation['signed as']; ?> <strong><a href="<?php echo PREPEND_PATH; ?>membership_profile.php" class="navbar-link"><?php echo getLoggedMemberID(); ?></a></strong>
							</p>
						</ul>
						<ul class="nav navbar-nav visible-xs">
							<a class="btn navbar-btn btn-default btn-lg visible-xs" href="<?php echo PREPEND_PATH; ?>index.php?signOut=1"><i class="glyphicon glyphicon-log-out"></i> <?php echo $Translation['sign out']; ?></a>
							<p class="navbar-text text-center">
								<?php echo $Translation['signed as']; ?> <strong><a href="<?php echo PREPEND_PATH; ?>membership_profile.php" class="navbar-link"><?php echo getLoggedMemberID(); ?></a></strong>
							</p>
						</ul>
						<script>
							/* periodically check if user is still signed in */
							setInterval(function() {
								$j.ajax({
									url: '<?php echo PREPEND_PATH; ?>ajax_check_login.php',
									success: function(username) {
										if(!username.length) window.location = '<?php echo PREPEND_PATH; ?>index.php?signIn=1';
									}
								});
							}, 60000);
						</script>
					<?php } ?>
				<?php } ?>
			</div>
		</nav>
		<?php

		$html = ob_get_contents();
		ob_end_clean();

		return $html;
	}

	#########################################################

	function showNotifications($msg = '', $class = '', $fadeout = true) {
		global $Translation;

		$notify_template_no_fadeout = '<div id="%%ID%%" class="alert alert-dismissable %%CLASS%%" style="display: none; padding-top: 6px; padding-bottom: 6px;">' .
					'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' .
					'%%MSG%%</div>' .
					'<script> jQuery(function() { /* */ jQuery("#%%ID%%").show("slow"); }); </script>'."\n";
		$notify_template = '<div id="%%ID%%" class="alert %%CLASS%%" style="display: none; padding-top: 6px; padding-bottom: 6px;">%%MSG%%</div>' .
					'<script>' .
						'jQuery(function() {' .
							'jQuery("#%%ID%%").show("slow", function() {' .
								'setTimeout(function() { /* */ jQuery("#%%ID%%").hide("slow"); }, 4000);' .
							'});' .
						'});' .
					'</script>'."\n";

		if(!$msg) { // if no msg, use url to detect message to display
			if($_REQUEST['record-added-ok'] != '') {
				$msg = $Translation['new record saved'];
				$class = 'alert-success';
			}elseif($_REQUEST['record-added-error'] != '') {
				$msg = $Translation['Couldn\'t save the new record'];
				$class = 'alert-danger';
				$fadeout = false;
			}elseif($_REQUEST['record-updated-ok'] != '') {
				$msg = $Translation['record updated'];
				$class = 'alert-success';
			}elseif($_REQUEST['record-updated-error'] != '') {
				$msg = $Translation['Couldn\'t save changes to the record'];
				$class = 'alert-danger';
				$fadeout = false;
			}elseif($_REQUEST['record-deleted-ok'] != '') {
				$msg = $Translation['The record has been deleted successfully'];
				$class = 'alert-success';
				$fadeout = false;
			}elseif($_REQUEST['record-deleted-error'] != '') {
				$msg = $Translation['Couldn\'t delete this record'];
				$class = 'alert-danger';
				$fadeout = false;
			}else{
				return '';
			}
		}
		$id = 'notification-' . rand();

		$out = ($fadeout ? $notify_template : $notify_template_no_fadeout);
		$out = str_replace('%%ID%%', $id, $out);
		$out = str_replace('%%MSG%%', $msg, $out);
		$out = str_replace('%%CLASS%%', $class, $out);

		return $out;
	}

	#########################################################

	function parseMySQLDate($date, $altDate) {
		// is $date valid?
		if(preg_match("/^\d{4}-\d{1,2}-\d{1,2}$/", trim($date))) {
			return trim($date);
		}

		if($date != '--' && preg_match("/^\d{4}-\d{1,2}-\d{1,2}$/", trim($altDate))) {
			return trim($altDate);
		}

		if($date != '--' && $altDate && intval($altDate)==$altDate) {
			return @date('Y-m-d', @time() + ($altDate >= 1 ? $altDate - 1 : $altDate) * 86400);
		}

		return '';
	}

	#########################################################

	function parseCode($code, $isInsert=true, $rawData=false) {
		if($isInsert) {
			$arrCodes=array(
				'<%%creatorusername%%>' => $_SESSION['memberID'],
				'<%%creatorgroupid%%>' => $_SESSION['memberGroupID'],
				'<%%creatorip%%>' => $_SERVER['REMOTE_ADDR'],
				'<%%creatorgroup%%>' => sqlValue("select name from membership_groups where groupID='{$_SESSION['memberGroupID']}'"),

				'<%%creationdate%%>' => ($rawData ? @date('Y-m-d') : @date('n/j/Y')),
				'<%%creationtime%%>' => ($rawData ? @date('H:i:s') : @date('h:i:s a')),
				'<%%creationdatetime%%>' => ($rawData ? @date('Y-m-d H:i:s') : @date('n/j/Y h:i:s a')),
				'<%%creationtimestamp%%>' => ($rawData ? @date('Y-m-d H:i:s') : @time())
			);
		}else{
			$arrCodes=array(
				'<%%editorusername%%>' => $_SESSION['memberID'],
				'<%%editorgroupid%%>' => $_SESSION['memberGroupID'],
				'<%%editorip%%>' => $_SERVER['REMOTE_ADDR'],
				'<%%editorgroup%%>' => sqlValue("select name from membership_groups where groupID='{$_SESSION['memberGroupID']}'"),

				'<%%editingdate%%>' => ($rawData ? @date('Y-m-d') : @date('n/j/Y')),
				'<%%editingtime%%>' => ($rawData ? @date('H:i:s') : @date('h:i:s a')),
				'<%%editingdatetime%%>' => ($rawData ? @date('Y-m-d H:i:s') : @date('n/j/Y h:i:s a')),
				'<%%editingtimestamp%%>' => ($rawData ? @date('Y-m-d H:i:s') : @time())
			);
		}

		$pc=str_ireplace(array_keys($arrCodes), array_values($arrCodes), $code);

		return $pc;
	}

	#########################################################

	function addFilter($index, $filterAnd, $filterField, $filterOperator, $filterValue) {
		// validate input
		if($index < 1 || $index > 80 || !is_int($index)) return false;
		if($filterAnd != 'or')   $filterAnd = 'and';
		$filterField = intval($filterField);

		/* backward compatibility */
		if(in_array($filterOperator, $GLOBALS['filter_operators'])) {
			$filterOperator = array_search($filterOperator, $GLOBALS['filter_operators']);
		}

		if(!in_array($filterOperator, array_keys($GLOBALS['filter_operators']))) {
			$filterOperator = 'like';
		}

		if(!$filterField) {
			$filterOperator = '';
			$filterValue = '';
		}

		$_REQUEST['FilterAnd'][$index] = $filterAnd;
		$_REQUEST['FilterField'][$index] = $filterField;
		$_REQUEST['FilterOperator'][$index] = $filterOperator;
		$_REQUEST['FilterValue'][$index] = $filterValue;

		return true;
	}

	#########################################################

	function clearFilters() {
		for($i=1; $i<=80; $i++) {
			addFilter($i, '', 0, '', '');
		}
	}

	#########################################################

	if(!function_exists('str_ireplace')) {
		function str_ireplace($search, $replace, $subject) {
			$ret=$subject;
			if(is_array($search)) {
				for($i=0; $i<count($search); $i++) {
					$ret=str_ireplace($search[$i], $replace[$i], $ret);
				}
			}else{
				$ret=preg_replace('/'.preg_quote($search, '/').'/i', $replace, $ret);
			}

			return $ret;
		} 
	} 

	#########################################################

	/**
	* Loads a given view from the templates folder, passing the given data to it
	* @param $view the name of a php file (without extension) to be loaded from the 'templates' folder
	* @param $the_data_to_pass_to_the_view (optional) associative array containing the data to pass to the view
	* @return the output of the parsed view as a string
	*/
	function loadView($view, $the_data_to_pass_to_the_view=false) {
		global $Translation;

		$view = dirname(__FILE__)."/templates/$view.php";
		if(!is_file($view)) return false;

		if(is_array($the_data_to_pass_to_the_view)) {
			foreach($the_data_to_pass_to_the_view as $k => $v)
				$$k = $v;
		}
		unset($the_data_to_pass_to_the_view, $k, $v);

		ob_start();
		@include($view);
		$out=ob_get_contents();
		ob_end_clean();

		return $out;
	}

	#########################################################

	/**
	* Loads a table template from the templates folder, passing the given data to it
	* @param $table_name the name of the table whose template is to be loaded from the 'templates' folder
	* @param $the_data_to_pass_to_the_table associative array containing the data to pass to the table template
	* @return the output of the parsed table template as a string
	*/
	function loadTable($table_name, $the_data_to_pass_to_the_table = array()) {
		$dont_load_header = $the_data_to_pass_to_the_table['dont_load_header'];
		$dont_load_footer = $the_data_to_pass_to_the_table['dont_load_footer'];

		$header = $table = $footer = '';

		if(!$dont_load_header) {
			// try to load tablename-header
			if(!($header = loadView("{$table_name}-header", $the_data_to_pass_to_the_table))) {
				$header = loadView('table-common-header', $the_data_to_pass_to_the_table);
			}
		}

		$table = loadView($table_name, $the_data_to_pass_to_the_table);

		if(!$dont_load_footer) {
			// try to load tablename-footer
			if(!($footer = loadView("{$table_name}-footer", $the_data_to_pass_to_the_table))) {
				$footer = loadView('table-common-footer', $the_data_to_pass_to_the_table);
			}
		}

		return "{$header}{$table}{$footer}";
	}

	#########################################################

	function filterDropdownBy($filterable, $filterers, $parentFilterers, $parentPKField, $parentCaption, $parentTable, &$filterableCombo) {
		$filterersArray = explode(',', $filterers);
		$parentFilterersArray = explode(',', $parentFilterers);
		$parentFiltererList = '`' . implode('`, `', $parentFilterersArray) . '`';
		$res=sql("SELECT `$parentPKField`, $parentCaption, $parentFiltererList FROM `$parentTable` ORDER BY 2", $eo);
		$filterableData = array();
		while($row=db_fetch_row($res)) {
			$filterableData[$row[0]] = $row[1];
			$filtererIndex = 0;
			foreach($filterersArray as $filterer) {
				$filterableDataByFilterer[$filterer][$row[$filtererIndex + 2]][$row[0]] = $row[1];
				$filtererIndex++;
			}
			$row[0] = addslashes($row[0]);
			$row[1] = addslashes($row[1]);
			$jsonFilterableData .= "\"{$row[0]}\":\"{$row[1]}\",";
		}
		$jsonFilterableData .= '}';
		$jsonFilterableData = '{'.str_replace(',}', '}', $jsonFilterableData);     
		$filterJS = "\nvar {$filterable}_data = $jsonFilterableData;";

		foreach($filterersArray as $filterer) {
			if(is_array($filterableDataByFilterer[$filterer])) foreach($filterableDataByFilterer[$filterer] as $filtererItem => $filterableItem) {
				$jsonFilterableDataByFilterer[$filterer] .= '"'.addslashes($filtererItem).'":{';
				foreach($filterableItem as $filterableItemID => $filterableItemData) {
					$jsonFilterableDataByFilterer[$filterer] .= '"'.addslashes($filterableItemID).'":"'.addslashes($filterableItemData).'",';
				}
				$jsonFilterableDataByFilterer[$filterer] .= '},';
			}
			$jsonFilterableDataByFilterer[$filterer] .= '}';
			$jsonFilterableDataByFilterer[$filterer] = '{'.str_replace(',}', '}', $jsonFilterableDataByFilterer[$filterer]);

			$filterJS.="\n\n// code for filtering {$filterable} by {$filterer}\n";
			$filterJS.="\nvar {$filterable}_data_by_{$filterer} = {$jsonFilterableDataByFilterer[$filterer]}; ";
			$filterJS.="\nvar selected_{$filterable} = \$j('#{$filterable}').val();";
			$filterJS.="\nvar {$filterable}_change_by_{$filterer} = function() {";
			$filterJS.="\n\t$('{$filterable}').options.length=0;";
			$filterJS.="\n\t$('{$filterable}').options[0] = new Option();";
			$filterJS.="\n\tif(\$j('#{$filterer}').val()) {";
			$filterJS.="\n\t\tfor({$filterable}_item in {$filterable}_data_by_{$filterer}[\$j('#{$filterer}').val()]) {";
			$filterJS.="\n\t\t\t$('{$filterable}').options[$('{$filterable}').options.length] = new Option(";
			$filterJS.="\n\t\t\t\t{$filterable}_data_by_{$filterer}[\$j('#{$filterer}').val()][{$filterable}_item],";
			$filterJS.="\n\t\t\t\t{$filterable}_item,";
			$filterJS.="\n\t\t\t\t({$filterable}_item == selected_{$filterable} ? true : false),";
			$filterJS.="\n\t\t\t\t({$filterable}_item == selected_{$filterable} ? true : false)";
			$filterJS.="\n\t\t\t);";
			$filterJS.="\n\t\t}";
			$filterJS.="\n\t}else{";
			$filterJS.="\n\t\tfor({$filterable}_item in {$filterable}_data) {";
			$filterJS.="\n\t\t\t$('{$filterable}').options[$('{$filterable}').options.length] = new Option(";
			$filterJS.="\n\t\t\t\t{$filterable}_data[{$filterable}_item],";
			$filterJS.="\n\t\t\t\t{$filterable}_item,";
			$filterJS.="\n\t\t\t\t({$filterable}_item == selected_{$filterable} ? true : false),";
			$filterJS.="\n\t\t\t\t({$filterable}_item == selected_{$filterable} ? true : false)";
			$filterJS.="\n\t\t\t);";
			$filterJS.="\n\t\t}";
			$filterJS.="\n\t\tif(selected_{$filterable} && selected_{$filterable} == \$j('#{$filterable}').val()) {";
			$filterJS.="\n\t\t\tfor({$filterer}_item in {$filterable}_data_by_{$filterer}) {";
			$filterJS.="\n\t\t\t\tfor({$filterable}_item in {$filterable}_data_by_{$filterer}[{$filterer}_item]) {";
			$filterJS.="\n\t\t\t\t\tif({$filterable}_item == selected_{$filterable}) {";
			$filterJS.="\n\t\t\t\t\t\t$('{$filterer}').value = {$filterer}_item;";
			$filterJS.="\n\t\t\t\t\t\tbreak;";
			$filterJS.="\n\t\t\t\t\t}";
			$filterJS.="\n\t\t\t\t}";
			$filterJS.="\n\t\t\t\tif({$filterable}_item == selected_{$filterable}) break;";
			$filterJS.="\n\t\t\t}";
			$filterJS.="\n\t\t}";
			$filterJS.="\n\t}";
			$filterJS.="\n\t$('{$filterable}').highlight();";
			$filterJS.="\n};";
			$filterJS.="\n$('{$filterer}').observe('change', function() { /* */ window.setTimeout({$filterable}_change_by_{$filterer}, 25); });";
			$filterJS.="\n";
		}

		$filterableCombo = new Combo;
		$filterableCombo->ListType = 0;
		$filterableCombo->ListItem = array_slice(array_values($filterableData), 0, 10);
		$filterableCombo->ListData = array_slice(array_keys($filterableData), 0, 10);
		$filterableCombo->SelectName = $filterable;
		$filterableCombo->AllowNull = true;

		return $filterJS;
	}

	#########################################################
	function br2nl($text) {
		return  preg_replace('/\<br(\s*)?\/?\>/i', "\n", $text);
	}

	#########################################################

	if(!function_exists('htmlspecialchars_decode')) {
		function htmlspecialchars_decode($string, $quote_style = ENT_COMPAT) {
			return strtr($string, array_flip(get_html_translation_table(HTML_SPECIALCHARS, $quote_style)));
		}
	}

	#########################################################

	function entitiesToUTF8($input) {
		return preg_replace_callback('/(&#[0-9]+;)/', '_toUTF8', $input);
	}

	function _toUTF8($m) {
		if(function_exists('mb_convert_encoding')) {
			return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES");
		}else{
			return $m[1];
		}
	}

	#########################################################

	function func_get_args_byref() {
		if(!function_exists('debug_backtrace')) return false;

		$trace = debug_backtrace();
		return $trace[1]['args'];
	}

	#########################################################

	function permissions_sql($table, $level = 'all') {
		if(!in_array($level, array('user', 'group'))) { $level = 'all'; }
		$perm = getTablePermissions($table);
		$from = '';
		$where = '';
		$pk = getPKFieldName($table);

		if($perm[2] == 1 || ($perm[2] > 1 && $level == 'user')) { // view owner only
			$from = 'membership_userrecords';
			$where = "(`$table`.`$pk`=membership_userrecords.pkValue and membership_userrecords.tableName='$table' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."')";
		}elseif($perm[2] == 2 || ($perm[2] > 2 && $level == 'group')) { // view group only
			$from = 'membership_userrecords';
			$where = "(`$table`.`$pk`=membership_userrecords.pkValue and membership_userrecords.tableName='$table' and membership_userrecords.groupID='".getLoggedGroupID()."')";
		}elseif($perm[2] == 3) { // view all
			// no further action
		}elseif($perm[2] == 0) { // view none
			return false;
		}

		return array('where' => $where, 'from' => $from, 0 => $where, 1 => $from);
	}

	#########################################################

	function error_message($msg, $back_url = '', $full_page = true) {
		$curr_dir = dirname(__FILE__);
		global $Translation;

		ob_start();

		if($full_page) include_once($curr_dir . '/header.php');

		echo '<div class="panel panel-danger">';
			echo '<div class="panel-heading"><h3 class="panel-title">' . $Translation['error:'] . '</h3></div>';
			echo '<div class="panel-body"><p class="text-danger">' . $msg . '</p>';
			if($back_url !== false) { // explicitly passing false suppresses the back link completely
				echo '<div class="text-center">';
				if($back_url) {
					echo '<a href="' . $back_url . '" class="btn btn-danger btn-lg vspacer-lg"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['< back'] . '</a>';
				}else{
					echo '<a href="#" class="btn btn-danger btn-lg vspacer-lg" onclick="history.go(-1); return false;"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['< back'] . '</a>';
				}
				echo '</div>';
			}
			echo '</div>';
		echo '</div>';

		if($full_page) include_once($curr_dir . '/footer.php');

		$out = ob_get_contents();
		ob_end_clean();

		return $out;
	}

	#########################################################

	function toMySQLDate($formattedDate, $sep = datalist_date_separator, $ord = datalist_date_format) {
		// extract date elements
		$de=explode($sep, $formattedDate);
		$mySQLDate=intval($de[strpos($ord, 'Y')]).'-'.intval($de[strpos($ord, 'm')]).'-'.intval($de[strpos($ord, 'd')]);
		return $mySQLDate;
	}

	#########################################################

	function reIndex(&$arr) {
		$i=1;
		foreach($arr as $n=>$v) {
			$arr2[$i]=$n;
			$i++;
		}
		return $arr2;
	}

	#########################################################

	function get_embed($provider, $url, $max_width = '', $max_height = '', $retrieve = 'html') {
		global $Translation;
		if(!$url) return '';

		$providers = array(
			'youtube' => array('oembed' => 'http://www.youtube.com/oembed?'),
			'googlemap' => array('oembed' => '', 'regex' => '/^http.*\.google\..*maps/i')
		);

		if(!isset($providers[$provider])) {
			return '<div class="text-danger">' . $Translation['invalid provider'] . '</div>';
		}

		if(isset($providers[$provider]['regex']) && !preg_match($providers[$provider]['regex'], $url)) {
			return '<div class="text-danger">' . $Translation['invalid url'] . '</div>';
		}

		if($providers[$provider]['oembed']) {
			$oembed = $providers[$provider]['oembed'] . 'url=' . urlencode($url) . "&maxwidth={$max_width}&maxheight={$max_height}&format=json";
			$data_json = request_cache($oembed);

			$data = json_decode($data_json, true);
			if($data === null) {
				/* an error was returned rather than a json string */
				if($retrieve == 'html') return "<div class=\"text-danger\">{$data_json}\n<!-- {$oembed} --></div>";
				return '';
			}

			return (isset($data[$retrieve]) ? $data[$retrieve] : $data['html']);
		}

		/* special cases (where there is no oEmbed provider) */
		if($provider == 'googlemap') return get_embed_googlemap($url, $max_width, $max_height, $retrieve);

		return '<div class="text-danger">Invalid provider!</div>';
	}

	#########################################################

	function get_embed_googlemap($url, $max_width = '', $max_height = '', $retrieve = 'html') {
		global $Translation;
		$url_parts = parse_url($url);
		$coords_regex = '/-?\d+(\.\d+)?[,+]-?\d+(\.\d+)?(,\d{1,2}z)?/'; /* https://stackoverflow.com/questions/2660201 */

		if(preg_match($coords_regex, $url_parts['path'] . '?' . $url_parts['query'], $m)) {
			list($lat, $long, $zoom) = explode(',', $m[0]);
			$zoom = intval($zoom);
			if(!$zoom) $zoom = 10; /* default zoom */
			if(!$max_height) $max_height = 360;
			if(!$max_width) $max_width = 480;

			$api_key = '';
			$embed_url = "https://www.google.com/maps/embed/v1/view?key={$api_key}&center={$lat},{$long}&zoom={$zoom}&maptype=roadmap";
			$thumbnail_url = "https://maps.googleapis.com/maps/api/staticmap?key={$api_key}&center={$lat},{$long}&zoom={$zoom}&maptype=roadmap&size={$max_width}x{$max_height}";

			if($retrieve == 'html') {
				return "<iframe width=\"{$max_width}\" height=\"{$max_height}\" frameborder=\"0\" style=\"border:0\" src=\"{$embed_url}\"></iframe>";
			}else{
				return $thumbnail_url;
			}
		}else{
			return '<div class="text-danger">' . $Translation['cant retrieve coordinates from url'] . '</div>';
		}
	}

	#########################################################

	function request_cache($request, $force_fetch = false) {
		$max_cache_lifetime = 7 * 86400; /* max cache lifetime in seconds before refreshing from source */

		/* membership_cache table exists? if not, create it */
		static $cache_table_exists = false;
		if(!$cache_table_exists && !$force_fetch) {
			$te = sqlValue("show tables like 'membership_cache'");
			if(!$te) {
				if(!sql("CREATE TABLE `membership_cache` (`request` VARCHAR(100) NOT NULL, `request_ts` INT, `response` TEXT NOT NULL, PRIMARY KEY (`request`))", $eo)) {
					/* table can't be created, so force fetching request */
					return request_cache($request, true);
				}
			}
			$cache_table_exists = true;
		}

		/* retrieve response from cache if exists */
		if(!$force_fetch) {
			$res = sql("select response, request_ts from membership_cache where request='" . md5($request) . "'", $eo);
			if(!$row = db_fetch_array($res)) return request_cache($request, true);

			$response = $row[0];
			$response_ts = $row[1];
			if($response_ts < time() - $max_cache_lifetime) return request_cache($request, true);
		}

		/* if no response in cache, issue a request */
		if(!$response || $force_fetch) {
			$response = @file_get_contents($request);
			if($response === false) {
				$error = error_get_last();
				$error_message = preg_replace('/.*: (.*)/', '$1', $error['message']);
				return $error_message;
			}elseif($cache_table_exists) {
				/* store response in cache */
				$ts = time();
				sql("replace into membership_cache set request='" . md5($request) . "', request_ts='{$ts}', response='" . makeSafe($response, false) . "'", $eo);
			}
		}

		return $response;
	}

	#########################################################

	function check_record_permission($table, $id, $perm = 'view') {
		if($perm != 'edit' && $perm != 'delete') $perm = 'view';

		$perms = getTablePermissions($table);
		if(!$perms[$perm]) return false;

		$safe_id = makeSafe($id);
		$safe_table = makeSafe($table);

		if($perms[$perm] == 1) { // own records only
			$username = getLoggedMemberID();
			$owner = sqlValue("select memberID from membership_userrecords where tableName='{$safe_table}' and pkValue='{$safe_id}'");
			if($owner == $username) return true;
		}elseif($perms[$perm] == 2) { // group records
			$group_id = getLoggedGroupID();
			$owner_group_id = sqlValue("select groupID from membership_userrecords where tableName='{$safe_table}' and pkValue='{$safe_id}'");
			if($owner_group_id == $group_id) return true;
		}elseif($perms[$perm] == 3) { // all records
			return true;
		}

		return false;
	}

	#########################################################

	function NavMenus($options = array()) {
		if(!defined('PREPEND_PATH')) define('PREPEND_PATH', '');
		global $Translation;
		$prepend_path = PREPEND_PATH;

		/* default options */
		if(empty($options)) {
			$options = array(
				'tabs' => 7
			);
		}

		$table_group_name = array_keys(get_table_groups()); /* 0 => group1, 1 => group2 .. */
		/* if only one group named 'None', set to translation of 'select a table' */
		if((count($table_group_name) == 1 && $table_group_name[0] == 'None') || count($table_group_name) < 1) $table_group_name[0] = $Translation['select a table'];
		$table_group_index = array_flip($table_group_name); /* group1 => 0, group2 => 1 .. */
		$menu = array_fill(0, count($table_group_name), '');

		$t = time();
		$arrTables = getTableList();
		if(is_array($arrTables)) {
			foreach($arrTables as $tn => $tc) {
				/* ---- list of tables where hide link in nav menu is set ---- */
				$tChkHL = array_search($tn, array('Country','Province','City','InvoiceDetails','Brand','Model','System','Part','Department','Position','CEO','Manager','Supervisor','MasterAccount','Account','SubAccount','Type','CC'));

				/* ---- list of tables where filter first is set ---- */
				$tChkFF = array_search($tn, array());
				if($tChkFF !== false && $tChkFF !== null) {
					$searchFirst = '&Filter_x=1';
				}else{
					$searchFirst = '';
				}

				/* when no groups defined, $table_group_index['None'] is NULL, so $menu_index is still set to 0 */
				$menu_index = intval($table_group_index[$tc[3]]);
				if(!$tChkHL && $tChkHL !== 0) $menu[$menu_index] .= "<li><a href=\"{$prepend_path}{$tn}_view.php?t={$t}{$searchFirst}\"><img src=\"{$prepend_path}" . ($tc[2] ? $tc[2] : 'blank.gif') . "\" height=\"32\"> {$tc[0]}</a></li>";
			}
		}

		// custom nav links, as defined in "hooks/links-navmenu.php" 
		global $navLinks;
		if(is_array($navLinks)) {
			$memberInfo = getMemberInfo();
			$links_added = array();
			foreach($navLinks as $link) {
				if(!isset($link['url']) || !isset($link['title'])) continue;
				if($memberInfo['admin'] || @in_array($memberInfo['group'], $link['groups']) || @in_array('*', $link['groups'])) {
					$menu_index = intval($link['table_group']);
					if(!$links_added[$menu_index]) $menu[$menu_index] .= '<li class="divider"></li>';

					/* add prepend_path to custom links if they aren't absolute links */
					if(!preg_match('/^(http|\/\/)/i', $link['url'])) $link['url'] = $prepend_path . $link['url'];
					if(!preg_match('/^(http|\/\/)/i', $link['icon']) && $link['icon']) $link['icon'] = $prepend_path . $link['icon'];

					$menu[$menu_index] .= "<li><a href=\"{$link['url']}\"><img src=\"" . ($link['icon'] ? $link['icon'] : "{$prepend_path}blank.gif") . "\" height=\"32\"> {$link['title']}</a></li>";
					$links_added[$menu_index]++;
				}
			}
		}

		$menu_wrapper = '';
		for($i = 0; $i < count($menu); $i++) {
			$menu_wrapper .= <<<EOT
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">{$table_group_name[$i]} <b class="caret"></b></a>
					<ul class="dropdown-menu" role="menu">{$menu[$i]}</ul>
				</li>
EOT;
		}

		return $menu_wrapper;
	}

	#########################################################

	function StyleSheet() {
		if(!defined('PREPEND_PATH')) define('PREPEND_PATH', '');
		$prepend_path = PREPEND_PATH;

		$css_links = <<<EOT

			<link rel="stylesheet" href="{$prepend_path}resources/initializr/css/slate.css">
			<link rel="stylesheet" href="{$prepend_path}resources/lightbox/css/lightbox.css" media="screen">
			<link rel="stylesheet" href="{$prepend_path}resources/select2/select2.css" media="screen">
			<link rel="stylesheet" href="{$prepend_path}resources/timepicker/bootstrap-timepicker.min.css" media="screen">
			<link rel="stylesheet" href="{$prepend_path}dynamic.css.php">
EOT;

		return $css_links;
	}

	#########################################################

	function getUploadDir($dir) {
		global $Translation;

		if($dir=="") {
			$dir=$Translation['ImageFolder'];
		}

		if(substr($dir, -1)!="/") {
			$dir.="/";
		}

		return $dir;
	}

	#########################################################

	function PrepareUploadedFile($FieldName, $MaxSize, $FileTypes = 'jpg|jpeg|gif|png', $NoRename = false, $dir = '') {
		global $Translation;
		$f = $_FILES[$FieldName];
		if($f['error'] == 4 || !$f['name']) return '';

		$dir = getUploadDir($dir);

		/* get php.ini upload_max_filesize in bytes */
		$php_upload_size_limit = trim(ini_get('upload_max_filesize'));
		$last = strtolower($php_upload_size_limit[strlen($php_upload_size_limit) - 1]);
		switch($last) {
			case 'g':
				$php_upload_size_limit *= 1024;
			case 'm':
				$php_upload_size_limit *= 1024;
			case 'k':
				$php_upload_size_limit *= 1024;
		}

		$MaxSize = min($MaxSize, $php_upload_size_limit);

		if($f['size'] > $MaxSize || $f['error']) {
			echo error_message(str_replace('<MaxSize>', intval($MaxSize / 1024), $Translation['file too large']));
			exit;
		}
		if(!preg_match('/\.(' . $FileTypes . ')$/i', $f['name'], $ft)) {
			echo error_message(str_replace('<FileTypes>', str_replace('|', ', ', $FileTypes), $Translation['invalid file type']));
			exit;
		}

		$name = str_replace(' ', '_', $f['name']);
		if(!$NoRename) $name = substr(md5(microtime() . rand(0, 100000)), -17) . $ft[0];

		if(!file_exists($dir)) @mkdir($dir, 0777);

		if(!@move_uploaded_file($f['tmp_name'], $dir . $name)) {
			echo error_message("Couldn't save the uploaded file. Try chmoding the upload folder '{$dir}' to 777.");
			exit;
		}

		@chmod($dir . $name, 0666);
		return $name;
	}

	#########################################################

	function get_home_links($homeLinks, $default_classes, $tgroup = '') {
		if(!is_array($homeLinks) || !count($homeLinks)) return '';

		$memberInfo = getMemberInfo();

		ob_start();
		foreach($homeLinks as $link) {
			if(!isset($link['url']) || !isset($link['title'])) continue;
			if($tgroup != $link['table_group'] && $tgroup != '*') continue;

			/* fall-back classes if none defined */
			if(!$link['grid_column_classes']) $link['grid_column_classes'] = $default_classes['grid_column'];
			if(!$link['panel_classes']) $link['panel_classes'] = $default_classes['panel'];
			if(!$link['link_classes']) $link['link_classes'] = $default_classes['link'];

			if($memberInfo['admin'] || @in_array($memberInfo['group'], $link['groups']) || @in_array('*', $link['groups'])) {
				?>
				<div class="col-xs-12 <?php echo $link['grid_column_classes']; ?>">
					<div class="panel <?php echo $link['panel_classes']; ?>">
						<div class="panel-body">
							<a class="btn btn-block btn-lg <?php echo $link['link_classes']; ?>" title="<?php echo preg_replace("/&amp;(#[0-9]+|[a-z]+);/i", "&$1;", html_attr(strip_tags($link['description']))); ?>" href="<?php echo $link['url']; ?>"><?php echo ($link['icon'] ? '<img src="' . $link['icon'] . '">' : ''); ?><strong><?php echo $link['title']; ?></strong></a>
							<div class="panel-body-description"><?php echo $link['description']; ?></div>
						</div>
					</div>
				</div>
				<?php
			}
		}

		$html = ob_get_contents();
		ob_end_clean();

		return $html;
	}

	#########################################################

	function quick_search_html($search_term, $label, $separate_dv = true) {
		global $Translation;

		$safe_search = html_attr($search_term);
		$safe_label = html_attr($label);
		$safe_clear_label = html_attr($Translation['Reset Filters']);

		if($separate_dv) {
			$reset_selection = "document.myform.SelectedID.value = '';";
		}else{
			$reset_selection = "document.myform.writeAttribute('novalidate', 'novalidate');";
		}
		$reset_selection .= ' document.myform.NoDV.value=1; return true;';

		$html = <<<EOT
		<div class="input-group" id="quick-search">
			<input type="text" id="SearchString" name="SearchString" value="{$safe_search}" class="form-control" placeholder="{$safe_label}">
			<span class="input-group-btn">
				<button name="Search_x" value="1" id="Search" type="submit" onClick="{$reset_selection}" class="btn btn-default" title="{$safe_label}"><i class="glyphicon glyphicon-search"></i></button>
				<button name="ClearQuickSearch" value="1" id="ClearQuickSearch" type="submit" onClick="\$j('#SearchString').val(''); {$reset_selection}" class="btn btn-default" title="{$safe_clear_label}"><i class="glyphicon glyphicon-remove-circle"></i></button>
			</span>
		</div>
EOT;
		return $html;
	}

	#########################################################

