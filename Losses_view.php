<?php
// This script and data application were generated by AppGini 5.84
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/Losses.php");
	include("$currDir/Losses_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('Losses');
	if(!$perm[0]) {
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "Losses";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(
		"`Losses`.`id`" => "id",
		"IF(    CHAR_LENGTH(`Customers1`.`Customer`), CONCAT_WS('',   `Customers1`.`Customer`), '') /* Customer */" => "Customer",
		"`Losses`.`Description`" => "Description",
		"`Losses`.`Saleprice`" => "Saleprice",
		"`Losses`.`OperationCost`" => "OperationCost",
		"`Losses`.`Lost`" => "Lost",
		"`Losses`.`Comment`" => "Comment",
		"`Losses`.`Recovered`" => "Recovered",
		"`Losses`.`Balance`" => "Balance",
		"`Losses`.`Status`" => "Status",
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(
		1 => '`Losses`.`id`',
		2 => '`Customers1`.`Customer`',
		3 => 3,
		4 => '`Losses`.`Saleprice`',
		5 => '`Losses`.`OperationCost`',
		6 => '`Losses`.`Lost`',
		7 => 7,
		8 => '`Losses`.`Recovered`',
		9 => '`Losses`.`Balance`',
		10 => 10,
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(
		"`Losses`.`id`" => "id",
		"IF(    CHAR_LENGTH(`Customers1`.`Customer`), CONCAT_WS('',   `Customers1`.`Customer`), '') /* Customer */" => "Customer",
		"`Losses`.`Description`" => "Description",
		"`Losses`.`Saleprice`" => "Saleprice",
		"`Losses`.`OperationCost`" => "OperationCost",
		"`Losses`.`Lost`" => "Lost",
		"`Losses`.`Comment`" => "Comment",
		"`Losses`.`Recovered`" => "Recovered",
		"`Losses`.`Balance`" => "Balance",
		"`Losses`.`Status`" => "Status",
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(
		"`Losses`.`id`" => "ID",
		"IF(    CHAR_LENGTH(`Customers1`.`Customer`), CONCAT_WS('',   `Customers1`.`Customer`), '') /* Customer */" => "Customer",
		"`Losses`.`Description`" => "Description",
		"`Losses`.`Saleprice`" => "Sale price",
		"`Losses`.`OperationCost`" => "Operation cost",
		"`Losses`.`Lost`" => "Amount Lost",
		"`Losses`.`Comment`" => "Comment",
		"`Losses`.`Recovered`" => "Amount recovered",
		"`Losses`.`Balance`" => "Balance",
		"`Losses`.`Status`" => "Status",
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(
		"`Losses`.`id`" => "id",
		"IF(    CHAR_LENGTH(`Customers1`.`Customer`), CONCAT_WS('',   `Customers1`.`Customer`), '') /* Customer */" => "Customer",
		"`Losses`.`Description`" => "Description",
		"`Losses`.`Saleprice`" => "Saleprice",
		"`Losses`.`OperationCost`" => "OperationCost",
		"`Losses`.`Lost`" => "Lost",
		"`Losses`.`Comment`" => "Comment",
		"`Losses`.`Recovered`" => "Recovered",
		"`Losses`.`Balance`" => "Balance",
		"`Losses`.`Status`" => "Status",
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array('Customer' => 'Customer', );

	$x->QueryFrom = "`Losses` LEFT JOIN `Customers` as Customers1 ON `Customers1`.`id`=`Losses`.`Customer` ";
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
	$x->RecordsPerPage = 300;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation["quick search"];
	$x->ScriptFileName = "Losses_view.php";
	$x->RedirectAfterInsert = "Losses_view.php?SelectedID=#ID#";
	$x->TableTitle = "LOSSES";
	$x->TableIcon = "resources/table_icons/Losses.png";
	$x->PrimaryKey = "`Losses`.`id`";

	$x->ColWidth   = array(  150, 150, 150, 150, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Customer", "Description", "Sale price", "Operation cost", "Amount Lost", "Comment", "Amount recovered", "Balance", "Status");
	$x->ColFieldName = array('Customer', 'Description', 'Saleprice', 'OperationCost', 'Lost', 'Comment', 'Recovered', 'Balance', 'Status');
	$x->ColNumber  = array(2, 3, 4, 5, 6, 7, 8, 9, 10);

	// template paths below are based on the app main directory
	$x->Template = 'templates/Losses_templateTV.html';
	$x->SelectedTemplate = 'templates/Losses_templateTVS.html';
	$x->TemplateDV = 'templates/Losses_templateDV.html';
	$x->TemplateDVP = 'templates/Losses_templateDVP.html';

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
		$x->QueryWhere="where `Losses`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='Losses' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])) { // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `Losses`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='Losses' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3) { // view all
		// no further action
	}elseif($perm[2]==0) { // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`Losses`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: Losses_init
	$render=TRUE;
	if(function_exists('Losses_init')) {
		$args=array();
		$render=Losses_init($x, getMemberInfo(), $args);
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
				$QueryWhere = 'where `Losses`.`id` in ('.substr($QueryWhere, 0, -1).')';
			}else{ // if no selected records, write the where clause to return an empty result
				$QueryWhere = 'where 1=0';
			}
		}else{
			$QueryWhere = $x->QueryWhere;
		}

		$sumQuery = "select sum(`Losses`.`Saleprice`), sum(`Losses`.`OperationCost`), sum(`Losses`.`Lost`), sum(`Losses`.`Recovered`), sum(`Losses`.`Balance`) from {$x->QueryFrom} {$QueryWhere}";
		$res = sql($sumQuery, $eo);
		if($row = db_fetch_row($res)) {
			$sumRow = '<tr class="success">';
			if(!isset($_REQUEST['Print_x'])) $sumRow .= '<td class="text-center"><strong>&sum;</strong></td>';
			$sumRow .= '<td class="Losses-Customer"></td>';
			$sumRow .= '<td class="Losses-Description"></td>';
			$sumRow .= "<td class=\"Losses-Saleprice text-right\">{$row[0]}</td>";
			$sumRow .= "<td class=\"Losses-OperationCost text-right\">{$row[1]}</td>";
			$sumRow .= "<td class=\"Losses-Lost text-right\">{$row[2]}</td>";
			$sumRow .= '<td class="Losses-Comment"></td>';
			$sumRow .= "<td class=\"Losses-Recovered text-right\">{$row[3]}</td>";
			$sumRow .= "<td class=\"Losses-Balance text-right\">{$row[4]}</td>";
			$sumRow .= '<td class="Losses-Status"></td>';
			$sumRow .= '</tr>';

			$x->HTML = str_replace('<!-- tv data below -->', '', $x->HTML);
			$x->HTML = str_replace('<!-- tv data above -->', $sumRow, $x->HTML);
		}
	}

	// hook: Losses_header
	$headerCode='';
	if(function_exists('Losses_header')) {
		$args=array();
		$headerCode=Losses_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode) {
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: Losses_footer
	$footerCode='';
	if(function_exists('Losses_footer')) {
		$args=array();
		$footerCode=Losses_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode) {
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>