<?php
// This script and data application were generated by AppGini 5.84
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/Return.php");
	include("$currDir/Return_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('Return');
	if(!$perm[0]) {
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "Return";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(
		"`Return`.`id`" => "id",
		"if(`Return`.`Date`,date_format(`Return`.`Date`,'%m/%d/%Y'),'')" => "Date",
		"`Return`.`Invoice`" => "Invoice",
		"IF(    CHAR_LENGTH(`Warehouse1`.`Warehouse`), CONCAT_WS('',   `Warehouse1`.`Warehouse`), '') /* Warehouse */" => "Warehouse",
		"IF(    CHAR_LENGTH(`Tracking1`.`Tracking`), CONCAT_WS('',   `Tracking1`.`Tracking`), '') /* Tracking */" => "Tracking",
		"`Return`.`Shippingt`" => "Shippingt",
		"`Return`.`Status`" => "Status",
		"`Return`.`Amount`" => "Amount",
		"concat('<i class=\"glyphicon glyphicon-', if(`Return`.`Refund`, 'check', 'unchecked'), '\"></i>')" => "Refund",
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(
		1 => '`Return`.`id`',
		2 => '`Return`.`Date`',
		3 => 3,
		4 => '`Warehouse1`.`Warehouse`',
		5 => '`Tracking1`.`Tracking`',
		6 => 6,
		7 => 7,
		8 => '`Return`.`Amount`',
		9 => 9,
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(
		"`Return`.`id`" => "id",
		"if(`Return`.`Date`,date_format(`Return`.`Date`,'%m/%d/%Y'),'')" => "Date",
		"`Return`.`Invoice`" => "Invoice",
		"IF(    CHAR_LENGTH(`Warehouse1`.`Warehouse`), CONCAT_WS('',   `Warehouse1`.`Warehouse`), '') /* Warehouse */" => "Warehouse",
		"IF(    CHAR_LENGTH(`Tracking1`.`Tracking`), CONCAT_WS('',   `Tracking1`.`Tracking`), '') /* Tracking */" => "Tracking",
		"`Return`.`Shippingt`" => "Shippingt",
		"`Return`.`Status`" => "Status",
		"`Return`.`Amount`" => "Amount",
		"`Return`.`Refund`" => "Refund",
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(
		"`Return`.`id`" => "ID",
		"`Return`.`Date`" => "Date",
		"`Return`.`Invoice`" => "Invoice",
		"IF(    CHAR_LENGTH(`Warehouse1`.`Warehouse`), CONCAT_WS('',   `Warehouse1`.`Warehouse`), '') /* Warehouse */" => "Warehouse",
		"IF(    CHAR_LENGTH(`Tracking1`.`Tracking`), CONCAT_WS('',   `Tracking1`.`Tracking`), '') /* Tracking */" => "Tracking",
		"`Return`.`Shippingt`" => "Shipping type",
		"`Return`.`Status`" => "Status",
		"`Return`.`Amount`" => "Amount",
		"`Return`.`Refund`" => "Refunded",
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(
		"`Return`.`id`" => "id",
		"if(`Return`.`Date`,date_format(`Return`.`Date`,'%m/%d/%Y'),'')" => "Date",
		"`Return`.`Invoice`" => "Invoice",
		"IF(    CHAR_LENGTH(`Warehouse1`.`Warehouse`), CONCAT_WS('',   `Warehouse1`.`Warehouse`), '') /* Warehouse */" => "Warehouse",
		"IF(    CHAR_LENGTH(`Tracking1`.`Tracking`), CONCAT_WS('',   `Tracking1`.`Tracking`), '') /* Tracking */" => "Tracking",
		"`Return`.`Shippingt`" => "Shippingt",
		"`Return`.`Status`" => "Status",
		"`Return`.`Amount`" => "Amount",
		"concat('<i class=\"glyphicon glyphicon-', if(`Return`.`Refund`, 'check', 'unchecked'), '\"></i>')" => "Refund",
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array('Warehouse' => 'Warehouse', 'Tracking' => 'Tracking', );

	$x->QueryFrom = "`Return` LEFT JOIN `Warehouse` as Warehouse1 ON `Warehouse1`.`id`=`Return`.`Warehouse` LEFT JOIN `Tracking` as Tracking1 ON `Tracking1`.`id`=`Return`.`Tracking` ";
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
	$x->ScriptFileName = "Return_view.php";
	$x->RedirectAfterInsert = "Return_view.php?SelectedID=#ID#";
	$x->TableTitle = "RETURN";
	$x->TableIcon = "resources/table_icons/Products 1.png";
	$x->PrimaryKey = "`Return`.`id`";

	$x->ColWidth   = array(  150, 150, 150, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Date", "Invoice", "Warehouse", "Tracking", "Shipping type", "Status", "Amount", "Refunded");
	$x->ColFieldName = array('Date', 'Invoice', 'Warehouse', 'Tracking', 'Shippingt', 'Status', 'Amount', 'Refund');
	$x->ColNumber  = array(2, 3, 4, 5, 6, 7, 8, 9);

	// template paths below are based on the app main directory
	$x->Template = 'templates/Return_templateTV.html';
	$x->SelectedTemplate = 'templates/Return_templateTVS.html';
	$x->TemplateDV = 'templates/Return_templateDV.html';
	$x->TemplateDVP = 'templates/Return_templateDVP.html';

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
		$x->QueryWhere="where `Return`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='Return' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])) { // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `Return`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='Return' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3) { // view all
		// no further action
	}elseif($perm[2]==0) { // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`Return`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: Return_init
	$render=TRUE;
	if(function_exists('Return_init')) {
		$args=array();
		$render=Return_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: Return_header
	$headerCode='';
	if(function_exists('Return_header')) {
		$args=array();
		$headerCode=Return_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode) {
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: Return_footer
	$footerCode='';
	if(function_exists('Return_footer')) {
		$args=array();
		$footerCode=Return_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode) {
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>