<?php
// This script and data application were generated by AppGini 5.84
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/Accounting.php");
	include("$currDir/Accounting_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('Accounting');
	if(!$perm[0]) {
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "Accounting";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(
		"`Accounting`.`id`" => "id",
		"if(`Accounting`.`date`,date_format(`Accounting`.`date`,'%m/%d/%Y'),'')" => "date",
		"`Accounting`.`description`" => "description",
		"IF(    CHAR_LENGTH(`MasterAccount1`.`masterAccount`), CONCAT_WS('',   `MasterAccount1`.`masterAccount`), '') /* Master account */" => "master_acount",
		"IF(    CHAR_LENGTH(`Account1`.`Account`), CONCAT_WS('',   `Account1`.`Account`), '') /* Account */" => "account",
		"IF(    CHAR_LENGTH(`SubAccount1`.`subAccount`), CONCAT_WS('',   `SubAccount1`.`subAccount`), '') /* Subaccount */" => "sub_account",
		"IF(, CONCAT_WS('', ), '') /* Type */" => "type",
		"FORMAT(`Accounting`.`amount`, 2)" => "amount",
		"`Accounting`.`balance`" => "balance",
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(
		1 => '`Accounting`.`id`',
		2 => '`Accounting`.`date`',
		3 => 3,
		4 => '`MasterAccount1`.`masterAccount`',
		5 => '`Account1`.`Account`',
		6 => '`SubAccount1`.`subAccount`',
		7 => "IF(, CONCAT_WS('', ), '') /* Type */",
		8 => '`Accounting`.`amount`',
		9 => '`Accounting`.`balance`',
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(
		"`Accounting`.`id`" => "id",
		"if(`Accounting`.`date`,date_format(`Accounting`.`date`,'%m/%d/%Y'),'')" => "date",
		"`Accounting`.`description`" => "description",
		"IF(    CHAR_LENGTH(`MasterAccount1`.`masterAccount`), CONCAT_WS('',   `MasterAccount1`.`masterAccount`), '') /* Master account */" => "master_acount",
		"IF(    CHAR_LENGTH(`Account1`.`Account`), CONCAT_WS('',   `Account1`.`Account`), '') /* Account */" => "account",
		"IF(    CHAR_LENGTH(`SubAccount1`.`subAccount`), CONCAT_WS('',   `SubAccount1`.`subAccount`), '') /* Subaccount */" => "sub_account",
		"IF(, CONCAT_WS('', ), '') /* Type */" => "type",
		"FORMAT(`Accounting`.`amount`, 2)" => "amount",
		"`Accounting`.`balance`" => "balance",
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(
		"`Accounting`.`id`" => "ID",
		"`Accounting`.`date`" => "Date",
		"`Accounting`.`description`" => "Description",
		"IF(    CHAR_LENGTH(`MasterAccount1`.`masterAccount`), CONCAT_WS('',   `MasterAccount1`.`masterAccount`), '') /* Master account */" => "Master account",
		"IF(    CHAR_LENGTH(`Account1`.`Account`), CONCAT_WS('',   `Account1`.`Account`), '') /* Account */" => "Account",
		"IF(    CHAR_LENGTH(`SubAccount1`.`subAccount`), CONCAT_WS('',   `SubAccount1`.`subAccount`), '') /* Subaccount */" => "Subaccount",
		"IF(, CONCAT_WS('', ), '') /* Type */" => "Type",
		"`Accounting`.`amount`" => "Amount",
		"`Accounting`.`balance`" => "Balance",
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(
		"`Accounting`.`id`" => "id",
		"if(`Accounting`.`date`,date_format(`Accounting`.`date`,'%m/%d/%Y'),'')" => "date",
		"`Accounting`.`description`" => "description",
		"IF(    CHAR_LENGTH(`MasterAccount1`.`masterAccount`), CONCAT_WS('',   `MasterAccount1`.`masterAccount`), '') /* Master account */" => "master_acount",
		"IF(    CHAR_LENGTH(`Account1`.`Account`), CONCAT_WS('',   `Account1`.`Account`), '') /* Account */" => "account",
		"IF(    CHAR_LENGTH(`SubAccount1`.`subAccount`), CONCAT_WS('',   `SubAccount1`.`subAccount`), '') /* Subaccount */" => "sub_account",
		"IF(, CONCAT_WS('', ), '') /* Type */" => "type",
		"FORMAT(`Accounting`.`amount`, 2)" => "amount",
		"`Accounting`.`balance`" => "balance",
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array('master_acount' => 'Master account', 'account' => 'Account', 'sub_account' => 'Subaccount', );

	$x->QueryFrom = "`Accounting` LEFT JOIN `MasterAccount` as MasterAccount1 ON `MasterAccount1`.`id`=`Accounting`.`master_acount` LEFT JOIN `Account` as Account1 ON `Account1`.`id`=`Accounting`.`account` LEFT JOIN `SubAccount` as SubAccount1 ON `SubAccount1`.`id`=`Accounting`.`sub_account` ";
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
	$x->ScriptFileName = "Accounting_view.php";
	$x->RedirectAfterInsert = "Accounting_view.php?SelectedID=#ID#";
	$x->TableTitle = "CASH FLOW";
	$x->TableIcon = "resources/table_icons/Cashflow.png";
	$x->PrimaryKey = "`Accounting`.`id`";

	$x->ColWidth   = array(  150, 150, 150, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Date", "Description", "Master account", "Account", "Subaccount", "Type", "Amount", "Balance");
	$x->ColFieldName = array('date', 'description', 'master_acount', 'account', 'sub_account', 'type', 'amount', 'balance');
	$x->ColNumber  = array(2, 3, 4, 5, 6, 7, 8, 9);

	// template paths below are based on the app main directory
	$x->Template = 'templates/Accounting_templateTV.html';
	$x->SelectedTemplate = 'templates/Accounting_templateTVS.html';
	$x->TemplateDV = 'templates/Accounting_templateDV.html';
	$x->TemplateDVP = 'templates/Accounting_templateDVP.html';

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
		$x->QueryWhere="where `Accounting`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='Accounting' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])) { // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `Accounting`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='Accounting' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3) { // view all
		// no further action
	}elseif($perm[2]==0) { // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`Accounting`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: Accounting_init
	$render=TRUE;
	if(function_exists('Accounting_init')) {
		$args=array();
		$render=Accounting_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// column sums
	if(strpos($x->HTML, '<!-- tv data below -->')) {
		// if printing multi-selection TV, calculate the sum only for the selected records
		if(isset($_REQUEST['Print_x']) && is_array($_REQUEST['record_selector'])) {
			$QueryWhere = '';
			foreach($_REQUEST['record_selector'] as $id) {   // get selected records
				if($id != '') $QueryWhere .= "'" . makeSafe($id) . "',";
			}
			if($QueryWhere != '') {
				$QueryWhere = 'where `Accounting`.`id` in ('.substr($QueryWhere, 0, -1).')';
			}else{ // if no selected records, write the where clause to return an empty result
				$QueryWhere = 'where 1=0';
			}
		}else{
			$QueryWhere = $x->QueryWhere;
		}

		$sumQuery = "select FORMAT(sum(`Accounting`.`amount`), 2), sum(`Accounting`.`balance`) from {$x->QueryFrom} {$QueryWhere}";
		$res = sql($sumQuery, $eo);
		if($row = db_fetch_row($res)) {
			$sumRow = '<tr class="success">';
			if(!isset($_REQUEST['Print_x'])) $sumRow .= '<td class="text-center"><strong>&sum;</strong></td>';
			$sumRow .= '<td class="Accounting-date"></td>';
			$sumRow .= '<td class="Accounting-description"></td>';
			$sumRow .= '<td class="Accounting-master_acount"></td>';
			$sumRow .= '<td class="Accounting-account"></td>';
			$sumRow .= '<td class="Accounting-sub_account"></td>';
			$sumRow .= '<td class="Accounting-type"></td>';
			$sumRow .= "<td class=\"Accounting-amount text-right\">{$row[0]}</td>";
			$sumRow .= "<td class=\"Accounting-balance text-right\">{$row[1]}</td>";
			$sumRow .= '</tr>';

			$x->HTML = str_replace('<!-- tv data below -->', '', $x->HTML);
			$x->HTML = str_replace('<!-- tv data above -->', $sumRow, $x->HTML);
		}
	}

	// hook: Accounting_header
	$headerCode='';
	if(function_exists('Accounting_header')) {
		$args=array();
		$headerCode=Accounting_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode) {
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: Accounting_footer
	$footerCode='';
	if(function_exists('Accounting_footer')) {
		$args=array();
		$footerCode=Accounting_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode) {
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>