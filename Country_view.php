<?php
// This script and data application were generated by AppGini 5.84
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/Country.php");
	include("$currDir/Country_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('Country');
	if(!$perm[0]) {
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "Country";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(
		"`Country`.`id`" => "id",
		"`Country`.`Country`" => "Country",
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(
		1 => '`Country`.`id`',
		2 => 2,
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(
		"`Country`.`id`" => "id",
		"`Country`.`Country`" => "Country",
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(
		"`Country`.`id`" => "ID",
		"`Country`.`Country`" => "Country",
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(
		"`Country`.`id`" => "id",
		"`Country`.`Country`" => "Country",
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array();

	$x->QueryFrom = "`Country` ";
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
	$x->ScriptFileName = "Country_view.php";
	$x->RedirectAfterInsert = "Country_view.php?SelectedID=#ID#";
	$x->TableTitle = "Country";
	$x->TableIcon = "table.gif";
	$x->PrimaryKey = "`Country`.`id`";

	$x->ColWidth   = array(  150);
	$x->ColCaption = array("Country");
	$x->ColFieldName = array('Country');
	$x->ColNumber  = array(2);

	// template paths below are based on the app main directory
	$x->Template = 'templates/Country_templateTV.html';
	$x->SelectedTemplate = 'templates/Country_templateTVS.html';
	$x->TemplateDV = 'templates/Country_templateDV.html';
	$x->TemplateDVP = 'templates/Country_templateDVP.html';

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
		$x->QueryWhere="where `Country`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='Country' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])) { // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `Country`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='Country' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3) { // view all
		// no further action
	}elseif($perm[2]==0) { // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`Country`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: Country_init
	$render=TRUE;
	if(function_exists('Country_init')) {
		$args=array();
		$render=Country_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: Country_header
	$headerCode='';
	if(function_exists('Country_header')) {
		$args=array();
		$headerCode=Country_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode) {
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: Country_footer
	$footerCode='';
	if(function_exists('Country_footer')) {
		$args=array();
		$footerCode=Country_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode) {
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>