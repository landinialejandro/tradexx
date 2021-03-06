<?php
// This script and data application were generated by AppGini 5.84
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/CustomerClass.php");
	include("$currDir/CustomerClass_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('CustomerClass');
	if(!$perm[0]) {
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "CustomerClass";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(
		"`CustomerClass`.`id`" => "id",
		"`CustomerClass`.`Type`" => "Type",
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(
		1 => '`CustomerClass`.`id`',
		2 => 2,
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(
		"`CustomerClass`.`id`" => "id",
		"`CustomerClass`.`Type`" => "Type",
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(
		"`CustomerClass`.`id`" => "ID",
		"`CustomerClass`.`Type`" => "Type",
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(
		"`CustomerClass`.`id`" => "id",
		"`CustomerClass`.`Type`" => "Type",
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array();

	$x->QueryFrom = "`CustomerClass` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm[2]==0 ? 1 : 0);
	$x->AllowDelete = $perm[4];
	$x->AllowMassDelete = false;
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
	$x->RecordsPerPage = 10;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation["quick search"];
	$x->ScriptFileName = "CustomerClass_view.php";
	$x->RedirectAfterInsert = "CustomerClass_view.php?SelectedID=#ID#";
	$x->TableTitle = "CUSTOMER TYPE";
	$x->TableIcon = "resources/table_icons/Customer type.png";
	$x->PrimaryKey = "`CustomerClass`.`id`";

	$x->ColWidth   = array(  150);
	$x->ColCaption = array("Type");
	$x->ColFieldName = array('Type');
	$x->ColNumber  = array(2);

	// template paths below are based on the app main directory
	$x->Template = 'templates/CustomerClass_templateTV.html';
	$x->SelectedTemplate = 'templates/CustomerClass_templateTVS.html';
	$x->TemplateDV = 'templates/CustomerClass_templateDV.html';
	$x->TemplateDVP = 'templates/CustomerClass_templateDVP.html';

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
		$x->QueryWhere="where `CustomerClass`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='CustomerClass' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])) { // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `CustomerClass`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='CustomerClass' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3) { // view all
		// no further action
	}elseif($perm[2]==0) { // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`CustomerClass`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: CustomerClass_init
	$render=TRUE;
	if(function_exists('CustomerClass_init')) {
		$args=array();
		$render=CustomerClass_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: CustomerClass_header
	$headerCode='';
	if(function_exists('CustomerClass_header')) {
		$args=array();
		$headerCode=CustomerClass_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode) {
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: CustomerClass_footer
	$footerCode='';
	if(function_exists('CustomerClass_footer')) {
		$args=array();
		$footerCode=CustomerClass_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode) {
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>