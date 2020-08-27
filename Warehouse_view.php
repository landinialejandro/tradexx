<?php
// This script and data application were generated by AppGini 5.84
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/Warehouse.php");
	include("$currDir/Warehouse_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('Warehouse');
	if(!$perm[0]) {
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "Warehouse";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(
		"`Warehouse`.`id`" => "id",
		"`Warehouse`.`Warehouse`" => "Warehouse",
		"if(`Warehouse`.`Date`,date_format(`Warehouse`.`Date`,'%m/%d/%Y'),'')" => "Date",
		"`Warehouse`.`Freight`" => "Freight",
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(
		1 => '`Warehouse`.`id`',
		2 => 2,
		3 => '`Warehouse`.`Date`',
		4 => 4,
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(
		"`Warehouse`.`id`" => "id",
		"`Warehouse`.`Warehouse`" => "Warehouse",
		"if(`Warehouse`.`Date`,date_format(`Warehouse`.`Date`,'%m/%d/%Y'),'')" => "Date",
		"`Warehouse`.`Freight`" => "Freight",
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(
		"`Warehouse`.`id`" => "ID",
		"`Warehouse`.`Warehouse`" => "Warehouse",
		"`Warehouse`.`Date`" => "Date",
		"`Warehouse`.`Freight`" => "Freight type",
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(
		"`Warehouse`.`id`" => "id",
		"`Warehouse`.`Warehouse`" => "Warehouse",
		"if(`Warehouse`.`Date`,date_format(`Warehouse`.`Date`,'%m/%d/%Y'),'')" => "Date",
		"`Warehouse`.`Freight`" => "Freight",
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array();

	$x->QueryFrom = "`Warehouse` ";
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
	$x->ScriptFileName = "Warehouse_view.php";
	$x->RedirectAfterInsert = "Warehouse_view.php?SelectedID=#ID#";
	$x->TableTitle = "WAREHOUSE";
	$x->TableIcon = "resources/table_icons/Warehouse.png";
	$x->PrimaryKey = "`Warehouse`.`id`";

	$x->ColWidth   = array(  150, 150, 150);
	$x->ColCaption = array("Warehouse", "Date", "Freight type");
	$x->ColFieldName = array('Warehouse', 'Date', 'Freight');
	$x->ColNumber  = array(2, 3, 4);

	// template paths below are based on the app main directory
	$x->Template = 'templates/Warehouse_templateTV.html';
	$x->SelectedTemplate = 'templates/Warehouse_templateTVS.html';
	$x->TemplateDV = 'templates/Warehouse_templateDV.html';
	$x->TemplateDVP = 'templates/Warehouse_templateDVP.html';

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
		$x->QueryWhere="where `Warehouse`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='Warehouse' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])) { // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `Warehouse`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='Warehouse' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3) { // view all
		// no further action
	}elseif($perm[2]==0) { // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`Warehouse`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: Warehouse_init
	$render=TRUE;
	if(function_exists('Warehouse_init')) {
		$args=array();
		$render=Warehouse_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: Warehouse_header
	$headerCode='';
	if(function_exists('Warehouse_header')) {
		$args=array();
		$headerCode=Warehouse_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode) {
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: Warehouse_footer
	$footerCode='';
	if(function_exists('Warehouse_footer')) {
		$args=array();
		$footerCode=Warehouse_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode) {
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>