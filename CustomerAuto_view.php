<?php
// This script and data application were generated by AppGini 5.84
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/CustomerAuto.php");
	include("$currDir/CustomerAuto_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('CustomerAuto');
	if(!$perm[0]) {
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "CustomerAuto";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(
		"`CustomerAuto`.`id`" => "id",
		"IF(    CHAR_LENGTH(`Customers1`.`Customer`), CONCAT_WS('',   `Customers1`.`Customer`), '') /* Customer */" => "Customer",
		"`CustomerAuto`.`VehicleType`" => "VehicleType",
		"`CustomerAuto`.`VIN`" => "VIN",
		"IF(    CHAR_LENGTH(`Brand1`.`Brand`), CONCAT_WS('',   `Brand1`.`Brand`), '') /* Brand */" => "Brand",
		"IF(    CHAR_LENGTH(`Model1`.`Model`), CONCAT_WS('',   `Model1`.`Model`), '') /* Model */" => "Model",
		"`CustomerAuto`.`Year`" => "Year",
		"`CustomerAuto`.`EngineNo`" => "EngineNo",
		"`CustomerAuto`.`Cylinder`" => "Cylinder",
		"`CustomerAuto`.`Liters`" => "Liters",
		"`CustomerAuto`.`Transmission`" => "Transmission",
		"`CustomerAuto`.`GEAR`" => "GEAR",
		"`CustomerAuto`.`URL`" => "URL",
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(
		1 => '`CustomerAuto`.`id`',
		2 => '`Customers1`.`Customer`',
		3 => 3,
		4 => 4,
		5 => '`Brand1`.`Brand`',
		6 => '`Model1`.`Model`',
		7 => '`CustomerAuto`.`Year`',
		8 => 8,
		9 => 9,
		10 => 10,
		11 => 11,
		12 => 12,
		13 => 13,
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(
		"`CustomerAuto`.`id`" => "id",
		"IF(    CHAR_LENGTH(`Customers1`.`Customer`), CONCAT_WS('',   `Customers1`.`Customer`), '') /* Customer */" => "Customer",
		"`CustomerAuto`.`VehicleType`" => "VehicleType",
		"`CustomerAuto`.`VIN`" => "VIN",
		"IF(    CHAR_LENGTH(`Brand1`.`Brand`), CONCAT_WS('',   `Brand1`.`Brand`), '') /* Brand */" => "Brand",
		"IF(    CHAR_LENGTH(`Model1`.`Model`), CONCAT_WS('',   `Model1`.`Model`), '') /* Model */" => "Model",
		"`CustomerAuto`.`Year`" => "Year",
		"`CustomerAuto`.`EngineNo`" => "EngineNo",
		"`CustomerAuto`.`Cylinder`" => "Cylinder",
		"`CustomerAuto`.`Liters`" => "Liters",
		"`CustomerAuto`.`Transmission`" => "Transmission",
		"`CustomerAuto`.`GEAR`" => "GEAR",
		"`CustomerAuto`.`URL`" => "URL",
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(
		"`CustomerAuto`.`id`" => "ID",
		"IF(    CHAR_LENGTH(`Customers1`.`Customer`), CONCAT_WS('',   `Customers1`.`Customer`), '') /* Customer */" => "Customer",
		"`CustomerAuto`.`VehicleType`" => "VehicleType",
		"`CustomerAuto`.`VIN`" => "VIN",
		"IF(    CHAR_LENGTH(`Brand1`.`Brand`), CONCAT_WS('',   `Brand1`.`Brand`), '') /* Brand */" => "Brand",
		"IF(    CHAR_LENGTH(`Model1`.`Model`), CONCAT_WS('',   `Model1`.`Model`), '') /* Model */" => "Model",
		"`CustomerAuto`.`Year`" => "Year",
		"`CustomerAuto`.`EngineNo`" => "Engine No (Optional)",
		"`CustomerAuto`.`Cylinder`" => "Cylinder",
		"`CustomerAuto`.`Liters`" => "Liters",
		"`CustomerAuto`.`Transmission`" => "Transmission",
		"`CustomerAuto`.`GEAR`" => "GEAR",
		"`CustomerAuto`.`URL`" => "URL",
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(
		"`CustomerAuto`.`id`" => "id",
		"IF(    CHAR_LENGTH(`Customers1`.`Customer`), CONCAT_WS('',   `Customers1`.`Customer`), '') /* Customer */" => "Customer",
		"`CustomerAuto`.`VehicleType`" => "VehicleType",
		"`CustomerAuto`.`VIN`" => "VIN",
		"IF(    CHAR_LENGTH(`Brand1`.`Brand`), CONCAT_WS('',   `Brand1`.`Brand`), '') /* Brand */" => "Brand",
		"IF(    CHAR_LENGTH(`Model1`.`Model`), CONCAT_WS('',   `Model1`.`Model`), '') /* Model */" => "Model",
		"`CustomerAuto`.`Year`" => "Year",
		"`CustomerAuto`.`EngineNo`" => "EngineNo",
		"`CustomerAuto`.`Cylinder`" => "Cylinder",
		"`CustomerAuto`.`Liters`" => "Liters",
		"`CustomerAuto`.`Transmission`" => "Transmission",
		"`CustomerAuto`.`GEAR`" => "GEAR",
		"`CustomerAuto`.`URL`" => "URL",
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array('Customer' => 'Customer', 'Brand' => 'Brand', 'Model' => 'Model', );

	$x->QueryFrom = "`CustomerAuto` LEFT JOIN `Customers` as Customers1 ON `Customers1`.`id`=`CustomerAuto`.`Customer` LEFT JOIN `Brand` as Brand1 ON `Brand1`.`id`=`CustomerAuto`.`Brand` LEFT JOIN `Model` as Model1 ON `Model1`.`id`=`CustomerAuto`.`Model` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm[2]==0 ? 1 : 0);
	$x->AllowDelete = $perm[4];
	$x->AllowMassDelete = true;
	$x->AllowInsert = $perm[1];
	$x->AllowUpdate = $perm[3];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 0;
	$x->AllowFilters = 1;
	$x->AllowSavingFilters = 0;
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowPrintingDV = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 300;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation["quick search"];
	$x->ScriptFileName = "CustomerAuto_view.php";
	$x->RedirectAfterInsert = "CustomerAuto_view.php?SelectedID=#ID#";
	$x->TableTitle = "CUSTOMER'S VEHICLES";
	$x->TableIcon = "resources/table_icons/vehicle 1.png";
	$x->PrimaryKey = "`CustomerAuto`.`id`";

	$x->ColWidth   = array(  150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Customer", "VehicleType", "VIN", "Brand", "Model", "Year", "Engine No (Optional)", "Cylinder", "Liters", "Transmission", "GEAR");
	$x->ColFieldName = array('Customer', 'VehicleType', 'VIN', 'Brand', 'Model', 'Year', 'EngineNo', 'Cylinder', 'Liters', 'Transmission', 'GEAR');
	$x->ColNumber  = array(2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);

	// template paths below are based on the app main directory
	$x->Template = 'templates/CustomerAuto_templateTV.html';
	$x->SelectedTemplate = 'templates/CustomerAuto_templateTVS.html';
	$x->TemplateDV = 'templates/CustomerAuto_templateDV.html';
	$x->TemplateDVP = 'templates/CustomerAuto_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HighlightColor = '#FFF0C2';
	$x->HasCalculatedFields = false;

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))) { $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])) { // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `CustomerAuto`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='CustomerAuto' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])) { // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `CustomerAuto`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='CustomerAuto' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3) { // view all
		// no further action
	}elseif($perm[2]==0) { // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`CustomerAuto`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: CustomerAuto_init
	$render=TRUE;
	if(function_exists('CustomerAuto_init')) {
		$args=array();
		$render=CustomerAuto_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: CustomerAuto_header
	$headerCode='';
	if(function_exists('CustomerAuto_header')) {
		$args=array();
		$headerCode=CustomerAuto_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode) {
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: CustomerAuto_footer
	$footerCode='';
	if(function_exists('CustomerAuto_footer')) {
		$args=array();
		$footerCode=CustomerAuto_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode) {
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>