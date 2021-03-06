<?php
// This script and data application were generated by AppGini 5.84
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/Account.php");
	include("$currDir/Account_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('Account');
	if(!$perm[0]) {
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "Account";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(
		"`Account`.`id`" => "id",
		"`Account`.`Account`" => "Account",
		"`Account`.`code`" => "code",
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(
		1 => '`Account`.`id`',
		2 => 2,
		3 => 3,
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(
		"`Account`.`id`" => "id",
		"`Account`.`Account`" => "Account",
		"`Account`.`code`" => "code",
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(
		"`Account`.`id`" => "ID",
		"`Account`.`Account`" => "Account",
		"`Account`.`code`" => "Code",
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(
		"`Account`.`id`" => "id",
		"`Account`.`Account`" => "Account",
		"`Account`.`code`" => "code",
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array();

	$x->QueryFrom = "`Account` ";
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
	$x->RecordsPerPage = 10;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation["quick search"];
	$x->ScriptFileName = "Account_view.php";
	$x->RedirectAfterInsert = "Account_view.php?SelectedID=#ID#";
	$x->TableTitle = "ACCOUNT";
	$x->TableIcon = "table.gif";
	$x->PrimaryKey = "`Account`.`id`";

	$x->ColWidth   = array(  150, 150);
	$x->ColCaption = array("Account", "Code");
	$x->ColFieldName = array('Account', 'code');
	$x->ColNumber  = array(2, 3);

	// template paths below are based on the app main directory
	$x->Template = 'templates/Account_templateTV.html';
	$x->SelectedTemplate = 'templates/Account_templateTVS.html';
	$x->TemplateDV = 'templates/Account_templateDV.html';
	$x->TemplateDVP = 'templates/Account_templateDVP.html';

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
		$x->QueryWhere="where `Account`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='Account' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])) { // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `Account`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='Account' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3) { // view all
		// no further action
	}elseif($perm[2]==0) { // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`Account`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: Account_init
	$render=TRUE;
	if(function_exists('Account_init')) {
		$args=array();
		$render=Account_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: Account_header
	$headerCode='';
	if(function_exists('Account_header')) {
		$args=array();
		$headerCode=Account_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode) {
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: Account_footer
	$footerCode='';
	if(function_exists('Account_footer')) {
		$args=array();
		$footerCode=Account_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode) {
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>