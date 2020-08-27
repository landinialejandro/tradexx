<?php
// This script and data application were generated by AppGini 5.84
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/Compras.php");
	include("$currDir/Compras_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('Compras');
	if(!$perm[0]) {
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "Compras";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(
		"`Compras`.`id`" => "id",
		"IF(    CHAR_LENGTH(`Customers1`.`Customer`), CONCAT_WS('',   `Customers1`.`Customer`), '') /* Customer */" => "Customer",
		"IF(    CHAR_LENGTH(`Staff1`.`Employee`), CONCAT_WS('',   `Staff1`.`Employee`), '') /* Assigned */" => "Employee",
		"IF(    CHAR_LENGTH(`Products1`.`item`), CONCAT_WS('',   `Products1`.`item`), '') /* Description */" => "Description",
		"`Compras`.`Url`" => "Url",
		"`Compras`.`Total`" => "Total",
		"if(`Compras`.`Odate`,date_format(`Compras`.`Odate`,'%m/%d/%Y'),'')" => "Odate",
		"if(`Compras`.`ETA`,date_format(`Compras`.`ETA`,'%m/%d/%Y'),'')" => "ETA",
		"`Compras`.`Status`" => "Status",
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(
		1 => '`Compras`.`id`',
		2 => '`Customers1`.`Customer`',
		3 => '`Staff1`.`Employee`',
		4 => '`Products1`.`item`',
		5 => 5,
		6 => '`Compras`.`Total`',
		7 => '`Compras`.`Odate`',
		8 => '`Compras`.`ETA`',
		9 => 9,
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(
		"`Compras`.`id`" => "id",
		"IF(    CHAR_LENGTH(`Customers1`.`Customer`), CONCAT_WS('',   `Customers1`.`Customer`), '') /* Customer */" => "Customer",
		"IF(    CHAR_LENGTH(`Staff1`.`Employee`), CONCAT_WS('',   `Staff1`.`Employee`), '') /* Assigned */" => "Employee",
		"IF(    CHAR_LENGTH(`Products1`.`item`), CONCAT_WS('',   `Products1`.`item`), '') /* Description */" => "Description",
		"`Compras`.`Url`" => "Url",
		"`Compras`.`Total`" => "Total",
		"if(`Compras`.`Odate`,date_format(`Compras`.`Odate`,'%m/%d/%Y'),'')" => "Odate",
		"if(`Compras`.`ETA`,date_format(`Compras`.`ETA`,'%m/%d/%Y'),'')" => "ETA",
		"`Compras`.`Status`" => "Status",
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(
		"`Compras`.`id`" => "ID",
		"IF(    CHAR_LENGTH(`Customers1`.`Customer`), CONCAT_WS('',   `Customers1`.`Customer`), '') /* Customer */" => "Customer",
		"IF(    CHAR_LENGTH(`Staff1`.`Employee`), CONCAT_WS('',   `Staff1`.`Employee`), '') /* Assigned */" => "Assigned",
		"IF(    CHAR_LENGTH(`Products1`.`item`), CONCAT_WS('',   `Products1`.`item`), '') /* Description */" => "Description",
		"`Compras`.`Url`" => "URL",
		"`Compras`.`Total`" => "Total",
		"`Compras`.`Odate`" => "Order date",
		"`Compras`.`ETA`" => "ETA",
		"`Compras`.`Status`" => "Status",
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(
		"`Compras`.`id`" => "id",
		"IF(    CHAR_LENGTH(`Customers1`.`Customer`), CONCAT_WS('',   `Customers1`.`Customer`), '') /* Customer */" => "Customer",
		"IF(    CHAR_LENGTH(`Staff1`.`Employee`), CONCAT_WS('',   `Staff1`.`Employee`), '') /* Assigned */" => "Employee",
		"IF(    CHAR_LENGTH(`Products1`.`item`), CONCAT_WS('',   `Products1`.`item`), '') /* Description */" => "Description",
		"`Compras`.`Url`" => "Url",
		"`Compras`.`Total`" => "Total",
		"if(`Compras`.`Odate`,date_format(`Compras`.`Odate`,'%m/%d/%Y'),'')" => "Odate",
		"if(`Compras`.`ETA`,date_format(`Compras`.`ETA`,'%m/%d/%Y'),'')" => "ETA",
		"`Compras`.`Status`" => "Status",
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array('Customer' => 'Customer', 'Employee' => 'Assigned', 'Description' => 'Description', );

	$x->QueryFrom = "`Compras` LEFT JOIN `Customers` as Customers1 ON `Customers1`.`id`=`Compras`.`Customer` LEFT JOIN `Staff` as Staff1 ON `Staff1`.`id`=`Compras`.`Employee` LEFT JOIN `Products` as Products1 ON `Products1`.`id`=`Compras`.`Description` ";
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
	$x->ScriptFileName = "Compras_view.php";
	$x->RedirectAfterInsert = "Compras_view.php?SelectedID=#ID#";
	$x->TableTitle = "PURCHASE ORDERS";
	$x->TableIcon = "resources/table_icons/Products 1.png";
	$x->PrimaryKey = "`Compras`.`id`";

	$x->ColWidth   = array(  150, 150, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Customer", "Assigned", "Description", "Total", "Order date", "ETA", "Status");
	$x->ColFieldName = array('Customer', 'Employee', 'Description', 'Total', 'Odate', 'ETA', 'Status');
	$x->ColNumber  = array(2, 3, 4, 6, 7, 8, 9);

	// template paths below are based on the app main directory
	$x->Template = 'templates/Compras_templateTV.html';
	$x->SelectedTemplate = 'templates/Compras_templateTVS.html';
	$x->TemplateDV = 'templates/Compras_templateDV.html';
	$x->TemplateDVP = 'templates/Compras_templateDVP.html';

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
		$x->QueryWhere="where `Compras`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='Compras' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])) { // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `Compras`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='Compras' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3) { // view all
		// no further action
	}elseif($perm[2]==0) { // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`Compras`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: Compras_init
	$render=TRUE;
	if(function_exists('Compras_init')) {
		$args=array();
		$render=Compras_init($x, getMemberInfo(), $args);
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
				$QueryWhere = 'where `Compras`.`id` in ('.substr($QueryWhere, 0, -1).')';
			}else{ // if no selected records, write the where clause to return an empty result
				$QueryWhere = 'where 1=0';
			}
		}else{
			$QueryWhere = $x->QueryWhere;
		}

		$sumQuery = "select sum(`Compras`.`Total`) from {$x->QueryFrom} {$QueryWhere}";
		$res = sql($sumQuery, $eo);
		if($row = db_fetch_row($res)) {
			$sumRow = '<tr class="success">';
			if(!isset($_REQUEST['Print_x'])) $sumRow .= '<td class="text-center"><strong>&sum;</strong></td>';
			$sumRow .= '<td class="Compras-Customer"></td>';
			$sumRow .= '<td class="Compras-Employee"></td>';
			$sumRow .= '<td class="Compras-Description"></td>';
			$sumRow .= "<td class=\"Compras-Total text-right\">{$row[0]}</td>";
			$sumRow .= '<td class="Compras-Odate"></td>';
			$sumRow .= '<td class="Compras-ETA"></td>';
			$sumRow .= '<td class="Compras-Status"></td>';
			$sumRow .= '</tr>';

			$x->HTML = str_replace('<!-- tv data below -->', '', $x->HTML);
			$x->HTML = str_replace('<!-- tv data above -->', $sumRow, $x->HTML);
		}
	}

	// hook: Compras_header
	$headerCode='';
	if(function_exists('Compras_header')) {
		$args=array();
		$headerCode=Compras_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode) {
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: Compras_footer
	$footerCode='';
	if(function_exists('Compras_footer')) {
		$args=array();
		$footerCode=Compras_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode) {
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>